<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 1/2/12
 * Time: 9:43 PM
 * To change this template use File | Settings | File Templates.
 */



class SQLConfig
{


public $configArray = Array();


      //this function used to make class PHP4 compatible
      function test() {
        $this->__construct();
      }
      function __construct() {

      }

      function getName($configname, $mode, $userid) {


          $this->configArray[0]->startstring = "";
          $this->configArray[0]->endstring = "";
          $this->configArray[0]->tablename = "";


          //Create Call to Get Role Data
          /*
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
          */

          $masteradd = "BSSCREATEMASTER_FLAG";
          $mastersave = "BSSUPDATEMASTER_FLAG";
          $masterdelete = "BSSDELETEMASTER_FLAG";

          $childadd = "BSSCREATECHILD_FLAG";
          $childsave = "BSSUPDATECHILD_FLAG";
          $childdelete = "BSSDELETECHILD_FLAG";


          if($mode == 'CHILD'){

                $this->configArray[0]->startstring = "{ store: childStore, selModel: 'cellmodel', columns:[ ";
                $this->configArray[0]->endstring =
                           "],
                           width: 960,
                           height: 300,
                           x: 5,
                           y: 5,
                           title: '" . $configname . "', " . "
                           frame: true,
                           tbar: [{text: 'Add',    disabled: " . $childadd . ", handler : function() {processInsert(BSSChildConfigName,childgrid,childStore);}},
                                  {text: 'Save',   disabled: " . $childsave . ", handler : function() {processUpdate(BSSChildConfigName,childgrid,childStore);}},
                                  {text: 'Delete', disabled: " . $childdelete . ", handler : function() {processDelete(BSSChildConfigName,childgrid,childStore);}}
                           ],
                           plugins: [cellEditing]}";
          }else{
                $this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel', features: [filters], listeners: {itemclick: function() {ProcessChildTab();}},columns:[ ";
                //$this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel', columns:[ ";

                $this->configArray[0]->endstring =
                           "],
                           width: 900,
                           height: 280,
                           x: 20,
                           y: 10,
                           title: '" . $configname . "', " . "
                           frame: true,
                           tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                                  {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                                  {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                           ],
                           plugins: [cellEditing1]}";
          }




  //`id` int(11) NOT NULL AUTO_INCREMENT,
  //`width` int(11) DEFAULT NULL,
  //`field` varchar(45) DEFAULT NULL,
  //`heading` varchar(45) DEFAULT NULL,
  //`renderedas` int(11) DEFAULT NULL,
  //`foreignkeytable` varchar(45) DEFAULT NULL,
  //`foreignkey` varchar(45) DEFAULT NULL,
  //`foreignkeyfield` varchar(45) DEFAULT NULL,
  //`defaultvalue` varchar(45) DEFAULT NULL,



