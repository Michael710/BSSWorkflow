<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 5/7/12
 * Time: 11:37 PM
 * To change this template use File | Settings | File Templates.
 */

require_once('config.php');
   include 'BSSGetReport.php';



   $Con = new ReportConfig();
   $arr = $Con->getName($_GET['BSSReportName']);
   $configname = $_GET['BSSReportName'];
   $startstring = $arr[0]->startstring;
   $endstring = $arr[0]->endstring;
   $colstring = "";



       for ($i = 0; $i <= count($arr)-1; $i++) {

           //Text Box code
           If($arr[$i]->renderedas === "Text"){

//echo $i;

               $id = "id:'" . "TR" . "-" . $arr[$i]->field  . "'";
               $header = "header:'" . $arr[$i]->heading . "'";
               $dataIndex = "dataIndex:'" . $arr[$i]->field  . "'";
               //$width = "width: 100";
               $width = "width: ". $arr[$i]->width;
               $flex = "disabled: false";
               $editor = "editor:{ allowBlank:false }";

               $colstring = $colstring . "{ " . $id . ", " . $header  . ", " . $dataIndex  . ", " . $width  . ", " . $flex  . ", " . $editor . " },";

           }
       }


$colstring = substr($colstring,0,strlen($colstring)-1);

$configstring = $startstring . $colstring  . $endstring;

echo $configstring;
