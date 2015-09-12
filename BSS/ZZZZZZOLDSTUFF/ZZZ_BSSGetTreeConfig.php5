<?php
require_once('config.php');
include 'BSSSQLOperation.php';
include 'BSSSQLConfig.php';

session_start();

$Con = new SQLConfig('A');
//$arr = $Con->getName($_GET['BSSConfigName']);

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

alert(parentNode.get('text') + '|' + rec.get('text'));
*/


            $startstring = "{title: 'Navigate', height: 500, width: 200, x: 20, y: 500, listeners: {itemclick: function(node, rec, item, index, e) {var parentNode = rec.parentNode; RouteRequest(parentNode.get('text') + '|' + rec.get('text'));}}, store: Ext.create('Ext.data.TreeStore', {root: {expanded: true,children: [";
            $endstring = "]}}),rootVisible: false}";
            $CTABLE = "{ text: 'Tables',";
            $CQUERY = "{ text: 'Queries',";
            $C3 = "children: [";
            $C4 = "{ text: 'Query AAA', leaf: true },";
            $C5 = "{ text: 'Query B', leaf: true },]},";
            $CREPORT = "{ text: 'Reports',";

            $CADMIN = ",{ text: 'Admin',";
            $CADM1 = "children: [";
            $CADM2 = "{ text: 'Tables', leaf: true,listeners: {click: function() {alert(this.text);}}},";
            $CADM3 = "{ text: 'Queries', leaf: true },";
            $CADM4 = "{ text: 'Reports', leaf: true },";
            $CADM5 = "{ text: 'Users', leaf: true },";
            $CADM6 = "{ text: 'Roles', leaf: true }]}";

            mysql_connect($HOST, $USERNAME, $PASSWORD) or die(mysql_error());
            mysql_select_db($DB) or die(mysql_error());

            //get the tables
            $SQLSTRING = "SELECT TableName  FROM Tables";
            $result = mysql_query($SQLSTRING);
            $BSSTABLES = "";
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                $BSSTABLES = $BSSTABLES . "{ text:" . '"' . $row[0] . '"' . ", leaf: true " . "},";
            }
            $BSSTABLES = substr($BSSTABLES,0,strlen($BSSTABLES)-1);
            mysql_free_result($result);

            //get the Queries
            $SQLSTRING = "SELECT QueryName  FROM Queries";
            $result = mysql_query($SQLSTRING);
            $BSSQUERIES = "";
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                $BSSQUERIES = $BSSQUERIES . "{ text:" . '"' . $row[0] . '"' . ", leaf: true " . "},";
            }
            $BSSQUERIES = substr($BSSQUERIES,0,strlen($BSSQUERIES)-1);
            mysql_free_result($result);


            //get the Reports
            $SQLSTRING = "SELECT ReportName  FROM Reports";
            $result = mysql_query($SQLSTRING);
            $BSSREPORTS = "";
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                $BSSREPORTS = $BSSREPORTS . "{ text:" . '"' . $row[0] . '"' . ", leaf: true " . "},";
            }
            $BSSREPORTS = substr($BSSREPORTS,0,strlen($BSSREPORTS)-1);
            mysql_free_result($result);

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

echo $_SESSION['BSSAdminUser'];

IF(strlen($_SESSION['BSSAdminUser']) > 0){
    $configstring = $startstring . $CTABLE . $BSSTABLES  . $CQUERY .  $BSSQUERIES . $CREPORT . $BSSREPORTS . $CADMIN . $CADM1  . $CADM2 . $CADM3 . $CADM4 . $CADM5 . $CADM6 . $endstring;
}ELSE
{
    $configstring = $startstring . $CTABLE . $BSSTABLES  . $CQUERY .  $BSSQUERIES . $CREPORT . $BSSREPORTS . $endstring;
}

echo $configstring;




?>