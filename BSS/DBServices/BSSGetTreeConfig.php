<?php
//require_once('config.php');
include 'BSSSQLOperation.php';
//include 'BSSSQLConfig.php';


//$Con = new SQLConfig('A');
session_start();
$UserId = $_SESSION["BSSUserId"];

/*
{title: 'Navigate',width: 200,x: 40,y: 80,store: Ext.create('Ext.data.TreeStore', {root: {expanded: true,children: [
            { text: "Tablea", leaf: true },
            { text: "Queries", expanded: true,
            children: [
            { text: "Query A", leaf: true },
            { text: "Query B", leaf: true}
            ] },
            { text: "Reports", leaf: true }
           ]}}),rootVisible: false,renderTo: 'tree-example'}

    listeners: {itemclick: function(index) {var record = store.getAt(index); alert(record);}

        handler: function(){Ext.example.msg('Click','This is a test');};

            listeners: {click: function() {alert(this.text);}}

        listeners:{
            itemclick:function(node, rec, item, index, e){
               console.log(node);
               console.log(rec);
               console.log(item);
               console.log(index);
               console.log(e);
            }
        },


        var parentNode = node.parentNode;
        if(parentNode) {
            alert(parentNode.get('text'));
        }
*/


$startstring = "{title: 'Navigate', height: 400, width: 200, x: 0, y: 120, listeners: {itemclick: function(node, rec, item, index, e) {var parentNode = rec.parentNode; RouteRequest(parentNode.get('text') + '|' + rec.get('text'));}}, store: Ext.create('Ext.data.TreeStore', {root: {expanded: true,children: [";
$endstring = "]}}),rootVisible: false,renderTo: 'tree-example'}";
$COBJECTS = "{ text: 'Enterprise Objects',";
$CTABLE = "{ text: 'Tables',";
$CQUERY = "{ text: 'Queries',";
$C3 = "children: [";
$C4 = "{ text: 'Query AAA', leaf: true },";
$C5 = "{ text: 'Query B', leaf: true },]},";
$CREPORT = "{ text: 'Reports',";

$CWORKFLOWS = "{text: 'Your Workflow Approvals', children: [{ text: 'Open Workflows', leaf: true }]},";

$CADMIN = ",{ text: 'Admin',";
$CADM1 = "children: [";
$CADM2 = "{ text: 'Enterprise Objects', leaf: true },";
$CADM3 = "";
$CADM4 = ""; //"{ text: 'Queries', leaf: true },";
$CADM5 = "{ text: 'Tables', leaf: true },";
$CADM6 = "{ text: 'Workflows', leaf: true },";
$CADM6A = "{ text: 'Workflow Instances', leaf: true },";
$CADM7 = "{ text: 'Actions', leaf: true },";
$CADM8 = "{ text: 'Notifications', leaf: true },";
$CADM9 = "{ text: 'Reports', leaf: true },";
$CADM10 = "{ text: 'Users', leaf: true },";
$CADM11 = "{ text: 'Roles', leaf: true }]}";


            mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
            mysql_select_db(DB) or die(mysql_error());


            //get the EnterPriseObjects
            $SQLSTRING = "SELECT ProfileName FROM EnterpriseObjects";
            $result = mysql_query($SQLSTRING);
            $BSSOBJECTS = "";
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                $BSSOBJECTS = $BSSOBJECTS . "{ text:" . '"' . $row[0] . '"' . ", leaf: true " . "},";
            }
            $BSSOBJECTS = substr($BSSOBJECTS,0,strlen($BSSOBJECTS)-1);
            mysql_free_result($result);

            //get the tables
            $SQLSTRING = "SELECT TableName FROM Tables WHERE id IN (SELECT tableid FROM Roles WHERE READPRIV = 1 AND Roles.id IN (SELECT roleid FROM UserRoles WHERE MasterId = " . $UserId . "))";  //Add Read Privilege
            $result = mysql_query($SQLSTRING);
            $BSSTABLES = "";
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                $BSSTABLES = $BSSTABLES . "{ text:" . '"' . $row[0] . '"' . ", leaf: true " . "},";
            }
            $BSSTABLES = substr($BSSTABLES,0,strlen($BSSTABLES)-1);
            mysql_free_result($result);

            //get the Queries
            $SQLSTRING = "SELECT QueryName  FROM Queries WHERE QueryScope = 1 OR QueryUser = " . $UserId;
            $result = mysql_query($SQLSTRING);
            $BSSQUERIES = "";
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                $BSSQUERIES = $BSSQUERIES . "{ text:" . '"' . $row[0] . '"' . ", leaf: true " . "},";
            }
            $BSSQUERIES = substr($BSSQUERIES,0,strlen($BSSQUERIES)-1);
            mysql_free_result($result);


            //get the Reports
            $SQLSTRING = "SELECT ReportName  FROM Reports WHERE ReportScope = 1 OR ReportUser = " . $UserId;
            $result = mysql_query($SQLSTRING);
            $BSSREPORTS = "";
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                $BSSREPORTS = $BSSREPORTS . "{ text:" . '"' . $row[0] . '"' . ", leaf: true " . "},";
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
                $BSSREPORTS = "children: [" . $BSSREPORTS . "]}";
            }else{
                $BSSREPORTS = "}";
            }


//$colstring = substr($colstring,0,strlen($colstring)-1);

//$configstring = $startstring . $COBJECTS . $BSSOBJECTS . /*$CTABLE . $BSSTABLES  .  $CQUERY .  $BSSQUERIES .*/ $CREPORT . $BSSREPORTS . $CADMIN . $CADM1  . $CADM2 . $CADM3 . $CADM4 . $CADM5 . $CADM6 . $CADM7 . $CADM8 . $CADM9 . $CADM10 . $endstring;

//echo 'HERE:';
//echo $_SESSION['BSSAdminUser'];

IF($_SESSION['BSSAdminUser'] == 1){
    $configstring = $startstring . $COBJECTS . $BSSOBJECTS . /*$CTABLE . $BSSTABLES  .  $CQUERY .  $BSSQUERIES .*/ $CWORKFLOWS . $CREPORT . $BSSREPORTS . $CADMIN . $CADM1  . $CADM2 . $CADM3 . $CADM4 . $CADM5 . $CADM6 . $CADM6A . $CADM7 . $CADM8 . $CADM9 . $CADM10 . $CADM11 . $endstring;
}ELSE
{
    $configstring = $startstring . $COBJECTS . $BSSOBJECTS . /*$CTABLE . $BSSTABLES  .  $CQUERY .  $BSSQUERIES .*/  $CWORKFLOWS . $CREPORT . $BSSREPORTS . $endstring;
}

echo $configstring;




?>