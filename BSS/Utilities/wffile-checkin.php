<?php

include 'BSSSQLOperation.php';

sleep(1);

$tmp_name = $_FILES["ContentFileName"]["tmp_name"];
    $name = $_FILES["ContentFileName"]["name"];
//$documentdesc = $_REQUEST["txtdescription"];
//$documentname = $_REQUEST["txtfilename"];
//$revision = $_REQUEST["txtrevision"];

$masterid = $_GET["BSSMasterId"];
//$userid = $_GET["BSSUserId"];

$version = 0;

//Get last version

$myFile = "debugFile.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh,'Here1');

//$sqlstring = "SELECT documentversion FROM Documents WHERE id = ". $masterid;
//echo $sqlstring;

fwrite($fh,'here i am');

fwrite($fh,$tmp_name);

fwrite($fh,$name);


//$version = PerformSQLGetVal($sqlstring);
//$newversion = $version + 1;
//fwrite($fh,$newversion);
//echo $newversion;
//$sqlstring = "update Documents set documentuser = " . $userid . ",documentdate = " . "now()" . ",documentname = '" . $documentname . "',documentdescription = '" . $documentdesc  . "',filename = '" . $name . "',documentrevision = '" . $revision . "',documentversion = '" . $newversion . "', checkoutuser = null WHERE id = ". $masterid;
//echo $sqlstring;
//fwrite($fh,$sqlstring);
//$LastId = PerformSQLOperation($sqlstring);
//$sqlvalues =  "'" . $masterid . "','" . $userid . "'," . "now()" . ",'" . $documentname . "','" .  $documentdesc  . "','" .  $name .   "','" .  $revision . "','" .  $newversion . "')";
//$sqlstring = "insert into DocumentVersions(masterid,documentuser,documentdate,documentname,documentdescription,filename, documentrevision, documentversion)values(" . $sqlvalues;
//echo $sqlstring;
//fwrite($fh,$sqlstring);
//$VersionId = PerformSQLOperation($sqlstring);

move_uploaded_file($tmp_name, $masterid.$name);

fclose($fh);

echo  '{success:true, file:'.json_encode($_FILES['ContentFileName']['name']).'}';
?>