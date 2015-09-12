<?php
require_once('config.php');
include 'BSSSQLOperation.php';
include 'BSSSQLConfig.php';

$Con = new SQLConfig();
$arr = $Con->getName($_GET['BSSConfigName'],'MASTER','');


$startstring = $arr[0]->startstring;
$endstring = $arr[0]->endstring;
$fieldstring = "";
$datastring = "";
$configname = $_GET['BSSConfigName'];

    for ($i = 1; $i <= count($arr)-1; $i++) {


            $id = "id:'" . $arr[$i]->field  . "'";
            $header = "header:'" . $arr[$i]->heading . "'";
            $dataIndex = "dataIndex:'" . $arr[$i]->field  . "'";
            $width = "width: 20";
            $flex = "flex:1";
            $editor = "editor:{ allowBlank:false }";

            If(strtoupper($arr[$i]->renderedas) === "TEXT"){
                $fieldstring = $fieldstring . "{ name: '" . $arr[$i]->field . "'},";
            }            

            If(strtoupper($arr[$i]->renderedas) === "COMBO"){
                $fieldstring = $fieldstring . "{ name: '" . $arr[$i]->field . "'},";
            } 

            If(strtoupper($arr[$i]->renderedas) === "DATE"){
                $fieldstring = $fieldstring . "{ name: '" . $arr[$i]->field . "', type: 'date', dateFormat: 'Y-m-d H:i:s'},";
            }
            
            If(strtoupper($arr[$i]->renderedas) === "CHECKBOX"){
                $fieldstring = $fieldstring . "{ name: '" . $arr[$i]->field . "',  type: 'bool'},";
            }
            
            
            $datastring = $datastring . $arr[$i]->field . ": '',";


    }


$fieldstring = substr($fieldstring,0,strlen($fieldstring)-1);
$datastring = substr($datastring,0,strlen($datastring)-1);


$configstring = "{ fields: [" . $fieldstring . "], data: [{" . $datastring . "},]}";

echo $configstring;


?>