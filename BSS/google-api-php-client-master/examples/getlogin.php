<?php

session_start();

echo "made it here1";


include_once "templates/base.php";

require_once realpath(dirname(__FILE__) . '/../src/Google/autoload.php');

require_once '../src/Google/Service/Oauth2.php';
require_once '../src/Google/Service/Plus.php';
require_once '../src/Google/Client.php';


/************************************************
ATTENTION: Fill in these values! Make sure
the redirect URI is to this page, e.g:
 ************************************************/
$client_id = '324261092842-2td2v8j1kilsfg9qbsnb302dj8t9ncmu.apps.googleusercontent.com';
$client_secret = 'xev1oYs7FO6AT_NTY_XqjvSa';
$redirect_uri = 'http://www.bssdevelopment.com//google/google-api-php-client-master/examples/getlogin.php';
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);

$user_email = '';
//$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile','https://www.googleapis.com/auth/plus.login'));
$client->setScopes(array('https://www.googleapis.com/auth/plus.login','https://www.googleapis.com/auth/drive.apps.readonly'));


echo "made it here2A";

echo $_GET['access_token'];

if (isset($_GET['code'])) {
    echo "made it her3A";
    $client->authenticate($_GET['code']);
    echo "made it her3B";
    $_SESSION['access_token'] = $client->getAccessToken();
    echo "made it her3C";
    echo $_SESSION['access_token'];
  //  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  //  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}


/************************************************
If we have an access token, we can make
requests, else we generate an error
 ************************************************/

try {
    echo '1';
//$me = $plus->people->get("me");
    echo '2';

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    echo "made it here3";
    $client->setAccessToken($_SESSION['access_token']);
    if ($_SESSION['access_token']) {
        echo "made it here4";
        $client->setAccessToken($_SESSION['access_token']);
        echo "made it here5";
        $PlusService = new Google_Service_Plus($client);
        echo "made it here6";
        $me = new Google_Service_Plus_Person();
        echo "made it here7";
        $me = $PlusService->people->get('me');
        echo "made it here8";
        $PlusPersonEMails = new Google_Service_Plus_PersonEmails();
        echo "made it here9";
        $PlusPersonEMails = $me->getEmails();
        echo "made it here10" . $PlusPersonEMails[0]->value;



        $service = new \Google_Service_Drive($client);

        /*
         * Find the certain file
         */
        foreach ($service->files->listFiles()->getItems() as $item) {
            /**
             * @var \Google_Service_Drive_DriveFile $item
             */

                   echo $item->getTitle();

            /*
            if ($item->getTitle() == 'test.txt') {
                $sUrl = $item->getDownloadUrl();

\
                $request = new \Google_Http_Request($sUrl, 'GET', null, null);
                $httpRequest = $client->getIo()->executeRequest($request);

                if ($httpRequest->getResponseHttpCode() == 200) {
                    echo $httpRequest->getResponseBody();

                    exit();
                } else {
\
                    return null;
                }
            }
            */


        }




























 //       echo "made it here10A";
 //       foreach($PlusPersonEMails as $em) {
          //  if($em->type == "account") {
 //               $user_email = $em->value;
 //               echo $user_email;
          //  }
 //       }

//        $PlusPersonName = new Google_Service_Plus_PersonName();
//        $PlusPersonName = $me->getName();
//        $PlusPersonImage = new Google_Service_Plus_PersonImage();
//        $PlusPersonImage = $me->getImage();
//        echo $me->getName();
//        echo "made it here11";
//        $user_id = $me->id;
//        echo $user_id;
//        $user_name = filter_var($me->displayName, FILTER_SANITIZE_SPECIAL_CHARS);
//        $user_gender = substr($me->gender,0,1);
//        $profile_url = $me->url;
//        $profile_image_url = filter_var($PlusPersonImage->getUrl(), FILTER_VALIDATE_URL);
//        $parsed_url = parse_url($profile_image_url);
//        $ImgResized	= $parsed_url['scheme']
//            . '://' . $parsed_url["host"]
//            . $parsed_url["path"]
//            . '?sz=25';
//        $given_name	= filter_var($PlusPersonName->getGivenName(), FILTER_SANITIZE_SPECIAL_CHARS);
//        $_SESSION['token'] = $client->getAccessToken();
//        $_SESSION['givenName'] = $given_name;
//        $_SESSION['Name'] = $user_name;
//        $_SESSION['id'] = $user_id;
//        $_SESSION['photo'] = $ImgResized;
//        $_SESSION['profileURL'] = $profile_url;
//        $_session['gender'] = $user_gender;
//        $_session['email'] = $user_email;

//        echo $user_email;

 // 	echo '<div id="gPlusNav">
//			<a href="https://plus.google.com/u/0/">+' . $_SESSION['givenName']. </a> '
//			<a href="' . $_SESSION['profileURL'] . '" class="dropdown-toggle" data-toggle="dropdown">
//			<img src="../img/gphotocache.png" style="background:url(''. $_SESSION['photo'] . '');"></a>
//			<a onclick="gvnSignOut(); return false;"
//					href="#">Disconnect me</a>
//			<a onclick="revokeAccess(); return false;"
//					href="#">Remove my consent</a>
//		</div>';
  } else {
        echo "HTTP/1.1 401 Bad token";
        exit;
    }
} else {
    echo "HTTP/1.2 401 Bad token";
}


} catch (Exception $e) {
    echo '3';
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


?>
