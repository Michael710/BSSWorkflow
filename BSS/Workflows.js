/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/

var workflowgrid;
var childgrid;
var notificationgrid;
var actiongrid;
// notificationStore
// actionStore
var BSSCREATEMASTER_FLAG = false;
var BSSREADMASTER_FLAG = false;
var BSSUPDATEMASTER_FLAG = false;
var BSSDELETEMASTER_FLAG = false;
var BSSCREATECHILD_FLAG = false;
var BSSREADCHILD_FLAG = false;
var BSSUPDATECHILD_FLAG = false;
var BSSDELETECHILD_FLAG = false;




var BSSChildConfigName = "WorkflowApprovers";

var BSSWorkflowNotificationConfigName = "WorkflowNotifications";
var BSSWorkflowActionConfigName = "WorkflowActions";

var bssNewFieldNameData;
var bssNewFlowManagerData;

bssFieldNameData = [ { id:1, value: 'AGLOBAL'},{ id:2, value: 'AUSER'}];
bssNewFlowManagerData = [ { id:1, value: 'AG'},{ id:2, value: 'AU'}];


fieldStore = Ext.create('Ext.data.Store', {
                 fields: [{name: 'id'}, {name: 'value'} ],
                 data: bssFieldNameData
                 }
                 );


flowmanagerStore = Ext.create('Ext.data.Store', {
        fields: [{name: 'id'}, {name: 'value'} ],
        data: bssNewFlowManagerData
    }
);


 //Get the data
xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "BSSGetComboStore.php?BSSSQLString=SELECT id, QueryName AS value FROM Queries", false );
xmlHttp.send( null );
//alert("DATA: " + xmlHttp.responseText);
var bssNewFieldNameData = eval('[' + xmlHttp.responseText + ']');
fieldStore.loadData(bssNewFieldNameData,false);

//Get the data
xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "BSSGetComboStore.php?BSSSQLString=SELECT id, Email AS value FROM users", false );
xmlHttp.send( null );
// alert("DATA: " + xmlHttp.responseText);
var bssNewFlowManagerData = eval('[' + xmlHttp.responseText + ']');
flowmanagerStore.loadData(bssNewFlowManagerData,false);

        // alert('test');

       // create the data store
    var workflowstore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'WorkflowName', type: 'string'},
            {name: 'Workflowdescription', type: 'string'},
            {name: 'Workflowtype', type: 'string'},
            {name: 'FlowManager', type: 'string'},
            {name: 'WorkflowAvailableFor', type: 'string'}
        ],
        data:
                   [['1','','','','','','','','','','']]
         });


    var childStore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'WorkflowApprover', type: 'string'}
        ],
        data:
                   [['1','0','0','0','0']]
    });


var notificationStore = Ext.create('Ext.data.Store', {
    fields: [
        {name: 'id', type: 'string'},
        {name: 'sequence', type: 'string'},
        {name: 'masterid', type: 'string'},
        {name: 'WorkflowStep', type: 'string'},
        {name: 'WorkflowNotifications', type: 'string'}
    ],
    data:
        [['1','0','0','0','0']]
});



var actionStore = Ext.create('Ext.data.Store', {
    fields: [
        {name: 'id', type: 'string'},
        {name: 'sequence', type: 'string'},
        {name: 'masterid', type: 'string'},
        {name: 'WorkflowStep', type: 'string'},
        {name: 'WorkflowActions', type: 'string'}
    ],
    data:
        [['1','0','0','0']]
});





