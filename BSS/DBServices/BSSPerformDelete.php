<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 12/30/11
 * Time: 3:19 PM
 * To change this template use File | Settings | File Templates.
 */

include 'BSSSQLConfig.php';
include 'BSSSQLOperation.php';
include '../tree/BSSCreateHistoryEntry.php';

$Userid = $_GET['userid'];
$Masterid = $_GET['masterid'];

$Con = new SQLConfig();
$arr = $Con->getName($_GET['BSSConfigName'],'MASTER',$Userid);
$IdString = $_GET['id'];

$TableName = $arr[0]->tablename;

$SQL = "DELETE FROM " . chr(96) . $TableName. chr(96) . " WHERE " . $arr[1]->field . ' = ' . $IdString;
//echo $SQL;
PerformSQLOperation($SQL);

$resit = CreateHistory($Masterid,$Userid, $TableName." Record Deleted",$SQL);

//echo($resit);




?>

