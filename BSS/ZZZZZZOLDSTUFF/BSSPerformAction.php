<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 8/11/12
 * Time: 9:26 PM
 * To change this template use File | Settings | File Templates.
 */

//        bssNewFieldNameData = [{ id:1, value: 'BGLOBAL'},{ id:2, value: 'BUSER'}];

include 'BSSSQLConfig.php';
include 'BSSSQLOperation.php';
include 'BSSPerformNotification.php';

//ini_set('display_errors', '1');

//xmlHttp.open( "GET", "BSSPerformAction.php?BSSActionId=" + Action + "&userid=" + BSSUserId + "&BSSJSONObject=" + GetBSSJSONObject(), false );

$UserId = $_GET['BSSUserId'];
$Action = $_GET['BSSActionId'];
$JSONObject = stripcslashes($_GET['BSSJSONObject']);

//echo $JSONObject;

//    BSSJSONObject = [{MasterTableName:BSSMasterConfigName,ChildTableName:BSSChildConfigName,Masterid:MasterId,Childid:ChildId,WorkflowId:WorkflowId,SignOffId:SignOffId,DocumentId:DocumentId,DiscussionId:DiscussionId,HistoryId:HistoryId}];

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

$SQL = "SELECT action, actiontype,actionurl,notificationid FROM Actions WHERE id = " . $Action;


mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db('EXTJS') or die(mysql_error());
$result = mysql_query($SQL);

$row = mysql_fetch_array($result, MYSQL_NUM);

$actionname = $row[0];
$actiontype = $row[1];
$actionurl = $row[2];
$NotificationId = $row[3];

mysql_free_result($result);

//echo " Name: " . $actionname;
//echo " Type: " . $actiontype;
//echo " ULR: " . $actionurl;

//    1 URL
//    2 NOTIFICATION
//    3 PHPCALL


if($actiontype == 3){    //PHP Call

    echo "PHP:".$actionurl;

}


if($actiontype == 2){

  //  echo "NOTIFY: ";

  //  echo $MasterTableName;
  //  echo $MasterId;
  //  echo $NotificationId;

    processnotification($MasterTableName,$MasterId,$NotificationId);




    }

if($actiontype == 1){   // open a URL at Client

    echo "URL:".$actionurl;

}

