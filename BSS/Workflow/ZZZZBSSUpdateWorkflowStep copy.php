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
$location = $_GET["BSSLocation"];
$yloc = $_GET["yloc"];
$WorkflowId = $_GET["BSSWorkflowId"];
$KeyId = $_GET["BSSKeyId"];

//echo "Workflowid Is: " . $WorkflowId;


$masterid = $_GET["BSSMasterId"];
$EnterpriseObjectId = $_GET["BSSEnterpriseObjectId"];
$userid = $_GET["BSSUserId"];
$revision = $_GET["BSSRevision"];
$version = "1";

//Add workflow id

// $sqlvalues =  "'" . $WorkflowId . "','" . "0" . "','" . $Masterid . "','" . $name . "','" . $name . "','" . $statustype . "','" . $location . "','" . $KeyId . "')";

 $sqlstring = "update AdvWorkflowStep SET location = '" . $location . "' WHERE WorkflowID = " . $WorkflowId . " AND stepkey = " . $KeyId;

echo $sqlstring;

$LastId = PerformSQLOperation($sqlstring);

echo $LastId;