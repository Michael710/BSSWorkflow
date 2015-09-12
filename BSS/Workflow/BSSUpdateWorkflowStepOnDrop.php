<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 9/26/12
 * Time: 10:18 PM
 * To change this template use File | Settings | File Templates.
 */


include '../DBServices/BSSSQLOperation.php';

//sleep(1);



$xloc = $_GET["xloc"];
$yloc = $_GET["yloc"];

$BSSWorkflowStepId = $_GET["BSSWorkflowStepId"];

$sqlstring = "update AdvWorkflowStep set xloc = " . $xloc . ", yloc = ". $yloc . " where id = " .  $BSSWorkflowStepId;


//echo "UPDATING WIT DIS: " . $sqlstring;

$LastId = PerformSQLOperation($sqlstring);

//echo $LastId;