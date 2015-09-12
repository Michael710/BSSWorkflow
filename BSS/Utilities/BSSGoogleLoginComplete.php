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

require_once realpath(dirname(__FILE__) . '/../google-api-php-client-master/src/Google/autoload.php');
require_once '../google-api-php-client-master/src/Google/Service/Oauth2.php';
require_once '../google-api-php-client-master/src/Google/Client.php';

session_start();

mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DB) or die(mysql_error());

/* get the Setup */
$SQLSTRING = "SELECT id,googleclientid,googleclientsecret,googleredirecturl" . " FROM Setup";
$result = mysql_query($SQLSTRING);
$row = mysql_fetch_array($result, MYSQL_NUM);
$googleclientid  = $row[1];
$googleclientsecret = $row[2];
$googleredirecturl  = $row[3];

//echo $googleclientid;
//echo $googleclientsecret;
//echo $googleredirecturl;
//$client_id = '324261092842-2td2v8j1kilsfg9qbsnb302dj8t9ncmu.apps.googleusercontent.com';
//$client_secret = 'eEdWqYwv3Oza3_A8X0JVQR8q';
//$redirect_uri = 'http://localhost:8888/google/google-api-php-client-master/examples/idtoken.php';
//$redirect_uri = 'http://localhost:8888/BSSADVWF/BSS/Utilities/BSSGoogleLoginComplete.php';

$client = new Google_Client();
$client->setClientId($googleclientid);
$client->setClientSecret($googleclientsecret);
$client->setRedirectUri($googleredirecturl);
//$client->setScopes('email');

$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile','https://www.googleapis.com/auth/drive'));

 
 if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

$client->setAccessToken($_SESSION['access_token']); 
echo 'You are logged into Google.'; 

  //echo "<a class='logout' href='?logout'>Logout</a>";



  



?>
