<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 12/30/11
 * Time: 3:19 PM
 * To change this template use File | Settings | File Templates.
 */

//require_once('JSON.php');
//$json = new Services_JSON();

include 'BSSSQLConfig.php';
include 'BSSSQLOperation.php';
include 'BSSCreateHistoryEntry.php';

$Con = new SQLConfig();

$Userid = $_GET['userid'];
$MasterId = $_GET['masterid'];
$EnterpriseObjectId = $_GET['EnterpriseObjectId'];
$curdata[] = null;
$FieldArr[] = null;

$arr = $Con->getName($_GET['BSSConfigName'],'MASTER',$Userid);
$UpdateString = $_GET['id'];

$Y =  0;
$LastLoc = 0;
for($x = 0; $x <= strlen($UpdateString) ; $x++)
{
    if(strcmp(substr($UpdateString,$x,1), "|")==0){

       $FieldArr[$Y] = substr($UpdateString,$LastLoc,$x-$LastLoc);
       $Y++;
       $LastLoc = $x+1;
    }
}

// SEt the Enterprise Object Id
if($EnterpriseObjectId <> 0){
    $FieldArr[2] = $EnterpriseObjectId;
}

// Get Current Record

$CURSQLString = '';

for($z = 2; $z <= count($arr) - 1; $z++)
{
    $CURSQLString =  $CURSQLString . trim($arr[$z]->field) . ",";
}


$CURSQLString = substr($CURSQLString,0,strlen($CURSQLString)-1);

$CURSQL = "SELECT " . $CURSQLString . ' FROM ' . $arr[0]->tablename. ' ' . ' WHERE ' . $arr[1]->field  . " = " . $FieldArr[0];

echo $CURSQL;

$mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
mysql_select_db(DB, $mysql) or die(mysql_error());

$result = mysql_query($CURSQL);


while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    for($w = 1; $w < count($arr); $w++)
    {
        if($arr[$w]->renderedas <> 'Date'){
            $curdata[$w] =  $row[$w];
        }
        if($arr[$w]->renderedas == 'Date'){
            //  $DATADATE = date("m/d/y", strtotime($row[$x-1]));
            $DATADATE = date("Y-m-d H:i:s", strtotime($row[$w]));
            $curdata[$w] =  $DATADATE;
        }
    }
}



mysql_free_result($result);

// End Get Current Record



$SQLString = "";
$HistoryString = "";

for($x = 1; $x < count($arr) - 1; $x++)
{
    $SQLString =  $SQLString . chr(96) . $arr[$x+1]->field . chr(96) . " = '" . $FieldArr[$x] . "', ";

    //Find Update Changes
    if(($FieldArr[$x] <>  $curdata[$x-1]) AND $x > 2){
        $HistoryString = $HistoryString . " " . $arr[$x+1]->field . " FROM " . $curdata[$x-1] . " TO " . $FieldArr[$x];
    }

}

$HistoryString = "MODIFIED: " . $HistoryString;

$SQLString = substr($SQLString,0,strlen($SQLString)-2);

$TableName = $arr[0]->tablename;

$SQL = "UPDATE " . chr(96) . $TableName . chr(96) . " SET " . $SQLString . ' WHERE ' . $arr[1]->field  . " = " . $FieldArr[0];

echo $SQL;

try {
      PerformSQLOperation($SQL);
      $resit = CreateHistory($EnterpriseObjectId,$MasterId,$Userid, $TableName." Record Updated: " . $HistoryString,$SQL);
    } 
catch (Exception $e) 
    {
      echo 'Caught exception: ',  $e->getMessage(), "\n";
    }




//mysql_connect("localhost", "root", "root") or die(mysql_error());
//mysql_select_db(DB) or die(mysql_error());
//$result = mysql_query($SQL);
//$LastId =  mysql_insert_id();
//mysql_free_result($result);


?>

