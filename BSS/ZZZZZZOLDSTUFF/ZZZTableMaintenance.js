/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/

var tablegrid;
var tablecolgrid;
var bssTableData;
var tableStore;

       // create the data store
    var tablestore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'TableName', type: 'string'},
            {name: 'TableDescription', type: 'string'},
            {name: 'DBTYPE', type: 'string'},
            {name: 'DBHOST', type: 'string'},
            {name: 'DBNAME', type: 'string'},
            {name: 'DBUSER', type: 'string'},
            {name: 'DBPASSWORD', type: 'string'}
        ],
        data:
                   [['1','','','','']]
         });



    var tablecolstore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'format', type: 'string'},
            {name: 'fieldname', type: 'string'},
            {name: 'heading', type: 'string'},
            {name: 'renderedas', type: 'string'},
            {name: 'foreignkeytable', type: 'string'},
            {name: 'foreignkey', type: 'string'},
            {name: 'foreignkeyfield', type: 'string'},
            {name: 'defaultvalue', type: 'string'},
            {name: 'width', type: 'string'}
        ],
        data:
                   [['1','1','1','50','name','Name','0','','','','','']]
    });


bssRenderedAsData = [ { id:1, value: 'TEXT'},{ id:2, value: 'COMBO'},{ id:3, value: 'DATE'},{ id:4, value: 'NUMBER'},{ id:5, value: 'CHECKBOX'}];

renderedasliststore = Ext.create('Ext.data.Store', {
        fields: [{name: 'id'}, {name: 'value'} ],
        data: bssRenderedAsData
    }
);


bssTableData = [ { id:1, value: 'AGLOBAL'},{ id:2, value: 'AUSER'}];

tableStore = Ext.create('Ext.data.Store', {
        fields: [{name: 'id'}, {name: 'value'} ],
        data: bssTableData
    }
);

//Get the data
xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "BSSGetComboStore.php?BSSSQLString=SELECT id, TableName AS value FROM Tables", false ); //+
xmlHttp.send( null );
//alert("DATA: " + xmlHttp.responseText);
var bssTableData = eval('[' + xmlHttp.responseText + ']');
tableStore.loadData(bssTableData,false);



