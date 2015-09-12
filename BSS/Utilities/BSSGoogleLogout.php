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

/* get the Setup */
$SQLSTRING = "SELECT id,googleclientid,googleclientsecret,googleredirecturl" . " FROM Setup";
$result = mysql_query($SQLSTRING);
$row = mysql_fetch_array($result, MYSQL_NUM);
$googleclientid  = $row[1];
$googleclientsecret = $row[2];
$googleredirecturl  = $row[3];

$client = new Google_Client();
$client->setClientId($googleclientid);
$client->setClientSecret($googleclientsecret);
$client->setRedirectUri($googleredirecturl);

$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile','https://www.googleapis.com/auth/drive'));

/************************************************
  If we're logging out we just need to clear our
  local access token in this case
 ***********************************************/
 
unset($_SESSION['access_token']);

?>