          if($configname == 'Tables'){

          $this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel', listeners: {itemclick: function() {ProcessChildTab();}},columns:[ ";

          $this->configArray[0]->endstring =
                     "],
                     width: 600,
                     height: 300,
                     x: 20,
                     y: 20,
                     title: 'Table Columns2',
                     frame: true,
                     tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                     ],
                     plugins: [cellEditing1]}";

          $this->configArray[0]->tablename = "Tables";

          $this->configArray[1]->width = 30;
          $this->configArray[1]->field = "id";
          $this->configArray[1]->heading = "Id";
          $this->configArray[1]->renderedas = "Text";
          $this->configArray[1]->foreignkeytable = "";
          $this->configArray[1]->foreignkey = "";
          $this->configArray[1]->foreignkeyfield = "";
          $this->configArray[1]->defaultvalue = 0;

          $this->configArray[2]->width = 30;
          $this->configArray[2]->field = "sequence";
          $this->configArray[2]->heading = "Sequence";
          $this->configArray[2]->renderedas = "Text";
          $this->configArray[2]->foreignkeytable = "";
          $this->configArray[2]->foreignkey = "";
          $this->configArray[2]->foreignkeyfield = "";
          $this->configArray[2]->defaultvalue = 0;

          $this->configArray[3]->width = 30;
          $this->configArray[3]->field = "masterid";
          $this->configArray[3]->heading = "Table Id";
          $this->configArray[3]->renderedas = "Text";
          $this->configArray[3]->foreignkeytable = "";
          $this->configArray[3]->foreignkey = "";
          $this->configArray[3]->foreignkeyfield = "";
          $this->configArray[3]->defaultvalue = 0;

          $this->configArray[4]->width = 30;
          $this->configArray[4]->field = "TableName";
          $this->configArray[4]->heading = "Table Name";
          $this->configArray[4]->renderedas = "Text";
          $this->configArray[4]->foreignkeytable = "";
          $this->configArray[4]->foreignkey = "";
          $this->configArray[4]->foreignkeyfield = "";
          $this->configArray[4]->defaultvalue = 'EDIT THE NAME';

          $this->configArray[5]->width = 40;
          $this->configArray[5]->field = "TableDescription";
          $this->configArray[5]->heading = "Table Description";
          $this->configArray[5]->renderedas = "Text";
          $this->configArray[5]->foreignkeytable = "";
          $this->configArray[5]->foreignkey = "";
          $this->configArray[5]->foreignkeyfield = "";
          $this->configArray[5]->defaultvalue = '';

          $this->configArray[6]->width = 60;
          $this->configArray[6]->field = "DBTYPE";
          $this->configArray[6]->heading = "DB Type";
          $this->configArray[6]->renderedas = "Combo";
          $this->configArray[6]->foreignkeytable = "DBTYPE";
          $this->configArray[6]->foreignkey = "id";
          $this->configArray[6]->foreignkeyfield = "DBTYPE";
          $this->configArray[6]->defaultvalue = '';

          $this->configArray[7]->width = 60;
          $this->configArray[7]->field = "DBHOST";
          $this->configArray[7]->heading = "DBHOST";
          $this->configArray[7]->renderedas = "Text";
          $this->configArray[7]->foreignkeytable = "";
          $this->configArray[7]->foreignkey = "";
          $this->configArray[7]->foreignkeyfield = "";
          $this->configArray[7]->defaultvalue = 'localhost';

          $this->configArray[8]->width = 60;
          $this->configArray[8]->field = "DBNAME";
          $this->configArray[8]->heading = "DBNAME";
          $this->configArray[8]->renderedas = "Text";
          $this->configArray[8]->foreignkeytable = "";
          $this->configArray[8]->foreignkey = "";
          $this->configArray[8]->foreignkeyfield = "";
          $this->configArray[8]->defaultvalue = '';

          $this->configArray[9]->width = 60;
          $this->configArray[9]->field = "DBUSER";
          $this->configArray[9]->heading = "DBUSER";
          $this->configArray[9]->renderedas = "Text";
          $this->configArray[9]->foreignkeytable = "";
          $this->configArray[9]->foreignkey = "";
          $this->configArray[9]->foreignkeyfield = "";
          $this->configArray[9]->defaultvalue = '';


          $this->configArray[10]->width = 60;
          $this->configArray[10]->field = "DBPASSWORD";
          $this->configArray[10]->heading = "DBPASSWORD";
          $this->configArray[10]->renderedas = "Text";
          $this->configArray[10]->foreignkeytable = "";
          $this->configArray[10]->foreignkey = "";
          $this->configArray[10]->foreignkeyfield = "";
          $this->configArray[10]->defaultvalue = '';



          return $this->configArray;

          }


          if($configname === 'TableColumns'){

          $this->configArray[0]->startstring = "{ store: childStore, selModel: 'cellmodel', columns:[ ";
          $this->configArray[0]->endstring =
                     "],
                     width: 960,
                     height: 300,
                     x: 0,
                     y: 0,
                     title: 'Table Columns1',
                     frame: true,
                     tbar: [{text: 'Add',    disabled: " . $childadd . ", handler : function() {processInsert(BSSChildConfigName,childgrid,childStore);}},
                            {text: 'Save',   disabled: " . $childsave . ", handler : function() {processUpdate(BSSChildConfigName,childgrid,childStore);}},
                            {text: 'Delete', disabled: " . $childdelete . ", handler : function() {processDelete(BSSChildConfigName,childgrid,childStore);}}
                     ],
                     plugins: [cellEditing]}";


          $this->configArray[0]->tablename = "TableColumns";

          $this->configArray[1]->width = 30;
          $this->configArray[1]->field = "id";
          $this->configArray[1]->heading = "Id";
          $this->configArray[1]->renderedas = "Text";
          $this->configArray[1]->foreignkeytable = "";
          $this->configArray[1]->foreignkey = "";
          $this->configArray[1]->foreignkeyfield = "";
          $this->configArray[1]->defaultvalue = 0;

          $this->configArray[2]->width = 30;
          $this->configArray[2]->field = "sequence";
          $this->configArray[2]->heading = "Sequence";
          $this->configArray[2]->renderedas = "Text";
          $this->configArray[2]->foreignkeytable = "";
          $this->configArray[2]->foreignkey = "";
          $this->configArray[2]->foreignkeyfield = "";
          $this->configArray[2]->defaultvalue = 0;

          $this->configArray[3]->width = 30;
          $this->configArray[3]->field = "masterid";
          $this->configArray[3]->heading = "Table Id";
          $this->configArray[3]->renderedas = "Text";
          $this->configArray[3]->foreignkeytable = "";
          $this->configArray[3]->foreignkey = "";
          $this->configArray[3]->foreignkeyfield = "";
          $this->configArray[3]->defaultvalue = 0;

          $this->configArray[4]->width = 30;
          $this->configArray[4]->field = "format";
          $this->configArray[4]->heading = "Format";
          $this->configArray[4]->renderedas = "Text";
          $this->configArray[4]->foreignkeytable = "";
          $this->configArray[4]->foreignkey = "";
          $this->configArray[4]->foreignkeyfield = "";
          $this->configArray[4]->defaultvalue = '';

          $this->configArray[5]->width = 40;
          $this->configArray[5]->field = "fieldname";
          $this->configArray[5]->heading = "Field Name";
          $this->configArray[5]->renderedas = "Text";
          $this->configArray[5]->foreignkeytable = "";
          $this->configArray[5]->foreignkey = "";
          $this->configArray[5]->foreignkeyfield = "";
          $this->configArray[5]->defaultvalue = 0;

          $this->configArray[6]->width = 40;
          $this->configArray[6]->field = "heading";
          $this->configArray[6]->heading = "Heading";
          $this->configArray[6]->renderedas = "Text";
          $this->configArray[6]->foreignkeytable = "";
          $this->configArray[6]->foreignkey = "";
          $this->configArray[6]->foreignkeyfield = "";
          $this->configArray[6]->defaultvalue = '';

          $this->configArray[7]->width = 40;
          $this->configArray[7]->field = "renderedas";
          $this->configArray[7]->heading = "Rendered As";
          $this->configArray[7]->renderedas = "Combo";
          $this->configArray[7]->foreignkeytable = "RenderedAs";
          $this->configArray[7]->foreignkey = "id";
          $this->configArray[7]->foreignkeyfield = "RenderedAs";
          $this->configArray[7]->defaultvalue = 0;

          $this->configArray[8]->width = 40;
          $this->configArray[8]->field = "foreignkeytable";
          $this->configArray[8]->heading = "Foreign Key Table";
          $this->configArray[8]->renderedas = "Combo";
          $this->configArray[8]->foreignkeytable = "Tables";
          $this->configArray[8]->foreignkey = "id";
          $this->configArray[8]->foreignkeyfield = "TableName";
          $this->configArray[8]->defaultvalue = '';

          $this->configArray[9]->width = 40;
          $this->configArray[9]->field = "foreignkey";
          $this->configArray[9]->heading = "Foreign Key";
          $this->configArray[9]->renderedas = "Text";
          $this->configArray[9]->foreignkeytable = "";
          $this->configArray[9]->foreignkey = "";
          $this->configArray[9]->foreignkeyfield = "";
          $this->configArray[9]->defaultvalue = '';

          $this->configArray[10]->width = 40;
          $this->configArray[10]->field = "foreignkeyfield";
          $this->configArray[10]->heading = "Foreign Key Field";
          $this->configArray[10]->renderedas = "Text";
          $this->configArray[10]->foreignkeytable = "";
          $this->configArray[10]->foreignkey = "";
          $this->configArray[10]->foreignkeyfield = "";
          $this->configArray[10]->defaultvalue = '';

          $this->configArray[11]->width = 40;
          $this->configArray[11]->field = "defaultvalue";
          $this->configArray[11]->heading = "Default Value";
          $this->configArray[11]->renderedas = "Text";
          $this->configArray[11]->foreignkeytable = "";
          $this->configArray[11]->foreignkey = "";
          $this->configArray[11]->foreignkeyfield = "";
          $this->configArray[11]->defaultvalue = '';

          $this->configArray[12]->width = 40;
          $this->configArray[12]->field = "width";
          $this->configArray[12]->heading = "Width";
          $this->configArray[12]->renderedas = "Text";
          $this->configArray[12]->foreignkeytable = "";
          $this->configArray[12]->foreignkey = "";
          $this->configArray[12]->foreignkeyfield = "";
          $this->configArray[12]->defaultvalue = '';

          return $this->configArray;
          }



          if($configname === 'Actions'){


          $masteradd = "false";
          $mastersave = "false";
          $masterdelete = "false";


          $this->configArray[0]->tablename = "Actions";

          $this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel', listeners: {itemclick: function() {ProcessChildTab();}},columns:[ ";
          //$this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel', columns:[ ";

          $this->configArray[0]->endstring =
                     "],
                     width: 920,
                     height: 390,
                     x: 10,
                     y: 10,
                     title: '" . $configname . "', " . "
                     frame: true,
                     tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                     ],
                     plugins: [cellEditing1]}";

          $this->configArray[1]->width = 30;
          $this->configArray[1]->field = "id";
          $this->configArray[1]->heading = "Id";
          $this->configArray[1]->renderedas = "Text";
          $this->configArray[1]->foreignkeytable = "";
          $this->configArray[1]->foreignkey = "";
          $this->configArray[1]->foreignkeyfield = "";
          $this->configArray[1]->defaultvalue = 0;

          $this->configArray[2]->width = 60;
          $this->configArray[2]->field = "sequence";
          $this->configArray[2]->heading = "Sequence";
          $this->configArray[2]->renderedas = "Text";
          $this->configArray[2]->foreignkeytable = "";
          $this->configArray[2]->foreignkey = "";
          $this->configArray[2]->foreignkeyfield = "";
          $this->configArray[2]->defaultvalue = 0;

          $this->configArray[3]->width = 60;
          $this->configArray[3]->field = "masterid";
          $this->configArray[3]->heading = "Table Id";
          $this->configArray[3]->renderedas = "Text";
          $this->configArray[3]->foreignkeytable = "";
          $this->configArray[3]->foreignkey = "";
          $this->configArray[3]->foreignkeyfield = "";
          $this->configArray[3]->defaultvalue = 0;

          $this->configArray[4]->width = 100;
          $this->configArray[4]->field = "action";
          $this->configArray[4]->heading = "Action Name";
          $this->configArray[4]->renderedas = "Text";
          $this->configArray[4]->foreignkeytable = "";
          $this->configArray[4]->foreignkey = "";
          $this->configArray[4]->foreignkeyfield = "";
          $this->configArray[4]->defaultvalue = 0;

          $this->configArray[5]->width = 200;
          $this->configArray[5]->field = "actiondescription";
          $this->configArray[5]->heading = "Action Description";
          $this->configArray[5]->renderedas = "Text";
          $this->configArray[5]->foreignkeytable = "";
          $this->configArray[5]->foreignkey = "";
          $this->configArray[5]->foreignkeyfield = "";
          $this->configArray[5]->defaultvalue = 0;

          $this->configArray[6]->width = 150;
          $this->configArray[6]->field = "actiontype";
          $this->configArray[6]->heading = "Action Type";
          $this->configArray[6]->renderedas = "Combo";
          $this->configArray[6]->foreignkeytable = "ACTIONTYPE";
          $this->configArray[6]->foreignkey = "id";
          $this->configArray[6]->foreignkeyfield = "ACTIONTYPE";
          $this->configArray[6]->defaultvalue = 0;


          $this->configArray[7]->width = 300;
          $this->configArray[7]->field = "actionurl";
          $this->configArray[7]->heading = "Action URL";
          $this->configArray[7]->renderedas = "Text";
          $this->configArray[7]->foreignkeytable = "";
          $this->configArray[7]->foreignkey = "";
          $this->configArray[7]->foreignkeyfield = "";
          $this->configArray[7]->defaultvalue = "";

          $this->configArray[8]->width = 150;
          $this->configArray[8]->field = "notificationid";
          $this->configArray[8]->heading = "Notification";
          $this->configArray[8]->renderedas = "Combo";
          $this->configArray[8]->foreignkeytable = "Notifications";
          $this->configArray[8]->foreignkey = "id";
          $this->configArray[8]->foreignkeyfield = "NotificationName";
          $this->configArray[8]->defaultvalue = "";


          return $this->configArray;

          }

          if($configname === 'Reports'){


          $masteradd = "false";
          $mastersave = "false";
          $masterdelete = "false";


          $this->configArray[0]->tablename = "Reports";

          $this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel', listeners: {itemclick: function() {ProcessChildTab();}},columns:[ ";
                        //$this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel', columns:[ ";
          $this->configArray[0]->endstring =
                   "],
                   width: 920,
                   height: 360,
                   x: 10,
                   y: 10,
                   title: '" . $configname . "', " . "
                   frame: true,
                   tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                          {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                          {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                   ],
                   plugins: [cellEditing1]}";

          $this->configArray[1]->width = 30;
          $this->configArray[1]->field = "id";
          $this->configArray[1]->heading = "Id";
          $this->configArray[1]->renderedas = "Text";
          $this->configArray[1]->foreignkeytable = "";
          $this->configArray[1]->foreignkey = "";
          $this->configArray[1]->foreignkeyfield = "";
          $this->configArray[1]->defaultvalue = 0;

          $this->configArray[2]->width = 30;
          $this->configArray[2]->field = "sequence";
          $this->configArray[2]->heading = "Sequence";
          $this->configArray[2]->renderedas = "Text";
          $this->configArray[2]->foreignkeytable = "";
          $this->configArray[2]->foreignkey = "";
          $this->configArray[2]->foreignkeyfield = "";
          $this->configArray[2]->defaultvalue = 0;

          $this->configArray[3]->width = 30;
          $this->configArray[3]->field = "masterid";
          $this->configArray[3]->heading = "Table Id";
          $this->configArray[3]->renderedas = "Text";
          $this->configArray[3]->foreignkeytable = "";
          $this->configArray[3]->foreignkey = "";
          $this->configArray[3]->foreignkeyfield = "";
          $this->configArray[3]->defaultvalue = 0;

          $this->configArray[4]->width = 80;
          $this->configArray[4]->field = "ReportName";
          $this->configArray[4]->heading = "Report Name";
          $this->configArray[4]->renderedas = "Text";
          $this->configArray[4]->foreignkeytable = "";
          $this->configArray[4]->foreignkey = "";
          $this->configArray[4]->foreignkeyfield = "";
          $this->configArray[4]->defaultvalue = "";

          $this->configArray[5]->width = 200;
          $this->configArray[5]->field = "ReportDescription";
          $this->configArray[5]->heading = "Report Description";
          $this->configArray[5]->renderedas = "Text";
          $this->configArray[5]->foreignkeytable = "";
          $this->configArray[5]->foreignkey = "";
          $this->configArray[5]->foreignkeyfield = "";
          $this->configArray[5]->defaultvalue = "";

          $this->configArray[6]->width = 80;
          $this->configArray[6]->field = "ReportType";
          $this->configArray[6]->heading = "Report Type";
          $this->configArray[6]->renderedas = "Combo";
          $this->configArray[6]->foreignkeytable = "REPORTTYPE";
          $this->configArray[6]->foreignkey = "id";
          $this->configArray[6]->foreignkeyfield = "REPORTTYPE";
          $this->configArray[6]->defaultvalue = 1;


          $this->configArray[7]->width = 200;
          $this->configArray[7]->field = "ReportUrl";
          $this->configArray[7]->heading = "Report URL";
          $this->configArray[7]->renderedas = "Text";
          $this->configArray[7]->foreignkeytable = "";
          $this->configArray[7]->foreignkey = "";
          $this->configArray[7]->foreignkeyfield = "";
          $this->configArray[7]->defaultvalue = "";


          $this->configArray[8]->width = 200;
          $this->configArray[8]->field = "ReportSQLStatement";
          $this->configArray[8]->heading = "Report SQL Statement";
          $this->configArray[8]->renderedas = "Text";
          $this->configArray[8]->foreignkeytable = "";
          $this->configArray[8]->foreignkey = "";
          $this->configArray[8]->foreignkeyfield = "";
          $this->configArray[8]->defaultvalue = "";

          $this->configArray[9]->width = 200;
          $this->configArray[9]->field = "ReportFields";
          $this->configArray[9]->heading = "Report Fields";
          $this->configArray[9]->renderedas = "Text";
          $this->configArray[9]->foreignkeytable = "";
          $this->configArray[9]->foreignkey = "";
          $this->configArray[9]->foreignkeyfield = "";
          $this->configArray[9]->defaultvalue = "";

          $this->configArray[10]->width = 200;
          $this->configArray[10]->field = "ReportHeaderLabels";
          $this->configArray[10]->heading = "Report Header Labels";
          $this->configArray[10]->renderedas = "Text";
          $this->configArray[10]->foreignkeytable = "";
          $this->configArray[10]->foreignkey = "";
          $this->configArray[10]->foreignkeyfield = "";
          $this->configArray[10]->defaultvalue = "";


          $this->configArray[11]->width = 200;
          $this->configArray[11]->field = "ReportHeaderWidths";
          $this->configArray[11]->heading = "Report Header Widths";
          $this->configArray[11]->renderedas = "Text";
          $this->configArray[11]->foreignkeytable = "";
          $this->configArray[11]->foreignkey = "";
          $this->configArray[11]->foreignkeyfield = "";
          $this->configArray[11]->defaultvalue = "";

          $this->configArray[12]->width = 200;
          $this->configArray[12]->field = "NumberOfFields";
          $this->configArray[12]->heading = "Number Of Fields";
          $this->configArray[12]->renderedas = "Text";
          $this->configArray[12]->foreignkeytable = "";
          $this->configArray[12]->foreignkey = "";
          $this->configArray[12]->foreignkeyfield = "";
          $this->configArray[12]->defaultvalue = "";

          $this->configArray[13]->width = 80;
          $this->configArray[13]->field = "ReportScope";
          $this->configArray[13]->heading = "Report Scope";
          $this->configArray[13]->renderedas = "Combo";
          $this->configArray[13]->foreignkeytable = "SCOPE";
          $this->configArray[13]->foreignkey = "id";
          $this->configArray[13]->foreignkeyfield = "SCOPE";
          $this->configArray[13]->defaultvalue = 1;

          $this->configArray[14]->width = 80;
          $this->configArray[14]->field = "ReportUser";
          $this->configArray[14]->heading = "Report User";
          $this->configArray[14]->renderedas = "Combo";
          $this->configArray[14]->foreignkeytable = "users";
          $this->configArray[14]->foreignkey = "id";
          $this->configArray[14]->foreignkeyfield = "email";
          $this->configArray[14]->defaultvalue = "";

          return $this->configArray;

          }




          if($configname === 'EnterpriseObjects'){

          $masteradd = "false";
          $mastersave = "false";
          $masterdelete = "false";

          $this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel', listeners: {itemclick: function() {ProcessChildTab();}},columns:[ ";

              $this->configArray[0]->endstring =
                         "],
                         width: 910,
                         height: 350,
                         x: 10,
                         y: 10,
                         title: '" . $configname . "', " . "
                         frame: true,
                         tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                                {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                                {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                         ],
                         plugins: [cellEditing1]}";




          $this->configArray[0]->tablename = "EnterpriseObjects";

          $this->configArray[1]->width = 30;
          $this->configArray[1]->field = "id";
          $this->configArray[1]->heading = "Id";
          $this->configArray[1]->renderedas = "Text";
          $this->configArray[1]->foreignkeytable = "";
          $this->configArray[1]->foreignkey = "";
          $this->configArray[1]->foreignkeyfield = "";
          $this->configArray[1]->defaultvalue = 0;

          $this->configArray[2]->width = 30;
          $this->configArray[2]->field = "sequence";
          $this->configArray[2]->heading = "Sequence";
          $this->configArray[2]->renderedas = "Text";
          $this->configArray[2]->foreignkeytable = "";
          $this->configArray[2]->foreignkey = "";
          $this->configArray[2]->foreignkeyfield = "";
          $this->configArray[2]->defaultvalue = 0;

          $this->configArray[3]->width = 30;
          $this->configArray[3]->field = "masterid";
          $this->configArray[3]->heading = "Table Id";
          $this->configArray[3]->renderedas = "Text";
          $this->configArray[3]->foreignkeytable = "";
          $this->configArray[3]->foreignkey = "";
          $this->configArray[3]->foreignkeyfield = "";
          $this->configArray[3]->defaultvalue = 0;

          $this->configArray[4]->width = 80;
          $this->configArray[4]->field = "ProfileName";
          $this->configArray[4]->heading = "Profile Name";
          $this->configArray[4]->renderedas = "Text";
          $this->configArray[4]->foreignkeytable = "";
          $this->configArray[4]->foreignkey = "";
          $this->configArray[4]->foreignkeyfield = "";
          $this->configArray[4]->defaultvalue = 0;

          $this->configArray[5]->width = 200;
          $this->configArray[5]->field = "ProfileDescription";
          $this->configArray[5]->heading = "Profile Description";
          $this->configArray[5]->renderedas = "Text";
          $this->configArray[5]->foreignkeytable = "";
          $this->configArray[5]->foreignkey = "";
          $this->configArray[5]->foreignkeyfield = "";
          $this->configArray[5]->defaultvalue = 0;

          $this->configArray[6]->width = 80;
          $this->configArray[6]->field = "ProfileType";
          $this->configArray[6]->heading = "Profile Type";
          $this->configArray[6]->renderedas = "Combo";
          $this->configArray[6]->foreignkeytable = "PROFILETYPE";
          $this->configArray[6]->foreignkey = "id";
          $this->configArray[6]->foreignkeyfield = "PROFILETYPE";
          $this->configArray[6]->defaultvalue = 0;



          $this->configArray[7]->width = 80;
          $this->configArray[7]->field = "MasterTable";
          $this->configArray[7]->heading = "Master Table";
          $this->configArray[7]->renderedas = "Combo";
          $this->configArray[7]->foreignkeytable = "Tables";
          $this->configArray[7]->foreignkey = "id";
          $this->configArray[7]->foreignkeyfield = "TableName";
          $this->configArray[7]->defaultvalue = '0';

          $this->configArray[8]->width = 80;
          $this->configArray[8]->field = "MasterField";
          $this->configArray[8]->heading = "Master Field";
          $this->configArray[8]->renderedas = "Combo";
          $this->configArray[8]->foreignkeytable = "TableColumns";
          $this->configArray[8]->foreignkey = "id";
          $this->configArray[8]->foreignkeyfield = "fieldname";
          $this->configArray[8]->defaultvalue = '';

          $this->configArray[9]->width = 80;
          $this->configArray[9]->field = "ChildTable";
          $this->configArray[9]->heading = "Child Table";
          $this->configArray[9]->renderedas = "Combo";
          $this->configArray[9]->foreignkeytable = "Tables";
          $this->configArray[9]->foreignkey = "id";
          $this->configArray[9]->foreignkeyfield = "TableName";
          $this->configArray[9]->defaultvalue = '';

          $this->configArray[10]->width = 80;
          $this->configArray[10]->field = "ChildTableField";
          $this->configArray[10]->heading = "Child Table Field";
          $this->configArray[10]->renderedas = "Combo";
          $this->configArray[10]->foreignkeytable = "TableColumns";
          $this->configArray[10]->foreignkey = "id";
          $this->configArray[10]->foreignkeyfield = "fieldname";
          $this->configArray[10]->defaultvalue = '';


          $this->configArray[11]->width = 60;
          $this->configArray[11]->field = "EnableDocs";
          $this->configArray[11]->heading = "Enable Docs";
          $this->configArray[11]->renderedas = "CheckBox";
          $this->configArray[11]->foreignkeytable = "";
          $this->configArray[11]->foreignkey = "";
          $this->configArray[11]->foreignkeyfield = "";
          $this->configArray[11]->defaultvalue = '';

          $this->configArray[12]->width = 60;
          $this->configArray[12]->field = "EnableDiscussions";
          $this->configArray[12]->heading = "Enable Discussions";
          $this->configArray[12]->renderedas = "CheckBox";
          $this->configArray[12]->foreignkeytable = "";
          $this->configArray[12]->foreignkey = "";
          $this->configArray[12]->foreignkeyfield = "";
          $this->configArray[12]->defaultvalue = '';

          $this->configArray[13]->width = 60;
          $this->configArray[13]->field = "EnableHistory";
          $this->configArray[13]->heading = "Enable History";
          $this->configArray[13]->renderedas = "CheckBox";
          $this->configArray[13]->foreignkeytable = "";
          $this->configArray[13]->foreignkey = "";
          $this->configArray[13]->foreignkeyfield = "";
          $this->configArray[13]->defaultvalue = '';

          $this->configArray[14]->width = 60;
          $this->configArray[14]->field = "EnableWorkflow";
          $this->configArray[14]->heading = "Enable Workflow";
          $this->configArray[14]->renderedas = "CheckBox";
          $this->configArray[14]->foreignkeytable = "";
          $this->configArray[14]->foreignkey = "";
          $this->configArray[14]->foreignkeyfield = "";
          $this->configArray[14]->defaultvalue = '';

          $this->configArray[15]->width = 60;
          $this->configArray[15]->field = "Action1";
          $this->configArray[15]->heading = "Action1";
          $this->configArray[15]->renderedas = "Combo";
          $this->configArray[15]->foreignkeytable = "Actions";
          $this->configArray[15]->foreignkey = "id";
          $this->configArray[15]->foreignkeyfield = "action";
          $this->configArray[15]->defaultvalue = '';

          $this->configArray[16]->width = 60;
          $this->configArray[16]->field = "Action2";
          $this->configArray[16]->heading = "Action2";
          $this->configArray[16]->renderedas = "Combo";
          $this->configArray[16]->foreignkeytable = "Actions";
          $this->configArray[16]->foreignkey = "id";
          $this->configArray[16]->foreignkeyfield = "action";
          $this->configArray[16]->defaultvalue = '';

          $this->configArray[17]->width = 60;
          $this->configArray[17]->field = "Action3";
          $this->configArray[17]->heading = "Action3";
          $this->configArray[17]->renderedas = "Combo";
          $this->configArray[17]->foreignkeytable = "Actions";
          $this->configArray[17]->foreignkey = "id";
          $this->configArray[17]->foreignkeyfield = "action";
          $this->configArray[17]->defaultvalue = '';

          $this->configArray[18]->width = 60;
          $this->configArray[18]->field = "Action4";
          $this->configArray[18]->heading = "Action4";
          $this->configArray[18]->renderedas = "Combo";
          $this->configArray[18]->foreignkeytable = "Actions";
          $this->configArray[18]->foreignkey = "id";
          $this->configArray[18]->foreignkeyfield = "action";
          $this->configArray[18]->defaultvalue = '';

          $this->configArray[19]->width = 60;
          $this->configArray[19]->field = "Action5";
          $this->configArray[19]->heading = "Action5";
          $this->configArray[19]->renderedas = "Combo";
          $this->configArray[19]->foreignkeytable = "Actions";
          $this->configArray[19]->foreignkey = "id";
          $this->configArray[19]->foreignkeyfield = "action";
          $this->configArray[19]->defaultvalue = '';

          $this->configArray[20]->width = 60;
          $this->configArray[20]->field = "Action6";
          $this->configArray[20]->heading = "Action6";
          $this->configArray[20]->renderedas = "Combo";
          $this->configArray[20]->foreignkeytable = "Actions";
          $this->configArray[20]->foreignkey = "id";
          $this->configArray[20]->foreignkeyfield = "action";
          $this->configArray[20]->defaultvalue = '';

          return $this->configArray;
          }

          if($configname === 'EnterpriseObjectWorkflows'){

              $childadd = "false";
              $childsave = "false";
              $childdelete = "false";

                  $this->configArray[0]->startstring = "{ store: childStore, selModel: 'cellmodel', columns:[ ";
                  $this->configArray[0]->endstring =
                      "],
                           width: 700,
                           height: 250,
                           x: 10,
                           y: 380,
                           title: '" . $configname . "', " . "
                           frame: true,
                           tbar: [{text: 'Add',    disabled: " . $childadd . ", handler : function() {processInsert(BSSChildConfigName,childgrid,childStore);}},
                                  {text: 'Save',   disabled: " . $childsave . ", handler : function() {processUpdate(BSSChildConfigName,childgrid,childStore);}},
                                  {text: 'Delete', disabled: " . $childdelete . ", handler : function() {processDelete(BSSChildConfigName,childgrid,childStore);}}
                           ],
                           plugins: [cellEditing]}";


              $this->configArray[0]->tablename = "EnterpriseObjectWorkflows";

              $this->configArray[1]->width = 30;
              $this->configArray[1]->field = "id";
              $this->configArray[1]->heading = "Id";
              $this->configArray[1]->renderedas = "Text";
              $this->configArray[1]->foreignkeytable = "";
              $this->configArray[1]->foreignkey = "";
              $this->configArray[1]->foreignkeyfield = "";
              $this->configArray[1]->defaultvalue = 0;

              $this->configArray[2]->width = 30;
              $this->configArray[2]->field = "sequence";
              $this->configArray[2]->heading = "Sequence";
              $this->configArray[2]->renderedas = "Text";
              $this->configArray[2]->foreignkeytable = "";
              $this->configArray[2]->foreignkey = "";
              $this->configArray[2]->foreignkeyfield = "";
              $this->configArray[2]->defaultvalue = 0;

              $this->configArray[3]->width = 30;
              $this->configArray[3]->field = "masterid";
              $this->configArray[3]->heading = "Table Id";
              $this->configArray[3]->renderedas = "Text";
              $this->configArray[3]->foreignkeytable = "";
              $this->configArray[3]->foreignkey = "";
              $this->configArray[3]->foreignkeyfield = "";
              $this->configArray[3]->defaultvalue = 0;

              $this->configArray[4]->width = 400;
              $this->configArray[4]->field = "WorkFlowId";
              $this->configArray[4]->heading = "Workflow";
              $this->configArray[4]->renderedas = "Combo";
              $this->configArray[4]->foreignkeytable = "Workflows";
              $this->configArray[4]->foreignkey = "id";
              $this->configArray[4]->foreignkeyfield = "WorkflowName";
              $this->configArray[4]->defaultvalue = 0;

              return $this->configArray;
          }



          if($configname === 'EnterpriseObjectColumns'){

          $this->configArray[0]->startstring = "{ store: childStore, selModel: 'cellmodel', columns:[ ";
          $this->configArray[0]->endstring =
                     "],
                     width: 960,
                     height: 300,
                     x: 0,
                     y: 0,
                     title: 'Table Columns1',
                     frame: true,
                     tbar: [{text: 'Add',    disabled: " . $childadd . ", handler : function() {processInsert(BSSChildConfigName,childgrid,childStore);}},
                            {text: 'Save',   disabled: " . $childsave . ", handler : function() {processUpdate(BSSChildConfigName,childgrid,childStore);}},
                            {text: 'Delete', disabled: " . $childdelete . ", handler : function() {processDelete(BSSChildConfigName,childgrid,childStore);}}
                     ],
                     plugins: [cellEditing]}";


          $this->configArray[0]->tablename = "EnterpriseObjectColumns";

          $this->configArray[1]->width = 30;
          $this->configArray[1]->field = "id";
          $this->configArray[1]->heading = "Id";
          $this->configArray[1]->renderedas = "Text";
          $this->configArray[1]->foreignkeytable = "";
          $this->configArray[1]->foreignkey = "";
          $this->configArray[1]->foreignkeyfield = "";
          $this->configArray[1]->defaultvalue = 0;

          $this->configArray[2]->width = 30;
          $this->configArray[2]->field = "sequence";
          $this->configArray[2]->heading = "Sequence";
          $this->configArray[2]->renderedas = "Text";
          $this->configArray[2]->foreignkeytable = "";
          $this->configArray[2]->foreignkey = "";
          $this->configArray[2]->foreignkeyfield = "";
          $this->configArray[2]->defaultvalue = 0;

          $this->configArray[3]->width = 30;
          $this->configArray[3]->field = "masterid";
          $this->configArray[3]->heading = "Table Id";
          $this->configArray[3]->renderedas = "Text";
          $this->configArray[3]->foreignkeytable = "";
          $this->configArray[3]->foreignkey = "";
          $this->configArray[3]->foreignkeyfield = "";
          $this->configArray[3]->defaultvalue = 0;

          $this->configArray[4]->width = 30;
          $this->configArray[4]->field = "format";
          $this->configArray[4]->heading = "Format";
          $this->configArray[4]->renderedas = "Text";
          $this->configArray[4]->foreignkeytable = "";
          $this->configArray[4]->foreignkey = "";
          $this->configArray[4]->foreignkeyfield = "";
          $this->configArray[4]->defaultvalue = 0;

          $this->configArray[5]->width = 40;
          $this->configArray[5]->field = "fieldname";
          $this->configArray[5]->heading = "Field Name";
          $this->configArray[5]->renderedas = "Text";
          $this->configArray[5]->foreignkeytable = "";
          $this->configArray[5]->foreignkey = "";
          $this->configArray[5]->foreignkeyfield = "";
          $this->configArray[5]->defaultvalue = 0;

          $this->configArray[6]->width = 40;
          $this->configArray[6]->field = "heading";
          $this->configArray[6]->heading = "Heading";
          $this->configArray[6]->renderedas = "Text";
          $this->configArray[6]->foreignkeytable = "";
          $this->configArray[6]->foreignkey = "";
          $this->configArray[6]->foreignkeyfield = "";
          $this->configArray[6]->defaultvalue = 0;

          $this->configArray[7]->width = 40;
          $this->configArray[7]->field = "renderedas";
          $this->configArray[7]->heading = "Rendered As";
          $this->configArray[7]->renderedas = "Combo";
          $this->configArray[7]->foreignkeytable = "RenderedAs";
          $this->configArray[7]->foreignkey = "id";
          $this->configArray[7]->foreignkeyfield = "RenderedAs";
          $this->configArray[7]->defaultvalue = 0;

          $this->configArray[8]->width = 40;
          $this->configArray[8]->field = "foreignkeytable";
          $this->configArray[8]->heading = "Foreign Key Table";
          $this->configArray[8]->renderedas = "Text";
          $this->configArray[8]->foreignkeytable = "";
          $this->configArray[8]->foreignkey = "";
          $this->configArray[8]->foreignkeyfield = "";
          $this->configArray[8]->defaultvalue = '0';

          $this->configArray[9]->width = 40;
          $this->configArray[9]->field = "foreignkey";
          $this->configArray[9]->heading = "Foreign Key";
          $this->configArray[9]->renderedas = "Text";
          $this->configArray[9]->foreignkeytable = "";
          $this->configArray[9]->foreignkey = "";
          $this->configArray[9]->foreignkeyfield = "";
          $this->configArray[9]->defaultvalue = '';

          $this->configArray[10]->width = 40;
          $this->configArray[10]->field = "foreignkeyfield";
          $this->configArray[10]->heading = "Foreign Key Field";
          $this->configArray[10]->renderedas = "Text";
          $this->configArray[10]->foreignkeytable = "";
          $this->configArray[10]->foreignkey = "";
          $this->configArray[10]->foreignkeyfield = "";
          $this->configArray[10]->defaultvalue = '';

          $this->configArray[11]->width = 40;
          $this->configArray[11]->field = "defaultvalue";
          $this->configArray[11]->heading = "Default Value";
          $this->configArray[11]->renderedas = "Text";
          $this->configArray[11]->foreignkeytable = "";
          $this->configArray[11]->foreignkey = "";
          $this->configArray[11]->foreignkeyfield = "";
          $this->configArray[11]->defaultvalue = '';

          return $this->configArray;
          }




          if($configname == 'History'){

          $this->configArray[0]->startstring = "";
          $this->configArray[0]->endstring = "";

          $this->configArray[0]->tablename = "History";

          $this->configArray[1]->width = 30;
          $this->configArray[1]->field = "id";
          $this->configArray[1]->heading = "Id";
          $this->configArray[1]->renderedas = "Text";
          $this->configArray[1]->foreignkeytable = "";
          $this->configArray[1]->foreignkey = "";
          $this->configArray[1]->foreignkeyfield = "";
          $this->configArray[1]->defaultvalue = 0;

          $this->configArray[2]->width = 30;
          $this->configArray[2]->field = "masterid";
          $this->configArray[2]->heading = "Table Id";
          $this->configArray[2]->renderedas = "Text";
          $this->configArray[2]->foreignkeytable = "";
          $this->configArray[2]->foreignkey = "";
          $this->configArray[2]->foreignkeyfield = "";
          $this->configArray[2]->defaultvalue = 0;

          $this->configArray[3]->width = 30;
          $this->configArray[3]->field = "sequence";
          $this->configArray[3]->heading = "Sequence";
          $this->configArray[3]->renderedas = "Text";
          $this->configArray[3]->foreignkeytable = "";
          $this->configArray[3]->foreignkey = "";
          $this->configArray[3]->foreignkeyfield = "";
          $this->configArray[3]->defaultvalue = 0;

          $this->configArray[4]->width = 30;
          $this->configArray[4]->field = "historyuser";
          $this->configArray[4]->heading = "User";
          $this->configArray[4]->renderedas = "Text";
          $this->configArray[4]->foreignkeytable = "";
          $this->configArray[4]->foreignkey = "";
          $this->configArray[4]->foreignkeyfield = "";
          $this->configArray[4]->defaultvalue = 0;

          $this->configArray[5]->width = 40;
          $this->configArray[5]->field = "historydate";
          $this->configArray[5]->heading = "Date";
          $this->configArray[5]->renderedas = "Text";
          $this->configArray[5]->foreignkeytable = "";
          $this->configArray[5]->foreignkey = "";
          $this->configArray[5]->foreignkeyfield = "";
          $this->configArray[5]->defaultvalue = 0;

          $this->configArray[6]->width = 40;
          $this->configArray[6]->field = "historytext";
          $this->configArray[6]->heading = "Date";
          $this->configArray[6]->renderedas = "History Notes";
          $this->configArray[6]->foreignkeytable = "";
          $this->configArray[6]->foreignkey = "";
          $this->configArray[6]->foreignkeyfield = "";
          $this->configArray[6]->defaultvalue = 0;
          return $this->configArray;

          }


          if($configname == 'Discussions'){

          $this->configArray[0]->startstring = "";
          $this->configArray[0]->endstring = "";

          $this->configArray[0]->tablename = "Discussions";

          $this->configArray[1]->width = 30;
          $this->configArray[1]->field = "id";
          $this->configArray[1]->heading = "Id";
          $this->configArray[1]->renderedas = "Text";
          $this->configArray[1]->foreignkeytable = "";
          $this->configArray[1]->foreignkey = "";
          $this->configArray[1]->foreignkeyfield = "";
          $this->configArray[1]->defaultvalue = 0;

          $this->configArray[2]->width = 30;
          $this->configArray[2]->field = "masterid";
          $this->configArray[2]->heading = "Table Id";
          $this->configArray[2]->renderedas = "Text";
          $this->configArray[2]->foreignkeytable = "";
          $this->configArray[2]->foreignkey = "";
          $this->configArray[2]->foreignkeyfield = "";
          $this->configArray[2]->defaultvalue = 0;

          $this->configArray[3]->width = 30;
          $this->configArray[3]->field = "sequence";
          $this->configArray[3]->heading = "Sequence";
          $this->configArray[3]->renderedas = "Text";
          $this->configArray[3]->foreignkeytable = "";
          $this->configArray[3]->foreignkey = "";
          $this->configArray[3]->foreignkeyfield = "";
          $this->configArray[3]->defaultvalue = "0";

          $this->configArray[4]->width = 30;
          $this->configArray[4]->field = "discussionuser";
          $this->configArray[4]->heading = "User";
          $this->configArray[4]->renderedas = "UserId";
          $this->configArray[4]->foreignkeytable = "";
          $this->configArray[4]->foreignkey = "";
          $this->configArray[4]->foreignkeyfield = "";
          $this->configArray[4]->defaultvalue = 0;

          $this->configArray[5]->width = 40;
          $this->configArray[5]->field = "discussiondate";
          $this->configArray[5]->heading = "Date";
          $this->configArray[5]->renderedas = "Date";
          $this->configArray[5]->foreignkeytable = "";
          $this->configArray[5]->foreignkey = "";
          $this->configArray[5]->foreignkeyfield = "";
          $this->configArray[5]->defaultvalue = "";

          $this->configArray[6]->width = 40;
          $this->configArray[6]->field = "discussiontext";
          $this->configArray[6]->heading = "Date";
          $this->configArray[6]->renderedas = "Discussion Text";
          $this->configArray[6]->foreignkeytable = "";
          $this->configArray[6]->foreignkey = "";
          $this->configArray[6]->foreignkeyfield = "";
          $this->configArray[6]->defaultvalue = 0;
          return $this->configArray;

          }



       //   {name: 'id', type: 'string'},
       //   {name: 'masterid', type: 'string'},
       //   {name: 'sequence', type: 'string'},
       //   {name: 'documentuser', type: 'string'},
       //   {name: 'documentdate', type: 'string'},
       //   {name: 'documentname', type: 'string'},
       //   {name: 'checkoutuser', type: 'string'},
       //   {name: 'documentdescription', type: 'string'},
       //   {name: 'documentrevision', type: 'string'},
       //   {name: 'documentversion', type: 'string'}




          if($configname == 'Documents'){

          $this->configArray[0]->startstring = "";
          $this->configArray[0]->endstring = "";

          $this->configArray[0]->tablename = "Documents";

          $this->configArray[1]->width = 30;
          $this->configArray[1]->field = "id";
          $this->configArray[1]->heading = "Id";
          $this->configArray[1]->renderedas = "Text";
          $this->configArray[1]->foreignkeytable = "";
          $this->configArray[1]->foreignkey = "";
          $this->configArray[1]->foreignkeyfield = "";
          $this->configArray[1]->defaultvalue = 0;

          $this->configArray[2]->width = 30;
          $this->configArray[2]->field = "masterid";
          $this->configArray[2]->heading = "Table Id";
          $this->configArray[2]->renderedas = "Text";
          $this->configArray[2]->foreignkeytable = "";
          $this->configArray[2]->foreignkey = "";
          $this->configArray[2]->foreignkeyfield = "";
          $this->configArray[2]->defaultvalue = 0;

          $this->configArray[3]->width = 30;
          $this->configArray[3]->field = "sequence";
          $this->configArray[3]->heading = "Sequence";
          $this->configArray[3]->renderedas = "Text";
          $this->configArray[3]->foreignkeytable = "";
          $this->configArray[3]->foreignkey = "";
          $this->configArray[3]->foreignkeyfield = "";
          $this->configArray[3]->defaultvalue = 0;

          $this->configArray[4]->width = 100;
          $this->configArray[4]->field = "filename";
          $this->configArray[4]->heading = "Filename";
          $this->configArray[4]->renderedas = "Text";
          $this->configArray[4]->foreignkeytable = "";
          $this->configArray[4]->foreignkey = "";
          $this->configArray[4]->foreignkeyfield = "";
          $this->configArray[4]->defaultvalue = 0;


          $this->configArray[5]->width = 30;
          $this->configArray[5]->field = "documentuser";
          $this->configArray[5]->heading = "User";
          $this->configArray[5]->renderedas = "Text";
          $this->configArray[5]->foreignkeytable = "";
          $this->configArray[5]->foreignkey = "";
          $this->configArray[5]->foreignkeyfield = "";
          $this->configArray[5]->defaultvalue = 0;

          $this->configArray[6]->width = 40;
          $this->configArray[6]->field = "documentdate";
          $this->configArray[6]->heading = "Date";
          $this->configArray[6]->renderedas = "Date";
          $this->configArray[6]->foreignkeytable = "";
          $this->configArray[6]->foreignkey = "";
          $this->configArray[6]->foreignkeyfield = "";
          $this->configArray[6]->defaultvalue = 0;

          $this->configArray[7]->width = 40;
          $this->configArray[7]->field = "documentname";
          $this->configArray[7]->heading = "Date";
          $this->configArray[7]->renderedas = "Document Name";
          $this->configArray[7]->foreignkeytable = "";
          $this->configArray[7]->foreignkey = "";
          $this->configArray[7]->foreignkeyfield = "";
          $this->configArray[7]->defaultvalue = 0;

          $this->configArray[8]->width = 40;
          $this->configArray[8]->field = "checkoutuser";
          $this->configArray[8]->heading = "Check Out User";
          $this->configArray[8]->renderedas = "Text";
          $this->configArray[8]->foreignkeytable = "";
          $this->configArray[8]->foreignkey = "";
          $this->configArray[8]->foreignkeyfield = "";
          $this->configArray[8]->defaultvalue = 0;

          $this->configArray[9]->width = 40;
          $this->configArray[9]->field = "documentdescription";
          $this->configArray[9]->heading = "Date";
          $this->configArray[9]->renderedas = "Document Description";
          $this->configArray[9]->foreignkeytable = "";
          $this->configArray[9]->foreignkey = "";
          $this->configArray[9]->foreignkeyfield = "";
          $this->configArray[9]->defaultvalue = 0;

          $this->configArray[10]->width = 40;
          $this->configArray[10]->field = "documentrevision";
          $this->configArray[10]->heading = "Date";
          $this->configArray[10]->renderedas = "Document Revision";
          $this->configArray[10]->foreignkeytable = "";
          $this->configArray[10]->foreignkey = "";
          $this->configArray[10]->foreignkeyfield = "";
          $this->configArray[10]->defaultvalue = 0;

          $this->configArray[11]->width = 40;
          $this->configArray[11]->field = "documentversion";
          $this->configArray[11]->heading = "Date";
          $this->configArray[11]->renderedas = "Document Version";
          $this->configArray[11]->foreignkeytable = "";
          $this->configArray[11]->foreignkey = "";
          $this->configArray[11]->foreignkeyfield = "";
          $this->configArray[11]->defaultvalue = 0;




              return $this->configArray;

          }




          if($configname == 'Roles'){

          $this->configArray[0]->endstring =
                     "],
                     width: 905,
                     height: 350,
                     x: 10,
                     y: 5,
                     title: '" . $configname . "', " . "
                     frame: true,
                     tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                     ],
                     plugins: [cellEditing1]}";


          $this->configArray[0]->tablename = "Roles";

          $this->configArray[1]->width = 20;
          $this->configArray[1]->field = "id";
          $this->configArray[1]->heading = "Id";
          $this->configArray[1]->renderedas = "Text";
          $this->configArray[1]->foreignkeytable = "";
          $this->configArray[1]->foreignkey = "";
          $this->configArray[1]->foreignkeyfield = "";
          $this->configArray[1]->defaultvalue = 0;

          $this->configArray[2]->width = 60;
          $this->configArray[2]->field = "sequence";
          $this->configArray[2]->heading = "Sequence";
          $this->configArray[2]->renderedas = "Text";
          $this->configArray[2]->foreignkeytable = "";
          $this->configArray[2]->foreignkey = "";
          $this->configArray[2]->foreignkeyfield = "";
          $this->configArray[2]->defaultvalue = 0;

          $this->configArray[3]->width = 60;
          $this->configArray[3]->field = "masterid";
          $this->configArray[3]->heading = "Master Id";
          $this->configArray[3]->renderedas = "Text";
          $this->configArray[3]->foreignkeytable = "";
          $this->configArray[3]->foreignkey = "";
          $this->configArray[3]->foreignkeyfield = "";
          $this->configArray[3]->defaultvalue = 0;

          $this->configArray[4]->width = 100;
          $this->configArray[4]->field = "tableid";
          $this->configArray[4]->heading = "Table";
          $this->configArray[4]->renderedas = "Combo";
          $this->configArray[4]->foreignkeytable = "Tables";
          $this->configArray[4]->foreignkey = "id";
          $this->configArray[4]->foreignkeyfield = "TableName";
          $this->configArray[4]->defaultvalue = "";


  //        $this->configArray[5]->width = 100;
  //        $this->configArray[5]->field = "queryid";
  //        $this->configArray[5]->heading = "Query";
  //        $this->configArray[5]->renderedas = "Combo";
  //        $this->configArray[5]->foreignkeytable = "Queries";
  //        $this->configArray[5]->foreignkey = "id";
  //        $this->configArray[5]->foreignkeyfield = "QueryName";
  //        $this->configArray[5]->defaultvalue = "";


          $this->configArray[5]->width = 100;
          $this->configArray[5]->field = "ROLE";
          $this->configArray[5]->heading = "Role";
          $this->configArray[5]->renderedas = "Text";
          $this->configArray[5]->foreignkeytable = "";
          $this->configArray[5]->foreignkey = "";
          $this->configArray[5]->foreignkeyfield = "";
          $this->configArray[5]->defaultvalue = "";

          $this->configArray[6]->width = 200;
          $this->configArray[6]->field = "ROLEDESCRIPTION";
          $this->configArray[6]->heading = "Role Description";
          $this->configArray[6]->renderedas = "Text";
          $this->configArray[6]->foreignkeytable = "";
          $this->configArray[6]->foreignkey = "";
          $this->configArray[6]->foreignkeyfield = "";
          $this->configArray[6]->defaultvalue = "";

          $this->configArray[7]->width = 100;
          $this->configArray[7]->field = "CREATEMASTER";
          $this->configArray[7]->heading = "CREATE MASTER";
          $this->configArray[7]->renderedas = "CheckBox";
          $this->configArray[7]->foreignkeytable = "";
          $this->configArray[7]->foreignkey = "";
          $this->configArray[7]->foreignkeyfield = "";
          $this->configArray[7]->defaultvalue = 0;

          $this->configArray[8]->width = 80;
          $this->configArray[8]->field = "READMASTER";
          $this->configArray[8]->heading = "READ MASTER";
          $this->configArray[8]->renderedas = "CheckBox";
          $this->configArray[8]->foreignkeytable = "";
          $this->configArray[8]->foreignkey = "";
          $this->configArray[8]->foreignkeyfield = "";
          $this->configArray[8]->defaultvalue = 0;

          $this->configArray[9]->width = 100;
          $this->configArray[9]->field = "UPDATEMASTER";
          $this->configArray[9]->heading = "UPDATE MASTER";
          $this->configArray[9]->renderedas = "CheckBox";
          $this->configArray[9]->foreignkeytable = "";
          $this->configArray[9]->foreignkey = "";
          $this->configArray[9]->foreignkeyfield = "";
          $this->configArray[9]->defaultvalue = 0;

          $this->configArray[10]->width = 100;
          $this->configArray[10]->field = "DELETEMASTER";
          $this->configArray[10]->heading = "DELETE MASTER";
          $this->configArray[10]->renderedas = "CheckBox";
          $this->configArray[10]->foreignkeytable = "";
          $this->configArray[10]->foreignkey = "";
          $this->configArray[10]->foreignkeyfield = "";
          $this->configArray[10]->defaultvalue = 0;

          $this->configArray[11]->width = 90;
          $this->configArray[11]->field = "CREATECHILD";
          $this->configArray[11]->heading = "CREATE CHILD";
          $this->configArray[11]->renderedas = "CheckBox";
          $this->configArray[11]->foreignkeytable = "";
          $this->configArray[11]->foreignkey = "";
          $this->configArray[11]->foreignkeyfield = "";
          $this->configArray[11]->defaultvalue = 0;

          $this->configArray[12]->width = 80;
          $this->configArray[12]->field = "READCHILD";
          $this->configArray[12]->heading = "READ CHILD";
          $this->configArray[12]->renderedas = "CheckBox";
          $this->configArray[12]->foreignkeytable = "";
          $this->configArray[12]->foreignkey = "";
          $this->configArray[12]->foreignkeyfield = "";
          $this->configArray[12]->defaultvalue = 0;

          $this->configArray[13]->width = 90;
          $this->configArray[13]->field = "UPDATECHILD";
          $this->configArray[13]->heading = "UPDATE CHILD";
          $this->configArray[13]->renderedas = "CheckBox";
          $this->configArray[13]->foreignkeytable = "";
          $this->configArray[13]->foreignkey = "";
          $this->configArray[13]->foreignkeyfield = "";
          $this->configArray[13]->defaultvalue = 0;

          $this->configArray[14]->width = 80;
          $this->configArray[14]->field = "DELETECHILD";
          $this->configArray[14]->heading = "DELETE CHILD";
          $this->configArray[14]->renderedas = "CheckBox";
          $this->configArray[14]->foreignkeytable = "";
          $this->configArray[14]->foreignkey = "";
          $this->configArray[14]->foreignkeyfield = "";
          $this->configArray[14]->defaultvalue = 0;

          $this->configArray[15]->width = 120;
          $this->configArray[15]->field = "CREATEWORKFLOW";
          $this->configArray[15]->heading = "CREATE WORKFLOW";
          $this->configArray[15]->renderedas = "CheckBox";
          $this->configArray[15]->foreignkeytable = "";
          $this->configArray[15]->foreignkey = "";
          $this->configArray[15]->foreignkeyfield = "";
          $this->configArray[15]->defaultvalue = 0;

          $this->configArray[16]->width = 140;
          $this->configArray[16]->field = "ADDREMOVEAPPROVERS";
          $this->configArray[16]->heading = "ADD/REMOVE APPROVERS";
          $this->configArray[16]->renderedas = "CheckBox";
          $this->configArray[16]->foreignkeytable = "";
          $this->configArray[16]->foreignkey = "";
          $this->configArray[16]->foreignkeyfield = "";
          $this->configArray[16]->defaultvalue = 0;

          $this->configArray[17]->width = 120;
          $this->configArray[17]->field = "PROMOTEWORKFLOW";
          $this->configArray[17]->heading = "PROMOTE WORKFLOW";
          $this->configArray[17]->renderedas = "CheckBox";
          $this->configArray[17]->foreignkeytable = "";
          $this->configArray[17]->foreignkey = "";
          $this->configArray[17]->foreignkeyfield = "";
          $this->configArray[17]->defaultvalue = 0;

          $this->configArray[18]->width = 80;
          $this->configArray[18]->field = "SIGNOFF";
          $this->configArray[18]->heading = "SIGNOFF";
          $this->configArray[18]->renderedas = "CheckBox";
          $this->configArray[18]->foreignkeytable = "";
          $this->configArray[18]->foreignkey = "";
          $this->configArray[18]->foreignkeyfield = "";
          $this->configArray[18]->defaultvalue = 0;


          $this->configArray[19]->width = 110;
          $this->configArray[19]->field = "READDOCUMENTS";
          $this->configArray[19]->heading = "READ DOCUMENTS";
          $this->configArray[19]->renderedas = "CheckBox";
          $this->configArray[19]->foreignkeytable = "";
          $this->configArray[19]->foreignkey = "";
          $this->configArray[19]->foreignkeyfield = "";
          $this->configArray[19]->defaultvalue = 0;

          $this->configArray[20]->width = 100;
          $this->configArray[20]->field = "ADDDOCUMENTS";
          $this->configArray[20]->heading = "ADD DOCUMENTS";
          $this->configArray[20]->renderedas = "CheckBox";
          $this->configArray[20]->foreignkeytable = "";
          $this->configArray[20]->foreignkey = "";
          $this->configArray[20]->foreignkeyfield = "";
          $this->configArray[20]->defaultvalue = 0;

          $this->configArray[21]->width = 120;
          $this->configArray[21]->field = "UPDATEDOCUMENTS";
          $this->configArray[21]->heading = "UPDATE DOCUMENTS";
          $this->configArray[21]->renderedas = "CheckBox";
          $this->configArray[21]->foreignkeytable = "";
          $this->configArray[21]->foreignkey = "";
          $this->configArray[21]->foreignkeyfield = "";
          $this->configArray[21]->defaultvalue = 0;

          $this->configArray[22]->width = 120;
          $this->configArray[22]->field = "DELETEDOCUMENTS";
          $this->configArray[22]->heading = "DELETE DOCUMENTS";
          $this->configArray[22]->renderedas = "CheckBox";
          $this->configArray[22]->foreignkeytable = "";
          $this->configArray[22]->foreignkey = "";
          $this->configArray[22]->foreignkeyfield = "";
          $this->configArray[22]->defaultvalue = 0;

          $this->configArray[23]->width = 120;
          $this->configArray[23]->field = "CHECKINCHECKOUT";
          $this->configArray[23]->heading = "CHECKIN CHECKOUT";
          $this->configArray[23]->renderedas = "CheckBox";
          $this->configArray[23]->foreignkeytable = "";
          $this->configArray[23]->foreignkey = "";
          $this->configArray[23]->foreignkeyfield = "";
          $this->configArray[23]->defaultvalue = 0;

          $this->configArray[24]->width = 100;
          $this->configArray[24]->field = "GETDOCUMENTS";
          $this->configArray[24]->heading = "GET DOCUMENTS";
          $this->configArray[24]->renderedas = "CheckBox";
          $this->configArray[24]->foreignkeytable = "";
          $this->configArray[24]->foreignkey = "";
          $this->configArray[24]->foreignkeyfield = "";
          $this->configArray[24]->defaultvalue = 0;

          $this->configArray[25]->width = 110;
          $this->configArray[25]->field = "VIEWDISCUSSIONS";
          $this->configArray[25]->heading = "VIEW DISCUSSIONS";
          $this->configArray[25]->renderedas = "CheckBox";
          $this->configArray[25]->foreignkeytable = "";
          $this->configArray[25]->foreignkey = "";
          $this->configArray[25]->foreignkeyfield = "";
          $this->configArray[25]->defaultvalue = 0;

          $this->configArray[26]->width = 110;
          $this->configArray[26]->field = "ADDDISCUSSIONS";
          $this->configArray[26]->heading = "ADD DISCUSSIONS";
          $this->configArray[26]->renderedas = "CheckBox";
          $this->configArray[26]->foreignkeytable = "";
          $this->configArray[26]->foreignkey = "";
          $this->configArray[26]->foreignkeyfield = "";
          $this->configArray[26]->defaultvalue = 0;

          $this->configArray[27]->width = 125;
          $this->configArray[27]->field = "UPDATEDISCUSSIONS";
          $this->configArray[27]->heading = "UPDATE DISCUSSIONS";
          $this->configArray[27]->renderedas = "CheckBox";
          $this->configArray[27]->foreignkeytable = "";
          $this->configArray[27]->foreignkey = "";
          $this->configArray[27]->foreignkeyfield = "";
          $this->configArray[27]->defaultvalue = 0;

          $this->configArray[28]->width = 120;
          $this->configArray[28]->field = "DELETEDISCUSSIONS";
          $this->configArray[28]->heading = "DELETE DISCUSSIONS";
          $this->configArray[28]->renderedas = "CheckBox";
          $this->configArray[28]->foreignkeytable = "";
          $this->configArray[28]->foreignkey = "";
          $this->configArray[28]->foreignkeyfield = "";
          $this->configArray[28]->defaultvalue = 0;

          $this->configArray[29]->width = 100;
          $this->configArray[29]->field = "VIEWHISTORY";
          $this->configArray[29]->heading = "VIEW HISTORY";
          $this->configArray[29]->renderedas = "CheckBox";
          $this->configArray[29]->foreignkeytable = "";
          $this->configArray[29]->foreignkey = "";
          $this->configArray[29]->foreignkeyfield = "";
          $this->configArray[29]->defaultvalue = 0;

          return $this->configArray;

          }

          if($configname == 'CustomActions'){

              //$this->configArray[0]->startstring = "";
              //$this->configArray[0]->endstring = "";

              $this->configArray[0]->tablename = "CustomActions";

              $this->configArray[0]->endstring =
                  "],
                     width: 905,
                     height: 350,
                     x: 10,
                     y: 5,
                     title: '" . $configname . "', " . "
                     frame: true,
                     tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                     ],
                     plugins: [cellEditing1]}";

              $this->configArray[1]->width = 30;
              $this->configArray[1]->field = "id";
              $this->configArray[1]->heading = "Id";
              $this->configArray[1]->renderedas = "Text";
              $this->configArray[1]->foreignkeytable = "";
              $this->configArray[1]->foreignkey = "";
              $this->configArray[1]->foreignkeyfield = "";
              $this->configArray[1]->defaultvalue = 0;

              $this->configArray[2]->width = 30;
              $this->configArray[2]->field = "sequence";
              $this->configArray[2]->heading = "Sequence";
              $this->configArray[2]->renderedas = "Text";
              $this->configArray[2]->foreignkeytable = "";
              $this->configArray[2]->foreignkey = "";
              $this->configArray[2]->foreignkeyfield = "";
              $this->configArray[2]->defaultvalue = 0;

              $this->configArray[3]->width = 30;
              $this->configArray[3]->field = "masterid";
              $this->configArray[3]->heading = "Table Id";
              $this->configArray[3]->renderedas = "Text";
              $this->configArray[3]->foreignkeytable = "";
              $this->configArray[3]->foreignkey = "";
              $this->configArray[3]->foreignkeyfield = "";
              $this->configArray[3]->defaultvalue = 0;

              $this->configArray[4]->width = 30;
              $this->configArray[4]->field = "Location";
              $this->configArray[4]->heading = "Location";
              $this->configArray[4]->renderedas = "Text";
              $this->configArray[4]->foreignkeytable = "";
              $this->configArray[4]->foreignkey = "";
              $this->configArray[4]->foreignkeyfield = "";
              $this->configArray[4]->defaultvalue = "";

              $this->configArray[5]->width = 40;
              $this->configArray[5]->field = "Category";
              $this->configArray[5]->heading = "Category";
              $this->configArray[5]->renderedas = "Text";
              $this->configArray[5]->foreignkeytable = "";
              $this->configArray[5]->foreignkey = "";
              $this->configArray[5]->foreignkeyfield = "";
              $this->configArray[5]->defaultvalue = "";

              $this->configArray[6]->width = 40;
              $this->configArray[6]->field = "Text";
              $this->configArray[6]->heading = "Text";
              $this->configArray[6]->renderedas = "Text";
              $this->configArray[6]->foreignkeytable = "";
              $this->configArray[6]->foreignkey = "";
              $this->configArray[6]->foreignkeyfield = "";
              $this->configArray[6]->defaultvalue = "";

              $this->configArray[7]->width = 40;
              $this->configArray[7]->field = "Figure";
              $this->configArray[7]->heading = "Figure";
              $this->configArray[7]->renderedas = "Text";
              $this->configArray[7]->foreignkeytable = "";
              $this->configArray[7]->foreignkey = "";
              $this->configArray[7]->foreignkeyfield = "";
              $this->configArray[7]->defaultvalue = "";

              $this->configArray[8]->width = 40;
              $this->configArray[8]->field = "Color";
              $this->configArray[8]->heading = "Color";
              $this->configArray[8]->renderedas = "Text";
              $this->configArray[8]->foreignkeytable = "";
              $this->configArray[8]->foreignkey = "";
              $this->configArray[8]->foreignkeyfield = "";
              $this->configArray[8]->defaultvalue = "";

              $this->configArray[9]->width = 40;
              $this->configArray[9]->field = "Enabled";
              $this->configArray[9]->heading = "Enabled";
              $this->configArray[9]->renderedas = "Text";
              $this->configArray[9]->foreignkeytable = "";
              $this->configArray[9]->foreignkey = "";
              $this->configArray[9]->foreignkeyfield = "";
              $this->configArray[9]->defaultvalue = "";

              return $this->configArray;

          }

          if($configname == 'Users'){

            //$this->configArray[0]->startstring = "";
            //$this->configArray[0]->endstring = "";

            $this->configArray[0]->tablename = "users";

            $this->configArray[0]->endstring =
                     "],
                     width: 905,
                     height: 350,
                     x: 10,
                     y: 5,
                     title: '" . $configname . "', " . "
                     frame: true,
                     tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                     ],
                     plugins: [cellEditing1]}";

            $this->configArray[1]->width = 30;
            $this->configArray[1]->field = "id";
            $this->configArray[1]->heading = "Id";
            $this->configArray[1]->renderedas = "Text";
            $this->configArray[1]->foreignkeytable = "";
            $this->configArray[1]->foreignkey = "";
            $this->configArray[1]->foreignkeyfield = "";
            $this->configArray[1]->defaultvalue = 0;

            $this->configArray[2]->width = 30;
            $this->configArray[2]->field = "sequence";
            $this->configArray[2]->heading = "Sequence";
            $this->configArray[2]->renderedas = "Text";
            $this->configArray[2]->foreignkeytable = "";
            $this->configArray[2]->foreignkey = "";
            $this->configArray[2]->foreignkeyfield = "";
            $this->configArray[2]->defaultvalue = 0;

            $this->configArray[3]->width = 30;
            $this->configArray[3]->field = "masterid";
            $this->configArray[3]->heading = "Table Id";
            $this->configArray[3]->renderedas = "Text";
            $this->configArray[3]->foreignkeytable = "";
            $this->configArray[3]->foreignkey = "";
            $this->configArray[3]->foreignkeyfield = "";
            $this->configArray[3]->defaultvalue = 0;

            $this->configArray[4]->width = 30;
            $this->configArray[4]->field = "FirstName";
            $this->configArray[4]->heading = "First Name";
            $this->configArray[4]->renderedas = "Text";
            $this->configArray[4]->foreignkeytable = "";
            $this->configArray[4]->foreignkey = "";
            $this->configArray[4]->foreignkeyfield = "";
            $this->configArray[4]->defaultvalue = "";

            $this->configArray[5]->width = 40;
            $this->configArray[5]->field = "LastName";
            $this->configArray[5]->heading = "Last Name";
            $this->configArray[5]->renderedas = "Text";
            $this->configArray[5]->foreignkeytable = "";
            $this->configArray[5]->foreignkey = "";
            $this->configArray[5]->foreignkeyfield = "";
            $this->configArray[5]->defaultvalue = "";

            $this->configArray[6]->width = 40;
            $this->configArray[6]->field = "Department";
            $this->configArray[6]->heading = "Department";
            $this->configArray[6]->renderedas = "Text";
            $this->configArray[6]->foreignkeytable = "";
            $this->configArray[6]->foreignkey = "";
            $this->configArray[6]->foreignkeyfield = "";
            $this->configArray[6]->defaultvalue = "";

            $this->configArray[7]->width = 40;
            $this->configArray[7]->field = "Email";
            $this->configArray[7]->heading = "Email";
            $this->configArray[7]->renderedas = "Text";
            $this->configArray[7]->foreignkeytable = "";
            $this->configArray[7]->foreignkey = "";
            $this->configArray[7]->foreignkeyfield = "";
            $this->configArray[7]->defaultvalue = "";

            $this->configArray[8]->width = 40;
            $this->configArray[8]->field = "Login";
            $this->configArray[8]->heading = "Login";
            $this->configArray[8]->renderedas = "Text";
            $this->configArray[8]->foreignkeytable = "";
            $this->configArray[8]->foreignkey = "";
            $this->configArray[8]->foreignkeyfield = "";
            $this->configArray[8]->defaultvalue = "";

            $this->configArray[9]->width = 40;
            $this->configArray[9]->field = "Password";
            $this->configArray[9]->heading = "Password";
            $this->configArray[9]->renderedas = "Text";
            $this->configArray[9]->foreignkeytable = "";
            $this->configArray[9]->foreignkey = "";
            $this->configArray[9]->foreignkeyfield = "";
            $this->configArray[9]->defaultvalue = "";

            $this->configArray[10]->width = 40;
            $this->configArray[10]->field = "AdminUser";
            $this->configArray[10]->heading = "Admin User";
            $this->configArray[10]->renderedas = "Text";
            $this->configArray[10]->foreignkeytable = "";
            $this->configArray[10]->foreignkey = "";
            $this->configArray[10]->foreignkeyfield = "";
            $this->configArray[10]->defaultvalue = "";

            $this->configArray[11]->width = 40;
            $this->configArray[11]->field = "Enabled";
            $this->configArray[11]->heading = "Enabled";
            $this->configArray[11]->renderedas = "Text";
            $this->configArray[11]->foreignkeytable = "";
            $this->configArray[11]->foreignkey = "";
            $this->configArray[11]->foreignkeyfield = "";
            $this->configArray[11]->defaultvalue = "";

            $this->configArray[12]->width = 40;
            $this->configArray[12]->field = "EscalationUser";
            $this->configArray[12]->heading = "Escalation User";
            $this->configArray[12]->renderedas = "Text";
            $this->configArray[12]->foreignkeytable = "";
            $this->configArray[12]->foreignkey = "";
            $this->configArray[12]->foreignkeyfield = "";
            $this->configArray[12]->defaultvalue = "";


              return $this->configArray;

            }


          if($configname == 'UserRoles'){

            //$this->configArray[0]->startstring = "";
            //$this->configArray[0]->endstring = "";

            $this->configArray[0]->tablename = "UserRoles";
            $this->configArray[0]->startstring = "{ store: childStore, selModel: 'cellmodel', columns:[ ";
            $this->configArray[0]->endstring =
                         "],
                         width: 960,
                         height: 300,
                         x: 20,
                         y:400,
                         title: '" . $configname . "', " . "
                         frame: true,
                         tbar: [{text: 'Add',    disabled: " . $childadd . ", handler : function() {processInsert(BSSChildConfigName,childgrid,childStore);}},
                                {text: 'Save',   disabled: " . $childsave . ", handler : function() {processUpdate(BSSChildConfigName,childgrid,childStore);}},
                                {text: 'Delete', disabled: " . $childdelete . ", handler : function() {processDelete(BSSChildConfigName,childgrid,childStore);}}
                         ],
                         plugins: [cellEditing]}";

            $this->configArray[1]->width = 60;
            $this->configArray[1]->field = "id";
            $this->configArray[1]->heading = "Id";
            $this->configArray[1]->renderedas = "Text";
            $this->configArray[1]->foreignkeytable = "";
            $this->configArray[1]->foreignkey = "";
            $this->configArray[1]->foreignkeyfield = "";
            $this->configArray[1]->defaultvalue = 0;

            $this->configArray[2]->width = 60;
            $this->configArray[2]->field = "sequence";
            $this->configArray[2]->heading = "Sequence";
            $this->configArray[2]->renderedas = "Text";
            $this->configArray[2]->foreignkeytable = "";
            $this->configArray[2]->foreignkey = "";
            $this->configArray[2]->foreignkeyfield = "";
            $this->configArray[2]->defaultvalue = 0;

            $this->configArray[3]->width = 60;
            $this->configArray[3]->field = "masterid";
            $this->configArray[3]->heading = "Table Id";
            $this->configArray[3]->renderedas = "Text";
            $this->configArray[3]->foreignkeytable = "";
            $this->configArray[3]->foreignkey = "";
            $this->configArray[3]->foreignkeyfield = "";
            $this->configArray[3]->defaultvalue = 0;

            $this->configArray[4]->width = 300;
            $this->configArray[4]->field = "roleid";
            $this->configArray[4]->heading = "Role Name";
            $this->configArray[4]->renderedas = "Combo";
            $this->configArray[4]->foreignkeytable = "Roles";
            $this->configArray[4]->foreignkey = "id";
            $this->configArray[4]->foreignkeyfield = "role";
            $this->configArray[4]->defaultvalue = "";

            return $this->configArray;

          }

          if($configname == 'Queries'){

            $this->configArray[0]->tablename = "Queries";

            $this->configArray[1]->width = 30;
            $this->configArray[1]->field = "id";
            $this->configArray[1]->heading = "Id";
            $this->configArray[1]->renderedas = "Text";
            $this->configArray[1]->foreignkeytable = "";
            $this->configArray[1]->foreignkey = "";
            $this->configArray[1]->foreignkeyfield = "";
            $this->configArray[1]->defaultvalue = "";

            $this->configArray[2]->width = 30;
            $this->configArray[2]->field = "sequence";
            $this->configArray[2]->heading = "Sequence";
            $this->configArray[2]->renderedas = "Text";
            $this->configArray[2]->foreignkeytable = "";
            $this->configArray[2]->foreignkey = "";
            $this->configArray[2]->foreignkeyfield = "";
            $this->configArray[2]->defaultvalue = "";

            $this->configArray[3]->width = 30;
            $this->configArray[3]->field = "masterid";
            $this->configArray[3]->heading = "Table Id";
            $this->configArray[3]->renderedas = "Text";
            $this->configArray[3]->foreignkeytable = "";
            $this->configArray[3]->foreignkey = "";
            $this->configArray[3]->foreignkeyfield = "";
            $this->configArray[3]->defaultvalue = "";

            $this->configArray[4]->width = 100;
            $this->configArray[4]->field = "QueryName";
            $this->configArray[4]->heading = "Query Name";
            $this->configArray[4]->renderedas = "Text";
            $this->configArray[4]->foreignkeytable = "";
            $this->configArray[4]->foreignkey = "";
            $this->configArray[4]->foreignkeyfield = "";
            $this->configArray[4]->defaultvalue = "";

            $this->configArray[5]->width = 300;
            $this->configArray[5]->field = "QueryDescription";
            $this->configArray[5]->heading = "Query Description";
            $this->configArray[5]->renderedas = "Text";
            $this->configArray[5]->foreignkeytable = "";
            $this->configArray[5]->foreignkey = "";
            $this->configArray[5]->foreignkeyfield = "";
            $this->configArray[5]->defaultvalue = "";

            $this->configArray[6]->width = 100;
            $this->configArray[6]->field = "TableId";
            $this->configArray[6]->heading = "Table";
            $this->configArray[6]->renderedas = "Combo";
            $this->configArray[6]->foreignkeytable = "Tables";
            $this->configArray[6]->foreignkey = "id";
            $this->configArray[6]->foreignkeyfield = "TableName";
            $this->configArray[6]->defaultvalue = "";

            $this->configArray[7]->width = 100;
            $this->configArray[7]->field = "EnterpriseObjectId";
            $this->configArray[7]->heading = "Enterprise Object";
            $this->configArray[7]->renderedas = "Combo";
            $this->configArray[7]->foreignkeytable = "EnterpriseObjects";
            $this->configArray[7]->foreignkey = "id";
            $this->configArray[7]->foreignkeyfield = "ProfileName";
            $this->configArray[7]->defaultvalue = "";

            $this->configArray[8]->width = 100;
            $this->configArray[8]->field = "QueryScope";
            $this->configArray[8]->heading = "Query Scope";
            $this->configArray[8]->renderedas = "Combo";
            $this->configArray[8]->foreignkeytable = "SCOPE";
            $this->configArray[8]->foreignkey = "id";
            $this->configArray[8]->foreignkeyfield = "SCOPE";
            $this->configArray[8]->defaultvalue = "";

            $this->configArray[9]->width = 100;
            $this->configArray[9]->field = "QueryUser";
            $this->configArray[9]->heading = "User Email";
            $this->configArray[9]->renderedas = "Combo";
            $this->configArray[9]->foreignkeytable = "users";
            $this->configArray[9]->foreignkey = "id";
            $this->configArray[9]->foreignkeyfield = "Email";
            $this->configArray[9]->defaultvalue = "";

            return $this->configArray;

            }


          if($configname == 'QueryDetail'){

            $this->configArray[0]->tablename = "QueryDetail";

            $this->configArray[1]->width = 30;
            $this->configArray[1]->field = "id";
            $this->configArray[1]->heading = "Id";
            $this->configArray[1]->renderedas = "Text";
            $this->configArray[1]->foreignkeytable = "";
            $this->configArray[1]->foreignkey = "";
            $this->configArray[1]->foreignkeyfield = "";
            $this->configArray[1]->defaultvalue = 0;

            $this->configArray[2]->width = 30;
            $this->configArray[2]->field = "sequence";
            $this->configArray[2]->heading = "Sequence";
            $this->configArray[2]->renderedas = "Text";
            $this->configArray[2]->foreignkeytable = "";
            $this->configArray[2]->foreignkey = "";
            $this->configArray[2]->foreignkeyfield = "";
            $this->configArray[2]->defaultvalue = 0;

            $this->configArray[3]->width = 30;
            $this->configArray[3]->field = "masterid";
            $this->configArray[3]->heading = "Table Id";
            $this->configArray[3]->renderedas = "Text";
            $this->configArray[3]->foreignkeytable = "";
            $this->configArray[3]->foreignkey = "";
            $this->configArray[3]->foreignkeyfield = "";
            $this->configArray[3]->defaultvalue = 0;

            $this->configArray[4]->width = 30;
            $this->configArray[4]->field = "LeftParen";
            $this->configArray[4]->heading = "(";
            $this->configArray[4]->renderedas = "Combo";
            $this->configArray[4]->foreignkeytable = "LeftParen";
            $this->configArray[4]->foreignkey = "id";
            $this->configArray[4]->foreignkeyfield = "LeftParenVal";
            $this->configArray[4]->defaultvalue = "";

            $this->configArray[5]->width = 40;
            $this->configArray[5]->field = "FieldName";
            $this->configArray[5]->heading = "Field Name";
            $this->configArray[5]->renderedas = "Combo";
            $this->configArray[5]->foreignkeytable = "TableColumns";
            $this->configArray[5]->foreignkey = "id";
            $this->configArray[5]->foreignkeyfield = "fieldname";
            $this->configArray[5]->defaultvalue = "";

            $this->configArray[6]->width = 40;
            $this->configArray[6]->field = "OperatorVal";
            $this->configArray[6]->heading = "Operator";
            $this->configArray[6]->renderedas = "Combo";
            $this->configArray[6]->foreignkeytable = "Operators";
            $this->configArray[6]->foreignkey = "id";
            $this->configArray[6]->foreignkeyfield = "OperatorVal";
            $this->configArray[6]->defaultvalue = "";

            $this->configArray[7]->width = 40;
            $this->configArray[7]->field = "ValueText   ";
            $this->configArray[7]->heading = "Value";
            $this->configArray[7]->renderedas = "Text";
            $this->configArray[7]->foreignkeytable = "";
            $this->configArray[7]->foreignkey = "";
            $this->configArray[7]->foreignkeyfield = "";
            $this->configArray[7]->defaultvalue = "";

            $this->configArray[8]->width = 40;
            $this->configArray[8]->field = "AndOr";
            $this->configArray[8]->heading = "And/Or";
            $this->configArray[8]->renderedas = "Combo";
            $this->configArray[8]->foreignkeytable = "AndOr";
            $this->configArray[8]->foreignkey = "id";
            $this->configArray[8]->foreignkeyfield = "ValueText";
            $this->configArray[8]->defaultvalue = "";

            $this->configArray[9]->width = 30;
            $this->configArray[9]->field = "RightParen";
            $this->configArray[9]->heading = "(";
            $this->configArray[9]->renderedas = "Combo";
            $this->configArray[9]->foreignkeytable = "RightParen";
            $this->configArray[9]->foreignkey = "id";
            $this->configArray[9]->foreignkeyfield = "RightParenVal";
            $this->configArray[9]->defaultvalue = "";

            return $this->configArray;

            }

