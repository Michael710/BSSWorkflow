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
var BSSMasterConfigName = "EnterpriseObjects";
var BSSChildConfigName = "EnterpriseObjectWorkflows";

       // create the data store
    var masterStore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'ProfileName', type: 'string'},
            {name: 'ProfileDescription', type: 'string'},
            {name: 'ProfileType', type: 'string'},
            {name: 'MasterTable', type: 'string'},
            {name: 'MasterField', type: 'string'},
            {name: 'ChildTable', type: 'string'},
            {name: 'ChildTableField', type: 'string'},
            {name: 'EnableDocs', type: 'string'},
            {name: 'EnableDiscussions', type: 'string'},
            {name: 'EnableHistory', type: 'string'},
            {name: 'EnableWorkflow', type: 'string'},
            {name: 'Action1', type: 'string'},
            {name: 'Action2', type: 'string'},
            {name: 'Action3', type: 'string'},
            {name: 'Action4', type: 'string'},
            {name: 'Action5', type: 'string'},
            {name: 'Action6', type: 'string'}
        ],
        data:
                   [['1','','','','','','','','','','','','','','','','','','']]
         });



    var childStore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'WorkFlowId', type: 'string'}
        ],
        data:
                   [['1','1','1','']]
    });


Ext.define('EnterpriseObjectsClass', {
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

//Get the Enterprise Object Grid Configuration
try{
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSGetConfig.php?BSSConfigName=EnterpriseObjects&BSSConfigMode=MASTER", false );
    xmlHttp.send( null );
    //document.write("<p>"+ xmlHttp.responseText + "</p>");

    mastergrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));

}catch(e)
     {alert('Master Grid Config Error: ' + e.message);
 }


try{
     //Get the Enterprise Object data
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "EnterpriseObjects" + "&BSSQueryId=0" + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );
    xmlHttp.send( null );
    //alert("DATA: " + xmlHttp.responseText);
    var newdata = eval('[' + xmlHttp.responseText + ']');
    masterStore.loadData(newdata,false);
}catch(e)
    {alert("Data Load ERROR: " + e.message);
}


//Get the Enterprise Object Workflows Grid Configuration
        try{
            var xmlHttp = null;
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetConfig.php?BSSConfigName=EnterpriseObjectWorkflows&BSSConfigMode=MASTER", false );
            xmlHttp.send( null );
            //document.write("<p>"+ xmlHttp.responseText + "</p>");

            childgrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));

        }catch(e)
        {alert('Master Grid Config Error: ' + e.message);
        }


        try{
            //Get the Enterprise Object workflow data
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "EnterpriseObjectWorkflows" + "&BSSQueryId=0" + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );
            xmlHttp.send( null );
            //alert("DATA: " + xmlHttp.responseText);
            var newdata = eval('[' + xmlHttp.responseText + ']');
            childStore.loadData(newdata,false);
        }catch(e)
        {alert("Data Load ERROR: " + e.message);
        }


        absolute1 = Ext.create('Ext.window.Window', {
           title: 'Enterprise Object Maintenance',
           width: 950,
           height: 700,
           layout:'absolute',
           defaults: {
           bodyStyle: 'padding:10px'
           },
           items: [mastergrid, childgrid]
           });

    absolute1.show();

 }

});

function processInsert(BSSConfigName, BSSGrid, BSSStore)
{


    try{
    idval = 0;
    var sm = mastergrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(sm.getCount() > 0){
        var fieldname = "id";
        var idval = selrecords[0].get('id')
        //alert(idval);
    }


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

    var sm = mastergrid.getSelectionModel();
   // if (sm.getSelection().getCount() = 0) {
   //     return;
   // }

    var selrecords = sm.getSelection();
    var fieldname = "id";
    //selrecords[0].get('id')
    try{
             //Get the data
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "EnterpriseObjectWorkflows" + "&BSSWhereClause=" + "masterid=" +  selrecords[0].get('id'), false );
            xmlHttp.send( null );
           // document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
            var newdata1 = eval('[' + xmlHttp.responseText + ']');
        childStore.loadData(newdata1,false);
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
    alert(xmlHttp.responseText);

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