Ext.define('Workflows', {
    name: 'Unknown',

    constructor: function(name) {

        if (name) {
            this.name = name;
       }
        //return this;


        var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 1
        });

        var cellEditing1 = Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 1
        });

        var cellEditing2 = Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 1
        });

        var cellEditing3 = Ext.create('Ext.grid.plugin.CellEditing', {
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

        try{
             //Get the data
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "Workflows" + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );
            xmlHttp.send( null );
       //  document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
            var newdata = eval('[' + xmlHttp.responseText + ']');
            workflowstore.loadData(newdata,false);
        }catch(e)
            {document.write("<p>" + "ERROR: " + e.message + "</p>");
        }


        // to use for the editor at each header.



        workflowgrid = Ext.create('Ext.grid.Panel', {
            store: workflowstore,
            selModel: 'cellmodel',
            listeners: {
                      itemclick: function() {
                          ProcessChildTab();
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
                {id: 'sequence1',
                header: 'Sequence',
                disabled: false,
                width: 100,
                dataIndex: 'sequence',
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
                {id: 'WorkflowName',
                header: 'Workflow Name',
                width: 150,
                editable: false,
                dataIndex: 'WorkflowName',
                editor: {
                    allowBlank: true
                }
                },
                {
                id: 'Workflowdescription',
                header: 'Workflow Description',
                width: 300,
                dataIndex: 'Workflowdescription',
                editor: {
                    allowBlank: false
                }
                },
                {
                id: 'Workflowtype',
                header: 'Workflow Type',
                width: 100,
                dataIndex: 'Workflowtype',
                editor: {
                    allowBlank: false
                }
                },
                {
                id: 'FlowManager',
                header: 'Flow Manager',
                width: 400,
                dataIndex: 'FlowManager',
                    editor:
                    { xtype: 'combobox',
                        typeAhead: true,
                        selectOnTab: true,
                        triggerAction: 'all',
                        fields:['id','value'],
                        store: flowmanagerStore, //[[1, 'GLOBAL'],[2, 'USER']],
                        valueField:'id',
                        displayField:'value',
                        multiSelect: false,
                        queryMode: 'local',
                        lazyRender: true,
                        listClass: 'x-combo-list-small'},
                    renderer: function(val) {var matching =  flowmanagerStore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}
                },

                { header:'Workflow Available For Query', dataIndex:'WorkflowAvailableFor', width: 200,
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
               renderer: function(val) {var matching =  fieldStore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}

                         //       renderer: function(val) { var CodesStore = Ext.create('Ext.data.Store', { fields: [ {name: 'id'}, {name: 'value'} ], data: bssFieldNameData }); var matching = CodesStore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''} },



                /*

                {
                id: 'WorkflowAvailableFor',
                header: 'Workflow Available For Query',
                width: 160,
                dataIndex: 'WorkflowAvailableFor',
                editor: {
                    allowBlank: false
                }

                {
                id: 'PendingComplete',
                header: 'Pending Complete',
                width: 80,
                dataIndex: 'PendingComplete',
                editor: {
                    allowBlank: false
                }
                },
                {
                id: 'SubmitComplete',
                header: 'Submit Complete',
                width: 80,
                dataIndex: 'SubmitComplete',
                editor: {
                    allowBlank: false
                }
                },
                {
                id: 'ReviewComplete',
                header: 'Review Complete',
                width: 80,
                dataIndex: 'ReviewComplete',
                editor: {
                    allowBlank: false
                }
                },
                {
                id: 'Complete',
                header: 'Complete',
                width: 80,
                dataIndex: 'Complete',
                editor: {
                    allowBlank: false
                }
                },
                {
                id: 'CurrentStatus',
                header: 'Current Status',
                width: 100,
                dataIndex: 'CurrentStatus',
                editor: {
                    allowBlank: false
                }
                */

            }],
            width: 1100,
            height: 350,
            x: 20,
            y: 20,
            title: 'Workflows',
            frame: true,
            tbar: [{text: 'Add',    handler : function() {processInsert("Workflows",workflowgrid,workflowstore);}},
                   {text: 'Save',   handler : function() {processUpdate("Workflows",workflowgrid,workflowstore);}},
                   {text: 'Delete', handler : function() {processDelete("Workflows",workflowgrid,workflowstore);}}
            ],
            plugins: [cellEditing1]
        });


        try{

        //Get the Child Grid Configuration
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetConfig.php?BSSConfigName=WorkflowApprovers&BSSConfigMode=CHILD", false );
        xmlHttp.send( null );
         //document.write("<p>"+ "TEST" + xmlHttp.responseText + "</p>");

        childgrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));
        //gridx.addListener("click",ProcessEdit());
        }catch(e){alert(e.message);}


        try{

            //Get the notification Grid Configuration
            var xmlHttp = null;
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetConfig.php?BSSConfigName=WorkflowNotifications&BSSConfigMode=CHILD", false );
            xmlHttp.send( null );
            //document.write("<p>"+ "TEST" + xmlHttp.responseText + "</p>");

            notificationgrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));
            //gridx.addListener("click",ProcessEdit());
        }catch(e){alert(e.message);}



        try{

            //Get the action Grid Configuration
            var xmlHttp = null;
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetConfig.php?BSSConfigName=WorkflowActions&BSSConfigMode=CHILD", false );
            xmlHttp.send( null );
            //document.write("<p>"+ "TEST" + xmlHttp.responseText + "</p>");

            actiongrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));
            //gridx.addListener("click",ProcessEdit());
        }catch(e){alert(e.message);}







        try{
             //Get the data
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "Workflows" + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );
            xmlHttp.send( null );
       //  document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
            var newdata = eval('[' + xmlHttp.responseText + ']');
            workflowstore.loadData(newdata,false);
        }catch(e)
            {document.write("<p>" + "ERROR: " + e.message + "</p>");
        }


        childtabs = Ext.createWidget('tabpanel', {
            renderTo: document.body,
            activeTab: 0,
            x: 20,
            y: 400,
            width: 1000,
            height: 300,
            plain: true,
            defaults :{
                autoScroll: true,
                bodyPadding: 10
            },
            items: [{
                title: 'Workflow Approvers',
                layout:'absolute',
                items: childgrid,
                listeners: {activate: function() {GetChildData();}}
            },{
                title: 'Workflow Actions',
                layout:'absolute',
                items: actiongrid,
                listeners: {activate: function() {GetActions();}}
            },{
                title: 'Workflow Notifications',
                layout:'absolute',
                items: notificationgrid,
                listeners: {activate: function() {GetNotifications();}}

            }
            ]
        });



        absolute1 = Ext.create('Ext.window.Window', {
           title: 'Workflow Maintenance',
           x:50,
           y:50,
           width: 1200,
           height: 750,
           layout:'absolute',
           defaults: {
           bodyStyle: 'padding:10px'
           },
           items: [workflowgrid, childtabs]
           })

    absolute1.show();


    }

});

