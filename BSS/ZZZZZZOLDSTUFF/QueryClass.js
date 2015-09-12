/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/

var mastergrid;
var childgrid;
var BSSMasterConfigName = "Queries";
var BSSChildConfigName = "QueryDetail";
var fieldStore = null;
var bssFieldNameData;
var bssNewFieldNameData;
var BSSCREATEMASTER_FLAG = false
var BSSREADMASTER_FLAG = false
var BSSUPDATEMASTER_FLAG = false
var BSSDELETEMASTER_FLAG = false
var BSSCREATECHILD_FLAG = false
var BSSREADCHILD_FLAG = false
var BSSUPDATECHILD_FLAG = false
var BSSDELETECHILD_FLAG = false


// create the data store
    var masterStore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'QueryName', type: 'string'},
            {name: 'QueryDescription', type: 'string'},
            {name: 'TableId', type: 'string'},
            {name: 'EnterpriseObjectId', type: 'string'},
            {name: 'QueryScope', type: 'string'},
            {name: 'QueryUser', type: 'string'}
        ],
        data:
                   [['1','','','','','','','']]
         });



    var childStore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'LeftParen', type: 'string'},
            {name: 'FieldName', type: 'string'},
            {name: 'OperatorVal', type: 'string'},
            {name: 'ValueText', type: 'string'},
            {name: 'AndOr', type: 'string'},
            {name: 'RightParen', type: 'string'}
        ],
        data:
                   [['1','','','','','','','','']]
    });


bssFieldNameData = [ { id:1, value: 'AGLOBAL'},{ id:2, value: 'AUSER'}];

fieldStore = Ext.create('Ext.data.Store', {
                 fields: [{name: 'id'}, {name: 'value'} ],
                 data: bssFieldNameData
                 }
                 );



/*
{ header:'Query Scope', dataIndex:'QueryScope', width: 100, editor:
{ xtype: 'combobox',
  typeAhead: true,
  selectOnTab: true,
  triggerAction: 'all',
  fields:['id','value'],
store: [[1, 'GLOBAL'],[2, 'USER']],
valueField:'id',
displayField:'value',
multiSelect: false,
lazyRender: false,
listClass: 'x-combo-list-small'},
renderer: function(val) { var CodesStore = Ext.create('Ext.data.Store', { fields: [ {name: 'id'}, {name: 'value'} ], data: [ { id:1, value: 'GLOBAL'},{ id:2, value: 'USER'}] }); var matching = CodesStore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''} }


*/

/*
bssFieldNameData = [ { id:1, value: 'AGLOBAL'},{ id:2, value: 'AUSER'}];

fieldStore = Ext.create('Ext.data.Store', {
                 fields: [{name: 'id'}, {name: 'value'} ],
                 data: bssFieldNameData
                 }
                 );

*/


Ext.define('QueryClass', {
    name: 'Unknown',

    constructor: function(name) {

        if (name) {
            this.name = name;
       }
        //return this;


        try{
            var xmlHttp = null;
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetLoginRights.php", false );
            xmlHttp.send( null );
      //  alert(xmlHttp.responseText);
        }catch(e)
            {document.write("<p>" + e.message + "</p>");
        }

        var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 1
        });

        var cellEditing1 = Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 1
        });

        var rowEditing = Ext.create('Ext.grid.plugin.RowEditing', {
            clicksToMoveEditor: 1,
            autoCancel: false
        });

        var rowEditing1 = Ext.create('Ext.grid.plugin.RowEditing', {
            clicksToMoveEditor: 1,
            autoCancel: false
        });

    //Get the Query Grid Configuration
try{
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSGetConfig.php?BSSConfigName=Queries&BSSConfigMode=MASTER", false );
    xmlHttp.send( null );
   // document.write("<p>"+ xmlHttp.responseText + "</p>");

    mastergrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));

}catch(e)
     {document.write("<p>" + 'Master Grid Config Error: ' +e.message + "</p>");
 }


try{
     //Get the Enterprise Object data
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "Queries" + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );
    xmlHttp.send( null );
