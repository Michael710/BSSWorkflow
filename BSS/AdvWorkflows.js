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
var BSSEDITDISABLED = true;

var BSSChildConfigName = "WorkflowApprovers";

var BSSWorkflowNotificationConfigName = "WorkflowNotifications";
var BSSWorkflowActionConfigName = "WorkflowActions";

var bssNewFieldNameData;
var bssNewFlowManagerData;
var bssWorkflowData;

bssFieldNameData = [ { id:1, value: 'AGLOBAL'},{ id:2, value: 'AUSER'}];
bssNewFlowManagerData = [ { id:1, value: 'AG'},{ id:2, value: 'AU'}];
bssWorkflowData = [ { id:1, value: 'A'},{ id:2, value: 'B'}];


Ext.Loader.setConfig({
    enabled: true
});
Ext.Loader.setPath('Ext.ux', '../ux');

try{
    Ext.require([
        'Ext.tree.*',
        'Ext.data.*',
        'Ext.form.*',
        'Ext.tab.*',
        'Ext.tip.*',
        'Ext.window.*',
        'Ext.grid.*',
        'Ext.ux.grid.FiltersFeature',
        'Ext.toolbar.Paging',
        'Ext.ux.ajax.JsonSimlet',
        'Ext.ux.ajax.SimManager'
    ]);

}catch(e)
{alert(e.message);}


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

workflowliststore = Ext.create('Ext.data.Store', {
        fields: [{name: 'id'}, {name: 'value'} ],
        data: bssWorkflowData
    }
);

aworkflowliststore = Ext.create('Ext.data.Store', {
        fields: ['id',  'WorkflowName'],
        data: [
            ['small', 'small'],
            ['medium', 'medium'],
            ['large', 'large'],
            ['extra large', 'extra large']
        ]
    }
);



 //Get the data
xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "DBServices/BSSGetComboStore.php?BSSSQLString=SELECT id, QueryName AS value FROM Queries", false );
xmlHttp.send( null );
//alert("DATA: " + xmlHttp.responseText);
var bssNewFieldNameData = eval('[' + xmlHttp.responseText + ']');
fieldStore.loadData(bssNewFieldNameData,false);

//Get the data
xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "DBServices/BSSGetComboStore.php?BSSSQLString=SELECT id, Email AS value FROM users", false );
xmlHttp.send( null );
// alert("DATA: " + xmlHttp.responseText);
var bssNewFlowManagerData = eval('[' + xmlHttp.responseText + ']');
flowmanagerStore.loadData(bssNewFlowManagerData,false);
// to use for the editor at each header.
//Get the data

xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "DBServices/BSSGetComboStore.php?BSSSQLString=SELECT id, WorkflowName AS value FROM AdvWorkflow WHERE Enabled = 1", false ); //+  selrecords[0].get('TableId')
xmlHttp.send( null );
//alert("DATA: " + xmlHttp.responseText);
var bssWorkflowData = eval('[' + xmlHttp.responseText + ']');
workflowliststore.loadData(bssWorkflowData,false);


xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "Utilities/BSSGetOptionsForFilter.php?BSSSQLString=SELECT id, WorkflowName FROM AdvWorkflow", false ); //+  selrecords[0].get('TableId')
xmlHttp.send( null );
//alert(xmlHttp.responseText);
var bssWorkflowOptions = eval('[' + xmlHttp.responseText + ']');

xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "Utilities/BSSGetOptionsForFilter.php?BSSSQLString=SELECT id, Email FROM users", false ); //+  selrecords[0].get('TableId')
xmlHttp.send( null );
var bssEmailOptions = eval('[' + xmlHttp.responseText + ']');

