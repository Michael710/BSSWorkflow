<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 5/7/12
 * Time: 9:38 AM
 * To change this template use File | Settings | File Templates.
 */

include 'BSSSQLOperation.php';

class ReportConfig
   {


   public $configArray = Array();


         //this function used to make class PHP4 compatible
         function test() {
           $this->__construct();
         }
         function __construct() {

         }

         function getName($ReportName) {


             $this->configArray[0]->startstring = "";
             $this->configArray[0]->endstring = "";
             $this->configArray[0]->tablename = "Report";


             $this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel',columns:[ ";

             $this->configArray[0]->endstring =
                              "],
                              width: 900,
                              height: 600,
                              x: 10,
                              y: 10,
                              title: '" . $ReportName . "', " . "
                              frame: true,
                              plugins: [cellEditing1]}";

             mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
             mysql_select_db(DB) or die(mysql_error());

             $result = mysql_query("SELECT ReportSQLStatement, ReportFields, ReportHeaderLabels, ReportHeaderWidths, NumberOfFields FROM Reports WHERE
                                         ReportName = '" . $ReportName . "'");

             $row = mysql_fetch_assoc($result);
             $ReportSQL = $row["ReportSQLStatement"];
             $ReportFields = $row["ReportFields"];
             $ReportFieldWidths = $row["ReportHeaderWidths"];
             $ReportFieldLabels = $row["ReportHeaderLabels"];
             $ReportFieldCount = $row["NumberOfFields"];
             //php to convert a comma delimited list to an array

     //        echo $ReportSQL;
      //       echo $ReportFields;
       //      echo $ReportFieldWidths;
        //     echo $ReportFieldLabels;


             //$csv
             $delimiter=',';
             $enclosure='"';
             $escape='\\';


             $reportfields=explode($delimiter, $ReportFields);
             foreach($reportfields as $key=>$val)
                 if( substr($val,0,1)==$enclosure )
                     $reportfields[$key] = str_replace($enclosure.$enclosure,$enclosure,substr($val, 1,-1));

             $reportfieldlabels=explode($delimiter, $ReportFieldLabels);
             foreach($reportfieldlabels as $key=>$val)
                 if( substr($val,0,1)==$enclosure )
                     $reportfieldlabels[$key] = str_replace($enclosure.$enclosure,$enclosure,substr($val, 1,-1));

             $reportfieldwidths=explode($delimiter, $ReportFieldWidths);
             foreach($reportfieldwidths as $key=>$val)
                 if( substr($val,0,1)==$enclosure )
                     $reportfieldwidths[$key] = str_replace($enclosure.$enclosure,$enclosure,substr($val, 1,-1));


//    echo $reportfields[0];
//    echo $reportfields[1];
 //   echo $reportfields[2];


       //      $result = mysql_query($ReportSQL);   // where tablename = $configname

                       $Y = 0;
                       $this->configArray[$Y]->reportsql = $ReportSQL;
                       while ($Y < $ReportFieldCount){
                          $this->configArray[$Y]->width = $reportfieldwidths[$Y];
                          $this->configArray[$Y]->field = $reportfields[$Y];
                          $this->configArray[$Y]->heading = $reportfieldlabels[$Y];
                          $this->configArray[$Y]->renderedas = 'Text'; //$row['renderedas'];
                          $this->configArray[$Y]->foreignkeytable = "";
                          $this->configArray[$Y]->foreignkey = "";
                          $this->configArray[$Y]->foreignkeyfield = "";
                          $this->configArray[$Y]->defaultvalue = "";
                          $Y = $Y + 1;
                       }

                       mysql_free_result($result);

            return $this->configArray;


         }

   }
   ?>