// document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
    var newdata = eval('[' + xmlHttp.responseText + ']');
    masterStore.loadData(newdata,false);
}catch(e)
    {alert("ERROR: " + e.message);
}


    /*

            {name: 'id', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'LeftParen', type: 'string'},
            {name: 'FieldName', type: 'string'},
            {name: 'OperatorVal', type: 'string'},
            {name: 'ValueText', type: 'string'},
            {name: 'AndOr', type: 'string'},
            {name: 'RightParen', type: 'string'}

        */
            // create the grid and specify what field you want
            // to use for the editor at each header.
            childgrid = Ext.create('Ext.grid.Panel', {
            store: childStore,
            selModel: 'cellmodel',
            columns: [{
                id: 'id',
                header: 'Id',
                width: 20,
                disabled: true,
                dataIndex: 'id',
                editor: {
                    allowBlank: false
                }
                },

                {
                id: 'sequence',
                header: 'Sequence',
                width: 100,
                dataIndex: 'sequence',
                editor: {
                    allowBlank: false
                }
                },

                {
                id: 'masterid',
                header: 'Master Id',
                width: 100,
                dataIndex: 'masterid',
                editor: {
                    allowBlank: false
                }
                },

                {
                header: 'Left Parentheses',
                dataIndex: 'LeftParen',
                width: 130,
                editor: {
                    xtype: 'combobox',
                    typeAhead: true,
                    triggerAction: 'all',
                    selectOnTab: true,
                    store: [
                        ['','.'],
                        ['(','(']
                    ],
                    lazyRender: true,
                    listClass: 'x-combo-list-small'
                }
                },


               { header:'FieldName', dataIndex:'FieldName', width: 100,
                editor:
               { xtype: 'combobox',
                 typeAhead: true,
                 selectOnTab: true,
                 triggerAction: 'all',
                 fields:['id','value'],
               store: fieldStore, //[[1, 'GLOBAL'],[2, 'USER']],
               valueField:'id',
               displayField:'value',
               multiSelect: false,
               queryMode: 'local',
               lazyRender: true,
               listClass: 'x-combo-list-small'},
               renderer: function(val) {var matching =  fieldStore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''} },

         //       renderer: function(val) { var CodesStore = Ext.create('Ext.data.Store', { fields: [ {name: 'id'}, {name: 'value'} ], data: bssFieldNameData }); var matching = CodesStore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''} },

                {
                header: 'Operator',
                dataIndex: 'OperatorVal',
                width: 130,
                editor: {
                xtype: 'combobox',
                typeAhead: true,
                triggerAction: 'all',
                selectOnTab: true,
                store: [
                    [' = ','Equal To'],
                    [' >= ','Greater Than'],
                    [' <= ','Less Than'],
                    [' <> ','Not Equal To'],
                    [' is null ','Is Null'],
                    [' is  not null ','Is Not Null']
                ],
                lazyRender: true,
                listClass: 'x-combo-list-small'
                }
                },

                {  //ADD COMBO STUFF
                id: 'ValueText',
                header: 'Value',
                width: 100,
                dataIndex: 'ValueText',
                editor: {
                    allowBlank: false
                }
                },

                {
                header: 'And/Or',
                dataIndex: 'AndOr',
                width: 130,
                editor: {
                    xtype: 'combobox',
                    typeAhead: true,
                    triggerAction: 'all',
                    selectOnTab: true,
                    store: [
                        ['','.'],
                        ['AND','AND'],
                        ['OR','OR']
                    ],
                    lazyRender: true,
                    listClass: 'x-combo-list-small'
                }
                },

                {
                header: 'Right Parentheses',
                dataIndex: 'RightParen',
                width: 130,
                editor: {
                    xtype: 'combobox',
                    typeAhead: true,
                    triggerAction: 'all',
                    selectOnTab: true,
                    store: [
                        ['','.'],
                        [')',')']
                    ],
                    lazyRender: true,
                    listClass: 'x-combo-list-small'
                }
            }],
            width: 1100,
            height: 360,
            x: 20,
            y: 400,
            title: 'Query Definition',
            frame: true,
            tbar: [{text: 'Add',    handler : function() {processInsert(BSSChildConfigName,childgrid,childStore);}},
                   {text: 'Save',   handler : function() {processUpdate(BSSChildConfigName,childgrid,childStore);}},
                   {text: 'Delete', handler : function() {processDelete(BSSChildConfigName,childgrid,childStore);}}
            ],
            plugins: [cellEditing]
        });

        //tablestore.load();




        btnProcessTable = Ext.create('Ext.Button', {
            id: 'testquery',
            x: 960,
            y: 120,
            width: 200,
            text: 'Test Query',
            handler: function() {
                ProcessTable();
            }
        });


        absolute1 = Ext.create('Ext.window.Window', {
           title: 'Query Maintenance',
           x:50,
           y:50,
           width: 1200,
           height: 800,
           layout:'absolute',
           defaults: {
           bodyStyle: 'padding:10px'
           },
           items: [mastergrid, childgrid, btnProcessTable]
           });

    absolute1.show();

      //  mastergrid.setSelection(1);


    }

});