var workflowstore = Ext.create('Ext.data.Store', {
    fields: [
        {name: 'id', type: 'string'},
        {name: 'sequence', type: 'string'},
        {name: 'masterid', type: 'string'},
        {name: 'WorkflowName', type: 'string'},
        {name: 'Workflowdescription', type: 'string'},
        {name: 'ContentName', type: 'string'},
        {name: 'ContentDescription', type: 'string'},
        {name: 'KeyName', type: 'string'},
        {name: 'Status', type: 'string'},
        {name: 'CreateDate', type: 'string'},
        {name: 'CreateUser', type: 'string'}
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



Ext.define('AdvWorkflows', {
    name: 'Unknown',
    calltype: 'Unknown',
    userid: 0,

    constructor: function(name,calltype,userid) {

        if (name) {
            this.name = name;
       }

        if (calltype) {
            this.calltype = calltype;
        }

        if (userid) {
            this.userid = userid;
        }

        BSSUserId = this.userid;


        //alert("NAme is " + this.name);
        //alert("Call type is " + this.calltype);
        //alert("BSSUserId is " + BSSUserid);

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
            // Get the data

            // alert(this.calltype);
            strWhereClause = "";

            switch (this.calltype) {
                case "Create Workflows":
                    strWhereClause = "id>0 AND CreateUser = " + BSSUserid + " ORDER BY id DESC";
                    BSSEDITDISABLED = false;
                    break;
                case "Open Workflows":
                    strWhereClause = "id>0 AND CreateUser = " + BSSUserid + " ORDER BY id DESC";
                    break;
                case "Late Workflows":
                    strWhereClause = "DATEDIFF(now(),DueDate) > 0  AND CreateUser = " + BSSUserid + " ORDER BY id DESC";
                    break;
                case "Closed Workflows":
                    strWhereClause = "Status = 'Complete'  AND CreateUser = " + BSSUserid + " ORDER BY id DESC";
                    break;
                case "All Workflows Instances":
                    strWhereClause = "id>0 ORDER BY id DESC";
                    break;
                case "All Late Workflows":
                    strWhereClause = "DATEDIFF(now(),DueDate) > 0 ORDER BY id DESC";
                    break;
            }

            //alert(BSSEDITDISABLED);

            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "DBServices/BSSGetJSData.php?BSSConfigName=" + "AdvWorkflowInstance" + "&BSSWhereClause=" + strWhereClause, false );
            xmlHttp.send( null );
            //alert("DATA: " + xmlHttp.responseText);
            var newdata = eval('[' + xmlHttp.responseText + ']');
            workflowstore.loadData(newdata,false);
        }catch(e)
            {alert("ERROR: " + e.message);
        }

        // configure whether filter query is encoded or not (initially)
        var encode = false;

        // configure whether filtering is performed locally or remotely (initially)
        var local = true;

        var filters = {
            ftype: 'filters',
            // encode and local configuration options defined previously for easier reuse
            encode: encode, // json encode the filter query
            local: local,   // defaults to false (remote filtering)

            // Filters are most naturally placed in the column definition, but can also be
            // added here.
            filters: [{
                type: 'boolean',
                dataIndex: 'visible'
            }]
        };


        workflowgrid = Ext.create('Ext.grid.Panel', {
            store: workflowstore,
            features: [filters],
            selModel: 'cellmodel',
       //     listeners: {
       //               itemclick: function() {
       //                   ProcessChildTab();
       //             }},
            listeners: {
                close: function(){
                    this.destroy();
                }},

            columns: [
                {//id: 'id1',
                header: 'Id',
                disabled: true,
                listeners: {
                beforeedit: function(){
                                return false;
                            }},
                width: 30,
                dataIndex: 'id',
                editor: {
                    allowBlank: false
                }
                },
                {//id: 'sequence1',
                header: 'Sequence',
                disabled: false,
                width: 0,
                dataIndex: 'sequence',
                editor: {
                allowBlank: false
                }
                },
                {//id: 'masterid1',
                header: 'Master Id',
                disabled: false,
                width: 0,
                dataIndex: 'masterid',
                editor: {
                allowBlank: false
                }

                },

                    {
                    //        //id: 'FlowManager',
                    header: 'Workflow Name',
                    width: 100,
                    dataIndex: 'WorkflowName',
                    filter: {
                        type: 'list',
                        dataIndex: 'WorkflowName',
                        options: bssWorkflowOptions
                        //,phpMode: true
                    },
                    editor:
                    { xtype: 'combobox',
                        typeAhead: true,
                        selectOnTab: true,
                        triggerAction: 'all',
                        fields:['id','value'],
                        store: workflowliststore, //[[1, 'GLOBAL'],[2, 'USER']],
                        valueField:'id',
                        displayField:'value',
                        multiSelect: false,
                        queryMode: 'local',
                        lazyRender: false,
                        listClass: 'x-combo-list-small'},
                    renderer: function(val) {var matching =  workflowliststore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}
                },

                {
                //id: 'Workflowdescription',
                header: 'Workflow Description',
                width: 150,
                filterable: true,
                dataIndex: 'Workflowdescription',
                editor: {
                    allowBlank: false
                }
                },
                {
                //id: 'Workflowdescription',
                header: 'Content Name',
                width: 100,
                filterable: true,
                dataIndex: 'ContentName',
                editor: {
                    allowBlank: false
                }
                },
                {
                header: 'Content Description',
                width: 150,
                filterable: true,
                dataIndex: 'ContentDescription',
                editor: {
                    allowBlank: false
                }
                },
                {
                header: 'Key Name',
                width: 100,
                dataIndex: 'KeyName',
                filter: {
                    type: 'string'
                    // specify disabled to disable the filter menu
                    //, disabled: true
                },
                editor: {
                    allowBlank: false
                }
                },
                {
                header: 'Workflow Status',
                width: 100,
                    filter: {
                        type: 'list',
                        options: ['Pending', 'In Process', 'Complete']
                    },
                dataIndex: 'Status',
                editor: {
                    allowBlank: false
                }

                },
                {
                header: 'Date Created',
                width: 100,
                    filter: {
                        type: 'date'
                        // specify disabled to disable the filter menu
                        //, disabled: true
                    },
                dataIndex: 'CreateDate',
                editor: {
                    allowBlank: false
                 }
                },

                {
        //        //id: 'FlowManager',          bssEmailOptions
                header: 'Create User',
                       width: 400,
                       filter: {
                           type: 'list',
                           options: bssEmailOptions
                        },
                       flex:1,
                       dataIndex: 'CreateUser',
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
                        lazyRender: false,
                        listClass: 'x-combo-list-small'},
                   renderer: function(val) {var matching =  flowmanagerStore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}


            }],
            width: 1020,
            height: 550,
            x: 10,
            y: 10,
            title: 'Workflows',
            frame: true,
            tbar: [{text: 'Add',    disabled: BSSEDITDISABLED, handler : function() {processInsert("AdvWorkflowInstance",workflowgrid,workflowstore);}, hidden: false},
                   {text: 'Save',   disabled: BSSEDITDISABLED, handler : function() {processUpdate("AdvWorkflowInstance",workflowgrid,workflowstore);}},
                   {text: 'Delete', disabled: BSSEDITDISABLED, handler : function() {processDelete("AdvWorkflowInstance",workflowgrid,workflowstore);}},
                 //  {text: 'View Content', handler : function() {GetContent("AdvWorkflowInstance",workflowgrid,workflowstore);}},
                   {text: 'Open Workflow', handler : function() {OpenWorkflow("AdvWorkflowInstance",workflowgrid,workflowstore);}}
                  // {text: 'Start Workflow', handler : function() {StartWorkflow("Workflows",workflowgrid,workflowstore);}},
                  // {text: 'View History', handler : function() {ViewWorkflowHistory("Workflows",workflowgrid,workflowstore);}}
            ],
            plugins: [cellEditing1]
        });


        try{

        //Get the Child Grid Configuration
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "DBServices/BSSGetConfig.php?BSSConfigName=WorkflowApprovers&BSSConfigMode=CHILD", false );
        xmlHttp.send( null );
         //document.write("<p>"+ "f" + xmlHttp.responseText + "</p>");

    //    childgrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));
        //gridx.addListener("click",ProcessEdit());
        }catch(e){alert(e.message);}

        try{

            //Get the notification Grid Configuration
            var xmlHttp = null;
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "DBServices/BSSGetConfig.php?BSSConfigName=WorkflowNotifications&BSSConfigMode=CHILD", false );
            xmlHttp.send( null );
            //document.write("<p>"+ "TEST" + xmlHttp.responseText + "</p>");

          //  notificationgrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));
            //gridx.addListener("click",ProcessEdit());
        }catch(e){alert(e.message);}

        try{

            //Get the action Grid Configuration
            var xmlHttp = null;
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "DBServices/BSSGetConfig.php?BSSConfigName=WorkflowActions&BSSConfigMode=CHILD", false );
            xmlHttp.send( null );
            //document.write("<p>"+ "TEST" + xmlHttp.responseText + "</p>");

     //       actiongrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));
            //gridx.addListener("click",ProcessEdit());
        }catch(e){alert(e.message);}

        try{
             //Get the data
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "DBServices/BSSGetJSData.php?BSSConfigName=" + "Workflows" + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );
            xmlHttp.send( null );
       //  document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
            var newdata = eval('[' + xmlHttp.responseText + ']');
     //       workflowstore.loadData(newdata,false);
        }catch(e)
            {document.write("<p>" + "ERROR: " + e.message + "</p>");
        }

        /*
        childtabs = Ext.createWidget('tabpanel', {
           // renderTo: document.body,
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

               */

        absolute1 = Ext.create('Ext.window.Window', {
           title: this.name,
           x:50,
           y:50,
           listeners: {
                close: function(){
                    this.destroy();
                }},
           width: 1050,
           height: 600,
           layout:'absolute',
           defaults: {
           bodyStyle: 'padding:10px'
           },
           items: [workflowgrid]
           });

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

    // Use the Google Loader script to load the google.picker script.
	alert('YYSGGY');


    try{


        var workflowcreate = Ext.create('Ext.form.Panel', {
            //   renderTo: 'editor-grid'
            id: 'idcreatenewworkflow',
            name: 'idcreatenewworkflow',
            width: 600,
            frame: true,
            title: 'Create Workflow A',
            bodyPadding: '10 10 0',

            defaults: {
                anchor: '100%',
                allowBlank: false,
                msgTarget: 'side',
                labelWidth: 70
            },

            items: [{
                name: 'idworkflowname',
                xtype: 'combobox',
                value: '',

                queryMode: 'local',
                fields:['id', 'value'],
                store: workflowliststore,
                displayField: 'value',
                valueField: 'id',
                grow: true,

                /*
                 name: 'txtuserlist',
                 xtype: 'combobox',
                 fieldLabel: 'Approver',
                 queryMode: 'local',
                 fields:['id', 'value'],
                 store: userliststore,
                 displayField: 'value',
                 valueField: 'id',
                 grow: true,
                 labelPad: 10,
                 labelWidth: 80,
                 labelAlign: 'right'
                 */

                fieldLabel: 'Workflow Name'
            },{
                name: 'idworkflowdescription',
                xtype: 'textfield',
                value: 'BSSDescription',
                fieldLabel: 'Workflow Description'
            },
                {
                    id: 'ContentFileName',
                    name: 'ContentFileName',
                    xtype: 'textfield',
                    emptyText: 'Select a File',
                    value: '',
                    fieldLabel: 'File',
                 //   buttonText: 'B',
                  //  buttonConfig: {
                  //       iconCls: 'upload-icon'	
                   // },
					            buttons: [{
                text: 'Google Picker',
                handler: function(){alert('H')},
				}]
	
                },
                {
                name: 'idcontentdescription',
                xtype: 'textfield',
                fieldLabel: 'Content Description'
                },
                {   id: 'idkeyname',
                    name: 'idkeyname',
                    xtype: 'textfield',
                    fieldLabel: 'Key Name'
                }
            ],

            buttons: [{
				
				
                text: 'Google Picker',
                handler: function(){alert('H')}},
				
				{
                text: 'Create Workflow',
                handler: function(){

                    idval = 0;


                    try{


                    var xmlHttp = null;
                    xmlHttp = new XMLHttpRequest();
                    xmlHttp.open( "GET", "DBServices/BSSPerformInsert.php?BSSConfigName=" + BSSConfigName+ "&masterid=" + idval, false );
                    xmlHttp.send(null);
                    // document.write("<p>"+ xmlHttp.responseText + "</p>");
                    newdata = eval('[' + xmlHttp.responseText + ']');
                    //newdata.set("WorkflowName","Test me freakshpw");
                    var AddedModel = BSSStore.add(newdata);

                        //    {name: 'sequence', type: 'string'},
                        //    {name: 'masterid', type: 'string'},
                        //    {name: 'WorkflowName', type: 'string'},
                        //     {name: 'Workflowdescription', type: 'string'},
                        //     {name: 'ContentName', type: 'string'},
                        //     {name: 'ContentDescription', type: 'string'},
                        //     {name: 'Status', type: 'string'},
                        //     {name: 'DateCreated', type: 'string'}


                     //alert(AddedModel[0].get("id"));

                     BSSWorkflowID = AddedModel[0].get("id");

                     /*

                     var sm = workflowgrid.getSelectionModel();
                     var selrecords = sm.getSelection();
                     if(sm.getCount() > 0){
                         var fieldname = "id";
                         var idval = selrecords[0].get('id')
                         alert(idval);
                     }
                       */



                     var form = this.up('form').getForm();
                    if(form.isValid()){
                        form.submit({
                            somevar: 'TTTTTTT',
                            url: 'Utilities/wffile-checkin.php?BSSUserId=' + BSSUserId +"&BSSMasterId=" + AddedModel[0].get("id"),
                            waitMsg: 'Checking your file in...',
                            success: function(fp, o) {
                                msg('Success', 'Processed file "' + o.result.file + '" on the server');

                                    try{

                                        var varWorkflowId = Ext.getCmp('idcreatenewworkflow').getForm().findField("idworkflowname").getValue();
                                       // alert(varWorkflowId);
                                        var varWorkflowdescription = Ext.getCmp('idcreatenewworkflow').getForm().findField("idworkflowdescription").getValue();
                                      //  alert(varWorkflowdescription);
                                        var varContentName = o.result.file; //Ext.getCmp('idcreatenewworkflow').getForm().findField("ContentFileName").getValue();
                                     //   alert(varContentName);
                                        var varContentDescription = Ext.getCmp('idcreatenewworkflow').getForm().findField("idcontentdescription").getValue();
                                     //   alert(varContentDescription);

                                        var varKeyName = Ext.getCmp('idcreatenewworkflow').getForm().findField("idkeyname").getValue();
                                        alert(varKeyName);


                                        AddedModel[0].set("WorkflowName",varWorkflowId);
                                        AddedModel[0].set("Workflowdescription",varWorkflowdescription);
                                        AddedModel[0].set("ContentName",varContentName);
                                        AddedModel[0].set("ContentDescription",varContentDescription);
                                        AddedModel[0].set("KeyName",varKeyName);
                                        AddedModel[0].set("Status","Pending");
                                        AddedModel[0].set("DateCreated","Date");
                                        AddedModel[0].set("CreateUser",BSSUserId);


                                        // Add call to create workflow steps

                                        processUpdate("AdvWorkflowInstance",workflowgrid,workflowstore);

                                        var URLString = "Workflow/BSSCreateWorkflow.php?ProcName=createadvworkflow&WorkflowId=" + BSSWorkflowID + "&BSSWorkflowDescription=" + varWorkflowdescription + "&BSSNewWorkflowId=" + varWorkflowId;
                                        alert(URLString);
                                        try{
                                            //Get the data
                                            xmlHttp = new XMLHttpRequest();
                                            xmlHttp.open("GET",URLString, false );
                                            xmlHttp.send( null );
                                            //   alert("RESULT: " + xmlHttp.responseText);
                                        }catch(e)
                                        {document.write("<p>" + "Master Data Get ERROR: " + e.message + "</p>");
                                        }


                                        try{
                                            //Get the data
                                            xmlHttp = new XMLHttpRequest();
                                            xmlHttp.open( "GET", "DBServices/BSSGetJSData.php?BSSConfigName=" + "AdvWorkflowInstance" + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );
                                            xmlHttp.send( null );
                                            //  document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
                                            var newdata = eval('[' + xmlHttp.responseText + ']');
                                            //       workflowstore.loadData(newdata,false);
                                        }catch(e)
                                        {document.write("<p>" + "ERROR: " + e.message + "</p>");
                                        }


                                        Ext.getCmp('idcreatenewworkflow').close();
                                        absolutedoc.close();

                                        }catch(e)
                                            {
                                                alert(e.message);
                                            }
                                                    }
                                        })
                    }

                    }catch(e)
                    {alert(e.message);
                    }

                }
            },{
                text: 'Close',
                handler: function() {
                    absolutedoc.close();
                    this.up('form').getForm().close();
                    Ext.getCmp('idfilecheckin').close();
                    GetDocuments();
                }
            }]
        });

        absolutedoc = Ext.create('Ext.window.Window', {
            //  title: 'File Upload',
            width: 610,
            height: 260,
            layout:'absolute',
            defaults: {
                bodyStyle: 'padding:10px'
            },
            items: [workflowcreate]
        });

        absolutedoc.show();




 //   return;



    //    var sel_model = BSSGrid.getSelectionModel();
    //    var record = sel_model.getSelection()[0];
    //    record.set("WorkflowName","Test");


    }catch(e)
        {alert(e.message);
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
        xmlHttp.open( "GET", "DBServices/BSSPerformDelete.php?BSSConfigName=" + BSSConfigName + "&id=" + delrecords[0].get('id'), false);
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
            xmlHttp.open( "GET", "DBServices/BSSGetJSData.php?BSSConfigName=" + "WorkflowApprovers" + "&BSSWhereClause=" + "masterid=" +  selrecords[0].get('id'), false );
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
        xmlHttp.open( "GET", "DBServices/BSSGetJSData.php?BSSConfigName=" + "WorkflowNotifications" + "&BSSWhereClause=" + "masterid=" +  selrecords[0].get('id'), false );
        xmlHttp.send( null );
        // document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
        var newdata1 = eval('[' + xmlHttp.responseText + ']');
        notificationStore.loadData(newdata1,false);
    }catch(e)
    {
        //document.write("<p>" + "ERROR: " + e.message + "</p>");
    }
}



