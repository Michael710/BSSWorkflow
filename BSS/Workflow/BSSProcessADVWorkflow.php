<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 4/7/12
 * Time: 7:08 PM
 * To change this template use File | Settings | File Templates.
 */


echo '1';

include '../DBServices/BSSSQLConfig.php';
echo '2';
include '../DBServices/BSSSQLOperation.php';
echo '3';
include 'BSSPerformNotification.php';
echo '4';



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

// CallSQLRoutine('processworkflow',$WorkflowId,$ProcessType,$UserId,0);

//Add Action Loop
//$WorkSQL = 'SELECT action, actiondescription,actiontype,actionurl,notificationid ' . 'FROM Actions
//INNER JOIN WorkflowActions ON WorkflowActions.WorkflowActions = Actions.id
//INNER JOIN Workflows ON Workflows.id = WorkflowActions.masterid
//INNER JOIN WorkflowInstance ON WorkflowInstance.Workflowid = Workflows.id
//WHERE WorkflowInstance.id = 19 AND WorkflowActions.WorkflowStep = 4';


// $WorkSQL = 'SELECT id,workflowid,xloc,yloc,ActionType,Notification,ActionID,Revision,statustype,actionurl '
// . ' FROM AdvWorkflowStep
// WHERE workflowid = 1
// ORDER BY xloc ASC';


$WorkSQL = 'SELECT AdvWorkflowStepInstance.id,workflowid,xloc,yloc,AdvWorkflowStepInstance.ActionType,Notification,
ActionID,Revision,name,statustype,ActionURL ' .'
FROM AdvWorkflowStepInstance
LEFT JOIN Notifications ON Notifications.id = AdvWorkflowStepInstance.Notification
WHERE COMPLETED IS NULL AND workflowid = ' . $WorkflowId . '
ORDER BY xloc ASC';

echo $WorkSQL;

try{
mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DB) or die(mysql_error());
$result = mysql_query($WorkSQL);



$Y = 0;
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $StatusID = "";
    $ActionDescription = "";
    $ActionType = "";
    $ActionURL = "";
    $NotificationId = "";

    $StatusID = $row[0];
 //   $ActionDescription = $row[1];
    $XLOC = $row[2];
    $YLOC = $row[3];
    $ActionType = $row[4];
    $NotificationId = $row[5];
    $ActionID = $row[6];
    $Revision = $row[7];
    $Name = $row[8];
    $StatusType = $row[9];
    $ActionURL = $row[10];
    $NotificationId = $row[4];


    echo " Status Type: " . $StatusType;
    echo '\r\n';
    echo " Status ID: " . $StatusID;
    echo '\r\n';



//    {id:1, value: 'Pending'},
//    {id:2, value: 'Submit'},
//    {id:3, value: 'Review'},
//    {id:4, value: 'Release'},
//    {id:5, value: 'Complete'},
//    {id:6, value: 'Action'},
//    {id:7, value: 'Notify'}

$BSSSuccessComplete = true;


//Pending
if($StatusType == 1){
    $CompleteSQL = 'UPDATE AdvWorkflowStepInstance SET completed = now() WHERE id = ' . $StatusID;

    echo 'DOING PENDING: ' . $CompleteSQL;


    try{
        PerformSQLOperation($CompleteSQL);
    }catch(Exception $e){
        $BSSSuccessComplete = false;
        echo $e->getMessage();
    }
}

// Submit
if($StatusType == 2){


    $CompleteSQL = 'UPDATE AdvWorkflowStepInstance SET completed = now() WHERE id = ' . $StatusID;

    echo 'DOING SUBMIT:' . $CompleteSQL;

    try{
        PerformSQLOperation($CompleteSQL);
    }catch(Exception $e){
        $BSSSuccessComplete = false;
        echo $e->getMessage();
    }
}

// Review
if($StatusType == 3){

    //Check count on open reviewers

    echo 'DOING REVIEW: ' . $CompleteSQL;


    $ReviewSQL = 'SELECT count(*) ' . ' FROM SignOffs WHERE IFNULL(SignoffResult,0) <> 1 AND masterid = ' . $StatusID;
    $OpenReviewerCount = PerformSQLOperation($CompleteSQL);

    if($OpenReviewerCount == 0){

    $CompleteSQL = 'UPDATE AdvWorkflowStepInstance SET completed = now() WHERE id = ' . $StatusID;
        try{
            PerformSQLOperation($CompleteSQL);
        }catch(Exception $e){
            $BSSSuccessComplete = false;
            echo $e->getMessage();
        }
    }else {$BSSSuccessComplete = false;}    //not all reviewers have signed
}
    // Release
    if($StatusType == 4){


        // Notify workflow admin

        $CompleteSQL = 'UPDATE AdvWorkflowStepInstance SET completed = now() WHERE id = ' . $StatusID;
        try{
            PerformSQLOperation($CompleteSQL);
        }catch(Exception $e){
            $BSSSuccessComplete = false;
            echo $e->getMessage();
        }
    }

    // Complete
    if($StatusType == 5){

        //Check count on open reviewers

        // if not complete exit

        // Notify workflow admin

        $CompleteSQL = 'UPDATE AdvWorkflowStepInstance SET Completed = now() WHERE id = ' . $StatusID;
        try{
            PerformSQLOperation($CompleteSQL);
        }catch(Exception $e){
            $BSSSuccessComplete = false;
            echo $e->getMessage();
        }
    }



if($StatusType == 6){
    if($ActionType == 1){   // Call Action PHP Program
         // Call PHP Action .php
        echo "/PHPActions/" .$ActionURL . '?BSSStatusid=' . $StatusID;
        echo 'ZZZZZZZZZZZZZZZZZZZ BEFORE THE EXECUTE';
        $execute1 = include("PHPActions/" . $ActionURL);
        // Get completed Status here
        //echo is_executable("/PHPActions/" . $ActionURL);



        echo $execute1 . 'FFF';
        echo 'ZZZZZZZZZZZZZZZZZZZ AFTER THE EXECUTE';


        $ActionCompleteSQL = 'SELECT count(*) FROM AdvWorkflowStepInstance WHERE completed is not null and id = ' . $StatusID;

        echo $ActionCompleteSQL;

        $ActionCompleteCount = PerformSQLOperation($ActionCompleteSQL);

        echo "count is here:";

        echo $ActionCompleteCount;

        if($ActionCompleteCount <> 1){$BSSSuccessComplete = false;}

    }
}

if($StatusType == 7){
    if($NotificationId >= 0){
        echo 'process notifications';
        try{
            processnotification($MasterTableName,$MasterId,$NotificationId,$StatusID);
        }catch(Exception $e){
            $BSSSuccessComplete = false;
            echo $e->getMessage();
        }
    }
}


//if($ActionType == 1){
//  echo 'Not used on Workflows';
//}

    echo '$BSSSuccessComplete: ';
    echo $BSSSuccessComplete;

if($BSSSuccessComplete == false){exit;}



}

mysql_free_result($result);

}catch(Exception $e) {
     echo $e;
}





?>