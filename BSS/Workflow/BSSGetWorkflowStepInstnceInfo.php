<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 9/26/12
 * Time: 10:18 PM
 * To change this template use File | Settings | File Templates.
 */


include '../DBServices/BSSSQLOperation.php';

//sleep(1);



$Masterid = '0'; //$_GET['BSSMasterId'];
$name = $_GET["name"];
$statustype = $_GET["statustype"];
$xloc = $_GET["xloc"];
$yloc = $_GET["yloc"];
$WorkflowId = $_GET["BSSWorkflowId"];


//echo "Workflowid Is: " . $WorkflowId;


$masterid = $_GET["BSSMasterId"];
$EnterpriseObjectId = $_GET["BSSEnterpriseObjectId"];
$userid = $_GET["BSSUserId"];
$revision = $_GET["BSSRevision"];
$version = "1";

//Add workflow id

//$sqlvalues =  "'" . $WorkflowId . "','" . "0" . "','" . $Masterid . "','" . $name . "','" . $statustype . "','" . $xloc . "','" . $yloc . "')";
$sqlstring = "SELECT Completed FROM AdvWorkflowStepInstance WHERE id = " . $WorkflowId;
echo $sqlstring;
$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DB) or die(mysql_error());
$result = mysql_query($SQLString);
   echo 'here';
$row = mysql_fetch_array($result, MYSQL_NUM);

echo $row[1];