function ProcessChildTab()
{

    switch(childtabs.getActiveTab().title){
        case "Workflow Approvers":
            GetChildData();
            break;
        case "Workflow Notifications":
            GetNotifications();
            break;
        case "Workflow Actions":
            GetActions();
            break;
        default:
    }

}



function processInsert(BSSConfigName, BSSGrid, BSSStore)
{
    //  Get default data from config array

    try{
    idval = 0;
    var sm = workflowgrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(sm.getCount() > 0){
        var fieldname = "id";
        var idval = selrecords[0].get('id')
       // alert(idval);
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

        //alert(xmlHttp.responseText);

        BSSStore.removed = [];


    }catch(e)
        {    alert(e.message); //document.write("<p>" + e.message + "</p>");
    }


}


function GetChildData()
{

    var sm = workflowgrid.getSelectionModel();
  //  if (sm.getSelection().getCount() == 0) {
  //      return;
  //  }

    var selrecords = sm.getSelection();
    var fieldname = "id";
    //selrecords[0].get('id')

    //alert("BSSGetJSData.php?BSSConfigName=" + "WorkflowApprovers" + "&BSSWhereClause=" + "masterid=" +  selrecords[0].get('id'));

    try{
             //Get the data
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "WorkflowApprovers" + "&BSSWhereClause=" + "masterid=" +  selrecords[0].get('id'), false );
            xmlHttp.send( null );
          // alert("Approver DATA: " + xmlHttp.responseText);
            var newdata1 = eval('[' + xmlHttp.responseText + ']');
        childStore.loadData(newdata1,false);
        }catch(e)
            {
                //document.write("<p>" + "ERROR: " + e.message + "</p>");
        }



}




function GetNotifications()
{

    var sm = workflowgrid.getSelectionModel();
    // if (sm.getSelection().getCount() = 0) {
    //     return;
    // }

    var selrecords = sm.getSelection();
    var fieldname = "id";
    //selrecords[0].get('id')
    try{
        //Get the data
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "WorkflowNotifications" + "&BSSWhereClause=" + "masterid=" +  selrecords[0].get('id'), false );
        xmlHttp.send( null );
        // document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
        var newdata1 = eval('[' + xmlHttp.responseText + ']');
        notificationStore.loadData(newdata1,false);
    }catch(e)
    {
        //document.write("<p>" + "ERROR: " + e.message + "</p>");
    }
}



function GetActions()
{
    var sm = workflowgrid.getSelectionModel();
    // if (sm.getSelection().getCount() = 0) {
    //     return;
    // }

    var selrecords = sm.getSelection();
    var fieldname = "id";
    //selrecords[0].get('id')
    try{
        //Get the data
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "WorkflowActions" + "&BSSWhereClause=" + "masterid=" +  selrecords[0].get('id'), false );
        xmlHttp.send( null );
        // document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
        var newdata1 = eval('[' + xmlHttp.responseText + ']');
        actionStore.loadData(newdata1,false);
    }catch(e)
    {
        //document.write("<p>" + "ERROR: " + e.message + "</p>");
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
   // alert(jsenc);

try{
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSPerformUpdate.php?BSSConfigName=" + BSSConfigName + "&id=" + jsenc, false);
    xmlHttp.send(null);
    //alert(xmlHttp.responseText);

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







