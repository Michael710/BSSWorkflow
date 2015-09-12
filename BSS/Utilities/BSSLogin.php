<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 4/7/12
 * Time: 12:39 PM
 * To change this template use File | Settings | File Templates.
 */

include "../DBServices/BSSSQLConfig.php";
include "../DBServices/BSSSQLOperation.php";

//include_once "templates/base.php";
require_once realpath(dirname(__FILE__) . '/../google-api-php-client-master/src/Google/autoload.php');
require_once '../google-api-php-client-master/src/Google/Service/Oauth2.php';
require_once '../google-api-php-client-master/src/Google/Client.php';

session_start();

$UserName = $_GET['BSSUserName'];
$Password = $_GET['BSSPassword'];

$UserName = 'mike';
$Password = 'test';

mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DB) or die(mysql_error());

//get the LDAP Setup
$SQLSTRING = "SELECT id,EnableLDAP,ldaphost,ldapdn,ldapusergroup,ldapmanagergroup,ldapuserdomain,googleclientid,googleclientsecret,googleredirecturl" . " FROM Setup";

//echo $SQLSTRING;

$result = mysql_query($SQLSTRING);
$row = mysql_fetch_array($result, MYSQL_NUM);
$EnableLDAP  = $row[1];
$ldaphost = $row[2];
$ldapdn  = $row[3];
$ldapusergroup  = $row[4];
$ldapmanagergroup  = $row[5];
$ldapuserdomain  = $row[6];
$googleclientid  = $row[7];
$googleclientsecret = $row[8];
$googleredirecturl  = $row[9];

if($EnableLDAP==1){   // Login with LDAP
    $Login = authenticate($UserName,$Password,$ldaphost,$ldapdn,$ldapusergroup,$ldapmanagergroup,$ldapuserdomain);
}

if($Login == false & $EnableLDAP==1){  // LDAP Login Failed
    $UserId = "";
    echo $UserId;
    return;
}

//$client_id = '324261092842-2td2v8j1kilsfg9qbsnb302dj8t9ncmu.apps.googleusercontent.com';
//$client_secret = 'eEdWqYwv3Oza3_A8X0JVQR8q';
//$redirect_uri = 'http://localhost:8888/google/google-api-php-client-master/examples/idtoken.php';
//$redirect_uri = 'http://localhost:8888/BSSADVWF/BSS/Utilities/BSSGoogleLoginComplete.php';
//$client = new Google_Client();
//$client->setClientId($client_id);
//$client->setClientSecret($client_secret);
//$client->setRedirectUri($redirect_uri);
//$client->setScopes('email');

$client = new Google_Client();
$client->setClientId($googleclientid);
$client->setClientSecret($googleclientsecret);
$client->setRedirectUri($googleredirecturl);

//echo 'CLIENT ID: ' . $googleclientid;
//echo 'SECRET: ' . $googleclientsecret;
//echo 'REDIRECTURL: ' . $googleredirecturl;

$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile','https://www.googleapis.com/auth/drive'));

/************************************************
  If we're logging out we just need to clear our
  local access token in this case
 ************************************************/
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
 ************************************************/
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) { 	
  $client->setAccessToken($_SESSION['access_token']); 
  //if here we do not need to authenticate
  
} else {
  $authUrl = $client->createAuthUrl();

  echo $authUrl;
  
  return;
  
}

/************************************************
  If we're signed in we can go ahead and retrieve
  the ID token, which is part of the bundle of
  data that is exchange in the authenticate step
  - we only need to do a network call if we have
  to retrieve the Google certificate to verify it,
  and that can be cached.
 ************************************************/
if ($client->getAccessToken()) {

  $_SESSION['access_token'] = $client->getAccessToken();
  $token_data = $client->verifyIdToken()->getAttributes();

}


if (isset($authUrl)) {
  //echo "<a class='login' href='" . $authUrl . "'>Conewsanect Me!</a>"; 
  //echo $authUrl;	
  $ch = curl_init($authUrl);
  curl_exec($ch);  
  
} else {
  //echo "logged In";
  // We Have a session so do a DB login

	if($EnableLDAP==0 || $Login == true){
		mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
		mysql_select_db(DB) or die(mysql_error());
		$result = mysql_query("SELECT id, AdminUser FROM users WHERE Login = '" . $UserName . "' AND password = '" .  $Password . "'");
		$row = mysql_fetch_assoc($result);
		$UserId = $row["id"];
		$AdminUser = $row["AdminUser"];
		$_SESSION['BSSUserId'] = $UserId;
		$_SESSION['BSSAdminUser'] = $AdminUser;
		echo $UserId;
	}

}





function authenticate($user,$password,$ldaphost,$ldapdn,$ldapusergroup,$ldapmanagergroup,$ldapuserdomain) {
    // Active Directory server
    $ldap_host = $ldaphost;

    // Active Directory DN
    $ldap_dn = $ldapdn; //"OU=Departments,DC=college,DC=school,DC=edu";

    // Active Directory user group
    $ldap_user_group = $ldapusergroup; //"WebUsers";

    // Active Directory manager group
    $ldap_manager_group = $ldapmanagergroup; //"WebManagers";

    // Domain, for purposes of constructing $user
    $ldap_usr_dom = $ldapuserdomain; //"@college.school.edu";

    // connect to active directory
    $ldap = ldap_connect($ldap_host);

    // verify user and password
    if($bind = @ldap_bind($ldap, $user . $ldap_usr_dom, $password)) {
        // valid
        // check presence in groups
        $filter = "(sAMAccountName=" . $user . ")";
        $attr = array("memberof");
        $result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
        $entries = ldap_get_entries($ldap, $result);
        ldap_unbind($ldap);

        // check groups
        foreach($entries[0]['memberof'] as $grps) {
            // is manager, break loop
            if (strpos($grps, $ldap_manager_group)) { $access = 2; break; }

            // is user
            if (strpos($grps, $ldap_user_group)) $access = 1;
        }

        if ($access != 0) {
            // establish session variables
            $_SESSION['user'] = $user;
            $_SESSION['access'] = $access;
            return true;
        } else {
            // user has no rights
            return false;
        }

    } else {
        // invalid name or password
        return false;
    }
}

?>
