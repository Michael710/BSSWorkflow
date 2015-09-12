<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 5/25/13
 * Time: 9:46 PM
 * To change this template use File | Settings | File Templates.
 */

include '../DBServices/BSSSQLConfig.php';
include '../DBServices/BSSSQLOperation.php';

session_start();

$SQLQuery =  "SELECT ActionURL " . "FROM AdvWorkflowStep INNER JOIN AdvWorkflows ON WorkflowId = AdvWorkflowStep.workflowid WHERE Category = 'LISTENER' AND Enabled = 1";

$mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
mysql_select_db(DB, $mysql) or die(mysql_error());
echo $SQLQuery;
$result = mysql_query($SQLQuery);

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {

    $ListenerURL = $row[0];

    echo $ListenerURL;

    $execute = include('./Listeners/' . $ListenerURL);

    echo 'LISTENER EXECUTION RESULT: ' . $execute;


}

mysql_free_result($result);