Ext.define('TableMaintenance', {
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
            clicksToEdit: 1,
            listeners: {
                edit: function(editor, e){
                    if(e.colIdx = 6){
                    switch (e.value)
                    {
                        case 1:  // text
                            e.record.set('format', 'varchar(50)');
                            break;
                        case 2:  // combo
                            e.record.set('format', 'int(11)');
                            e.record.set('foreignkey', 'id');
                            break;
                        case 3:  // date
                            e.record.set('format', 'datetime');
                            break;
                        case 4:  // number
                            e.record.set('format', 'decimal(18,2)');
                            break;

                    }

                    }
                }
            }
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

            // create the grid and specify what field you want

        // to use for the editor at each header.
        tablegrid = Ext.create('Ext.grid.Panel', {
            store: tablestore,
            selModel: 'cellmodel',
            listeners: {
                      itemclick: function() {
                          GetChildData();
                    }},
            columns: [
                {id: 'id111',
                header: 'Id',
                disabled: true,
                listeners: {
                beforeedit: function(){
                                return false;
                            }},
                width: 40,
                dataIndex: 'id',
                editor: {
                    allowBlank: false
                }
                },
                {id: 'tablemasterid1',
                header: 'Master Id',
                disabled: false,
                width: 80,
                dataIndex: 'masterid',
                editor: {
                allowBlank: false
                }
                },
                {id: 'sequence11',
                header: 'Sequence',
                disabled: false,
                width: 80,
                dataIndex: 'sequence',
                editor: {
                allowBlank: false
                }
                },
                {id: 'TableName',
                header: 'Table Name',
                width: 100,
                editable: false,
                dataIndex: 'TableName',
                editor: {
                    allowBlank: true
                }
                },
                {
                id: 'TableDescription',
                header: 'Table Description',
                width: 250,
                dataIndex: 'TableDescription',
                editor: {
                    allowBlank: false
                }
                },

                {
                header: 'DB TYPE',
                dataIndex: 'DBTYPE',
                width: 130,
                editor: {
                    xtype: 'combobox',
                    typeAhead: true,
                    triggerAction: 'all',
                    selectOnTab: true,
                    store: [
                        ['MYSQL','MYSQL'],
                        ['MSSQL','MSSQL'],
                        ['ORACLE','ORACLE']
                    ],
                    lazyRender: true,
                    listClass: 'x-combo-list-small'
                }
                },

                {
                id: 'DBHOST',
                header: 'DB HOST',
                width: 250,
                dataIndex: 'DBHOST',
                editor: {
                    allowBlank: false
                }
                },

                {
                id: 'DBNAME',
                header: 'DB NAME',
                width: 250,
                dataIndex: 'DBNAME',
                editor: {
                    allowBlank: false
                }
                },

                {
                id: 'DBUSER',
                header: 'DB USER',
                width: 250,
                dataIndex: 'DBUSER',
                editor: {
                    allowBlank: false
                }
                },

                {
                id: 'DBPASSWORD',
                header: 'DB PASSWORD',
                width: 250,
                dataIndex: 'DBPASSWORD',
                editor: {
                    allowBlank: false
                }
                }


            ],
            width: 900,
            height: 300,
            x: 20,
            y: 20,
            title: 'Tables',
            frame: true,
            tbar: [{text: 'Add',    handler : function() {processInsert("Tables",tablegrid,tablestore);}},
                   {text: 'Save',   handler : function() {processUpdate("Tables",tablegrid,tablestore);}},
                   {text: 'Delete', handler : function() {processDelete("Tables",tablegrid,tablestore);}}
            ],
            plugins: [cellEditing1]
        });


      //`id` int(11) NOT NULL AUTO_INCREMENT,
      //`width` int(11) DEFAULT NULL,
      //`field` varchar(45) DEFAULT NULL,
      //`heading` varchar(45) DEFAULT NULL,
      //`renderedas` int(11) DEFAULT NULL,
      //`foreignkeytable` varchar(45) DEFAULT NULL,
      //`foreignkey` varchar(45) DEFAULT NULL,
      //`foreignkeyfield` varchar(45) DEFAULT NULL,
      //`defaultvalue` varchar(45) DEFAULT NULL,
    /*
        var tablecolstore = Ext.create('Ext.data.Store', {
            fields: [
                {name: 'id', type: 'string'},
                {name: 'masterid', type: 'string'},
                {name: 'sequence', type: 'string'},
                {name: 'width', type: 'string'},
                {name: 'fieldname', type: 'string'},
                {name: 'heading', type: 'string'},
                {name: 'renderedas', type: 'string'},
                {name: 'foreignkeytable', type: 'string'},
                {name: 'foreignkey', type: 'string'},
                {name: 'foreignkeyfield', type: 'string'},
                {name: 'defaultvalue', type: 'string'}
            ],
            data:
                       [['1','1','1','50','name','Name','0','','','','']]
        });
        */
            // create the grid and specify what field you want
        // to use for the editor at each header.
            tablecolgrid = Ext.create('Ext.grid.Panel', {
            store: tablecolstore,
            selModel: 'cellmodel',
            columns: [{
                id: 'tabcolid',
                header: 'Id',
                width: 60,
                disabled: true,
                dataIndex: 'id',
                editor: {
                    allowBlank: false
                }
            },
            {
                id: 'tabcolsequence',
                header: 'Sequence',
                width: 80,
                dataIndex: 'sequence',
                editor: {
                    allowBlank: false
                }
            },

                {
                id: 'tabcolmasterid',
                header: 'Master Id',
                width: 80,
                dataIndex: 'masterid',
                editor: {
                    allowBlank: false
                }
            },
                {
                id: 'format',
                header: 'Format',
                width: 100,
                dataIndex: 'format',
                editor: {
                    allowBlank: false
                }
            },{
                id: 'fieldname',
                header: 'Field',
                width: 100,
                dataIndex: 'fieldname',
                editor: {
                    allowBlank: false
                }
            },{
                id: 'heading',
                header: 'Heading',
                width: 100,
                dataIndex: 'heading',
                editor: {
                    allowBlank: false
                }
            }
                ,{  //ADD COMBO STUFF
                id: 'renderedas',
                header: 'Rendered as',
                width: 100,
      //          listeners: {

      //              select: function(){ alert('click el'); }
      //          },
                datastore: renderedasliststore,
                dataIndex: 'renderedas',
                    editor: {
                        xtype: 'combobox',
                        typeAhead: true,
                        triggerAction: 'all',
                        selectOnTab: true,
                        store: [
                            [1,'TEXT'],
                            [2,'COMBO'],
                            [3,'DATE'],
                            [4,'NUMBER'],
                            [5,'CHECKBOX']
                        ],
                        lazyRender: true,
                        listClass: 'x-combo-list-small'
               //         listeners: {
               //             click: {fn:this.SetDefaultFormat,scope:this}
               //         }
                    },
                        renderer: function(val) {var matching =  renderedasliststore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}

            }
                ,{
                id: 'foreignkeytable',
                header: 'Foreign Key Table',
                datastore: tableStore,
                width: 100,
                dataIndex: 'foreignkeytable',
                    editor: {
                        xtype: 'combobox',
                        typeAhead: true,
                        fields:['id','value'],
                        triggerAction: 'all',
                        valueField:'id',
                        displayField:'value',
                        selectOnTab: true,
                        store: tableStore,
                        multiSelect: false,
                        queryMode: 'local',
                        lazyRender: true,
                        listClass: 'x-combo-list-small'
                    },
                    renderer: function(val) {var matching =  tableStore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}
                }
                ,{
                id: 'foreignkey',
                header: 'Foreign Key',
                width: 100,
                dataIndex: 'foreignkey',
                editor: {
                    allowBlank: false
                }
              },{
                id: 'foreignkeyfield',
                header: 'Foreign Key Field',
                width: 100,
                dataIndex: 'foreignkeyfield',
                editor: {
                    allowBlank: false
                }
               },
                {
                id: 'defaultvalue',
                header: 'Default Value',
                width: 100,
                dataIndex: 'defaultvalue',
                editor: {
                    allowBlank: false
                }
                },
                {
                id: 'width',
                header: 'Width',
                width: 100,
                dataIndex: 'width',
                editor: {
                    allowBlank: false
                }
            }],
            width: 1100,
            height: 400,
            x: 20,
            y: 350,
            title: 'Table Columns',
            frame: true,
            tbar: [{text: 'Add',    handler : function() {processInsert("TableColumns",tablecolgrid,tablecolstore);}},
                   {text: 'Save',   handler : function() {processUpdate("TableColumns",tablecolgrid,tablecolstore);}},
                   {text: 'Delete', handler : function() {processDelete("TableColumns",tablecolgrid,tablecolstore);}}
            ],
            plugins: [cellEditing]
        });

        //tablestore.load();


        try{
             //Get the data
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "Tables" + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );
            xmlHttp.send( null );
       //  document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
            var newdata = eval('[' + xmlHttp.responseText + ']');
            tablestore.loadData(newdata,false);
        }catch(e)
            {document.write("<p>" + "ERROR: " + e.message + "</p>");
        }




        btnProcessTable = Ext.create('Ext.Button', {
            id: 'ProcessTable',
            x: 1000,
            y: 120,
            width: 100,
            text: 'Process Table',
            handler: function() {
                ProcessTable();
            }
        });


        absolute1 = Ext.create('Ext.window.Window', {
           title: 'Table Maintenance',
           x:50,
           y:50,
           width: 1200,
           height: 800,
           layout:'absolute',
           defaults: {
           bodyStyle: 'padding:10px'
           },
           items: [tablegrid, tablecolgrid, btnProcessTable]
           });

    absolute1.show();

      //  tablegrid.setSelection(1);


    }

});

