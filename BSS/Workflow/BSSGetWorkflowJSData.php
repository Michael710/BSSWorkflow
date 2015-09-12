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

// $Con = new SQLConfig();
// $arr = $Con->getName($_GET['BSSConfigName'],'MASTER');

session_start();

$UserId = $_SESSION['BSSUserId'];
$QueryType = $_GET['BSSQueryType'];
$SQLQuery = $_GET['BSSSQLQuery'];

$QueryType = 'USER';

if($QueryType = 'USER'){
$SQLQuery = "SELECT awi.id,awi.WorkflowName AS WorkflowName,awi.WorkflowDescription AS WorkflowDescription,AdvWorkflowStepInstance.xloc AS xloc " .
    "FROM AdvWorkflowStepInstance JOIN AdvWorkflowInstance awi ON awi.id = AdvWorkflowStepInstance.workflowid WHERE statustype = 3 AND Completed IS NULL
    AND xloc = (SELECT MIN(xloc) FROM AdvWorkflowStepInstance WHERE AdvWorkflowStepInstance.workflowid = awi.id AND statustype = 3
    AND Completed IS NULL)
ORDER BY id,xloc ASC";

$arr[1]->field  = 'id';
$arr[2]->field  = 'WorkflowName';
$arr[3]->field  = 'WorkflowDescription';
$arr[4]->field  = 'xloc';
}

$mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
mysql_select_db(DB, $mysql) or die(mysql_error());

//echo $SQLQuery;

$result = mysql_query($SQLQuery);

    $Y = 0;
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {

        $DATASTRING = "";
        for($x = 1; $x <= count($arr); $x++)
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