function GetContent(BSSConfigName, BSSGrid, BSSStore)
{
    var sm = BSSGrid.getSelectionModel();
    var selrecords = sm.getSelection();

    if (sm.getCount() != 1) {
        return;
    }

    var vid = "";
    var filename = "";

    // vid = selrecords[0].get('id');
    // filename = selrecords[0].get('filename');

    vid = selrecords[0].get('id');
    filename = selrecords[0].get('ContentName');
   // version =  selrecords[0].get('documentversion');


    alert("BSSWFDownloadFile.php?BSSid=" + vid + "&BSSFileName=" + filename);

    window.open("BSSWFDownloadFile.php?BSSid=" + vid + "&BSSFileName=" + filename);



}




function OpenWorkflow(BSSConfigName, BSSGrid, BSSStore)
{
    var sm = BSSGrid.getSelectionModel();
    var selrecords = sm.getSelection();

    if (sm.getCount() != 1) {
        return;
    }

    var vid = "";
    var filename = "";

    // vid = selrecords[0].get('id');
    // filename = selrecords[0].get('filename');

    vid = selrecords[0].get('id');
    //filename = selrecords[0].get('ContentName');
    // version =  selrecords[0].get('documentversion');
    //alert("BSSWFDownloadFile.php?BSSid=" + vid + "&BSSFileName=" + filename);

    window.open("NEWWorkflowDesigner.html?foo=Instance=" + vid, height = 200, width = 150);

    // window.open("NEWWorkflowDesigner.html?foo=Design", height = 200, width = 150);



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
        xmlHttp.open( "GET", "DBServices/BSSGetJSData.php?BSSConfigName=" + "WorkflowActions" + "&BSSWhereClause=" + "masterid=" +  selrecords[0].get('id'), false );
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
    xmlHttp.open( "GET", "DBServices/BSSPerformUpdate.php?BSSConfigName=" + BSSConfigName + "&id=" + jsenc, false);
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



// Create and render a Picker object for searching images
// and uploading files.
function createPicker() {
	// Create a view to search images.
	var view = new google.picker.View(google.picker.ViewId.DOCS);
	view.setMimeTypes('image/png,image/jpeg');

	// Use DocsUploadView to upload documents to Google Drive.
	var uploadView = new google.picker.DocsUploadView();

	var picker = new google.picker.PickerBuilder().
		addView(view).
		addView(uploadView).
		setAppId(YOUR_APP_ID).
		setCallback(pickerCallback).
		build();
	picker.setVisible(true);
}

// A simple callback implementation.
function pickerCallback(data) {
	if (data.action == google.picker.Action.PICKED) {
		var fileId = data.docs[0].id;
		alert('The user selected: ' + fileId);
	}
}



var msg = function(title, msg) {
    Ext.Msg.show({
        title: title,
        msg: msg,
        minWidth: 200,
        modal: true,
        icon: Ext.Msg.INFO,
        buttons: Ext.Msg.OK
    });
};