function processInsert(BSSConfigName, BSSGrid, BSSStore)
{
    //  Get default data from config array

    try{
    idval = 0;
    var sm = tablegrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(sm.getCount() > 0){
        var fieldname = "id";
        var idval = selrecords[0].get('id')
        //alert(idval);
    }

 //   return;

       // alert("BSSPerformInsert.php?BSSConfigName=" + BSSConfigName+ "&masterid=" + idval);

    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSPerformInsert.php?BSSConfigName=" + BSSConfigName+ "&masterid=" + idval, false );
    xmlHttp.send(null);



    if(xmlHttp.responseText.substr(0,5) != 'ERROR'){
        newdata = eval('[' + xmlHttp.responseText + ']');
        BSSStore.add(newdata);
    }else{
        alert(xmlHttp.responseText);
    }

    }catch(e)
        {document.write("<p>" + e.message + "</p>");
    }

}



function ProcessTable()
{

  //"&id=" + delrecords[0].get('id'),

    try{

        var sm = tablegrid.getSelectionModel();
            var selrecords = sm.getSelection();
            if(selrecords == ''){return;}
            var fieldname = "id";

            tableval = selrecords[0].get('TableName');
            alert(tableval);


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


function GetChildData()
{
    var sm = tablegrid.getSelectionModel();
   // if (sm.getSelection().getCount() = 0) {
   //     return;
   // }

    var selrecords = sm.getSelection();
    var fieldname = "id";
    //selrecords[0].get('id')
    try{
             //Get the data
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "TableColumns" + "&BSSWhereClause=" + "masterid=" +  selrecords[0].get('id'), false );
            xmlHttp.send( null );
           // document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
            var newdata1 = eval('[' + xmlHttp.responseText + ']');
        tablecolstore.loadData(newdata1,false);
        }catch(e)
            {document.write("<p>" + "ERROR: " + e.message + "</p>");
        }
}

function processUpdate(BSSConfigName, BSSGrid, BSSStore)
{

    var updrecords = BSSStore.getUpdatedRecords();

    var fieldname = "phone_type";
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
   // document.write("<p>"+ jsenc + "</p>");

try{
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSPerformUpdate.php?BSSConfigName=" + BSSConfigName + "&id=" + jsenc, false);
    xmlHttp.send(null);
 //   document.write("<p>"+ xmlHttp.responseText + "</p>");

     //REmove the red triangle
    BSSStore.each(function(r){
      r.commit();
     });


}catch(e)
    {alert(e.message);}
}


function formatDate(value){
    return value ? Ext.Date.dateFormat(value, 'M d, Y') : '';
}

function SetDefaultFormat(){
    alert("Here i is");
}






