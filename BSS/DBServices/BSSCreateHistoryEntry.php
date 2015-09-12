<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 8/4/12
 * Time: 7:36 PM
 * To change this template use File | Settings | File Templates.
 */


//include '../tree/BSSSQLOperation.php';

function CreateHistory($EnterpriseObjectId,$MasterId,$UserId,$HistoryText,$SQLText){

$SQLCommand = 'INSERT ' . 'INTO History(sequence,masterid,historyuser,historydate,historytext,sqlcommand)VALUES('  .$EnterpriseObjectId . ',' . $MasterId . ',' . $UserId . ', now(),' . "'" . $HistoryText . "'," . '"' .$SQLText . '"'  . ")";


mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DB) or die(mysql_error());
$result = mysql_query($SQLCommand);

//echo $result;


return $SQLCommand;



}