function processInsert(BSSConfigName, BSSGrid, BSSStore)
{
    //  Get default data from config array


    try{
    idval = 0;
    var sm = mastergrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(sm.getCount() > 0){
        var fieldname = "id";
        var idval = selrecords[0].get('id')
        alert(idval);
    }

 //   return;

    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSPerformInsert.php?BSSConfigName=" + BSSConfigName+ "&masterid=" + idval, false );
    xmlHttp.send(null);

       // document.write("<p>"+ xmlHttp.responseText + "</p>");

    newdata = eval('[' + xmlHttp.responseText + ']');

    BSSStore.add(newdata);
    }catch(e)
        {document.write("<p>" + e.message + "</p>");
    }

}



function ProcessTable()
{

  //"&id=" + delrecords[0].get('id'),

    try{

        var sm = mastergrid.getSelectionModel();
            var selrecords = sm.getSelection();
            if(selrecords == ''){return;}
            var fieldname = "id";

            tableval = selrecords[0].get('TableName');
           // alert(tableval);


        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSProcessTable.php?BSSTableName=" + tableval, false); // + "&id=" + delrecords[0].get('id'), false);
        xmlHttp.send(null);

        alert(xmlHttp.responseText);

    }catch(e)
        {document.write("<p>" + e.message + "</p>");
    }


}


function processDelete(BSSConfigName, BSSGrid, BSSStore)
{


      var sm = BSSGrid.getSelectionModel();
      BSSStore.remove(sm.getSelection());

        if (BSSStore.getCount() > 0) {
            sm.select(0);
        }

      var delrecords = BSSStore.getRemovedRecords();

      var fieldname = "id";

    //"&id=" + delrecords[0].get('id'),

    try{
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSPerformDelete.php?BSSConfigName=" + BSSConfigName + "&id=" + delrecords[0].get('id'), false);
        xmlHttp.send(null);

        BSSStore.removed = [];
       // document.write("<p>"+ xmlHttp.responseText + "</p>");

    }catch(e)
        {document.write("<p>" + e.message + "</p>");
    }


}


function ProcessChildTab()
{



        try{


                var sm = mastergrid.getSelectionModel();
                // if (sm.getSelection().getCount() = 0) {
                //     return;
                // }

                var selrecords = sm.getSelection();
                var fieldname = "id";
                //alert(selrecords[0].get('TableId'));

                 //Get the data
                xmlHttp = new XMLHttpRequest();
                xmlHttp.open( "GET", "BSSGetComboStore.php?BSSSQLString=SELECT id, fieldname AS value FROM TableColumns WHERE masterid = " + selrecords[0].get('TableId'), false ); //+  selrecords[0].get('TableId')
                xmlHttp.send( null );
                //alert("DATA: " + xmlHttp.responseText);
                var bssNewFieldNameData = eval('[' + xmlHttp.responseText + ']');
                fieldStore.loadData(bssNewFieldNameData,false);


                 //Get the data
                xmlHttp = new XMLHttpRequest();
                xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "QueryDetail" + "&BSSWhereClause=" + "masterid=" +  selrecords[0].get('id'), false );
                xmlHttp.send( null );
                // document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
                var newdata1 = eval('[' + xmlHttp.responseText + ']');
                childStore.loadData(newdata1,false);


             }
                catch(e)
                {
                    alert("ERROR: " + e.message);
                }


}

function processUpdate(BSSConfigName, BSSGrid, BSSStore)
{

    var updrecords = BSSStore.getUpdatedRecords();

    var rec = new BSSStore.model();

    jsenc = "";
    var fieldcount = rec.fields.getCount();

    var xfieldtype;
    var xfieldname;


    for(x = 0; x < fieldcount; x++){
         xfieldtype = rec.fields.getAt(x).type.type;
         xfieldname = rec.fields.getAt(x).name;

        switch(xfieldtype){
        case "date":
            jsenc = jsenc + formatDate(updrecords[0].get(xfieldname)) + "|";
        break;
        case "bool":
            if(updrecords[0].get(xfieldname).toString()=='true'){
                jsenc = jsenc + "1" + "|";
            }else{
                jsenc = jsenc + "0" + "|";
            }
        break;
        default:
        jsenc = jsenc + updrecords[0].get(xfieldname) + "|";
        }

    }
  //  document.write("<p>"+ jsenc + "</p>");

try{
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSPerformUpdate.php?BSSConfigName=" + BSSConfigName + "&id=" + jsenc, false);
    xmlHttp.send(null);
  //  document.write("<p>"+ xmlHttp.responseText + "</p>");

     //REmove the red triangle
    BSSStore.each(function(r){
      r.commit();
     });


}catch(e)
    {document.write("<p>" + e.message + "</p>");}
}


function formatDate(value){
    return value ? Ext.Date.dateFormat(value, 'M d, Y') : '';
}







