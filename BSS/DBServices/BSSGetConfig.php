<?php
require_once('config.php');
include 'BSSSQLOperation.php';
include 'BSSSQLConfig.php';



$Con = new SQLConfig();
$arr = $Con->getName($_GET['BSSConfigName'],$_GET['BSSConfigMode'],$_GET['BSSUserId']);
$startstring = '';
$configname = $_GET['BSSConfigName'];
$startstring = $arr[0]->startstring;
$endstring = $arr[0]->endstring;
$colstring = "";



    for ($i = 1; $i <= count($arr)-1; $i++) {


        //Text Box code
        If(strtoupper($arr[$i]->renderedas) === "TEXT"){
            $id = "id:'" . $configname . "-" . $arr[$i]->field  . "'";
            $header = "header:'" . $arr[$i]->heading . "'";
            $dataIndex = "dataIndex:'" . $arr[$i]->field  . "'";
            //$width = "width: 100";
            $width = "width: ". $arr[$i]->width;
            $flex = "disabled: false";
            $editor = "editor:{ allowBlank:false }";

            $filter = "filterable: true";

            $colstring = $colstring . "{ " . $id . ", " . $header  . ", " . $dataIndex  . ", " . $width  . ", " . $flex  . ", " . $filter . ", " . $editor . " },";

        }


        //Combo Box code
        If(strtoupper($arr[$i]->renderedas) === "COMBO"){

            
            //get the combo box store
            mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
            mysql_select_db(DB) or die(mysql_error());
            $SQLCOMBOSTRING = "SELECT " . $arr[$i]->foreignkey . ", " .  CHR(96) .$arr[$i]->foreignkeyfield . CHR(96) ." FROM " . CHR(96) . $arr[$i]->foreignkeytable . CHR(96);
          //  echo $SQLCOMBOSTRING;
            $result = mysql_query($SQLCOMBOSTRING);
            //$result = mysql_query("SELECT id, phone_type FROM phone_type");
            
            $BSSCBSTORE = "";
            $BSSCBDATA = "";
            
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {

                    $BSSCBSTORE = $BSSCBSTORE . '[' . $row[0] . ", '" . $row[1] . "'],";

                    $BSSCBDATA = $BSSCBDATA . '{ id:' . $row[0] . ", value: '" . $row[1] . "'},";

            }            
            
            $BSSCBSTORE = substr($BSSCBSTORE,0,strlen($BSSCBSTORE)-1);
            $BSSCBDATA = substr($BSSCBDATA,0,strlen($BSSCBDATA)-1);

            
            mysql_free_result($result);
            
            $id = "id:'" . $arr[$i]->field  . "'";
            $header = "header:'" . $arr[$i]->heading . "'";
            $dataIndex = "dataIndex:'" . $arr[$i]->field  . "'"; // . ",fields:['id','value'],valueField:'id',displayField:'value',store: [[1,'Home'],[2,'Mobile'],[3,'Work']]";
            $flex = "flex:1";
            $width = "width: ". $arr[$i]->width;
            $editor = "editor: {
                                    xtype: 'combobox',
                                    typeAhead: true,
                                    selectOnTab: true,
                                    triggerAction: 'all',
                                    fields:['id','value'],
                                    store: [" . $BSSCBSTORE .
                                     //   [1,'Home'],
                                       // [2,'Mobile'],
                                       // [3,'Work']
                                    "],
                                    valueField:'id',
                                    displayField:'value',
                                    multiSelect: false,
                                    lazyRender: false,
                                    listClass: 'x-combo-list-small'}";
         
            
            $renderer = "renderer: function(val) {
            var CodesStore = Ext.create('Ext.data.Store', {
                fields: [
                   {name: 'id'},
                   {name: 'value'}
                ],
                data: [ " . $BSSCBDATA .
                   // { id: 1, value: 'Home'},
                   // { id: 2, value: 'Mobile'},
                   // { id: 3, value: 'Work'}
                "]
            });

            var matching = CodesStore.queryBy(
                              function(rec){
                              return rec.data.id == val;
                              });

            return (matching.items[0]) ? matching.items[0].data.value : ''}";

            $colstring = $colstring . "{ " . $header  . ", " . $dataIndex  . ", " . $width . ", " . $editor . "," . $renderer . " },";

        }


        If(strtoupper($arr[$i]->renderedas) === "DATE"){
            $id = "id:'" . $arr[$i]->field  . "'";
            $header = "header:'" . $arr[$i]->heading . "'," . "renderer: formatDate";
            $dataIndex = "dataIndex:'" . $arr[$i]->field  . "'";
            $flex = "flex:1";
            $editor = "editor:{xtype: 'datefield',format: 'Y-m-d H:i:s',minValue: '01/01/06',disabledDays: [0, 6],disabledDaysText: 'Not available on the weekends' }";

            $colstring = $colstring . "{ " . $id . ", " . $header  . ", " . $dataIndex  . ", " . $flex  . ", " . $editor . " },";

        }

            //CheckBox code

        If(strtoupper($arr[$i]->renderedas) === "CHECKBOX"){
            $id = "id:'" . $arr[$i]->field  . "'";
            $header = "header:'" . $arr[$i]->heading . "'";
            $dataIndex = "dataIndex:'" . $arr[$i]->field  . "'";
            //$flex = "flex:1";
            $editor = "editor: {xtype: 'checkbox', cls: 'x-grid-checkheader-editor'}";
            $xtype = "xtype: 'checkcolumn'";
            $width = "width: ". $arr[$i]->width;

            $colstring = $colstring . "{ " . $id . ", " . $xtype . ", " . $header  . ", " . $dataIndex  . ", " . $width  . ", " . $editor . " },";

        }


    }



$colstring = substr($colstring,0,strlen($colstring)-1);


$configstring = $startstring . $colstring  . $endstring;

echo $configstring;


?>