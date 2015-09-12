<?php
require_once('config.php');

$configArray[0]->startstring = "{ store: bssStore, selModel: 'cellmodel', columns:[ ";
$configArray[0]->endstring = "], width: 800, renderTo:'editor-grid', height: 300, plugins: [cellEditing]}";

$configArray[1]->width = 50;
$configArray[1]->field = "id";
$configArray[1]->heading = "Id";
$configArray[1]->renderedas = "Text";
$configArray[1]->foreignkeytable = "";
$configArray[1]->foreignkey = "";
$configArray[1]->foreignkeyfield = "";
//$commonColumn1->updatable = false;

$configArray[2]->width = 200;
$configArray[2]->field = "phone_type";
$configArray[2]->heading = "Phone Type";
$configArray[2]->renderedas = "Combo";
$configArray[2]->foreignkeytable = "";
$configArray[2]->foreignkey = "";
$configArray[2]->foreignkeyfield = "";
//$commonColumn2->updatable = true;

$configArray[3]->width = 200;
$configArray[3]->field = "phone_date";
$configArray[3]->heading = "Phone Date";
$configArray[3]->renderedas = "Date";
$configArray[3]->foreignkeytable = "";
$configArray[3]->foreignkey = "";
$configArray[3]->foreignkeyfield = "";
//$commonColumn2->updatable = true;

$configArray[4]->width = 100;
$configArray[4]->field = "phone_on";
$configArray[4]->heading = "Phone on";
$configArray[4]->renderedas = "CheckBox";
$configArray[4]->foreignkeytable = "";
$configArray[4]->foreignkey = "";
$configArray[4]->foreignkeyfield = "";
//$commonColumn2->updatable = true;



$startstring = $configArray[0]->startstring;
$endstring = $configArray[0]->endstring;
$colstring = "";

    for ($i = 1; $i <= count($configArray)-1; $i++) {

                //Text Box code
                If($configArray[$i]->renderedas === "Text"){
                    $id = "id:'" . $configArray[$i]->field  . "'";
                    $header = "header:'" . $configArray[$i]->heading . "'";
                    $dataIndex = "dataIndex:'" . $configArray[$i]->field  . "'";
                    $flex = "flex:1";
                    $editor = "editor:{ allowBlank:false }";

                    $colstring = $colstring . "{ " . $id . ", " . $header  . ", " . $dataIndex  . ", " . $flex  . ", " . $editor . " },";

                }


       // store: [[1,'Home'],[2,'Mobile'],[3,'Work']],

        //Combo Box code
        If($configArray[$i]->renderedas === "Combo"){
            $id = "id:'" . $configArray[$i]->field  . "'";
            $header = "header:'" . $configArray[$i]->heading . "'";
            $dataIndex = "dataIndex:'" . $configArray[$i]->field  . "'"; // . ",fields:['id','value'],valueField:'id',displayField:'value',store: [[1,'Home'],[2,'Mobile'],[3,'Work']]";
            $flex = "flex:1";
            $editor = "editor: {
                                    xtype: 'combobox',
                                    typeAhead: true,
                                    selectOnTab: true,
                                    triggerAction: 'all',
                                    fields:['id','value'],
                                    store: [
                                        [1,'Home'],
                                        [2,'Mobile'],
                                        [3,'Work']
                                    ],
                                    valueField:'id',
                                    displayField:'value',
                                    lazyRender: true,
                                    listClass: 'x-combo-list-small'}";

            //$renderer = "renderer: function(value) { return 'TEST'}";

            $renderer = "renderer: function(val) {


            // create the data store
            var CodesStore = Ext.create('Ext.data.Store', {
                fields: [
                   {name: 'id'},
                   {name: 'value'}
                ],
                data: [
                    { id: 1, value: 'Home'},
                    { id: 2, value: 'Mobile'},
                    { id: 3, value: 'Work'}

                ]
            });

            var matching = CodesStore.queryBy(
                              function(rec){
                              return rec.data.id == val;
                              });

            return (matching.items[0]) ? matching.items[0].data.value : ''}";

            $colstring = $colstring . "{ " . $header  . ", " . $dataIndex  . ", " . $editor . "," . $renderer . " },";

        }


  //      ,fields:['id','value'],valueField:'id',displayField:'value'"


            //Combo Box code

                    //header: 'Light',
                    //dataIndex: 'light',
                    //width: 130,
                    //editor: {
                    //    xtype: 'combobox',
                    //    typeAhead: true,
                    //    triggerAction: 'all',
                    //    selectOnTab: true,
                    //    store: [
                    //        ['Shade','Shade'],
                    //        ['Mostly Shady','Mostly Shady'],
                    //        ['Sun or Shade','Sun or Shade'],
                    //        ['Mostly Sunny','Mostly Sunny'],
                    //        ['Sunny','Sunny']
                    //    ],
                    //    lazyRender: true,
                    //    listClass: 'x-combo-list-small'



//        { header:'Phone Type', dataIndex:'phone_type',
        //editor: { xtype: 'combobox',
         //         typeAhead: true, triggerAction: 'all', selectOnTab: true,
        //store: [ ['Shade','Shade'], ['Mostly Shady','Mostly Shady'], ['Sun or Shade','Sun or Shade'],
        //['Mostly Sunny','Mostly Sunny'], ['Sunny','Sunny'] ], lazyRender: true, listClass: 'x-combo-list-small' }


            //Date Code

                //header: 'Available',
                //dataIndex: 'availDate',
                //width: 95,
                //renderer: formatDate,
                //editor: {xtype: 'datefield',format: 'm/d/y',minValue: '01/01/06',disabledDays: [0, 6],disabledDaysText: 'Not available on the weekends' }

            If($configArray[$i]->renderedas === "Date"){
                $id = "id:'" . $configArray[$i]->field  . "'";
                $header = "header:'" . $configArray[$i]->heading . "'," . "renderer: formatDate";
                $dataIndex = "dataIndex:'" . $configArray[$i]->field  . "'";
                $flex = "flex:1";
                $editor = "editor:{xtype: 'datefield',format: 'm/d/y',minValue: '01/01/06',disabledDays: [0, 6],disabledDaysText: 'Not available on the weekends' }";

                $colstring = $colstring . "{ " . $id . ", " . $header  . ", " . $dataIndex  . ", " . $flex  . ", " . $editor . " },";

            }

            //CheckBox code

            //xtype: 'checkcolumn',
            //header: 'Indoor?',
            //dataIndex: 'indoor',
            //width: 55

        If($configArray[$i]->renderedas === "CheckBox"){
            $id = "id:'" . $configArray[$i]->field  . "'";
            $header = "header:'" . $configArray[$i]->heading . "'";
            $dataIndex = "dataIndex:'" . $configArray[$i]->field  . "'";
            //$flex = "flex:1";
            $editor = "editor: {xtype: 'checkbox', cls: 'x-grid-checkheader-editor'}";
            $xtype = "xtype: 'checkcolumn'";

            $width = "width: ". $configArray[$i]->width;

            $colstring = $colstring . "{ " . $id . ", " . $xtype . ", " . $header  . ", " . $dataIndex  . ", " . $width  . ", " . $editor . " },";

        }



    }


$colstring = substr($colstring,0,strlen($colstring)-1);

$configstring = $startstring . $colstring  . $endstring;

echo $configstring;




?>