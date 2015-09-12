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
$FromNode = $_GET["BSSFromNode"];
$ToNode = $_GET["BSSToNode"];

$sqlstring = "DELETE FROM AdvWorkflowLine WHERE WorkflowID = " . $WorkflowId . " AND fromnode = " . $FromNode . " AND tonode = " . $ToNode;

echo $sqlstring;

$LastId = PerformSQLOperation($sqlstring);

echo $LastId;