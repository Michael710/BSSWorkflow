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


$xloc = $_REQUEST["xloc"];
$yloc = $_REQUEST["yloc"];
$name = $_REQUEST["name"];
$description = $_REQUEST["description"];
$revision = $_REQUEST["revision"];
$statustype = $_REQUEST["statustype"];
$actiontype = $_REQUEST["actiontype"];
$notification = $_REQUEST["notification"];
$actionurl = $_REQUEST["actionurl"];
$instructions = $_REQUEST["instructions"];
$errorresult = $_REQUEST["errorresult"];
$start = $_REQUEST["start"];
$complete = $_REQUEST["complete"];


$masterid = $_GET["BSSMasterId"];
$EnterpriseObjectId = $_GET["BSSEnterpriseObjectId"];
$userid = $_GET["BSSUserId"];

$sqlvalues =  "'" . $name . "','" . $statustype . "','" . $xloc . "'," . $yloc . ",'" . $actiontype . "','" .  $notification  . "','" .  $actionurl .   "','" .  $instructions . "')";
$sqlstring = "insert into AdvWorkflowStep(sequence,masterid,name,statustype,xloc,yloc,ActionType,Notification,ActionURL,Revision,Instructions)values(" . $sqlvalues;

//echo $sqlstring;

$LastId = PerformSQLOperation($sqlstring);
