<?php
//require_once('config.php');
include 'BSSSQLOperation.php';
//include 'BSSSQLConfig.php';


//$Con = new SQLConfig('A');
session_start();
$UserId = $_SESSION["BSSUserId"];

$startstring = "{title: 'Navigate', height: 400, width: 200, x: 0, y: 120, listeners: {itemclick: function(node, rec, item, index, e) {var parentNode = rec.parentNode; RouteRequest(parentNode.get('text') + '|' + rec.get('text'));}}, store: Ext.create('Ext.data.TreeStore', {root: {expanded: true,children: [";
$endstring = "]}}),rootVisible: false,renderTo: 'tree-example'}";
//$COBJECTS = "{ text: 'Enterprise Objects',";
//$CTABLE = "{ text: 'Tables',";
//$CQUERY = "{ text: 'Queries',";
$C3 = "children: [";
$C4 = "{ text: 'Query AAA', leaf: true },";
$C5 = "{ text: 'Query B', leaf: true },]},";
$CREPORT =  ""; //"{ text: 'Reports',";

$CWORKFLOWSA = "{text: 'Create Workflows', children: [{ text: 'Create Workflows', leaf: true }]},";

$CWORKFLOWS = "{text: 'Your Workflows', children: [{ text: 'Open Workflows', leaf: true },{ text: 'Late Workflows', leaf: true },{ text: 'Closed Workflows', leaf: true }]},";

$CADMIN = "{ text: 'Admin',";
$CADM1 = "children: [";
$CADM2 = "";
$CADM3 = "";
$CADM4 = ""; //"{ text: 'Queries', leaf: true },";
$CADM5 = "";
$CADM6 = "{ text: 'Workflow Designer', leaf: true },";
$CADM6A = "{ text: 'All Workflow Instances', leaf: true },";
$CADM7 = "{ text: 'All Late Workflows', leaf: true },";
$CADM8 = "";
$CADM9 = ""; //"{ text: 'Reports', leaf: true },";
$CADM10 = "{ text: 'Users', leaf: true },";
$CADM11 = "{ text: 'Custom Actions', leaf: true },";
$CADM12 = "{ text: 'Setup', leaf: true }]}";

            mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
            mysql_select_db(DB) or die(mysql_error());

            //get the Reports
            $SQLSTRING = "SELECT ReportName  FROM Reports WHERE ReportScope = 1 OR ReportUser = " . $UserId;
            $result = mysql_query($SQLSTRING);
            $BSSREPORTS = "";
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
               // $BSSREPORTS = $BSSREPORTS . "{ text:" . '"' . $row[0] . '"' . ", leaf: true " . "},";
            }
            $BSSREPORTS = substr($BSSREPORTS,0,strlen($BSSREPORTS)-1);
            mysql_free_result($result);

            if(strlen($BSSOBJECTS) > 2){
                $BSSOBJECTS = "children: [" . $BSSOBJECTS . "]},";
            }else{
                $BSSOBJECTS = "},";
            }

            if(strlen($BSSTABLES) > 2){
                $BSSTABLES = "children: [" . $BSSTABLES . "]},";
            }else{
                $BSSTABLES = "},";
            }

            if(strlen($BSSQUERIES) > 2){
                $BSSQUERIES = "children: [" . $BSSQUERIES . "]},";
            }else{
                $BSSQUERIES = "},";
            }

            if(strlen($BSSREPORTS) > 2){
            //    $BSSREPORTS = "children: [" . $BSSREPORTS . "]}";
            }else{
             //   $BSSREPORTS = ""; //"}";
            }


IF($_SESSION['BSSAdminUser'] == 1){
    $configstring = $startstring . /*$COBJECTS . $BSSOBJECTS . /*$CTABLE . $BSSTABLES  .  $CQUERY .  $BSSQUERIES .*/ $CWORKFLOWSA . $CWORKFLOWS .  $CREPORT .  $BSSREPORTS .  $CADMIN . $CADM1  . $CADM2 . $CADM3 . $CADM4 . $CADM5 . $CADM6 . $CADM6A . $CADM7 . $CADM8 . $CADM9 . $CADM10 . $CADM11 . $CADM12 . $endstring;
}ELSE
{
    $configstring = $startstring . /*$COBJECTS . $BSSOBJECTS . /*$CTABLE . $BSSTABLES  .  $CQUERY .  $BSSQUERIES .*/ $CWORKFLOWSA . $CWORKFLOWS .  $CREPORT . $BSSREPORTS .  $endstring;
}

echo $configstring;




?>