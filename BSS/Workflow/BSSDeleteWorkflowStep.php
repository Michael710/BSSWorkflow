<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 9/26/12
 * Time: 10:18 PM
 * To change this template use File | Settings | File Templates.
 */


include '../DBServices/BSSSQLOperation.php';

$WorkflowId = $_GET["BSSWorkflowId"];
$KeyId = $_GET["BSSKeyId"];

$sqlstring = "DELETE FROM AdvWorkflowStep WHERE WorkflowID = " . $WorkflowId . " AND stepkey = '" . $KeyId . "'";

echo $sqlstring;

$LastId = PerformSQLOperation($sqlstring);


$sqlstring = "DELETE FROM AdvWorkflowLine WHERE WorkflowID = " . $WorkflowId . " AND (fromnode = '" . $KeyId . "' OR tonode = '" . $KeyId . "')";

echo $sqlstring;

$LastId = PerformSQLOperation($sqlstring);

echo $LastId;