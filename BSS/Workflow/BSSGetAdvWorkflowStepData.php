<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 10/14/12
 * Time: 12:39 PM
 * To change this template use File | Settings | File Templates.
 */


include '../DBServices/BSSSQLConfig.php';
include '../DBServices/BSSSQLOperation.php';

$Con = new SQLConfig();
$arr = $Con->getName('AdvWorkflowStep','MASTER','');

session_start();

$UserId = $_SESSION['BSSUserId'];
$WorkflowStepId = $_GET['BSSWorkflowStepId'];
$WorkflowId = $_GET['BSSWorkflowId'];
$BSSInstanceMode = $_GET['BSSInstanceMode'];

//echo $BSSInstanceMode;

$UserId = 1;

//echo 'KEY= '  . $WorkflowStepId;
//Get Where Used String
//BSSGetJSData.php?BSSConfigName=Cars1&BSSQueryId=4&BSSWhereClause=id>0 ORDER BY sequence,id

$mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
mysql_select_db(DB, $mysql) or die(mysql_error());



if($BSSInstanceMode == 'Design') {
    $SQL = "SELECT id,sequence,masterid,tableid,workflowid,location,ActionType,Notification,
ActionURL,Revision,Started,Completed,CreateDate,Instructions,ErrorResult,name,status,description,ApproverUserId,category,ReviewPolicy,Figure,Color
FROM AdvWorkflowStep WHERE stepkey = " . $WorkflowStepId . ' AND WorkflowId = ' . $WorkflowId;
}else{
    $SQL = "SELECT id,sequence,masterid,tableid,workflowid,location,ActionType,Notification,
ActionURL,Revision,Started,Completed,CreateDate,Instructions,ErrorResult,name,status,description,ApproverUserId,category,ReviewPolicy,Figure,Color
FROM AdvWorkflowStepInstance WHERE stepkey = " . $WorkflowStepId . ' AND WorkflowId = ' . $WorkflowId;

}

//echo $SQL;

$result = mysql_query($SQL);

$Y = 0;
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {

    $DATASTRING = "";
    for($x = 1; $x < count($arr); $x++)
    {

        if(strtoupper($arr[$x]->renderedas) <> 'DATE'){
            $DATASTRING = $DATASTRING . $arr[$x]->field . ": '" . $row[$x-1] . "', ";
        }

        if(strtoupper($arr[$x]->renderedas) == 'DATE'){
            //  $DATADATE = date("m/d/y", strtotime($row[$x-1]));
            $DATADATE = date("Y-m-d H:i:s", strtotime($row[$x-1]));

            $DATASTRING = $DATASTRING . $arr[$x]->field . ": '" . $DATADATE . "', ";
        }

        $Y++;

    }
    $DATASTRING = substr($DATASTRING,0,strlen($DATASTRING)-2);
    $LONGDATASTRING = $LONGDATASTRING .  '{' . $DATASTRING . '},';;
}

mysql_free_result($result);

$LONGDATASTRING = substr($LONGDATASTRING,0,strlen($LONGDATASTRING)-1);

echo $LONGDATASTRING;