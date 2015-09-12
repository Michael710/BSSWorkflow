<?php
require_once('config.php');
include 'BSSSQLOperation.php';
include 'SQLConfig.php5';

$Con = new BSSSQLConfig();
$arr = $Con->getName($_GET['BSSConfigName']);



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