/*
 *
   `id` int(11) NOT NULL AUTO_INCREMENT,
  `sequence` int(11) DEFAULT NULL,
  `masterid` int(11) DEFAULT NULL,
  `WorkflowName` varchar(50) DEFAULT NULL,
  `Workflowdescription` varchar(500) DEFAULT NULL,
  `Workflowtype` int(11) DEFAULT NULL,
  `PendingComplete` datetime DEFAULT NULL,
  `SubmitComplete` datetime DEFAULT NULL,
  `ReviewComplete` datetime DEFAULT NULL,
  `Complete` datetime DEFAULT NULL,
  `CurrentStatus` int(11) DEFAULT NULL,
 *
 */


          if($configname == 'Notifications'){

              $this->configArray[0]->tablename = "Notifications";

              $this->configArray[1]->width = 30;
              $this->configArray[1]->field = "id";
              $this->configArray[1]->heading = "Id";
              $this->configArray[1]->renderedas = "Text";
              $this->configArray[1]->foreignkeytable = "";
              $this->configArray[1]->foreignkey = "";
              $this->configArray[1]->foreignkeyfield = "";
              $this->configArray[1]->defaultvalue = "";

              $this->configArray[2]->width = 30;
              $this->configArray[2]->field = "sequence";
              $this->configArray[2]->heading = "Sequence";
              $this->configArray[2]->renderedas = "Text";
              $this->configArray[2]->foreignkeytable = "";
              $this->configArray[2]->foreignkey = "";
              $this->configArray[2]->foreignkeyfield = "";
              $this->configArray[2]->defaultvalue = "";

              $this->configArray[3]->width = 30;
              $this->configArray[3]->field = "masterid";
              $this->configArray[3]->heading = "Table Id";
              $this->configArray[3]->renderedas = "Text";
              $this->configArray[3]->foreignkeytable = "";
              $this->configArray[3]->foreignkey = "";
              $this->configArray[3]->foreignkeyfield = "";
              $this->configArray[3]->defaultvalue = "";

              $this->configArray[4]->width = 100;
              $this->configArray[4]->field = "NotificationName";
              $this->configArray[4]->heading = "Notification Name";
              $this->configArray[4]->renderedas = "Text";
              $this->configArray[4]->foreignkeytable = "";
              $this->configArray[4]->foreignkey = "";
              $this->configArray[4]->foreignkeyfield = "";
              $this->configArray[4]->defaultvalue = "";

              $this->configArray[5]->width = 200;
              $this->configArray[5]->field = "NotificationDescription";
              $this->configArray[5]->heading = "Notification Description";
              $this->configArray[5]->renderedas = "Text";
              $this->configArray[5]->foreignkeytable = "";
              $this->configArray[5]->foreignkey = "";
              $this->configArray[5]->foreignkeyfield = "";
              $this->configArray[5]->defaultvalue = "";

              $this->configArray[6]->width = 100;
              $this->configArray[6]->field = "Subject";
              $this->configArray[6]->heading = "Subject";
              $this->configArray[6]->renderedas = "Text";
              $this->configArray[6]->foreignkeytable = "";
              $this->configArray[6]->foreignkey = "";
              $this->configArray[6]->foreignkeyfield = "";
              $this->configArray[6]->defaultvalue = "";

              $this->configArray[7]->width = 500;
              $this->configArray[7]->field = "MessageText";
              $this->configArray[7]->heading = "Message Text";
              $this->configArray[7]->renderedas = "Text";
              $this->configArray[7]->foreignkeytable = "";
              $this->configArray[7]->foreignkey = "";
              $this->configArray[7]->foreignkeyfield = "";
              $this->configArray[7]->defaultvalue = "";

              return $this->configArray;

          }


          if($configname == 'NotificationUsers'){

              $this->configArray[0]->tablename = "Notifications";

              $this->configArray[1]->width = 30;
              $this->configArray[1]->field = "id";
              $this->configArray[1]->heading = "Id";
              $this->configArray[1]->renderedas = "Text";
              $this->configArray[1]->foreignkeytable = "";
              $this->configArray[1]->foreignkey = "";
              $this->configArray[1]->foreignkeyfield = "";
              $this->configArray[1]->defaultvalue = "";

              $this->configArray[2]->width = 30;
              $this->configArray[2]->field = "sequence";
              $this->configArray[2]->heading = "Sequence";
              $this->configArray[2]->renderedas = "Text";
              $this->configArray[2]->foreignkeytable = "";
              $this->configArray[2]->foreignkey = "";
              $this->configArray[2]->foreignkeyfield = "";
              $this->configArray[2]->defaultvalue = "";

              $this->configArray[3]->width = 30;
              $this->configArray[3]->field = "masterid";
              $this->configArray[3]->heading = "Table Id";
              $this->configArray[3]->renderedas = "Text";
              $this->configArray[3]->foreignkeytable = "";
              $this->configArray[3]->foreignkey = "";
              $this->configArray[3]->foreignkeyfield = "";
              $this->configArray[3]->defaultvalue = "";

              $this->configArray[4]->width = 300;
              $this->configArray[4]->field = "userid";
              $this->configArray[4]->heading = "Notification User";
              $this->configArray[4]->renderedas = "Combo";
              $this->configArray[4]->foreignkeytable = "users";
              $this->configArray[4]->foreignkey = "id";
              $this->configArray[4]->foreignkeyfield = "Email";
              $this->configArray[4]->defaultvalue = "";

              return $this->configArray;

          }


          if($configname == 'AdvWorkflow'){

              $this->configArray[0]->tablename = "AdvWorkflow";

              $this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel', listeners: {itemclick: function() {ProcessChildTab();}},columns:[ ";

              $this->configArray[0]->endstring =
                  "],
                     width: 910,
                     height: 350,
                     x: 10,
                     y: 10,
                     title: '" . $configname . "', " . "
                     frame: true,
                     tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                     ],
                     plugins: [cellEditing1]}";

              $this->configArray[1]->width = 30;
              $this->configArray[1]->field = "id";
              $this->configArray[1]->heading = "Id";
              $this->configArray[1]->renderedas = "Text";
              $this->configArray[1]->foreignkeytable = "";
              $this->configArray[1]->foreignkey = "";
              $this->configArray[1]->foreignkeyfield = "";
              $this->configArray[1]->defaultvalue = 0;

              $this->configArray[2]->width = 30;
              $this->configArray[2]->field = "sequence";
              $this->configArray[2]->heading = "Sequence";
              $this->configArray[2]->renderedas = "Text";
              $this->configArray[2]->foreignkeytable = "";
              $this->configArray[2]->foreignkey = "";
              $this->configArray[2]->foreignkeyfield = "";
              $this->configArray[2]->defaultvalue = 0;

              $this->configArray[3]->width = 30;
              $this->configArray[3]->field = "masterid";
              $this->configArray[3]->heading = "Table Id";
              $this->configArray[3]->renderedas = "Text";
              $this->configArray[3]->foreignkeytable = "";
              $this->configArray[3]->foreignkey = "";
              $this->configArray[3]->foreignkeyfield = "";
              $this->configArray[3]->defaultvalue = 0;

              $this->configArray[4]->width = 100;
              $this->configArray[4]->field = "WorkflowName";
              $this->configArray[4]->heading = "Workflow Name";
              $this->configArray[4]->renderedas = "Text";
              $this->configArray[4]->foreignkeytable = "";
              $this->configArray[4]->foreignkey = "";
              $this->configArray[4]->foreignkeyfield = "";
              $this->configArray[4]->defaultvalue = "";

              $this->configArray[5]->width = 200;
              $this->configArray[5]->field = "Workflowdescription";
              $this->configArray[5]->heading = "Workflow description";
              $this->configArray[5]->renderedas = "Text";
              $this->configArray[5]->foreignkeytable = "";
              $this->configArray[5]->foreignkey = "";
              $this->configArray[5]->foreignkeyfield = "";
              $this->configArray[5]->defaultvalue = "";

              $this->configArray[6]->width = 50;
              $this->configArray[6]->field = "Enabled";
              $this->configArray[6]->heading = "Enabled";
              $this->configArray[6]->renderedas = "Text";
              $this->configArray[6]->foreignkeytable = "";
              $this->configArray[6]->foreignkey = "";
              $this->configArray[6]->foreignkeyfield = "";
              $this->configArray[6]->defaultvalue = "";


              return $this->configArray;

          }




          if($configname == 'AdvWorkflowStep'){

              $this->configArray[0]->tablename = "AdvWorkflows";

              $this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel', listeners: {itemclick: function() {ProcessChildTab();}},columns:[ ";

              $this->configArray[0]->endstring =
                  "],
                     width: 910,
                     height: 350,
                     x: 10,
                     y: 10,
                     title: '" . $configname . "', " . "
                     frame: true,
                     tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                     ],
                     plugins: [cellEditing1]}";

              $this->configArray[1]->width = 30;
              $this->configArray[1]->field = "id";
              $this->configArray[1]->heading = "Id";
              $this->configArray[1]->renderedas = "Text";
              $this->configArray[1]->foreignkeytable = "";
              $this->configArray[1]->foreignkey = "";
              $this->configArray[1]->foreignkeyfield = "";
              $this->configArray[1]->defaultvalue = 0;

              $this->configArray[2]->width = 30;
              $this->configArray[2]->field = "sequence";
              $this->configArray[2]->heading = "Sequence";
              $this->configArray[2]->renderedas = "Text";
              $this->configArray[2]->foreignkeytable = "";
              $this->configArray[2]->foreignkey = "";
              $this->configArray[2]->foreignkeyfield = "";
              $this->configArray[2]->defaultvalue = 0;

              $this->configArray[3]->width = 30;
              $this->configArray[3]->field = "masterid";
              $this->configArray[3]->heading = "Master Id";
              $this->configArray[3]->renderedas = "Text";
              $this->configArray[3]->foreignkeytable = "";
              $this->configArray[3]->foreignkey = "";
              $this->configArray[3]->foreignkeyfield = "";
              $this->configArray[3]->defaultvalue = 0;

              $this->configArray[4]->width = 30;
              $this->configArray[4]->field = "tableid";
              $this->configArray[4]->heading = "Table Id";
              $this->configArray[4]->renderedas = "Text";
              $this->configArray[4]->foreignkeytable = "";
              $this->configArray[4]->foreignkey = "";
              $this->configArray[4]->foreignkeyfield = "";
              $this->configArray[4]->defaultvalue = 0;

              $this->configArray[5]->width = 100;
              $this->configArray[5]->field = "workflowid";
              $this->configArray[5]->heading = "Workflow Id";
              $this->configArray[5]->renderedas = "Text";
              $this->configArray[5]->foreignkeytable = "";
              $this->configArray[5]->foreignkey = "";
              $this->configArray[5]->foreignkeyfield = "";
              $this->configArray[5]->defaultvalue = "";

              $this->configArray[6]->width = 100;
              $this->configArray[6]->field = "location";
              $this->configArray[6]->heading = "Location";
              $this->configArray[6]->renderedas = "Text";
              $this->configArray[6]->foreignkeytable = "";
              $this->configArray[6]->foreignkey = "";
              $this->configArray[6]->foreignkeyfield = "";
              $this->configArray[6]->defaultvalue = "";

              $this->configArray[7]->width = 100;
              $this->configArray[7]->field = "ActionType";
              $this->configArray[7]->heading = "ActionType";
              $this->configArray[7]->renderedas = "Text";
              $this->configArray[7]->foreignkeytable = "";
              $this->configArray[7]->foreignkey = "";
              $this->configArray[7]->foreignkeyfield = "";
              $this->configArray[7]->defaultvalue = "";

              $this->configArray[8]->width = 100;
              $this->configArray[8]->field = "Notification";
              $this->configArray[8]->heading = "Notification";
              $this->configArray[8]->renderedas = "Text";
              $this->configArray[8]->foreignkeytable = "";
              $this->configArray[8]->foreignkey = "";
              $this->configArray[8]->foreignkeyfield = "";
              $this->configArray[8]->defaultvalue = "";

              $this->configArray[9]->width = 100;
              $this->configArray[9]->field = "ActionURL";
              $this->configArray[9]->heading = "ActionURL";
              $this->configArray[9]->renderedas = "Text";
              $this->configArray[9]->foreignkeytable = "";
              $this->configArray[9]->foreignkey = "";
              $this->configArray[9]->foreignkeyfield = "";
              $this->configArray[9]->defaultvalue = "";

              $this->configArray[10]->width = 100;
              $this->configArray[10]->field = "Revision";
              $this->configArray[10]->heading = "Revision";
              $this->configArray[10]->renderedas = "Text";
              $this->configArray[10]->foreignkeytable = "";
              $this->configArray[10]->foreignkey = "";
              $this->configArray[10]->foreignkeyfield = "";
              $this->configArray[10]->defaultvalue = "";

              $this->configArray[11]->width = 100;
              $this->configArray[11]->field = "Started";
              $this->configArray[11]->heading = "Started";
              $this->configArray[11]->renderedas = "Text";
              $this->configArray[11]->foreignkeytable = "";
              $this->configArray[11]->foreignkey = "";
              $this->configArray[11]->foreignkeyfield = "";
              $this->configArray[11]->defaultvalue = "";

              $this->configArray[12]->width = 100;
              $this->configArray[12]->field = "Completed";
              $this->configArray[12]->heading = "Completed";
              $this->configArray[12]->renderedas = "Text";
              $this->configArray[12]->foreignkeytable = "";
              $this->configArray[12]->foreignkey = "";
              $this->configArray[12]->foreignkeyfield = "";
              $this->configArray[12]->defaultvalue = "";

              $this->configArray[13]->width = 100;
              $this->configArray[13]->field = "CreateDate";
              $this->configArray[13]->heading = "CreateDate";
              $this->configArray[13]->renderedas = "Text";
              $this->configArray[13]->foreignkeytable = "";
              $this->configArray[13]->foreignkey = "";
              $this->configArray[13]->foreignkeyfield = "";
              $this->configArray[13]->defaultvalue = "";

              $this->configArray[14]->width = 100;
              $this->configArray[14]->field = "Instructions";
              $this->configArray[14]->heading = "Instructions";
              $this->configArray[14]->renderedas = "Text";
              $this->configArray[14]->foreignkeytable = "";
              $this->configArray[14]->foreignkey = "";
              $this->configArray[14]->foreignkeyfield = "";
              $this->configArray[14]->defaultvalue = "";

              $this->configArray[15]->width = 100;
              $this->configArray[15]->field = "ErrorResult";
              $this->configArray[15]->heading = "ErrorResult";
              $this->configArray[15]->renderedas = "Text";
              $this->configArray[15]->foreignkeytable = "";
              $this->configArray[15]->foreignkey = "";
              $this->configArray[15]->foreignkeyfield = "";
              $this->configArray[15]->defaultvalue = "";

              $this->configArray[16]->width = 100;
              $this->configArray[16]->field = "name";
              $this->configArray[16]->heading = "name";
              $this->configArray[16]->renderedas = "Text";
              $this->configArray[16]->foreignkeytable = "";
              $this->configArray[16]->foreignkey = "";
              $this->configArray[16]->foreignkeyfield = "";
              $this->configArray[16]->defaultvalue = "";

              $this->configArray[17]->width = 100;
              $this->configArray[17]->field = "status";
              $this->configArray[17]->heading = "status";
              $this->configArray[17]->renderedas = "Text";
              $this->configArray[17]->foreignkeytable = "";
              $this->configArray[17]->foreignkey = "";
              $this->configArray[17]->foreignkeyfield = "";
              $this->configArray[17]->defaultvalue = "";

              $this->configArray[18]->width = 100;
              $this->configArray[18]->field = "description";
              $this->configArray[18]->heading = "description";
              $this->configArray[18]->renderedas = "Text";
              $this->configArray[18]->foreignkeytable = "";
              $this->configArray[18]->foreignkey = "";
              $this->configArray[18]->foreignkeyfield = "";
              $this->configArray[18]->defaultvalue = "";

              $this->configArray[19]->width = 100;
              $this->configArray[19]->field = "ApproverUserId";
              $this->configArray[19]->heading = "Approver User";
              $this->configArray[19]->renderedas = "Combo";
              $this->configArray[19]->foreignkeytable = "users";
              $this->configArray[19]->foreignkey = "id";
              $this->configArray[19]->foreignkeyfield = "Email";
              $this->configArray[19]->defaultvalue = "";

              $this->configArray[20]->width = 100;
              $this->configArray[20]->field = "category";
              $this->configArray[20]->heading = "category";
              $this->configArray[20]->renderedas = "Text";
              $this->configArray[20]->foreignkeytable = "";
              $this->configArray[20]->foreignkey = "";
              $this->configArray[20]->foreignkeyfield = "";
              $this->configArray[20]->defaultvalue = "";

              $this->configArray[21]->width = 100;
              $this->configArray[21]->field = "ReviewPolicy";
              $this->configArray[21]->heading = "Review Policy";
              $this->configArray[21]->renderedas = "Text";
              $this->configArray[21]->foreignkeytable = "";
              $this->configArray[21]->foreignkey = "";
              $this->configArray[21]->foreignkeyfield = "";
              $this->configArray[21]->defaultvalue = "";

              $this->configArray[22]->width = 100;
              $this->configArray[22]->field = "UIClass";
              $this->configArray[22]->heading = "UIClass";
              $this->configArray[22]->renderedas = "Text";
              $this->configArray[22]->foreignkeytable = "";
              $this->configArray[22]->foreignkey = "";
              $this->configArray[22]->foreignkeyfield = "";
              $this->configArray[22]->defaultvalue = "";

              return $this->configArray;

          }


          if($configname == 'AdvWorkflowStepList'){

              $this->configArray[0]->tablename = "AdvWorkflows";

              $this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel', listeners: {itemclick: function() {ProcessChildTab();}},columns:[ ";

              $this->configArray[0]->endstring =
                  "],
                     width: 910,
                     height: 350,
                     x: 10,
                     y: 10,
                     title: '" . $configname . "', " . "
                     frame: true,
                     tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                     ],
                     plugins: [cellEditing1]}";

              $this->configArray[1]->width = 30;
              $this->configArray[1]->field = "id";
              $this->configArray[1]->heading = "Id";
              $this->configArray[1]->renderedas = "Text";
              $this->configArray[1]->foreignkeytable = "";
              $this->configArray[1]->foreignkey = "";
              $this->configArray[1]->foreignkeyfield = "";
              $this->configArray[1]->defaultvalue = 0;

              $this->configArray[2]->width = 100;
              $this->configArray[2]->field = "xloc";
              $this->configArray[2]->heading = "xloc";
              $this->configArray[2]->renderedas = "Text";
              $this->configArray[2]->foreignkeytable = "";
              $this->configArray[2]->foreignkey = "";
              $this->configArray[2]->foreignkeyfield = "";
              $this->configArray[2]->defaultvalue = "";

              $this->configArray[3]->width = 100;
              $this->configArray[3]->field = "yloc";
              $this->configArray[3]->heading = "yloc";
              $this->configArray[3]->renderedas = "Text";
              $this->configArray[3]->foreignkeytable = "";
              $this->configArray[3]->foreignkey = "";
              $this->configArray[3]->foreignkeyfield = "";
              $this->configArray[3]->defaultvalue = "";

              $this->configArray[4]->width = 100;
              $this->configArray[4]->field = "name";
              $this->configArray[4]->heading = "name";
              $this->configArray[4]->renderedas = "Text";
              $this->configArray[4]->foreignkeytable = "";
              $this->configArray[4]->foreignkey = "";
              $this->configArray[4]->foreignkeyfield = "";
              $this->configArray[4]->defaultvalue = "";

              $this->configArray[5]->width = 100;
              $this->configArray[5]->field = "statustype";
              $this->configArray[5]->heading = "statustype";
              $this->configArray[5]->renderedas = "Text";
              $this->configArray[5]->foreignkeytable = "";
              $this->configArray[5]->foreignkey = "";
              $this->configArray[5]->foreignkeyfield = "";
              $this->configArray[5]->defaultvalue = "";

              return $this->configArray;

          }


          if($configname == 'AdvWorkflowInstance'){

            $this->configArray[0]->tablename = "AdvWorkflowInstance";

            $this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel', listeners: {itemclick: function() {ProcessChildTab();}},columns:[ ";

            $this->configArray[0]->endstring =
                     "],
                     width: 910,
                     height: 350,
                     x: 10,
                     y: 10,
                     title: '" . $configname . "', " . "
                     frame: true,
                     tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                     ],
                     plugins: [cellEditing1]}";

            $this->configArray[1]->width = 30;
            $this->configArray[1]->field = "id";
            $this->configArray[1]->heading = "Id";
            $this->configArray[1]->renderedas = "Text";
            $this->configArray[1]->foreignkeytable = "";
            $this->configArray[1]->foreignkey = "";
            $this->configArray[1]->foreignkeyfield = "";
            $this->configArray[1]->defaultvalue = 0;

            $this->configArray[2]->width = 30;
            $this->configArray[2]->field = "sequence";
            $this->configArray[2]->heading = "Sequence";
            $this->configArray[2]->renderedas = "Text";
            $this->configArray[2]->foreignkeytable = "";
            $this->configArray[2]->foreignkey = "";
            $this->configArray[2]->foreignkeyfield = "";
            $this->configArray[2]->defaultvalue = 0;

            $this->configArray[3]->width = 30;
            $this->configArray[3]->field = "masterid";
            $this->configArray[3]->heading = "Table Id";
            $this->configArray[3]->renderedas = "Text";
            $this->configArray[3]->foreignkeytable = "";
            $this->configArray[3]->foreignkey = "";
            $this->configArray[3]->foreignkeyfield = "";
            $this->configArray[3]->defaultvalue = 0;

            $this->configArray[4]->width = 100;
            $this->configArray[4]->field = "WorkflowName";
            $this->configArray[4]->heading = "Workflow Name";
            $this->configArray[4]->renderedas = "Combo";
            $this->configArray[4]->foreignkeytable = "AdvWorkflows";
            $this->configArray[4]->foreignkey = "id";
            $this->configArray[4]->foreignkeyfield = "WorkflowName";
            $this->configArray[4]->defaultvalue = "";

            $this->configArray[5]->width = 200;
            $this->configArray[5]->field = "Workflowdescription";
            $this->configArray[5]->heading = "Workflow description";
            $this->configArray[5]->renderedas = "Text";
            $this->configArray[5]->foreignkeytable = "";
            $this->configArray[5]->foreignkey = "";
            $this->configArray[5]->foreignkeyfield = "";
            $this->configArray[5]->defaultvalue = "";

            $this->configArray[6]->width = 60;
            $this->configArray[6]->field = "ContentName";
            $this->configArray[6]->heading = "Content Name";
            $this->configArray[6]->renderedas = "Text";
            $this->configArray[6]->foreignkeytable = "";
            $this->configArray[6]->foreignkey = "";
            $this->configArray[6]->foreignkeyfield = "";
            $this->configArray[6]->defaultvalue = "";

            $this->configArray[7]->width = 60;
            $this->configArray[7]->field = "ContentDescription";
            $this->configArray[7]->heading = "Content Description";
            $this->configArray[7]->renderedas = "Text";
            $this->configArray[7]->foreignkeytable = "";
            $this->configArray[7]->foreignkey = "";
            $this->configArray[7]->foreignkeyfield = "";
            $this->configArray[7]->defaultvalue = "";

            $this->configArray[8]->width = 100;
            $this->configArray[8]->field = "KeyName";
            $this->configArray[8]->heading = "Key Name";
            $this->configArray[8]->renderedas = "Text";
            $this->configArray[8]->foreignkeytable = "";
            $this->configArray[8]->foreignkey = "";
            $this->configArray[8]->foreignkeyfield = "";
            $this->configArray[8]->defaultvalue = "";

            $this->configArray[9]->width = 60;
            $this->configArray[9]->field = "Status";
            $this->configArray[9]->heading = "Status";
            $this->configArray[9]->renderedas = "Text";
            $this->configArray[9]->foreignkeytable = "";
            $this->configArray[9]->foreignkey = "";
            $this->configArray[9]->foreignkeyfield = "";
            $this->configArray[9]->defaultvalue = "";

            $this->configArray[10]->width = 60;
            $this->configArray[10]->field = "CreateDate";
            $this->configArray[10]->heading = "Date Created";
            $this->configArray[10]->renderedas = "Text";
            $this->configArray[10]->foreignkeytable = "";
            $this->configArray[10]->foreignkey = "";
            $this->configArray[10]->foreignkeyfield = "";
            $this->configArray[10]->defaultvalue = "";

            $this->configArray[11]->width = 300;
            $this->configArray[11]->field = "CreateUser";
            $this->configArray[11]->heading = "User";
            $this->configArray[11]->renderedas = "Combo";
            $this->configArray[11]->foreignkeytable = "users";
            $this->configArray[11]->foreignkey = "id";
            $this->configArray[11]->foreignkeyfield = "Email";
            $this->configArray[11]->defaultvalue = "";

            return $this->configArray;

            }


          if($configname == 'AdvWorkflowInstance1'){

              $this->configArray[0]->tablename = "AdvWorkflowInstance";

              $this->configArray[0]->startstring = "{ store: workflowinstanceStore, selModel: 'cellmodel', listeners: {itemclick: function() {ProcessChildTab();}},columns:[ ";

              $this->configArray[0]->endstring =
                  "],
                     width: 910,
                     height: 350,
                     x: 10,
                     y: 10,
                     title: '" . $configname . "', " . "
                     frame: true,
                     tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                     ],
                     plugins: [cellEditing1]}";

              $this->configArray[1]->width = 30;
              $this->configArray[1]->field = "id";
              $this->configArray[1]->heading = "Id";
              $this->configArray[1]->renderedas = "Text";
              $this->configArray[1]->foreignkeytable = "";
              $this->configArray[1]->foreignkey = "";
              $this->configArray[1]->foreignkeyfield = "";
              $this->configArray[1]->defaultvalue = 0;

              $this->configArray[2]->width = 30;
              $this->configArray[2]->field = "sequence";
              $this->configArray[2]->heading = "Sequence";
              $this->configArray[2]->renderedas = "Text";
              $this->configArray[2]->foreignkeytable = "";
              $this->configArray[2]->foreignkey = "";
              $this->configArray[2]->foreignkeyfield = "";
              $this->configArray[2]->defaultvalue = 0;

              $this->configArray[3]->width = 30;
              $this->configArray[3]->field = "masterid";
              $this->configArray[3]->heading = "Table Id";
              $this->configArray[3]->renderedas = "Text";
              $this->configArray[3]->foreignkeytable = "";
              $this->configArray[3]->foreignkey = "";
              $this->configArray[3]->foreignkeyfield = "";
              $this->configArray[3]->defaultvalue = 0;

           //   $this->configArray[4]->width = 30;
           //   $this->configArray[4]->field = "recordid";
           //   $this->configArray[4]->heading = "Record Id";
           //   $this->configArray[4]->renderedas = "Text";
           //   $this->configArray[4]->foreignkeytable = "";
           //   $this->configArray[4]->foreignkey = "";
           //   $this->configArray[4]->foreignkeyfield = "";
           //   $this->configArray[4]->defaultvalue = 0;

              $this->configArray[4]->width = 100;
              $this->configArray[4]->field = "WorkflowName";
              $this->configArray[4]->heading = "Workflow Name";
              $this->configArray[4]->renderedas = "Text";
              $this->configArray[4]->foreignkeytable = "";
              $this->configArray[4]->foreignkey = "";
              $this->configArray[4]->foreignkeyfield = "";
              $this->configArray[4]->defaultvalue = "";

              $this->configArray[5]->width = 100;
              $this->configArray[5]->field = "Workflowdescription";
              $this->configArray[5]->heading = "Workflow Description";
              $this->configArray[5]->renderedas = "Text";
              $this->configArray[5]->foreignkeytable = "";
              $this->configArray[5]->foreignkey = "";
              $this->configArray[5]->foreignkeyfield = "";
              $this->configArray[5]->defaultvalue = "";

              $this->configArray[6]->width = 120;
              $this->configArray[6]->field = "createdate";
              $this->configArray[6]->heading = "Create Date";
              $this->configArray[6]->renderedas = "Date";
              $this->configArray[6]->foreignkeytable = "";
              $this->configArray[6]->foreignkey = "";
              $this->configArray[6]->foreignkeyfield = "";
              $this->configArray[6]->defaultvalue = "";


              $this->configArray[7]->width = 120;
              $this->configArray[7]->field = "completedate";
              $this->configArray[7]->heading = "Complete Date";
              $this->configArray[7]->renderedas = "Date";
              $this->configArray[7]->foreignkeytable = "";
              $this->configArray[7]->foreignkey = "";
              $this->configArray[7]->foreignkeyfield = "";
              $this->configArray[7]->defaultvalue = "";

              $this->configArray[8]->width = 120;
              $this->configArray[8]->field = "KeyName";
              $this->configArray[8]->heading = "Key Name";
              $this->configArray[8]->renderedas = "Text";
              $this->configArray[8]->foreignkeytable = "";
              $this->configArray[8]->foreignkey = "";
              $this->configArray[8]->foreignkeyfield = "";
              $this->configArray[8]->defaultvalue = "";



              //  $this->configArray[6]->width = 100;
            //  $this->configArray[6]->field = "Revision";
            //  $this->configArray[6]->heading = "Revision";
            //  $this->configArray[6]->renderedas = "Text";
            //  $this->configArray[6]->foreignkeytable = "";
            //  $this->configArray[6]->foreignkey = "";
            //  $this->configArray[6]->foreignkeyfield = "";
            //  $this->configArray[6]->defaultvalue = "";

            //  $this->configArray[7]->width = 60;
            //  $this->configArray[7]->field = "CurrentStatus";
            //  $this->configArray[7]->heading = "Current Status";
            //  $this->configArray[7]->renderedas = "Text";
            //  $this->configArray[7]->foreignkeytable = "";
            //  $this->configArray[7]->foreignkey = "";
            //  $this->configArray[7]->foreignkeyfield = "";
            //  $this->configArray[7]->defaultvalue = "1";

          //    $this->configArray[8]->width = 120;
          //    $this->configArray[8]->field = "PendingComplete";
          //    $this->configArray[8]->heading = "Pending Complete";
          //    $this->configArray[8]->renderedas = "Date";
          //    $this->configArray[8]->foreignkeytable = "";
          //    $this->configArray[8]->foreignkey = "";
          //    $this->configArray[8]->foreignkeyfield = "";
          //    $this->configArray[8]->defaultvalue = "";

          //    $this->configArray[9]->width = 120;
          //    $this->configArray[9]->field = "SubmitComplete";
           //   $this->configArray[9]->heading = "Submit Complete";
            //  $this->configArray[9]->renderedas = "Date";
             // $this->configArray[9]->foreignkeytable = "";
            //  $this->configArray[9]->foreignkey = "";
            //  $this->configArray[9]->foreignkeyfield = "";
           //   $this->configArray[9]->defaultvalue = "";

          //    $this->configArray[10]->width = 120;
          //    $this->configArray[10]->field = "ReviewComplete";
          //    $this->configArray[10]->heading = "Review Complete";
          //    $this->configArray[10]->renderedas = "Date";
          //    $this->configArray[10]->foreignkeytable = "";
          //    $this->configArray[10]->foreignkey = "";
          //    $this->configArray[10]->foreignkeyfield = "";
          //    $this->configArray[10]->defaultvalue = "";

          //    $this->configArray[11]->width = 120;
          //    $this->configArray[11]->field = "Complete";
          //    $this->configArray[11]->heading = "Complete";
          //    $this->configArray[11]->renderedas = "Date";
          //    $this->configArray[11]->foreignkeytable = "";
          //    $this->configArray[11]->foreignkey = "";
          //    $this->configArray[11]->foreignkeyfield = "";
          //    $this->configArray[11]->defaultvalue = "";

              return $this->configArray;

          }




          if($configname == 'SignOffs'){

              $this->configArray[0]->tablename = "SignOffs";

              $this->configArray[0]->startstring = "{ store: childStore, selModel: 'cellmodel', columns:[ ";
              $this->configArray[0]->endstring =
                  "],
                         width: 960,
                         height: 300,
                         x: 20,
                         y: 390,
                         title: '" . $configname . "', " . "
                         frame: true,
                         tbar: [{text: 'Add',    disabled: " . $childadd . ", handler : function() {processInsert(BSSChildConfigName,childgrid,childStore);}},
                                {text: 'Save',   disabled: " . $childsave . ", handler : function() {processUpdate(BSSChildConfigName,childgrid,childStore);}},
                                {text: 'Delete', disabled: " . $childdelete . ", handler : function() {processDelete(BSSChildConfigName,childgrid,childStore);}}
                         ],
                         plugins: [cellEditing]}";

              $this->configArray[1]->width = 60;
              $this->configArray[1]->field = "id";
              $this->configArray[1]->heading = "Id";
              $this->configArray[1]->renderedas = "Text";
              $this->configArray[1]->foreignkeytable = "";
              $this->configArray[1]->foreignkey = "";
              $this->configArray[1]->foreignkeyfield = "";
              $this->configArray[1]->defaultvalue = 0;

              $this->configArray[2]->width = 80;
              $this->configArray[2]->field = "sequence";
              $this->configArray[2]->heading = "Sequence";
              $this->configArray[2]->renderedas = "Text";
              $this->configArray[2]->foreignkeytable = "";
              $this->configArray[2]->foreignkey = "";
              $this->configArray[2]->foreignkeyfield = "";
              $this->configArray[2]->defaultvalue = 0;

              $this->configArray[3]->width = 80;
              $this->configArray[3]->field = "masterid";
              $this->configArray[3]->heading = "Table Id";
              $this->configArray[3]->renderedas = "Text";
              $this->configArray[3]->foreignkeytable = "";
              $this->configArray[3]->foreignkey = "";
              $this->configArray[3]->foreignkeyfield = "";
              $this->configArray[3]->defaultvalue = 0;

              $this->configArray[4]->width = 300;
              $this->configArray[4]->field = "WorkflowApprover";
              $this->configArray[4]->heading = "Workflow Approver";
              $this->configArray[4]->renderedas = "Combo";
              $this->configArray[4]->foreignkeytable = "users";
              $this->configArray[4]->foreignkey = "id";
              $this->configArray[4]->foreignkeyfield = "Email";
              $this->configArray[4]->defaultvalue = "";

              $this->configArray[5]->width = 100;
              $this->configArray[5]->field = "SignoffDate";
              $this->configArray[5]->heading = "Signoff Date";
              $this->configArray[5]->renderedas = "Date";
              $this->configArray[5]->foreignkeytable = "";
              $this->configArray[5]->foreignkey = "";
              $this->configArray[5]->foreignkeyfield = "";
              $this->configArray[5]->defaultvalue = "";

              $this->configArray[6]->width = 100;
              $this->configArray[6]->field = "SignoffResult";
              $this->configArray[6]->heading = "Signoff Result";
              $this->configArray[6]->renderedas = "Combo";
              $this->configArray[6]->foreignkeytable = "SignoffResult";
              $this->configArray[6]->foreignkey = "id";
              $this->configArray[6]->foreignkeyfield = "Result";
              $this->configArray[6]->defaultvalue = "";

              $this->configArray[7]->width = 100;
              $this->configArray[7]->field = "Comments";
              $this->configArray[7]->heading = "Comments";
              $this->configArray[7]->renderedas = "Text";
              $this->configArray[7]->foreignkeytable = "";
              $this->configArray[7]->foreignkey = "";
              $this->configArray[7]->foreignkeyfield = "";
              $this->configArray[7]->defaultvalue = "";
   /*
              $this->configArray[8]->width = 100;
              $this->configArray[8]->field = "workflowid";
              $this->configArray[8]->heading = "Workflow Id";
              $this->configArray[8]->renderedas = "Text";
              $this->configArray[8]->foreignkeytable = "";
              $this->configArray[8]->foreignkey = "";
              $this->configArray[8]->foreignkeyfield = "";
              $this->configArray[8]->defaultvalue = "";

              $this->configArray[9]->width = 100;
              $this->configArray[9]->field = "stepkey";
              $this->configArray[9]->heading = "Step Key";
              $this->configArray[9]->renderedas = "Text";
              $this->configArray[9]->foreignkeytable = "";
              $this->configArray[9]->foreignkey = "";
              $this->configArray[9]->foreignkeyfield = "";
              $this->configArray[9]->defaultvalue = "";
     */

              return $this->configArray;

          }


          if($configname == 'WorkflowApprovers'){

            $this->configArray[0]->tablename = "WorkflowApprovers";

            $this->configArray[0]->startstring = "{ store: childStore, selModel: 'cellmodel', columns:[ ";
            $this->configArray[0]->endstring =
                         "],
                         width: 960,
                         height: 250,
                         x: 10,
                         y: 10,
                         title: '" . $configname . "', " . "
                         frame: true,
                         tbar: [{text: 'Add',    disabled: " . $childadd . ", handler : function() {processInsert(BSSChildConfigName,childgrid,childStore);}},
                                {text: 'Save',   disabled: " . $childsave . ", handler : function() {processUpdate(BSSChildConfigName,childgrid,childStore);}},
                                {text: 'Delete', disabled: " . $childdelete . ", handler : function() {processDelete(BSSChildConfigName,childgrid,childStore);}}
                         ],
                         plugins: [cellEditing]}";

            $this->configArray[1]->width = 60;
            $this->configArray[1]->field = "id";
            $this->configArray[1]->heading = "Id";
            $this->configArray[1]->renderedas = "Text";
            $this->configArray[1]->foreignkeytable = "";
            $this->configArray[1]->foreignkey = "";
            $this->configArray[1]->foreignkeyfield = "";
            $this->configArray[1]->defaultvalue = 0;

            $this->configArray[2]->width = 80;
            $this->configArray[2]->field = "sequence";
            $this->configArray[2]->heading = "Sequence";
            $this->configArray[2]->renderedas = "Text";
            $this->configArray[2]->foreignkeytable = "";
            $this->configArray[2]->foreignkey = "";
            $this->configArray[2]->foreignkeyfield = "";
            $this->configArray[2]->defaultvalue = 0;

            $this->configArray[3]->width = 80;
            $this->configArray[3]->field = "masterid";
            $this->configArray[3]->heading = "Table Id";
            $this->configArray[3]->renderedas = "Text";
            $this->configArray[3]->foreignkeytable = "";
            $this->configArray[3]->foreignkey = "";
            $this->configArray[3]->foreignkeyfield = "";
            $this->configArray[3]->defaultvalue = 0;

            $this->configArray[4]->width = 300;
            $this->configArray[4]->field = "WorkflowApprover";
            $this->configArray[4]->heading = "Workflow Approver";
            $this->configArray[4]->renderedas = "Combo";
            $this->configArray[4]->foreignkeytable = "users";
            $this->configArray[4]->foreignkey = "id";
            $this->configArray[4]->foreignkeyfield = "Email";
            $this->configArray[4]->defaultvalue = "";


            return $this->configArray;

            }


