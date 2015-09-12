/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/
Ext.Loader.setConfig({
    enabled: true
});
Ext.Loader.setPath('Ext.ux', '../ux');

var tablegrid;
var tablecolgrid;

Ext.require([
    'Ext.selection.CellModel',
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.util.*',
    'Ext.state.*',
    'Ext.form.*',
    'Ext.ux.CheckColumn'
]);


        try{
            var xmlHttp = null;
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetLoginRights.php", false );
            xmlHttp.send( null );
      //  alert(xmlHttp.responseText);
        }catch(e)
            {document.write("<p>" + e.message + "</p>");
        }

       // create the data store
    var tablestore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'TableName', type: 'string'},
            {name: 'TableDescription', type: 'string'}
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
            {name: 'defaultvalue', type: 'string'}
        ],
        data:
                   [['1','1','1','50','name','Name','0','','','','']]
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

        var sm = tablegrid.getSelectionModel();
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
    {document.write("<p>" + e.message + "</p>");}
}

Ext.onReady(function(){

    function formatDate(value){
        return value ? Ext.Date.dateFormat(value, 'M d, Y') : '';
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
            {id: 'id1',
            header: 'Id',
            disabled: true,
            listeners: {
            beforeedit: function(){
                            return false;
                        }},
            width: 20,
            dataIndex: 'id',
            editor: {
                allowBlank: false
            }
            },
            {id: 'masterid1',
            header: 'Master Id',
            disabled: false,
            width: 100,
            dataIndex: 'masterid',
            editor: {
            allowBlank: false
            }
            },
            {id: 'sequence1',
            header: 'Sequence',
            disabled: false,
            width: 100,
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
        }],
        width: 600,
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
            dataIndex: 'renderedas',
            editor: {
                allowBlank: false
            }
        }
            ,{
            id: 'foreignkeytable',
            header: 'Foreign Key Table',
            width: 100,
            dataIndex: 'foreignkeytable',
            editor: {
                allowBlank: false
            }
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
    // document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
        var newdata = eval('[' + xmlHttp.responseText + ']');
        tablestore.loadData(newdata,false);
    }catch(e)
        {document.write("<p>" + "ERROR: " + e.message + "</p>");
    }




    btnProcessTable = Ext.create('Ext.Button', {
        id: 'ProcessTable',
        x: 700,
        y: 120,
        width: 100,
        text: 'Process Table',
        handler: function() {
            ProcessTable();
        }
    });


    absolute1 = Ext.create('Ext.window.Window', {
       title: 'Table Maintenance',
       width: 1200,
       height: 800,
       layout:'absolute',
       defaults: {
       bodyStyle: 'padding:10px'
       },
       items: [tablegrid, tablecolgrid, btnProcessTable]
       });

absolute1.show();

    tablegrid.setSelection(1);





});

