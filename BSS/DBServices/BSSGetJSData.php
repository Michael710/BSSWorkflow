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

$Con = new SQLConfig();
$arr = $Con->getName($_GET['BSSConfigName'],'MASTER','');

session_start();

$UserId = $_SESSION['BSSUserId'];
$QueryId = $_GET['BSSQueryId'];

$UserId = 1;

//Get Where Used String

//BSSGetJSData.php?BSSConfigName=Cars1&BSSQueryId=4&BSSWhereClause=id>0 ORDER BY sequence,id

$mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
mysql_select_db(DB, $mysql) or die(mysql_error());

try{
    $whereusedstring = "";
    // PROCEDURE `getwhereused`(parUserId INT(11), parTableId INT(11), parQueryId INT(11), OUT varWhereUsedString VARCHAR(500))


        $rs = mysql_query("call getwhereused(". $UserId . ',' . "'" . $arr[0]->tablename . "'" . ',' . $QueryId .",@whereused);");
        $row = mysql_fetch_assoc($rs);
        $rs2 = mysql_query("select @whereused;");
        $whereused = mysql_fetch_assoc($rs2);
        $whereusedstring =  $whereused['@whereused'];
        mysql_free_result($rs);

}catch(Exception $e)
{
    echo $e->getMessage();
}


$WhereClause = $_GET['BSSWhereClause'];

if(strlen($WhereClause) == 0 & strlen($whereusedstring) == 0)
    {
        $WhereClause = '';
    }

if(strlen($WhereClause) == 0 & strlen($whereusedstring) > 1)
    {
        $WhereClause = 'WHERE ' . $whereusedstring;
    }

if(strlen($WhereClause) > 1 & strlen($whereusedstring) == 0)
    {
        $WhereClause = 'WHERE ' . $WhereClause;
    }

if(strlen($WhereClause) > 1 & strlen($whereusedstring) > 1)
    {
        $WhereClause = 'WHERE ' . $whereusedstring .' AND ' . $WhereClause;
    }




$SQLString = '';
for($x = 1; $x <= count($arr); $x++)
{
    $SQLString =  $SQLString . chr(96) . trim($arr[$x]->field) . chr(96) . ",";
}
$SQLString = substr($SQLString,0,strlen($SQLString)-4);


for($x = 1; $x <= count($arr); $x++)
{

    $DataString =  $DataString . $arr[$x]->field . ": " . $row[$x-1] .",";
}

$SQL = "SELECT " . $SQLString . ' FROM ' . chr(96) . $arr[0]->tablename . chr(96) .' ' . $WhereClause;

$SQL =  stripslashes($SQL);

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


?>

