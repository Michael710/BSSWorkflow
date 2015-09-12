<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 9/26/12
 * Time: 10:18 PM
 * To change this template use File | Settings | File Templates.
 */


include '../DBServices/BSSSQLOperation.php';


$fromnode = $_GET["BSSFromNode"];
$tonode = $_GET["BSSToNode"];
$WorkflowId = $_GET["BSSWorkflowId"];

//Add workflow id

$sqlvalues =  "'" . $WorkflowId  . "','" . $WorkflowId . "','" . $fromnode . "','" . $tonode . "')";
$sqlstring = "insert into AdvWorkflowLine(workflowid,masterid,fromnode,tonode)values(" . $sqlvalues;

echo $sqlstring;

$LastId = PerformSQLOperation($sqlstring);

echo $LastId;