<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 12/30/11
 * Time: 3:19 PM
 * To change this template use File | Settings | File Templates.
 */


include '../DBServices/BSSSQLConfig.php';
include '../DBServices/BSSSQLOperation.php';

session_start();

$UserId = $_SESSION['BSSUserId'];


//$QueryType = $_GET['BSSQueryType'];
//$SQLQuery = $_GET['BSSSQLQuery'];

$WorkflowId = $_GET['BSSWorkflowId'];
$BSSFormMode = $_GET['BSSFormMode'];

$QueryType = 'USER';

if($BSSFormMode == 'Design'){
    $SQLQuery = "SELECT stepkey, location," . " Category,name,status, Figure,Color FROM AdvWorkflowStep WHERE workflowid = " . $WorkflowId;
}

if($BSSFormMode == 'Instance'){
    $SQLQuery = "SELECT stepkey, location," . " Category,name,status, Figure,Color FROM AdvWorkflowStepInstance WHERE workflowid = " . $WorkflowId;
}

$arr[1]->field  = 'key';
$arr[2]->field  = 'loc';
$arr[3]->field  = 'category';
$arr[4]->field  = 'text';
$arr[5]->field  = 'status';
$arr[6]->field  = 'Figure';
$arr[7]->field  = 'fill';


$mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
mysql_select_db(DB, $mysql) or die(mysql_error());
// echo $SQLQuery;
$result = mysql_query($SQLQuery);

    $Y = 0;
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        $DATASTRING = "";
        for($x = 1; $x <= count($arr); $x++)
        {
            $DATASTRING = $DATASTRING . '"' . $arr[$x]->field . '"' . ": " . '"' . $row[$x-1] . '"' . ", ";
            $Y++;
        }
        $DATASTRING = substr($DATASTRING,0,strlen($DATASTRING)-2);
        $NODESTRING = $NODESTRING .  '{' . $DATASTRING . '},';;
    }
mysql_free_result($result);
$NODESTRING = substr($NODESTRING,0,strlen($NODESTRING)-1);


//$mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
//mysql_select_db(DB, $mysql) or die(mysql_error());
//echo $SQLQuery;

// echo $NODESTRING;

if($BSSFormMode == 'Design'){
    $SQLQuery = "SELECT fromnode, tonode FROM AdvWorkflowLine WHERE workflowid = " . $WorkflowId;
}

if($BSSFormMode == 'Instance'){
    $SQLQuery = "SELECT fromnode, tonode FROM AdvWorkflowLineInstance WHERE workflowid = " . $WorkflowId;
}

//if($QueryType = 'USER'){
//    $SQLQuery = "SELECT fromnode, tonode FROM AdvWorkflowLine WHERE workflowid = " . $WorkflowId;
//}

$arr[1]->field  = 'from';
$arr[2]->field  = 'to';

$result = mysql_query($SQLQuery);

$Y = 0;
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $DATASTRING = "";
    for($x = 1; $x <= 2; $x++)
    {
        $DATASTRING = $DATASTRING . '"' . $arr[$x]->field . '"'  . ': "' . $row[$x-1] . '", ';
        $Y++;
    }
    $DATASTRING = substr($DATASTRING,0,strlen($DATASTRING)-2);
    $LINESTRING = $LINESTRING .  '{' . $DATASTRING . '},';;
}
mysql_free_result($result);
$LINESTRING = substr($LINESTRING,0,strlen($LINESTRING)-1);

$LONGDATASTRING ='{"class": "go.GraphLinksModel", "key": "10000",
        "linkFromPortIdProperty": "fromPort",
        "linkToPortIdProperty": "toPort",
        "nodeDataArray": [ ' .
        $NODESTRING   .
        '],  "linkDataArray": [ ' .
         $LINESTRING .
        ']}  ';

echo  $LONGDATASTRING;


?>

