<?php

include 'BSSSQLOperation.php';

sleep(1);

$tmp_name = $_FILES["photo-path"]["tmp_name"];
    $name = $_FILES["photo-path"]["name"];
$documentdesc = $_REQUEST["txtdescription"];
$documentname = $_REQUEST["txtfilename"];

$masterid = $_GET["BSSMasterId"];
$EnterpriseObjectId = $_GET["BSSEnterpriseObjectId"];
$userid = $_GET["BSSUserId"];
$revision = $_GET["BSSRevision"];
$version = "1";

$sqlvalues =  "'" . $EnterpriseObjectId . "','" . $masterid . "','" . $userid . "'," . "now()" . ",'" . $documentname . "','" .  $documentdesc  . "','" .  $name .   "','" .  $revision . "','" .  $version . "')";
$sqlstring = "insert into Documents(sequence,masterid,documentuser,documentdate,documentname,documentdescription,filename, documentrevision, documentversion)values(" . $sqlvalues;

//echo $sqlstring;

$LastId = PerformSQLOperation($sqlstring);

move_uploaded_file($tmp_name, $LastId.$version.$name);

echo  '{success:true, file:'.json_encode($_FILES['photo-path']['name']).'}';

?>