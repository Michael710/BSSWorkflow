<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 4/25/12
 * Time: 7:27 PM
 * To change this template use File | Settings | File Templates.
 */


//        bssNewFieldNameData = [{ id:1, value: 'BGLOBAL'},{ id:2, value: 'BUSER'}];

include 'BSSSQLConfig.php';
include 'BSSSQLOperation.php';

//$Con = new SQLConfig();
//$arr = $Con->getName($_GET['BSSConfigName'],'MASTER');

$SQL = $_GET['BSSSQLString'];

//echo $SQL;


mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db('EXTJS') or die(mysql_error());
$result = mysql_query($SQL);


    $Y = 0;
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        $DATASTRING = "";

                $DATASTRING = $DATASTRING . 'id: ' . $row[0]  . ", value:'" .  $row[1] .  "', ";   //$arr[$x]->value" .

            $Y++;

        $DATASTRING = substr($DATASTRING,0,strlen($DATASTRING)-2);
        $LONGDATASTRING = $LONGDATASTRING .  '{' . $DATASTRING . '},';;
    }

mysql_free_result($result);

$LONGDATASTRING = substr($LONGDATASTRING,0,strlen($LONGDATASTRING)-1);

echo $LONGDATASTRING;


?>

