<?php
require_once('config.php');
include 'BSSSQLOperation.php';
include 'SQLConfig.php5';

$Con = new SQLConfig();
$arr = $Con->getName();


//var bssStore = Ext.create('Ext.data.Store', {
//    fields: [
//       {name: 'id'},
//       {name: 'phone_type'},
//       {name: 'phone_date', type: 'date', dateFormat: 'm/d/y'},
//       {name: 'phone_on',  type: 'bool'}
//    ],
//    data: [
//        {id: 1, phone_type: 'mobile', phone_date: '06/10/11',phone_on: 0},
//    ]
//});


$startstring = $arr[0]->startstring;
$endstring = $arr[0]->endstring;
$fieldstring = "";
$datastring = "";

    for ($i = 1; $i <= count($arr)-1; $i++) {


            $id = "id:'" . $arr[$i]->field  . "'";
            $header = "header:'" . $arr[$i]->heading . "'";
            $dataIndex = "dataIndex:'" . $arr[$i]->field  . "'";
            $width = "width: 20";
            $flex = "flex:1";
            $editor = "editor:{ allowBlank:false }";

            If($arr[$i]->renderedas === "Text"){
                $fieldstring = $fieldstring . "{ name: '" . $arr[$i]->field . "'},";
            }            

            If($arr[$i]->renderedas === "Combo"){
                $fieldstring = $fieldstring . "{ name: '" . $arr[$i]->field . "'},";
            } 

            If($arr[$i]->renderedas === "Date"){
                $fieldstring = $fieldstring . "{ name: '" . $arr[$i]->field . "', type: 'date', dateFormat: 'm/d/y'},";
            }
            
            If($arr[$i]->renderedas === "CheckBox"){
                $fieldstring = $fieldstring . "{ name: '" . $arr[$i]->field . "',  type: 'bool'},";
            }
            
            
            $datastring = $datastring . $arr[$i]->field . ": '',";


    }


$fieldstring = substr($fieldstring,0,strlen($fieldstring)-1);
$datastring = substr($datastring,0,strlen($datastring)-1);


$configstring = "{ fields: [" . $fieldstring . "], data: [{" . $datastring . "},]}";

echo $configstring;


?>