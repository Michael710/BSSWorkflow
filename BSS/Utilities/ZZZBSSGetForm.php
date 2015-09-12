<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 3/27/12
 * Time: 9:43 AM
 * To change this template use File | Settings | File Templates.
 */

include '../DBServices/BSSSQLConfig.php';
include '../DBServices/BSSSQLOperation.php';

$FormName = "";
$FormMode = "";
$FormDescription = "";
$MasterTable = "";
$ChildTable = "";
$Action1 = "";
$Action2 = "";
$Action3 = "";
$Action4 = "";
$DocumentsEnabled = "";

$FormName = $_GET['BSSFormName'];
$FormMode = $_GET['BSSFormMode'];

//echo $FormMode;

mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DB) or die(mysql_error());

if ($FormMode == 'Object') {
    $result = mysql_query("SELECT
          EnterpriseObjects.id,
          EnterpriseObjects.sequence,
          EnterpriseObjects.masterid,
          ProfileName,
          ProfileDescription,
          MT.TableName AS MasterTable,
          CT.TableName AS ChildTable,
          Action1,Action2,Action3,Action4,Action5,Action6,EnableDocs,EnableDiscussions,EnableHistory,EnableWorkflow,
          Ac1.Action AS ActionName1,Ac2.Action AS ActionName2,Ac3.Action AS ActionName3,Ac4.Action AS ActionName4,Ac5.Action AS ActionName5,Ac6.Action AS ActionName6
          FROM EnterpriseObjects
          LEFT JOIN Tables MT ON MT.id = EnterpriseObjects.MasterTable
          LEFT JOIN Tables CT ON CT.id = EnterpriseObjects.ChildTable
          LEFT JOIN Actions Ac1 ON Ac1.id = EnterpriseObjects.Action1
          LEFT JOIN Actions Ac2 ON Ac2.id = EnterpriseObjects.Action2
          LEFT JOIN Actions Ac3 ON Ac3.id = EnterpriseObjects.Action3
          LEFT JOIN Actions Ac4 ON Ac4.id = EnterpriseObjects.Action4
          LEFT JOIN Actions Ac5 ON Ac5.id = EnterpriseObjects.Action5
          LEFT JOIN Actions Ac6 ON Ac6.id = EnterpriseObjects.Action6
          WHERE ProfileName = '" . $FormName . "'");
}

if ($FormMode == 'Query') {
    $result = mysql_query("SELECT
          EnterpriseObjects.id,
          EnterpriseObjects.sequence,
          EnterpriseObjects.masterid,
          ProfileName,
          ProfileDescription,
          MT.TableName AS MasterTable,
          CT.TableName AS ChildTable,
          Action1,Action2,Action3,Action4,Action5,Action6,EnableDocs,EnableDiscussions,EnableHistory,EnableWorkflow,
          Ac1.Action AS ActionName1,Ac2.Action AS ActionName2,Ac3.Action AS ActionName3,Ac4.Action AS ActionName4,Ac5.Action AS ActionName5,Ac6.Action AS ActionName6
          FROM EnterpriseObjects
          LEFT JOIN Tables MT ON MT.id = EnterpriseObjects.MasterTable
          LEFT JOIN Tables CT ON CT.id = EnterpriseObjects.ChildTable
          LEFT JOIN Actions Ac1 ON Ac1.id = EnterpriseObjects.Action1
          LEFT JOIN Actions Ac2 ON Ac2.id = EnterpriseObjects.Action2
          LEFT JOIN Actions Ac3 ON Ac3.id = EnterpriseObjects.Action3
          LEFT JOIN Actions Ac4 ON Ac4.id = EnterpriseObjects.Action4
          LEFT JOIN Actions Ac5 ON Ac5.id = EnterpriseObjects.Action5
          LEFT JOIN Actions Ac6 ON Ac6.id = EnterpriseObjects.Action6
          INNER JOIN Queries ON Queries.EnterpriseObjectId = EnterpriseObjects.id
          WHERE Queries.QueryName = '" . $FormName . "'");
}

$Y = 0;
while ($row = mysql_fetch_assoc($result)) {
    $Y = $Y + 1;
    $EnterpriseObjectId = $row["id"];
    $FormName = $row["ProfileName"];
    $FormDescription = $row["ProfileDescription"];
    $MasterTable = $row["MasterTable"];
    $ChildTable = $row["ChildTable"];
    $Action1 = $row["Action1"];
    $Action2 = $row["Action2"];
    $Action3 = $row["Action3"];
    $Action4 = $row["Action4"];
    $Action5 = $row["Action5"];
    $Action6 = $row["Action6"];
    $DocumentsEnabled = $row["EnableDocs"];
    $DiscussionsEnabled = $row["EnableDiscussions"];
    $HistoryEnabled = $row["EnableHistory"];
    $WorkflowEnabled = $row["EnableWorkflow"];
    $ActionName1 = $row["ActionName1"];
    $ActionName2 = $row["ActionName2"];
    $ActionName3 = $row["ActionName3"];
    $ActionName4 = $row["ActionName4"];
    $ActionName5 = $row["ActionName5"];
    $ActionName6 = $row["ActionName6"];
}

mysql_free_result($result);

$FormConfig =
    '{"FormName": "' . $FormName . '",' .
        '"FormDescription" :"' . $FormDescription . '",' .
        '"EnterpriseObjectId" :"' . $EnterpriseObjectId . '",' .
        '"MasterTable" :"' . $MasterTable . '",' .
        '"ChildTable" :"' . $ChildTable . '",' .
        '"Action1" :"' . $Action1 . '",' .
        '"Action2" :"' . $Action2 . '",' .
        '"Action3" :"' . $Action3 . '",' .
        '"Action4" :"' . $Action4 . '",' .
        '"Action5" :"' . $Action5 . '",' .
        '"Action6" :"' . $Action6 . '",' .
        '"BSSDocumentsEnabled" :"' . $DocumentsEnabled . '",' .
        '"BSSDiscussionsEnabled" :"' . $DiscussionsEnabled . '",' .
        '"BSSHistoryEnabled" :"' . $HistoryEnabled . '",' .
        '"BSSWorkflowEnabled" :"' . $WorkflowEnabled . '",' .
        '"BSSActionName1" :"' . $ActionName1 . '",' .
        '"BSSActionName2" :"' . $ActionName2 . '",' .
        '"BSSActionName3" :"' . $ActionName3 . '",' .
        '"BSSActionName4" :"' . $ActionName4 . '",' .
        '"BSSActionName5" :"' . $ActionName5 . '",' .
        '"BSSActionName6" :"' . $ActionName6 . '"}';

echo $FormConfig;

