<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 6/25/12
 * Time: 8:24 AM
 * To change this template use File | Settings | File Templates.
 */

include 'BSSSQLOperation.php';


/*
sleep(1);

$tmp_name = $_FILES["photo-path"]["tmp_name"];
$name = $_FILES["photo-path"]["name"];
$documentdesc = $_REQUEST["txtdescription"];
$documentname = $_REQUEST["txtfilename"];

$masterid = $_GET["BSSMasterId"];
$userid = $_GET["BSSUserId"];
$revision = $_GET["BSSRevision"];
$version = "1";
  */

//Get last version


$sqlstring = "SELECT documentversion " . "FROM" . " Documents WHERE id = 1";

$result = PerformSQLGetVal($sqlstring);

echo $result;

