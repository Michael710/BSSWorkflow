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


$BSSWorkflowModel = stripcslashes($_GET['$BSSWorkflowModel']);

//echo $BSSWorkflowModel;

/*
$BSSWorkflowModelAA ='{"class": "go.GraphLinksModel",
        "linkFromPortIdProperty": "fromPort",
        "linkToPortIdProperty": "toPort",
        "nodeDataArray": [ ' .

    '{"key":-13, "category":"Comment", "loc":"360 -10", "text":"Kookie Brittle"},
        {"key":-1,  "category":"Start", "loc":"175 0", "text":"Start"},
        {"key":0,   "category":"Step", "loc":"25 90",  "text":"Step 1"},
        {"key":1,   "category":"Step", "loc":"175 90", "text":"Step 2"},
        {"key":2,   "category":"Step", "loc":"175 180", "text":"Step 3"},
        {"key":3,   "category":"Step","loc":"175 270", "text":"Step 4"},
        {"key":4,   "category":"Step","loc":"175 360", "text":"Step 5"},
        {"key":5,   "category":"Review","loc":"325 90", "text":"Step 6"},
        {"key":6,   "category":"Review","loc":"175 430", "text":"Step 7"},
        {"key":7,   "category":"Rejected","loc":"175 490", "text":"Step 8"},
        {"key":8,   "category":"Rejected","loc":"175 540", "text":"Step 9"},
        {"key":9,   "category":"Step","loc":"175 590", "text":"Step 9"},
        {"key":-2,  "category":"End", "loc":"175 640", "text":"Enjoy!"}' .

    '],  "linkDataArray": [ ' .

       '{"from":1, "to":2, "fromPort":"B", "toPort":"T"},
        {"from":2, "to":3, "fromPort":"B", "toPort":"T"},
        {"from":3, "to":4, "fromPort":"B", "toPort":"T"},
        {"from":4, "to":6, "fromPort":"B", "toPort":"T"},
        {"from":6, "to":7, "fromPort":"B", "toPort":"T"},
        {"from":7, "to":8, "fromPort":"B", "toPort":"T"},
        {"from":8, "to":9, "fromPort":"B", "toPort":"T"},
        {"from":9, "to":-2, "fromPort":"B", "toPort":"T"},
        {"from":-1, "to":0, "fromPort":"B", "toPort":"T"},
        {"from":-1, "to":1, "fromPort":"B", "toPort":"T"},
        {"from":-1, "to":5, "fromPort":"B", "toPort":"T"},
        {"from":5, "to":6, "fromPort":"B", "toPort":"T"},
        {"from":0, "to":6, "fromPort":"B", "toPort":"T"}
        ]}  ';

 */

$root = json_decode($BSSWorkflowModel, true );
$mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
mysql_select_db(DB, $mysql) or die(mysql_error());

//echo $SQLQuery;


foreach( $root['nodeDataArray'] as $nodeDataArray ) {

    $SQLQuery =  "UPDATE AdvWorkflowStep SET workflowid = " . "4" .
                                            ",stepkey = '" . $nodeDataArray['key'] .
                                            "',Category = '" . $nodeDataArray['category'].
                                            "',location  = '" . $nodeDataArray['loc'].
                                            "',name = '". $nodeDataArray['text']."' WHERE workflowid = " . "4";
    echo $SQLQuery;

    $result = mysql_query($SQLQuery);


}



foreach( $root['linkDataArray'] as $linkDataArray ) {


    $SQLQuery =  "UPDATE AdvWorkflowStepLine SET workflowid,nstepkey,Category,loc,name)VALUES(1,".$linkDataArray['from'] ."','" . $linkDataArray['to']."','" . $linkDataArray['fromPort']."','" . $linkDataArray['toPort']."')";
    echo $SQLQuery;

    //$result = mysql_query($SQLQuery);

}






?>

