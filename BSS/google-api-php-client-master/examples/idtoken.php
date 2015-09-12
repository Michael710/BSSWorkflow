<?php
/*
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the  specific language governing permissions and
 * limitations under the License.
 */
include_once "templates/base.php";
session_start();

require_once realpath(dirname(__FILE__) . '/../src/Google/autoload.php');

require_once '../src/Google/Service/Oauth2.php';

require_once '../src/Google/Client.php';


/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
 ************************************************/
$client_id = '324261092842-2td2v8j1kilsfg9qbsnb302dj8t9ncmu.apps.googleusercontent.com';
$client_secret = 'Ybcl9-5KK4cWppYuwFJ8xRy7';
$redirect_uri = 'http://www.bssdevelopment.com/google/google-api-php-client-master/examples/idtoken.php';

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
//$client->setScopes('email');

$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile','https://www.googleapis.com/auth/drive'));


// you can access the properties of the object thru the "->"
//echo $object->email; // mona123.janorkar@gmail.com

   // $myfile = fopen('testfile.txt', "w");  
   // $txt = $object->email;
   // fwrite($myfile, $txt . 'ZZZ');
   // fclose($myfile);


try {
 echo '1';
//$me = $plus->people->get("me");
 echo '2';

} catch (Exception $e) {
 echo '3';
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


  // $user = $object->userinfo->get();

//$correo = ($me['emails'][0]['value']);
     echo '4';
//fwrite($myfile, $correo);
//    fclose($myfile);
    


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
  
      
  //  $txt = "JIM ZZXXXZ  Doe\n";
  //  fwrite($myfile, $txt);
 //   fclose($myfile);
  
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  
 // $me = $plus->people->get("me");

 //   $plus = new Google_Service_Oauth2($client);
 //   $Google_Service_Oauth2_Tokeninfo = new Google_Service_Oauth2_Tokeninfo($plus);
 //   echo $Google_Service_Oauth2_Tokeninfo->getEmail();


 //   $myfile = fopen('testfile.txt', "w");
  //  $txt = "Jane dfsf adf Doe";
  //  fwrite($myfile, $txt);
  //  fclose($myfile);
  
  $client->setAccessToken($_SESSION['access_token']);
  
 // $me = $plus->people->get("me");
    

  
} else {
  $authUrl = $client->createAuthUrl();

  //  $myfile = fopen('testfile.txt', "w");
  //  $txt = "auth url";
  //  fwrite($myfile, $txt);
  //  fclose($myfile);
  
  
   // $me = $plus->people->get("me");
  
  
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

    $myfile = fopen('testfile.txt', "w");
    $txt = "We are logged in?";
    fwrite($myfile, $txt);
    fclose($myfile);

  $_SESSION['access_token'] = $client->getAccessToken();
  $token_data = $client->verifyIdToken()->getAttributes();







}

echo pageHeader("User Query - Retrieving An Id TokenZZZ");
if (strpos($client_id, "googleusercontent") == false) {
  echo missingClientSecretsWarning();
  exit;
}

?>
<div class="box">
  <div class="request">
<?php
if (isset($authUrl)) {
   echo "<a class='login' href='" . $authUrl . "'>Conewsanect Me!</a>"; 

  /*echo $authUrl;

	
   $ch = curl_init($authUrl);
  curl_exec($ch);  */
  
} else {
  echo "<a class='logout' href='?logout'>Logout</a>";
}
?>
  </div>

<div class="data">
<?php 
if (isset($token_data)) {

    echo 'ZZZ';

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



// Get the API client and construct the service object.
    $service = new Google_Service_Drive($client);
// Print the names and IDs for up to 10 files.
    $optParams = array(
        'maxResults' => 10,
    );


    $results = $service->files->listFiles();


    if (count($results->getItems()) == 0) {
        print "No files found.\n";
    } else {
        print "Files:\n";
        foreach ($results->getItems() as $file) {
 //           printf("%s (%s)\n", $file->getTitle(), $file->getId(), "<br>");
             printf("%s (%s)\n", $file->getTitle(), "<br>");
        }
    }







}
?>
  </div>
</div>
<?php
echo pageFooter(__FILE__);
