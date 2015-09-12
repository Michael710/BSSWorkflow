<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 4/7/12
 * Time: 7:08 PM
 * To change this template use File | Settings | File Templates.
 */


// PROCEDURE `createadvworkflow`(parWorkflowId INT(11), parWorkflowDescription INT(11), parNewWorkflowId INT(11),arg4 VARCHAR(50))


include '../DBServices/BSSSQLConfig.php';
include '../DBServices/BSSSQLOperation.php';

$ProcName = $_GET['ProcName'];
$WorkflowId = $_GET['WorkflowId'];
$BSSWorkflowDescription = $_GET['BSSWorkflowDescription'];
$BSSNewWorkflowId = $_GET['BSSNewWorkflowId'];

 echo $ProcName;
 echo $WorkflowId;
 echo BSSEnterpriseObjectID;
 echo $RecordId;

CallSQLRoutine('createadvworkflow', $WorkflowId,"'" . $BSSWorkflowDescription ."'",$BSSNewWorkflowId,'1');

?>