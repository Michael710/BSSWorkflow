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



$Masterid = '0';
$name = $_GET["name"];
$status = 0;  // Set to BLACK Not Started
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

$sqlvalues =  "'" . $WorkflowId . "','" . "0" . "','" . $Masterid . "','" . $name . "','" . $name . "','" . $status . "','" . $location . "','" . $KeyId . "')";
$sqlstring = "insert into AdvWorkflowStep(workflowid, sequence,masterid,name,Category, status,location,stepkey)values(" . $sqlvalues;

echo $sqlstring;

$LastId = PerformSQLOperation($sqlstring);

echo $LastId;