//SELECT id,EnableLDAP,ldaphost,ldapdn,ldapusergroup,ldapmanagergroup,ldapuserdomain,
//          emailhost,emailport,emailusername,emailpassword,NotificationTime,EscalationTime FROM Setup;


          if($configname == 'Setup'){

              $this->configArray[0]->tablename = "AdvWorkflows";

              $this->configArray[0]->startstring = "{ store: masterStore, selModel: 'cellmodel', listeners: {itemclick: function() {ProcessChildTab();}},columns:[ ";

              $this->configArray[0]->endstring =
                  "],
                     width: 910,
                     height: 350,
                     x: 10,
                     y: 10,
                     title: '" . $configname . "', " . "
                     frame: true,
                     tbar: [{text: 'Add',    disabled: " . $masteradd . ", handler : function() {processInsert(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Save',   disabled: " . $mastersave . ", handler : function() {processUpdate(BSSMasterConfigName,mastergrid,masterStore);}},
                            {text: 'Delete', disabled: " . $masterdelete . ", handler : function() {processDelete(BSSMasterConfigName,mastergrid,masterStore);}}
                     ],
                     plugins: [cellEditing1]}";

              $this->configArray[1]->width = 30;
              $this->configArray[1]->field = "ldaphost";
              $this->configArray[1]->heading = "ldaphost";
              $this->configArray[1]->renderedas = "Text";
              $this->configArray[1]->foreignkeytable = "";
              $this->configArray[1]->foreignkey = "";
              $this->configArray[1]->foreignkeyfield = "";
              $this->configArray[1]->defaultvalue = 0;

              $this->configArray[2]->width = 30;
              $this->configArray[2]->field = "ldapdn";
              $this->configArray[2]->heading = "ldapdn";
              $this->configArray[2]->renderedas = "Text";
              $this->configArray[2]->foreignkeytable = "";
              $this->configArray[2]->foreignkey = "";
              $this->configArray[2]->foreignkeyfield = "";
              $this->configArray[2]->defaultvalue = 0;

              $this->configArray[3]->width = 30;
              $this->configArray[3]->field = "ldapusergroup";
              $this->configArray[3]->heading = "ldapusergroup";
              $this->configArray[3]->renderedas = "Text";
              $this->configArray[3]->foreignkeytable = "";
              $this->configArray[3]->foreignkey = "";
              $this->configArray[3]->foreignkeyfield = "";
              $this->configArray[3]->defaultvalue = 0;

              $this->configArray[4]->width = 100;
              $this->configArray[4]->field = "ldapmanagergroup";
              $this->configArray[4]->heading = "ldapmanagergroup";
              $this->configArray[4]->renderedas = "Text";
              $this->configArray[4]->foreignkeytable = "";
              $this->configArray[4]->foreignkey = "";
              $this->configArray[4]->foreignkeyfield = "";
              $this->configArray[4]->defaultvalue = "";

              $this->configArray[5]->width = 200;
              $this->configArray[5]->field = "ldapuserdomain";
              $this->configArray[5]->heading = "ldapuserdomain";
              $this->configArray[5]->renderedas = "Text";
              $this->configArray[5]->foreignkeytable = "";
              $this->configArray[5]->foreignkey = "";
              $this->configArray[5]->foreignkeyfield = "";
              $this->configArray[5]->defaultvalue = "";

              $this->configArray[6]->width = 50;
              $this->configArray[6]->field = "emailhost";
              $this->configArray[6]->heading = "emailhost";
              $this->configArray[6]->renderedas = "Text";
              $this->configArray[6]->foreignkeytable = "";
              $this->configArray[6]->foreignkey = "";
              $this->configArray[6]->foreignkeyfield = "";
              $this->configArray[6]->defaultvalue = "";

              $this->configArray[7]->width = 50;
              $this->configArray[7]->field = "emailport";
              $this->configArray[7]->heading = "emailport";
              $this->configArray[7]->renderedas = "Text";
              $this->configArray[7]->foreignkeytable = "";
              $this->configArray[7]->foreignkey = "";
              $this->configArray[7]->foreignkeyfield = "";
              $this->configArray[7]->defaultvalue = "";

              $this->configArray[8]->width = 50;
              $this->configArray[8]->field = "emailusername";
              $this->configArray[8]->heading = "emailusername";
              $this->configArray[8]->renderedas = "Text";
              $this->configArray[8]->foreignkeytable = "";
              $this->configArray[8]->foreignkey = "";
              $this->configArray[8]->foreignkeyfield = "";
              $this->configArray[8]->defaultvalue = "";

              $this->configArray[9]->width = 50;
              $this->configArray[9]->field = "emailpassword";
              $this->configArray[9]->heading = "emailpassword";
              $this->configArray[9]->renderedas = "Text";
              $this->configArray[9]->foreignkeytable = "";
              $this->configArray[9]->foreignkey = "";
              $this->configArray[9]->foreignkeyfield = "";
              $this->configArray[9]->defaultvalue = "";

              $this->configArray[10]->width = 50;
              $this->configArray[10]->field = "NotificationTime";
              $this->configArray[10]->heading = "NotificationTime";
              $this->configArray[10]->renderedas = "Text";
              $this->configArray[10]->foreignkeytable = "";
              $this->configArray[10]->foreignkey = "";
              $this->configArray[10]->foreignkeyfield = "";
              $this->configArray[10]->defaultvalue = "";

              $this->configArray[11]->width = 50;
              $this->configArray[11]->field = "EscalationTime";
              $this->configArray[11]->heading = "EscalationTime";
              $this->configArray[11]->renderedas = "Text";
              $this->configArray[11]->foreignkeytable = "";
              $this->configArray[11]->foreignkey = "";
              $this->configArray[11]->foreignkeyfield = "";
              $this->configArray[11]->defaultvalue = "";

              return $this->configArray;

          }




          if($configname == 'WorkflowNotifications'){

              $this->configArray[0]->tablename = "WorkflowNotifications";

              $this->configArray[0]->startstring = "{ store: notificationStore, selModel: 'cellmodel', columns:[ ";
              $this->configArray[0]->endstring =
                  "],
                         width: 960,
                         height: 250,
                         x: 10,
                         y: 10,
                         title: '" . $configname . "', " . "
                         frame: true,
                         tbar: [{text: 'Add',    disabled: " . $childadd . ", handler : function() {processInsert(BSSWorkflowNotificationConfigName,notificationgrid,notificationStore);}},
                                {text: 'Save',   disabled: " . $childsave . ", handler : function() {processUpdate(BSSWorkflowNotificationConfigName,notificationgrid,notificationStore);}},
                                {text: 'Delete', disabled: " . $childdelete . ", handler : function() {processDelete(BSSWorkflowNotificationConfigName,notificationgrid,notificationStore);}}
                         ],
                         plugins: [cellEditing2]}";

              $this->configArray[1]->width = 60;
              $this->configArray[1]->field = "id";
              $this->configArray[1]->heading = "Id";
              $this->configArray[1]->renderedas = "Text";
              $this->configArray[1]->foreignkeytable = "";
              $this->configArray[1]->foreignkey = "";
              $this->configArray[1]->foreignkeyfield = "";
              $this->configArray[1]->defaultvalue = 0;

              $this->configArray[2]->width = 80;
              $this->configArray[2]->field = "sequence";
              $this->configArray[2]->heading = "Sequence";
              $this->configArray[2]->renderedas = "Text";
              $this->configArray[2]->foreignkeytable = "";
              $this->configArray[2]->foreignkey = "";
              $this->configArray[2]->foreignkeyfield = "";
              $this->configArray[2]->defaultvalue = 0;

              $this->configArray[3]->width = 80;
              $this->configArray[3]->field = "masterid";
              $this->configArray[3]->heading = "Table Id";
              $this->configArray[3]->renderedas = "Text";
              $this->configArray[3]->foreignkeytable = "";
              $this->configArray[3]->foreignkey = "";
              $this->configArray[3]->foreignkeyfield = "";
              $this->configArray[3]->defaultvalue = 0;

              $this->configArray[4]->width = 300;
              $this->configArray[4]->field = "WorkflowStep";
              $this->configArray[4]->heading = "Workflow Step";
              $this->configArray[4]->renderedas = "Combo";
              $this->configArray[4]->foreignkeytable = "WorkflowStatuses";
              $this->configArray[4]->foreignkey = "id";
              $this->configArray[4]->foreignkeyfield = "WorkflowStatus";
              $this->configArray[4]->defaultvalue = "";

              $this->configArray[5]->width = 300;
              $this->configArray[5]->field = "WorkflowNotifications";
              $this->configArray[5]->heading = "Workflow Notification";
              $this->configArray[5]->renderedas = "Combo";
              $this->configArray[5]->foreignkeytable = "Notifications";
              $this->configArray[5]->foreignkey = "id";
              $this->configArray[5]->foreignkeyfield = "NotificationName";
              $this->configArray[5]->defaultvalue = "";


              return $this->configArray;

          }



          if($configname == 'WorkflowActions'){

              $this->configArray[0]->tablename = "WorkflowActions";

              $this->configArray[0]->startstring = "{ store: actionStore, selModel: 'cellmodel', columns:[ ";
              $this->configArray[0]->endstring =
                  "],
                         width: 960,
                         height: 250,
                         x: 10,
                         y: 10,
                         title: '" . $configname . "', " . "
                         frame: true,
                         tbar: [{text: 'Add',    disabled: " . $childadd . ", handler : function() {processInsert(BSSWorkflowActionConfigName,actiongrid,actionStore);}},
                                {text: 'Save',   disabled: " . $childsave . ", handler : function() {processUpdate(BSSWorkflowActionConfigName,actiongrid,actionStore);}},
                                {text: 'Delete', disabled: " . $childdelete . ", handler : function() {processDelete(BSSWorkflowActionConfigName,actiongrid,actionStore);}}
                         ],
                         plugins: [cellEditing3]}";

              $this->configArray[1]->width = 60;
              $this->configArray[1]->field = "id";
              $this->configArray[1]->heading = "Id";
              $this->configArray[1]->renderedas = "Text";
              $this->configArray[1]->foreignkeytable = "";
              $this->configArray[1]->foreignkey = "";
              $this->configArray[1]->foreignkeyfield = "";
              $this->configArray[1]->defaultvalue = 0;

              $this->configArray[2]->width = 80;
              $this->configArray[2]->field = "sequence";
              $this->configArray[2]->heading = "Sequence";
              $this->configArray[2]->renderedas = "Text";
              $this->configArray[2]->foreignkeytable = "";
              $this->configArray[2]->foreignkey = "";
              $this->configArray[2]->foreignkeyfield = "";
              $this->configArray[2]->defaultvalue = 0;

              $this->configArray[3]->width = 80;
              $this->configArray[3]->field = "masterid";
              $this->configArray[3]->heading = "Table Id";
              $this->configArray[3]->renderedas = "Text";
              $this->configArray[3]->foreignkeytable = "";
              $this->configArray[3]->foreignkey = "";
              $this->configArray[3]->foreignkeyfield = "";
              $this->configArray[3]->defaultvalue = 0;

              $this->configArray[4]->width = 300;
              $this->configArray[4]->field = "WorkflowStep";
              $this->configArray[4]->heading = "Workflow Step";
              $this->configArray[4]->renderedas = "Combo";
              $this->configArray[4]->foreignkeytable = "WorkflowStatuses";
              $this->configArray[4]->foreignkey = "id";
              $this->configArray[4]->foreignkeyfield = "WorkflowStatus";
              $this->configArray[4]->defaultvalue = "";

              $this->configArray[5]->width = 300;
              $this->configArray[5]->field = "WorkflowActions";
              $this->configArray[5]->heading = "Workflow Actions";
              $this->configArray[5]->renderedas = "Combo";
              $this->configArray[5]->foreignkeytable = "Actions";
              $this->configArray[5]->foreignkey = "id";
              $this->configArray[5]->foreignkeyfield = "action";
              $this->configArray[5]->defaultvalue = "";

              return $this->configArray;

          }






          if($configname <> 'Tables1' AND $configname <> 'TableColumns' AND $configname <> 'History'){
          mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
          mysql_select_db(DB) or die(mysql_error());




              $this->configArray[1]->width = 50;
              $this->configArray[1]->field = "id";
              $this->configArray[1]->heading = "Id";
              $this->configArray[1]->renderedas = "Text";
              $this->configArray[1]->foreignkeytable = "";
              $this->configArray[1]->foreignkey = "";
              $this->configArray[1]->foreignkeyfield = "";
              $this->configArray[1]->defaultvalue = 0;

              $this->configArray[2]->width = 60;
              $this->configArray[2]->field = "masterid";
              $this->configArray[2]->heading = "Table Id";
              $this->configArray[2]->renderedas = "Text";
              $this->configArray[2]->foreignkeytable = "";
              $this->configArray[2]->foreignkey = "";
              $this->configArray[2]->foreignkeyfield = "";
              $this->configArray[2]->defaultvalue = 0;


              $this->configArray[3]->width = 0;
              $this->configArray[3]->field = "sequence";
              $this->configArray[3]->heading = "Sequence";
              $this->configArray[3]->renderedas = "Text";
              $this->configArray[3]->foreignkeytable = "";
              $this->configArray[3]->foreignkey = "";
              $this->configArray[3]->foreignkeyfield = "";
              $this->configArray[3]->defaultvalue = 0;


              $this->configArray[0]->tablename = $configname;

                    $result = mysql_query("SELECT format,fieldname,heading,RenderedAs.RenderedAs,IFNULL(ft.TableName,'') as foreignkeytable,foreignkey,foreignkeyfield, defaultvalue,width FROM TableColumns JOIN Tables ON Tables.id = TableColumns.masterid AND Tables.TableName = '" . $configname . "' JOIN RenderedAs ON RenderedAs.id = TableColumns.renderedas LEFT JOIN Tables ft ON ft.id = TableColumns.foreignkeytable ORDER BY TableColumns.sequence");   // where tablename = $configname

                    $Y = 3;
                    while ($row = mysql_fetch_assoc($result)){
                       $Y = $Y + 1;
                       $this->configArray[$Y]->width = $row["width"];
                       $this->configArray[$Y]->field = $row["fieldname"];
                       $this->configArray[$Y]->heading = $row['heading'];
                       $this->configArray[$Y]->renderedas = $row['RenderedAs'];
                       $this->configArray[$Y]->foreignkeytable = $row['foreignkeytable'];
                       $this->configArray[$Y]->foreignkey = $row['foreignkey'];
                       $this->configArray[$Y]->foreignkeyfield = $row['foreignkeyfield'];
                       $this->configArray[$Y]->defaultvalue = $row['defaultvalue'];
                    }

                    mysql_free_result($result);

         return $this->configArray;


      }

      }

}
?>
