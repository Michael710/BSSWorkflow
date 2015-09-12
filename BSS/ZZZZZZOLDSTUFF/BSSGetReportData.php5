<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 12/30/11
 * Time: 3:19 PM
 * To change this template use File | Settings | File Templates.
 */

require_once('config.php');

//include 'BSSSQLOperation.php';
include 'BSSGetReport.php';

$Con = new ReportConfig();
$arr = $Con->getName($_GET['BSSReportName']);
$SQL = $arr[0]->reportsql;

//Get Where Used String

//BSSGetJSData.php?BSSConfigName=Cars1&BSSQueryId=4&BSSWhereClause=id>0 ORDER BY sequence,id

$mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
mysql_select_db('EXTJS', $mysql) or die(mysql_error());

//echo $SQL;

$result = mysql_query($SQL);

    $Y = 0;
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {

        $DATASTRING = "";
        for($x = 0; $x < count($arr); $x++)
        {

            if($arr[$x]->renderedas <> 'Date'){
                $DATASTRING = $DATASTRING . $arr[$x]->field . ": '" . $row[$x] . "', ";
            }

        //    if($arr[$x]->renderedas == 'Date'){
        //        $DATADATE = date("m/d/y", strtotime($row[$x-1]));
        //        $DATASTRING = $DATASTRING . $arr[$x]->field . ": '" . $DATADATE . "', ";
        //    }

            $Y++;

        }
        $DATASTRING = substr($DATASTRING,0,strlen($DATASTRING)-2);
        $LONGDATASTRING = $LONGDATASTRING .  '{' . $DATASTRING . '},';;
    }

mysql_free_result($result);

$LONGDATASTRING = substr($LONGDATASTRING,0,strlen($LONGDATASTRING)-1);

echo $LONGDATASTRING;

?>

