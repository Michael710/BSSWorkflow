<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 4/7/12
 * Time: 7:08 PM
 * To change this template use File | Settings | File Templates.
 */

include 'BSSSQLConfig.php';
include 'BSSSQLOperation.php';

$WorkflowId = $_GET['BSSWorkflowId'];
$ProcessType = "'" . $_GET['BSSProcessType'] . "'";
$UserId = $_GET['BSSUserId'];

$JSONObject = stripcslashes($_GET['BSSJSONObject']);
$ParsedObject = json_decode($JSONObject);

$MasterTableName = $ParsedObject->MasterTableName;
//echo $ParsedObject->ChildTableName;
$MasterId =  $ParsedObject->Masterid;
//echo $ParsedObject->Childid;
//echo $ParsedObject->WorkflowId;
//echo $ParsedObject->SignOffId;
//echo $ParsedObject->DocumentId;
//echo $ParsedObject->DiscussionId;
//echo $ParsedObject->HistoryId;
// echo $WorkflowId;

CallSQLRoutine('processworkflow',$WorkflowId,$ProcessType,$UserId,0);

//Add Action Loop
$WorkSQL = 'SELECT action, actiondescription,actiontype,actionurl,notificationid ' . 'FROM Actions
INNER JOIN WorkflowActions ON WorkflowActions.WorkflowActions = Actions.id
INNER JOIN Workflows ON Workflows.id = WorkflowActions.masterid
INNER JOIN WorkflowInstance ON WorkflowInstance.Workflowid = Workflows.id
WHERE WorkflowInstance.id = 19 AND WorkflowActions.WorkflowStep = 4';

mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db('EXTJS') or die(mysql_error());
$result = mysql_query($WorkSQL);

$Y = 0;
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $Action = "";
    $ActionDescription = "";
    $ActionType = "";
    $ActionURL = "";
    $NotificationId = "";

    $Action = $row[0];
    $ActionDescription = $row[1];
    $ActionType = $row[2];
    $ActionURL = $row[3];
    $NotificationId = $row[4];


    if($ActionType == 'PHPAction'){
         // Call PHP Action .php
        $execute = "/PHPActions/" .$ActionURL;
    }

    if($ActionType == 'Notificaton'){
        processnotification($MasterTableName,$MasterId,$NotificationId);

    }


    if($ActionType == 'URL'){
      // Not used on Workflows
    }

}

mysql_free_result($result);







?>