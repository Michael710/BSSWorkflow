/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/



var mastergrid;
var masterStore;
var childStore;
var childgrid;
var arFormConfig;
var arFormPrivs;
var BSSMasterConfigName = "";
var BSSChildConfigName = "";
var BSSFormName = "";
var BSSConfigName = "";
var btnact1;
var childtabs;
var workflows;
var signoffs;
var documents;
var history;
var BSSAction1 = "";
var BSSAction2 = "";
var BSSAction3 = "";
var BSSAction4 = "";
var BSSAction5 = "";
var BSSAction6 = "";
var BSSFormMode = "";
var comboQuery = "";
var querystore = "";
var bssQueryNameData = "";
var BSSUserId = "";


var BSSCREATEMASTER  = 0;
var BSSREADMASTER = 0;
var BSSUPDATEMASTER = 0;
var BSSDELETEMASTER = 0;
var BSSCREATECHILD = 0;
var BSSREADCHILD = 0;
var BSSUPDATECHILD = 0;
var BSSDELETECHILD = 0;
var BSSCREATEWORKFLOW = 0;
var BSSADDREMOVEAPPROVERS = 0;
var BSSPROMOTEWORKFLOW = 0;
var BSSSIGNOFF = 0;
var BSSREADDOCUMENTS = 0;
var BSSADDDOCUMENTS = 0;
var BSSUPDATEDOCUMENTS = 0;
var BSSDELETEDOCUMENTS = 0;
var BSSCHECKINCHECKOUT = 0;
var BSSGETDOCUMENTS = 0;
var BSSVIEWDISCUSSIONS = 0;
var BSSADDDISCUSSIONS = 0;
var BSSUPDATEDISCUSSIONS = 0;
var BSSDELETEDISCUSSIONS = 0;
var BSSVIEWHISTORY = 0;


var BSSCREATEMASTER_FLAG = true
var BSSREADMASTER_FLAG = true
var BSSUPDATEMASTER_FLAG = true
var BSSDELETEMASTER_FLAG = true
var BSSCREATECHILD_FLAG = true
var BSSREADCHILD_FLAG = true
var BSSUPDATECHILD_FLAG = true
var BSSDELETECHILD_FLAG = true
var BSSCREATEWORKFLOW_FLAG = true
var BSSADDREMOVEAPPROVERS_FLAG = true
var BSSPROMOTEWORKFLOW_FLAG = true
var BSSSIGNOFF_FLAG = true
var BSSREADDOCUMENTS_FLAG = false // Used to for data call
var BSSADDDOCUMENTS_FLAG = true
var BSSUPDATEDOCUMENTS_FLAG = true
var BSSDELETEDOCUMENTS_FLAG = true
var BSSCHECKINCHECKOUT_FLAG = true
var BSSGETDOCUMENTS_FLAG = true
var BSSVIEWDISCUSSIONS_FLAG = false // Used to for data call
var BSSADDDISCUSSIONS_FLAG = true
var BSSUPDATEDISCUSSIONS_FLAG = true
var BSSDELETEDISCUSSIONS_FLAG = true
var BSSVIEWHISTORY_FLAG = false // Used to for data call

var BSSDocumentsEnabled = "";
var BSSDiscussionsEnabled = "";
var BSSHistoryEnabled = "";
var BSSWorkflowEnabled = "";
var bssWorkflowData;
var workflowliststore;

var BSSJSONObject = "";


bssWorkflowData = [ { id:1, value: 'A'},{ id:2, value: 'B'}];

workflowliststore = Ext.create('Ext.data.Store', {
                fields: [{name: 'id'}, {name: 'value'} ],
                data: bssWorkflowData
            }
        );

bssWorkflowStatusData = [ { id:1, value: 'A'},{ id:2, value: 'B'}];

workflowstatusliststore = Ext.create('Ext.data.Store', {
        fields: [{name: 'id'}, {name: 'value'} ],
        data: bssWorkflowStatusData
    }
);



bssWorkflowApprovalStatusData = [ { id:1, value: 'A'},{ id:2, value: 'B'}];

workflowapprovalstatusliststore = Ext.create('Ext.data.Store', {
        fields: [{name: 'id'}, {name: 'value'} ],
        data: bssWorkflowApprovalStatusData
    }
);



bssUserData = [ { id:1, value: 'A'},{ id:2, value: 'B'}];

userliststore = Ext.create('Ext.data.Store', {
        fields: [{name: 'id'}, {name: 'value'} ],
        data: bssUserData
    }
);


var workflowinstanceStore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'recordid', type: 'string'},
            {name: 'WorkflowName', type: 'string'},
            {name: 'Workflowdescription', type: 'string'},
         //   {name: 'Revision', type: 'string'},
         //   {name: 'CurrentStatus', type: 'string'},
       //     {name: 'PendingComplete', type: 'date'},
      //      {name: 'SubmitComplete', type: 'date'},
      //      {name: 'ReviewComplete', type: 'date'},
            {name: 'createdate', type: 'date'},
            {name: 'completedate', type: 'date'}
        ],
        data:
            [['1','','','','','','','','','']]
    });



var signoffsStore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'WorkflowApprover', type: 'string'},
            {name: 'SignoffDate', type: 'date'},
            {name: 'SignoffResult', type: 'string'},
            {name: 'Comments', type: 'string'}
        ],
        data:
            [['1','','','','','','']]
    });


var documentStore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'filename', type: 'string'},
            {name: 'documentuser', type: 'string'},
            {name: 'documentdate', type: 'date'},
            {name: 'documentname', type: 'string'},
            {name: 'checkoutuser', type: 'string'},
            {name: 'documentdescription', type: 'string'},
            {name: 'documentrevision', type: 'string'},
            {name: 'documentversion', type: 'string'}
        ],
        data:
                   [['1','','','','','','']]
         });

    var discussionStore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'discussionuser', type: 'string'},
            {name: 'discussiondate', type: 'date'},
            {name: 'discussiontext', type: 'string'}
        ],
        data:
                   [['1','','','','','','']]
         });

    var historyStore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'historyuser', type: 'string'},
            {name: 'historydate', type: 'date'},
            {name: 'historytext', type: 'string'}
        ],
        data:
                   [['1','','','','','']]
         });

//Get the form definition here

var filters = {
    ftype: 'filters',
    // encode and local configuration options defined previously for easier reuse
    encode: false, // json encode the filter query
    local: true,   // defaults to false (remote filtering)

    // Filters are most naturally placed in the column definition, but can also be
    // added here.
    filters: [{
        type: 'boolean',
        dataIndex: 'visible'
    }]
};


Ext.define('EnterpriseObjectForm', {
    name: 'Unknown',
    mode: 'Unknown',
  userid: 'Unknown',
    constructor: function(name, mode, userid) {

        if (name) {
            this.name = name;
        }

        if (mode) {
            this.mode = mode;
        }

        if (userid) {
            this.userid = userid;
        }

     //   alert(this.userid);



        BSSFormName = this.name;
        BSSFormMode = this.mode;
        BSSUserId =  this.userid;

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

          var cellEditing4 = Ext.create('Ext.grid.plugin.CellEditing', {
              clicksToEdit: 1
          });

          var cellEditing5 = Ext.create('Ext.grid.plugin.CellEditing', {
              clicksToEdit: 1
          });

          var cellEditing6 = Ext.create('Ext.grid.plugin.CellEditing', {
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


        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "ZZZBSSGetForm.php?BSSFormName=" + BSSFormName + "&BSSFormMode=" + BSSFormMode, false );
        xmlHttp.send( null );
        //alert("Form Config String:  " + xmlHttp.responseText);
        arFormConfig = eval( "(" + xmlHttp.responseText + ")" );


        BSSMasterConfigName = arFormConfig.MasterTable;
        BSSChildConfigName = arFormConfig.ChildTable;
        BSSEnterpriseObjectId = arFormConfig.EnterpriseObjectId;
        BSSFormName = arFormConfig.FormName;
        BSSAction1 = arFormConfig.Action1;
        BSSAction2 = arFormConfig.Action2;
        BSSAction3 = arFormConfig.Action3;
        BSSAction4 = arFormConfig.Action4;
        BSSAction5 = arFormConfig.Action5;
        BSSAction6 = arFormConfig.Action6;
        BSSDocumentsEnabled = arFormConfig.BSSDocumentsEnabled;
        BSSDiscussionsEnabled = arFormConfig.BSSDiscussionsEnabled;
        BSSHistoryEnabled = arFormConfig.BSSHistoryEnabled;
        BSSWorkflowEnabled = arFormConfig.BSSWorkflowEnabled;
        BSSActionName1 = arFormConfig.BSSActionName1;
        BSSActionName2 = arFormConfig.BSSActionName2;
        BSSActionName3 = arFormConfig.BSSActionName3;
        BSSActionName4 = arFormConfig.BSSActionName4;
        BSSActionName5 = arFormConfig.BSSActionName5;
        BSSActionName6 = arFormConfig.BSSActionName6;



        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetPrivileges.php?BSSFormName=" + BSSFormName + "&BSSUserId" + BSSUserId, false );
        xmlHttp.send( null );
        //alert("Privs Config String:  " + xmlHttp.responseText);
        arFormPrivs = eval( "(" + xmlHttp.responseText + ")" );


        BSSCREATEMASTER  = arFormPrivs.CREATEMASTER;
        BSSREADMASTER = arFormPrivs.READMASTER;
        BSSUPDATEMASTER = arFormPrivs.UPDATEMASTER;
        BSSDELETEMASTER = arFormPrivs.DELETEMASTER;
        BSSCREATECHILD = arFormPrivs.CREATECHILD;
        BSSREADCHILD = arFormPrivs.READCHILD;
        BSSUPDATECHILD = arFormPrivs.UPDATECHILD;
        BSSDELETECHILD = arFormPrivs.DELETECHILD;
        BSSCREATEWORKFLOW = arFormPrivs.CREATEWORKFLOW;
        BSSADDREMOVEAPPROVERS = arFormPrivs.ADDREMOVEAPPROVERS;
        BSSPROMOTEWORKFLOW = arFormPrivs.PROMOTEWORKFLOW;
        BSSSIGNOFF = arFormPrivs.SIGNOFF;
        BSSREADDOCUMENTS = arFormPrivs.READDOCUMENTS;
        BSSADDDOCUMENTS = arFormPrivs.ADDDOCUMENTS;
        BSSUPDATEDOCUMENTS = arFormPrivs.UPDATEDOCUMENTS;
        BSSDELETEDOCUMENTS = arFormPrivs.DELETEDOCUMENTS;
        BSSCHECKINCHECKOUT = arFormPrivs.CHECKINCHECKOUT;
        BSSGETDOCUMENTS = arFormPrivs.GETDOCUMENTS;
        BSSVIEWDISCUSSIONS = arFormPrivs.VIEWDISCUSSIONS;
        BSSADDDISCUSSIONS = arFormPrivs.ADDDISCUSSIONS;
        BSSUPDATEDISCUSSIONS = arFormPrivs.UPDATEDISCUSSIONS;
        BSSDELETEDISCUSSIONS = arFormPrivs.DELETEDISCUSSIONS;
        BSSVIEWHISTORY = arFormPrivs.VIEWHISTORY;

        if(BSSCREATEMASTER!="0"){BSSCREATEMASTER_FLAG = false}
        if(BSSREADMASTER!="0"){BSSREADMASTER_FLAG = false}
        if(BSSUPDATEMASTER!="0"){BSSUPDATEMASTER_FLAG = false}
        if(BSSDELETEMASTER!="0"){BSSDELETEMASTER_FLAG = false}
        if(BSSCREATECHILD!="0"){BSSCREATECHILD_FLAG = false}
        if(BSSREADCHILD!="0"){BSSREADCHILD_FLAG = false}
        if(BSSUPDATECHILD!="0"){BSSUPDATECHILD_FLAG = false}
        if(BSSDELETECHILD!="0"){BSSDELETECHILD_FLAG = false}
        if(BSSCREATEWORKFLOW!="0"){BSSCREATEWORKFLOW_FLAG = false}
        if(BSSADDREMOVEAPPROVERS!="0"){BSSADDREMOVEAPPROVERS_FLAG = false}
        if(BSSPROMOTEWORKFLOW!="0"){BSSPROMOTEWORKFLOW_FLAG = false}
        if(BSSSIGNOFF!="0"){BSSSIGNOFF_FLAG = false}
        if(BSSREADDOCUMENTS!="0"){BSSREADDOCUMENTS_FLAG = true}
        if(BSSADDDOCUMENTS!="0"){BSSADDDOCUMENTS_FLAG = false}
        if(BSSUPDATEDOCUMENTS!="0"){BSSUPDATEDOCUMENTS_FLAG = false}
        if(BSSDELETEDOCUMENTS!="0"){BSSDELETEDOCUMENTS_FLAG = false}
        if(BSSCHECKINCHECKOUT!="0"){BSSCHECKINCHECKOUT_FLAG = false}
        if(BSSGETDOCUMENTS!="0"){BSSGETDOCUMENTS_FLAG = false}
        if(BSSVIEWDISCUSSIONS!="0"){BSSVIEWDISCUSSIONS_FLAG = true}
        if(BSSADDDISCUSSIONS!="0"){BSSADDDISCUSSIONS_FLAG = false}
        if(BSSUPDATEDISCUSSIONS!="0"){BSSUPDATEDISCUSSIONS_FLAG = false}
        if(BSSDELETEDISCUSSIONS!="0"){BSSDELETEDISCUSSIONS_FLAG = false}
        if(BSSVIEWHISTORY!="0"){BSSVIEWHISTORY_FLAG = true}



        //Get the Master DataStore
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetStore.php?BSSConfigName=" + arFormConfig.MasterTable, false );
        xmlHttp.send( null );
        //alert("Master Store String:  " + xmlHttp.responseText);

        try{
            masterStore = Ext.create('Ext.data.Store', eval('(' + xmlHttp.responseText + ')'));
        }catch(e)
            {alert(e.message);}

        //document.write("<p>"+ "Store String:  " + "HERE2" + "</p>");



          //Get the Master Grid Configuration

         try{
          var xmlHttp = null;
          xmlHttp = new XMLHttpRequest();
          xmlHttp.open( "GET", "BSSGetConfig.php?BSSConfigName=" + arFormConfig.MasterTable + "&BSSConfigMode=MASTER&BSSUserId=" + userid, false );
          xmlHttp.send( null );

          //alert(xmlHttp.responseText);

          mastergrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));

          }catch(e)
           {alert('Master Grid Config Error: ' +e.message);
          }


          //alert(arFormConfig.MasterTable);

          //Get the Child Grid Configuration

        //Get the Child DataStore
         if(arFormConfig.ChildTable.length > 0){
            var xmlHttp = null;
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetStore.php?BSSConfigName=" + arFormConfig.ChildTable, false );
            xmlHttp.send( null );
         //   alert("Child Store String:  " + xmlHttp.responseText);

            try{
                childStore = Ext.create('Ext.data.Store', eval('(' + xmlHttp.responseText + ')'));
            }catch(e)
                {alert(e.message);}
         }

        if(BSSChildConfigName.length > 1){
              try{
              var xmlHttp = null;
              xmlHttp = new XMLHttpRequest();
              xmlHttp.open( "GET", "BSSGetConfig.php?BSSConfigName=" + arFormConfig.ChildTable + "&BSSConfigMode=CHILD", false );
              xmlHttp.send( null );

           //    alert('CHILD GRID CONFIG:' + xmlHttp.responseText);

              childgrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));

              }catch(e)
               {alert('Child Grid Config Error: ' + e.message);
              }
         }



          try{
               //Get the data
              xmlHttp = new XMLHttpRequest();
              varQueryId = 0;
//              xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + arFormConfig.MasterTable + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );
              xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + arFormConfig.MasterTable + "&BSSQueryId=" + varQueryId + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );

              xmlHttp.send( null );
             // alert("DATA: " + xmlHttp.responseText);
              var newdata = eval('[' + xmlHttp.responseText + ']');
              masterStore.loadData(newdata,false);
          }catch(e)
              {document.write("<p>" + "Master Data Get ERROR: " + e.message + "</p>");
          }


          btnact1 = Ext.create('Ext.Button', {
              name: 'Action1',
              x: 1000,
              y: 60,
              width: 100,
              text: BSSActionName1,
              handler: function() {
                  DoAction(BSSAction1);
              }
          });

          btnact2 = Ext.create('Ext.Button', {
              name: 'Action2',
              x: 1000,
              y: 90,
              width: 100,
              text: BSSActionName2,
              handler: function() {
                  DoAction(BSSAction2);
              }
          });

          btnact3 = Ext.create('Ext.Button', {
              name: 'Action3',
              x: 1000,
              y: 120,
              width: 100,
              text: BSSActionName3,
              handler: function() {
                  DoAction(BSSAction3);
              }
          });

          btnact4 = Ext.create('Ext.Button', {
              name: 'Action4',
              x: 1000,
              y: 150,
              width: 100,
              text: BSSActionName4,
              handler: function() {
                  DoAction(BSSAction4);
              }
          });

          btnact5 = Ext.create('Ext.Button', {
              name: 'Action5',
              x: 1000,
              y: 180,
              width: 100,
              text: BSSActionName5,
              handler: function() {
                  DoAction(BSSAction5);
              }
          });

        btnact6 = Ext.create('Ext.Button', {
              name: 'Action6',
              x: 1000,
              y: 210,
              width: 100,
              text: BSSActionName6,
              handler: function() {
                  DoAction(BSSAction6);
              }
          });

        AddWorkflow = Ext.create('Ext.Button', {
            name: 'AddWorkflow',
            x: 450,
            y: 10,
            width: 100,
            disabled: BSSCREATEWORKFLOW_FLAG,
            text: 'Add Workflow',
            handler: function() {
                CreateWorkflow();
            }
        });

        AddApprover = Ext.create('Ext.Button', {
            name: 'AddApprover',
            x: 680,
            y: 10,
            width: 100,
            disabled: BSSADDREMOVEAPPROVERS_FLAG,
            text: 'Add Approver',
            handler: function() {
                AddApprovers();
            }
        });

        RemoveApprover = Ext.create('Ext.Button', {
            name: 'RemoveApprover',
            x: 820,
            y: 10,
            width: 100,
            disabled: BSSADDREMOVEAPPROVERS_FLAG,
            text: 'Remove Approver',
            handler: function() {
                removeApprovers();
            }
        });



        // to use for the editor at each header.
          documents = Ext.create('Ext.grid.Panel', {
              name: 'documentgrid',
              store: documentStore,
              selModel: 'cellmodel',
              columns: [
                  {name: 'iddoc',
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
                  {name: 'masteriddocs',
                  header: 'Id',
                  disabled: true,
                  listeners: {
                  beforeedit: function(){
                                  return false;
                              }},
                  width: 20,
                  dataIndex: 'masterid',
                  editor: {
                      allowBlank: false
                  }
                  },{name: 'sequencedocs',
                  header: 'Id',
                  disabled: true,
                  listeners: {
                  beforeedit: function(){
                                  return false;
                  }
                  },
                  width: 20,
                  dataIndex: 'sequence',
                  editor: {
                      allowBlank: false
                  }
                  },
                  {name: 'idfilename',
                      header: 'Filename',
                      disabled: false,
                      width: 100,
                      dataIndex: 'filename',
                      editor: {
                          allowBlank: false
                      }
                  },
                  {name: 'idDocumentUser',
                  header: 'Document User',
                  disabled: false,
                  width: 200,
                  dataIndex: 'documentuser',
                      editor:
                      { xtype: 'combobox',
                          typeAhead: true,
                          selectOnTab: true,
                          triggerAction: 'all',
                          fields:['id','value'],
                          store: userliststore, //[[1, 'GLOBAL'],[2, 'USER']],
                          valueField:'id',
                          displayField:'value',
                          multiSelect: false,
                          queryMode: 'local',
                          lazyRender: true,
                          listClass: 'x-combo-list-small'},
                      renderer: function(val) {var matching =  userliststore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}

                  },
                  {name: 'idDocDate',
                  header: 'Document Date',
                  disabled: false,
                  width: 150,
                  dataIndex: 'documentdate',
                  editor: {
                  allowBlank: false
                  }
                  },
                  {name: 'idDocName',
                  header: 'Document Name',
                  disabled: false,
                  width: 300,
                  dataIndex: 'documentname',
                  editor: {
                     allowBlank: false
                  }
                  },
                  /*
                  {name: 'idCheckOutUser',
                  header: 'Check Out User',
                  width: 200,
                  editable: false,
                  dataIndex: 'checkoutuser',
                  editor: {
                      allowBlank: true
                  }
                  },   */
                  {name: 'idCheckOutUser',
                      header: 'Chwck Out User',
                      disabled: false,
                      width: 200,
                      dataIndex: 'checkoutuser',
                      editor:
                      { xtype: 'combobox',
                          typeAhead: true,
                          selectOnTab: true,
                          triggerAction: 'all',
                          fields:['id','value'],
                          store: userliststore, //[[1, 'GLOBAL'],[2, 'USER']],
                          valueField:'id',
                          displayField:'value',
                          multiSelect: false,
                          queryMode: 'local',
                          lazyRender: true,
                          listClass: 'x-combo-list-small'},
                      renderer: function(val) {var matching =  userliststore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}

                  },
                  {name: 'idDocDescription',
                  header: 'Document Description',
                  disabled: false,
                  width: 400,
                  dataIndex: 'documentdescription',
                  editor: {
                  allowBlank: false
                  }
                  },
                  {name: 'idDocRevision',
                  header: 'Document Revision',
                  disabled: false,
                  width: 100,
                  dataIndex: 'documentrevision',
                  editor: {
                      allowBlank: false
                  }
                  },
                  {name: 'idDocVersion',
                  header: 'Document Version',
                  disabled: false,
                  width: 100,
                  dataIndex: 'documentversion',
                  editor: {
                      allowBlank: false
                  }
              }],
              width: 960,
              height: 300,
              x: 0,
              y: 0,
              title: 'Documents',
              frame: true,
              tbar: [{text: 'Add',disabled: BSSADDDOCUMENTS_FLAG, handler : function() {processDocumentAdd("Add");}},
                     {text: 'Update',disabled: BSSUPDATEDOCUMENTS_FLAG, handler : function() {processDocumentUpdate();}},
                     {text: 'Delete',disabled: BSSDELETEDOCUMENTS_FLAG, handler : function() {processDocumentDelete();}},
                     {text: 'Get',disabled: BSSGETDOCUMENTS_FLAG,   handler : function() {processDocumentGet();}},
                     {text: 'Check Out', disabled: BSSCHECKINCHECKOUT_FLAG, handler : function() {processDocumentCheckOut();}},
                     {text: 'Cancel Check Out',disabled: BSSCHECKINCHECKOUT_FLAG, handler : function() {processCheckInOutOperation("CancelCheckOut");}},
                     {text: 'Check In',disabled: BSSCHECKINCHECKOUT_FLAG, handler : function() {processDocumentCheckIn();}},
                     {text: 'Versions', handler : function() {processViewVersions();}}
              ],
              plugins: [cellEditing2]
          });


          // to use for the editor at each header.
          discussions = Ext.create('Ext.grid.Panel', {
              name: 'discussiongrid',
              store: discussionStore,
              selModel: 'cellmodel',
              columns: [
                  {name: 'iddisc',
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

                  },{name: 'sequencedisc',
                      header: 'Id',
                      disabled: true,
                      listeners: {
                          beforeedit: function(){
                              return false;
                          }},
                      width: 20,
                      dataIndex: 'sequence',
                      editor: {
                          allowBlank: false
                      }
                  },
                  {name: 'masteriddisc',
                  header: 'Id',
                  disabled: true,
                  listeners: {
                  beforeedit: function(){
                                  return false;
                              }},
                  width: 20,
                  dataIndex: 'masterid',
                  editor: {
                      allowBlank: false
                  }

                  },
                  {name: 'idDiscussionUser',
                  header: 'Discussion User',
                  disabled: false,
                  width: 180,
                  dataIndex: 'discussionuser',
                      editor:
                      { xtype: 'combobox',
                          typeAhead: true,
                          selectOnTab: true,
                          triggerAction: 'all',
                          fields:['id','value'],
                          store: userliststore, //[[1, 'GLOBAL'],[2, 'USER']],
                          valueField:'id',
                          displayField:'value',
                          multiSelect: false,
                          queryMode: 'local',
                          lazyRender: true,
                          listClass: 'x-combo-list-small'},
                      renderer: function(val) {var matching =  userliststore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}

                  },
                  {name: 'idDiscussionDate',
                  header: 'Discussion Date',
                  disabled: false,
                  format: 'Y-m-d H:i:s',
                  width: 150,
                  dataIndex: 'discussiondate',
                  editor:{xtype: 'datefield',
                          format: 'Y-m-d H:i:s',
                          minValue: '01/01/06',
                         disabled: true,
                    disabledDays: [0, 6],
                 disabledDaysText: 'Not available on the weekends' }
                  },
                  {name: 'iddiscussiontext',
                  header: 'Discussion Text',
                  width: 560,
                  editable: false,
                  dataIndex: 'discussiontext',
                  editor: {
                      allowBlank: true
                  }
              }],
              width: 960,
              height: 300,
              x: 0,
              y: 0,
              title: 'Discussions',
              frame: true,
              tbar: [{text: 'Add',disabled: BSSADDDISCUSSIONS_FLAG, handler : function() {processInsert("Discussions",discussions,discussionStore);}},
                     {text: 'Udpate',disabled: BSSUPDATEDISCUSSIONS_FLAG, handler : function() {processUpdate("Discussions",discussions,discussionStore);}},
                     {text: 'Delete',disabled: BSSDELETEDISCUSSIONS_FLAG,  handler : function() {processDelete("Discussions",discussions,discussionStore);}}
              ],
              plugins: [cellEditing3]
          });


                      // to use for the editor at each header.
          history = Ext.create('Ext.grid.Panel', {
              name: 'historygrid',
              store: historyStore,
              selModel: 'cellmodel',
              columns: [
                  {name: 'idhist',
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
                  {name: 'masteridhist',
                  header: 'Id',
                  disabled: true,
                  listeners: {
                  beforeedit: function(){
                                  return false;
                              }},
                  width: 20,
                  dataIndex: 'masterid',
                  editor: {
                      allowBlank: false
                  }
                  },{name: 'sequencehist',
                  header: 'Id',
                  disabled: true,
                  listeners: {
                  beforeedit: function(){
                                  return false;
                  }},
                  width: 20,
                  dataIndex: 'sequence',
                  editor: {
                      allowBlank: false
                  }
                  },
             //     {name: 'idHistoryUser',
             //     header: 'History User',
             //     disabled: false,
             //     width: 200,
             //     dataIndex: 'historyuser',
             //     editor: {
             //     allowBlank: false
             //     }
             //     },


                  {name: 'idHistoryUser',
                      header: 'History User',
                      disabled: false,
                      width: 180,
                      dataIndex: 'historyuser',
                      editor:
                      { xtype: 'combobox',
                          typeAhead: true,
                          selectOnTab: true,
                          disabled: true,
                          triggerAction: 'all',
                          fields:['id','value'],
                          store: userliststore, //[[1, 'GLOBAL'],[2, 'USER']],
                          valueField:'id',
                          displayField:'value',
                          multiSelect: false,
                          queryMode: 'local',
                          lazyRender: true,
                          listClass: 'x-combo-list-small'},
                      renderer: function(val) {var matching =  userliststore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}
                  },


                  {name: 'idhistorydate',
                  header: 'Date',
                  width: 240,
                  editable: false,
                  dataIndex: 'historydate',
                  editor: {
                      allowBlank: true
                  }
                  },
                  {name: 'idHistoryText',
                  header: 'History Text',
                  disabled: false,
                  width: 500,
                  dataIndex: 'historytext',
                  editor: {
                  allowBlank: false
                  }
              }],
              width: 960,
              height: 300,
              x: 0,
              y: 0,
              title: 'History',
              frame: true,
              plugins: [cellEditing4]
          });




        // to use for the editor at each header.
        workflows = Ext.create('Ext.grid.Panel', {
            name: 'workflowgrid',
            store: workflowinstanceStore,
            selModel: 'cellmodel',
            listeners: {itemclick: function() {GetSignOffs();}},
            columns: [
                {name: 'idworkflow',
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
                {name: 'masteridworkflow',
                    header: 'Id',
                    disabled: true,
                    listeners: {
                        beforeedit: function(){
                            return false;
                        }},
                    width: 20,
                    dataIndex: 'masterid',
                    editor: {
                        allowBlank: false
                    }
                },{name: 'sequenceworkflow',
                    header: 'Id',
                    disabled: true,
                    listeners: {
                        beforeedit: function(){
                            return false;
                        }},
                    width: 20,
                    dataIndex: 'sequence',
                    editor: {
                        allowBlank: false
                    }
                },
                {name: 'idWorkflowName',
                    header: 'Workflow Name',
                    disabled: false,
                    width: 200,
                    dataIndex: 'WorkflowName',
                    editor: {
                        allowBlank: false
                    }
                },
                {name: 'idWorkflowdescription',
                    header: 'Workflow Description',
                    disabled: false,
                    width: 300,
                    dataIndex: 'Workflowdescription',
                    editor: {
                        allowBlank: false
                    }
                },

        //        {name: 'idRevision',
        //            header: 'Revision',
        //            disabled: false,
        //            width: 200,
        //            dataIndex: 'Revision',
        //            editor: {
        //                allowBlank: false
        //            }
        //        },



        //        {name: 'idCurrentStatus',
        //           header: 'Current Status',
        //            disabled: false,
        //            width: 200,
        //            dataIndex: 'CurrentStatus',
        //            editor:
        //            { xtype: 'combobox',
        //                typeAhead: true,
                //                selectOnTab: true,
                //                triggerAction: 'all',
                //         fields:['id','value'],
                //        store: workflowstatusliststore, //[[1, 'GLOBAL'],[2, 'USER']],
                //        valueField:'id',
                //        displayField:'value',
                //        multiSelect: false,
                //        queryMode: 'local',
                //        lazyRender: true,
                //        listClass: 'x-combo-list-small'},
                //    renderer: function(val) {var matching =  workflowstatusliststore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}
                //
                //
                //},


        //        {name: 'idPendingComplete',
        //            header: 'Pending Complete',
        //            width: 100,
        //            editable: false,
        //            dataIndex: 'PendingComplete',
        //            editor: {
        //                allowBlank: true
        //            }
        //        },
        //        {name: 'idSubmitComplete',
       //             header: 'Submit Complete',
       //             disabled: false,
        //            width: 100,
         //           dataIndex: 'SubmitComplete',
         //           editor: {
         //               allowBlank: false
         //           }
         //       },
       //         {name: 'idReviewComplete',
       //             header: 'Review Complete',
       //             disabled: false,
       //             width: 100,
       //             dataIndex: 'ReviewComplete',
       //             editor: {
       //                 allowBlank: false
       //             }
        //        },
                {name: 'idcreatedate',
                    header: 'Create Date',
                    disabled: false,
                    width: 200,
                    dataIndex: 'createdate',
                    editor: {
                        allowBlank: false
                    }
                },
                {name: 'idComplete',
                    header: 'Complete Date',
                    disabled: false,
                    width: 200,
                    dataIndex: 'completedate',
                    editor: {
                        allowBlank: false
                    }
                }],
            width: 980,
            height: 270,
            x: 10,
            y: 40,
            title: 'Workflows',
            frame: true,
            tbar: [
                {text: 'Cancel',disabled: BSSPROMOTEWORKFLOW_FLAG, handler : function() {CancelWorkflow("Workflows");}},
                {text: 'Delete',disabled: BSSPROMOTEWORKFLOW_FLAG, handler : function() {DeleteWorkflow("Workflows");}},
                {text: 'Open Flow',disabled: BSSPROMOTEWORKFLOW_FLAG,handler : function() {OpenWorkflow("Workflows");}}
            ],
            plugins: [cellEditing5]
        });


       // {name: 'id', type: 'string'},
      //  {name: 'masterid', type: 'string'},
      //  {name: 'sequence', type: 'string'},
      //  {name: 'WorkflowApprover', type: 'string'},
      //  {name: 'SignoffDate', type: 'string'},
      //  {name: 'SignoffResult', type: 'string'},
      //  {name: 'Comments', type: 'string'}

        // to use for the editor at each header.
        signoffs = Ext.create('Ext.grid.Panel', {
            name: 'signoffgrid',
            store: signoffsStore,
            listeners: {itemclick: function() {alert('SSS');}},
            selModel: 'cellmodel',
            columns: [
                {name: 'idsignoff',
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
                {name: 'masteridsignoff',
                    header: 'Id',
                    disabled: true,
                    listeners: {
                        beforeedit: function(){
                            return false;
                        }},
                    width: 20,
                    dataIndex: 'masterid',
                    editor: {
                        allowBlank: false
                    }
                },{name: 'sequenceasignoff',
                    header: 'Id',
                    disabled: true,
                    listeners: {
                        beforeedit: function(){
                            return false;
                        }},
                    width: 20,
                    dataIndex: 'sequence',
                    editor: {
                        allowBlank: false
                    }
                },
                {name: 'idWorkflowApprover',
                    header: 'Workflow Approver',
                    disabled: false,
                    width: 180,
                    dataIndex: 'WorkflowApprover',
                    editor:
                    { xtype: 'combobox',
                        typeAhead: true,
                        selectOnTab: true,
                        triggerAction: 'all',
                        fields:['id','value'],
                        store: userliststore, //[[1, 'GLOBAL'],[2, 'USER']],
                        valueField:'id',
                        displayField:'value',
                        multiSelect: false,
                        queryMode: 'local',
                        lazyRender: true,
                        listClass: 'x-combo-list-small'},
                    renderer: function(val) {var matching =  userliststore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}
                },

                {name: 'idSignoffDate',
                    header: 'Signoff Date',
                    disabled: false,
                    width: 180,
                    dataIndex: 'SignoffDate',
                    editor: {
                        allowBlank: false
                    }
                },

                {name: 'idSignoffResult',
                    header: 'Signoff Result',
                    disabled: false,
                    width: 200,
                    dataIndex: 'SignoffResult',
                    editor:
                    { xtype: 'combobox',
                        typeAhead: true,
                        selectOnTab: true,
                        triggerAction: 'all',
                        fields:['id','value'],
                        store: workflowapprovalstatusliststore, //[[1, 'GLOBAL'],[2, 'USER']],
                        valueField:'id',
                        displayField:'value',
                        multiSelect: false,
                        queryMode: 'local',
                        lazyRender: true,
                        listClass: 'x-combo-list-small'},
                    renderer: function(val) {var matching =  workflowapprovalstatusliststore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}


                },
                {name: 'idComments',
                    header: 'Comments',
                    disabled: false,
                    width: 100,
                    dataIndex: 'Comments',
                    editor: {
                        allowBlank: false
                    }
                }],
            width: 350,
            height: 270,
            x: 630,
            y: 40,
            title: 'Approval Status',
            frame: true,
            tbar: [{text: 'Approve',disabled: BSSSIGNOFF_FLAG, handler : function() {ApproveWorkflow("Workflows");}},
                {text: 'Reject',disabled: BSSSIGNOFF_FLAG, handler : function() {RejectWorkflow("Workflows");}}
            ],
            plugins: [cellEditing6]
        });


        //Get the data
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetComboStore.php?BSSSQLString=SELECT id, Email AS value FROM users", false ); //+  selrecords[0].get('TableId')
        xmlHttp.send( null );
        //alert("DATA: " + xmlHttp.responseText);
        bssUserData = eval('[' + xmlHttp.responseText + ']');
        userliststore.loadData(bssUserData,false);


        //Get the data
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetComboStore.php?BSSSQLString=SELECT id, WorkflowName AS value FROM AdvWorkflows", false ); //+  selrecords[0].get('TableId')
        xmlHttp.send( null );
        //alert("DATA: " + xmlHttp.responseText);
        bssWorkflowData = eval('[' + xmlHttp.responseText + ']');
        workflowliststore.loadData(bssWorkflowData,false);

        //Get the workflow status list data
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetComboStore.php?BSSSQLString=SELECT id, WorkflowStatus FROM WorkflowStatuses", false ); //+  selrecords[0].get('TableId')
        xmlHttp.send( null );
        //alert("DATA: " + xmlHttp.responseText);
        bssWorkflowStatusData = eval('[' + xmlHttp.responseText + ']');
        workflowstatusliststore.loadData(bssWorkflowStatusData,false);


        //Get the workflow approval status list data
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetComboStore.php?BSSSQLString=SELECT id, ApprovalType FROM ApprovalTypes", false ); //+  selrecords[0].get('TableId')
        xmlHttp.send( null );
        //alert("DATA: " + xmlHttp.responseText);
        bssWorkflowApprovalStatusData = eval('[' + xmlHttp.responseText + ']');
        workflowapprovalstatusliststore.loadData(bssWorkflowApprovalStatusData,false);



        // Create the combo box, attached to the states data store
        comboWorkflow = Ext.create('Ext.form.ComboBox', {
         //   listeners:{
          //      select: function() {RunQuery();}
          //  },
            fieldLabel: 'Add Workflow',
            queryMode: 'local',
            fields:['id', 'value'],
            store: workflowliststore,
            displayField: 'value',
            valueField: 'id',
            grow: true,
            labelPad: 10,
            labelWidth: 100,
            labelAlign: 'right',
            width: 400,
            //  height: 20,
            x: 20,
            y: 10
        });


        childtabs = Ext.createWidget('tabpanel', {
              renderTo: document.body,
              activeTab: 0,
              x: 20,
              y: 300,
              width: 1000,
              height: 350,
              plain: true,
              defaults :{
                  autoScroll: true,
                  bodyPadding: 10
              },
              items: [{
                      title: 'Children',
                      items: childgrid
                    //  listeners: {activate: function() {GetChildren();}}
                  },{
                      title: 'Workflow',
                      layout:'absolute',
                      items: [comboWorkflow, workflows, AddWorkflow],   //[comboWorkflow, workflows, AddWorkflow, AddApprover, RemoveApprover, signoffs],
                      listeners: {activate: function() {GetWorkflows();}}
                  },{
                      title: 'Documents',
                      items: documents,
                      listeners: {activate: function() {GetDocuments();}}


                  },{
                      title: 'Discussions',
                      disabled: false,
                      items: discussions,
                      listeners: {activate: function() {GetDiscussions();}}

                  }
                  ,{
                      title: 'History',
                      disabled: false,
                      items: history,
                      listeners: {activate: function() {GetHistory();}}
                   }
              ]
          });

        /*

        querystore = Ext.create('Ext.data.Store', {
            fields: ['id', 'name'],
            data : [
                {"value":"1", "name":"TEST"}
            ]
        });
*/

        bssQueryNameData = [ { id:1, value: 'A'},{ id:2, value: 'B'}];

        querystore = Ext.create('Ext.data.Store', {
                         fields: [{name: 'id'}, {name: 'value'} ],
                         data: bssQueryNameData
                         }
                         );

//, listeners: {itemclick: function() {ProcessChildTab();}}

        // Create the combo box, attached to the states data store
            comboQuery = Ext.create('Ext.form.ComboBox', {
                listeners:{
                  select: function() {RunQuery();}
                  },
            fieldLabel: 'Query',
            queryMode: 'local',
            fields:['id', 'value'],
            store: querystore,
            displayField: 'value',
            valueField: 'id',
            grow: true,
            labelPad: 10,
            labelWidth: 50,
            labelAlign: 'right',
            width: 400,
          //  height: 20,
            x: 15,
            y: 14
        });



                     //Get the data
            xmlHttp = new XMLHttpRequest();

       // alert(BSSMasterConfigName);

            xmlHttp.open( "GET", "BSSGetComboStore.php?BSSSQLString=SELECT id, QueryName AS name FROM Queries WHERE TableId IN (SELECT id FROM Tables WHERE TableName = '" + BSSMasterConfigName + "')", false );
                //" WHERE masterid = " + selrecords[0].get('TableId'), false ); //+  selrecords[0].get('TableId')
            xmlHttp.send( null );
            //alert("DATA: " + xmlHttp.responseText);

          bssQueryNameData = eval('[' + xmlHttp.responseText + ']');
          querystore.loadData(bssQueryNameData,false);

          absolute1 = Ext.create('Ext.window.Window', {
             title: 'Enterprise Object: ' + BSSFormName,
             x: 50,
             y: 50,
             width: 1200,
             height: 700,
             layout:'absolute',
             listeners: {
                  close: function(){
                      this.destroy();
                  }},
             defaults: {
             bodyStyle: 'padding:10px'
             },
             items: [mastergrid] //, comboQuery]
             });


        if(BSSChildConfigName.length != 0 ||
           BSSDocumentsEnabled.length > 0 ||
           BSSDiscussionsEnabled.length > 0 ||
           BSSHistoryEnabled.length > 0 ||
           BSSWorkflowEnabled.length > 0)
          {
          absolute1.items.add(childtabs);
          }

          if(BSSAction1 != 0){absolute1.items.add(btnact1)};
          if(BSSAction2 != 0){absolute1.items.add(btnact2)};
          if(BSSAction3 != 0){absolute1.items.add(btnact3)};
          if(BSSAction4 != 0){absolute1.items.add(btnact4)};
          if(BSSAction5 != 0){absolute1.items.add(btnact5)};
          if(BSSAction6 != 0){absolute1.items.add(btnact6)};

          absolute1.show();


        try{
    //    childtabs.items[1].visible = false;
        }
    catch(e)
        {alert(e.message);}

  //        mastergrid.setSelection(1);


}}

);


//document.write("<p>"+ "Store String:  " + "HERE3" + "</p>");

function RunQuery(){

   // alert('run query: ' + comboQuery.getValue());

    var varQueryId = comboQuery.getValue();

    try{
         //Get the data
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + arFormConfig.MasterTable + "&BSSQueryId=" + varQueryId + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );
        xmlHttp.send( null );
        //document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
        var newdata = eval('[' + xmlHttp.responseText + ']');
        masterStore.loadData(newdata,false);
    }catch(e)
        {document.write("<p>" + "Master Data Get ERROR: " + e.message + "</p>");
    }


}


function processInsert(BSSConfigName, BSSGrid, BSSStore)
{
// alert(BSSChildConfigName);
//  alert(BSSMasterConfigName);
  //alert(BSSConfigName);
var idval;
idval = 0;

if(BSSConfigName == BSSChildConfigName || BSSConfigName == 'Discussions'){
try{

    var sm = mastergrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(sm.getCount() > 0){
        var fieldname = "id";
        idval = selrecords[0].get('id');
        // sequenceval = selrecords[0].get('sequence');
        alert(idval);
    }

}catch(e)
    {document.write(alert(e.message));
}

}


try{
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSPerformInsert.php?BSSConfigName=" + BSSConfigName + "&masterid=" + idval + "&EnterpriseObjectId=" + BSSEnterpriseObjectId +  "&userid=" + BSSUserId,  false );
    xmlHttp.send(null);

//    alert("BSSPerformInsert.php?BSSConfigName=" + BSSConfigName + "&masterid=" + idval + "&EnterpriseObjectId=" + BSSEnterpriseObjectId +  "&userid=" + BSSUserId);

  //  alert(xmlHttp.responseText);

    newdata = eval('[' + xmlHttp.responseText + ']');

    BSSStore.add(newdata);
    }catch(e)
        {document.write("<p>" + e.message + "</p>");
    }


}



function processDelete(delBSSConfigName, delBSSGrid, delBSSStore)
{

      var sm = delBSSGrid.getSelectionModel();
      delBSSStore.remove(sm.getSelection());

        if (delBSSStore.getCount() > 0) {
            sm.select(0);
        }

      var delrecords = delBSSStore.getRemovedRecords();

      var fieldname = "id";

    //"&id=" + delrecords[0].get('id'),

    try{
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSPerformDelete.php?BSSConfigName=" + delBSSConfigName + "&id=" + delrecords[0].get('id') + "&masterid=" + delrecords[0].get('masterid') + "&userid=" + BSSUserId, false);
        xmlHttp.send(null);

   //     alert(xmlHttp.responseText);

        delBSSStore.removed = [];

    }catch(e)
        {document.write("<p>" + e.message + "</p>");
    }


}

function ProcessChildTab()
{
    //childtabs.getActiveTab().title)\

    switch(childtabs.getActiveTab().title){
    case "Children":
        GetChildData();
    break;
    case "Workflow":
        GetWorkflows();
    break;
    case "Documents":
        GetDocuments();
    break;
    case "Discussions":
        GetDiscussions();
    break;
    case "History":
        GetHistory();
    break;
    default:

    }


}


function GetChildData()
{
    //alert(childtabs.getSelected());


    if(arFormConfig.ChildTable.length < 1){return;}

    var sm = mastergrid.getSelectionModel();
   // if (sm.getSelection().getCount() = 0) {
   //     return;
   // }
    var selrecords = sm.getSelection();
    var fieldname = "id";

    try{
         //Get the data
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + arFormConfig.ChildTable + "&BSSWhereClause=" + "masterid=" +  selrecords[0].get('id') + " and sequence=" + BSSEnterpriseObjectId, false );
        xmlHttp.send( null );

      //  alert("CHILD DATA: " + xmlHttp.responseText);

        var newdata1 = eval('[' + xmlHttp.responseText + ']');
        childStore.loadData(newdata1,false);
        }catch(e)
            {alert("CHILD DATA LOAD ERROR: " + e.message);
        }

}


function GetHistory()
{

//    alert('Here' + childtabs.getActiveTab().title);

    if(BSSVIEWHISTORY_FLAG = false){return;}

    var sm = mastergrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(selrecords == ''){return;}
    var fieldname = "id";

    try{

         //Get the history data
        xmlHttp = new XMLHttpRequest();
        //alert("BSSGetJSData.php?BSSConfigName=History&BSSWhereClause=masterid="+  selrecords[0].get('id') + "sequence=" + BSSEnterpriseObjectId + " ORDER BY id DESC");
        xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=History&BSSWhereClause=masterid="+  selrecords[0].get('id') + " and sequence=" + BSSEnterpriseObjectId + " ORDER BY id DESC",false);
        // &BSSWhereClause=" + "masterid>0"); // +  selrecords[0].get('id'), false );
        xmlHttp.send( null );
       // document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
        var newdata1 = eval('[' + xmlHttp.responseText + ']');
        historyStore.loadData(newdata1,false);
        }catch(e)
            {document.write("<p>" + "ERROR: " + e.message + "</p>");
        }

}


function GetDiscussions()
{
    if(BSSVIEWDISCUSSIONS_FLAG = false){return;}

    var sm = mastergrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(selrecords == ''){return;}
    var fieldname = "id";

    try{
         //Get the history data
        xmlHttp = new XMLHttpRequest();

        //alert ("BSSGetJSData.php?BSSConfigName=Discussions&BSSWhereClause=masterid="+  selrecords[0].get('id') + " sequence = " + BSSEnterpriseObjectId + " ORDER BY id DESC");

        xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=Discussions&BSSWhereClause=masterid="+  selrecords[0].get('id') + " and sequence = " + BSSEnterpriseObjectId + " ORDER BY id DESC",false);
        xmlHttp.send( null );
        //alert("DATA: " + xmlHttp.responseText);
        var newdata1 = eval('[' + xmlHttp.responseText + ']');
        discussionStore.loadData(newdata1,false);
        }catch(e)
            {document.write("<p>" + "ERROR: " + e.message + "</p>");
        }
}

function GetDocuments()
{

    if(BSSREADDOCUMENTS_FLAG = false){return;}

    var sm = mastergrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(selrecords == ''){return;}
    var fieldname = "id";

    try{
         //Get the document data
        xmlHttp = new XMLHttpRequest();
      //  alert("BSSGetJSData.php?BSSConfigName=Documents&BSSWhereClause=masterid="+  selrecords[0].get('id') + " and sequence = " + BSSEnterpriseObjectId + " ORDER BY id DESC");

 //       xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=Documents&BSSWhereClause=masterid="+  selrecords[0].get('id') + " sequence = " + BSSEnterpriseObjectId + " ORDER BY id DESC",false);

        xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=Documents&BSSWhereClause=masterid=" + selrecords[0].get('id') + " AND sequence = " + BSSEnterpriseObjectId,false);


        xmlHttp.send( null );
      //  alert("DATA: " + xmlHttp.responseText);
        var newdata1 = eval('[' + xmlHttp.responseText + ']');
        documentStore.loadData(newdata1,false);
        }catch(e)
            {document.write("<p>" + "ERROR: " + e.message + "</p>");
        }

}

function processUpdate(BSSConfigName, BSSGrid, BSSStore)
{


    var sm = mastergrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(selrecords == ''){return;}


    var updrecords = BSSStore.getUpdatedRecords();

    var fieldname = "";
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
    //document.write("<p>"+ jsenc + "</p>");
//alert('save');
try{
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSPerformUpdate.php?BSSConfigName=" + BSSConfigName + "&id=" + jsenc  + "&masterid=" + selrecords[0].get('id') + "&EnterpriseObjectId=" + BSSEnterpriseObjectId+ "&userid=" + BSSUserId, false);
    xmlHttp.send(null);
 //   alert(xmlHttp.responseText);

     //REmove the red triangle
    BSSStore.each(function(r){
      r.commit();
     });


}catch(e)
    {document.write("<p>" + e.message + "</p>");
    }
}




function processDocumentUpdate()
{
    var updrecords = documentStore.getUpdatedRecords();

    var fieldname = "";
    var rec = new documentStore.model();

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
    //document.write("<p>"+ jsenc + "</p>");
    alert('save');
    try{
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSPerformUpdate.php?BSSConfigName=" + "Documents" + "&id=" + jsenc, false);
        xmlHttp.send(null);
     //   alert(xmlHttp.responseText);

        //REmove the red triangle
        documentStore.each(function(r){
            r.commit();
        });


    }catch(e)
    {document.write("<p>" + e.message + "</p>");
    }
}




//    [{text: 'Add',    handler : function() {processDocumentAdd("Documents",documents,documentStore);}},
   //    {text: 'Update', handler : function() {processDocumentUpdate("Documents",documents,documentStore);}},
   //    {text: 'Delete', handler : function() {processDocumentDelete("Documents",documents,documentStore);}},
   //    {text: 'Get',   handler : function() {processDocumentGet("Documents",documents,documentStore);}},
   //    {text: 'Check Out', handler : function() {processDocumentCheckOut("Documents",documents,documentStore);}},
   //    {text: 'Cancel Check Out', handler : function() {processDocumentCancelCheckOut("Documents",documents,documentStore);}},
   //    {text: 'Check In', handler : function() {processDocumentCheckIn("Documents",documents,documentStore);}}


function processDocumentAdd(filemode)
{

    //alert(childtabs.getSelected());
    var sm = mastergrid.getSelectionModel();
    // if (sm.getSelection().getCount() = 0) {
    //     return;
    // }
    var selrecords = sm.getSelection();
    var fieldname = "id";

    var BSSMasterId = selrecords[0].get('id');

   // alert(BSSMasterId);

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


    var fileupload = Ext.create('Ext.form.Panel', {
     //   renderTo: 'editor-grid',
        name: 'idfileupload',
        width: 600,
        frame: true,
        title: 'File Upload Form',
        bodyPadding: '10 10 0',

        defaults: {
            anchor: '100%',
            allowBlank: false,
            msgTarget: 'side',
            labelWidth: 70
        },

        items: [{
            name: 'idfuname',
            name: 'txtfilename',
            xtype: 'textfield',
            fieldLabel: 'Name'
        },{
            name: 'idfudescription',
            name: 'txtdescription',
            xtype: 'textfield',
            fieldLabel: 'Description'
             },
            {
                name: 'idfrevision',
                name: 'txtrevision',
                xtype: 'textfield',
                fieldLabel: 'Revision'
            },
            {
            xtype: 'filefield',
            name: 'form-file',
            emptyText: 'Select a File',
            fieldLabel: 'File',
            name: 'photo-path',
            buttonText: '',
            buttonConfig: {
                iconCls: 'upload-icon'
            }
        }],

        buttons: [{
            text: 'Upload',
            handler: function(){
                var form = this.up('form').getForm();
                if(form.isValid()){
                    var flddescvalue = Ext.getCmp('idfileupload').getForm().findField("idfudescription").getValue();
                    var fldnamevalue = Ext.getCmp('idfileupload').getForm().findField("idfuname").getValue();
                    form.submit({
                        somevar: 'TTTTTTT',
                        url: 'file-upload.php?BSSUserId=' + BSSUserId +"&BSSMasterId=" + BSSMasterId +"&BSSEnterpriseObjectId=" + BSSEnterpriseObjectId,
                        waitMsg: 'Uploading your file...',
                        success: function(fp, o) {
                            msg('Success', 'Processed file "' + o.result.file + '" on the server');
                            try{
                            var flddescvalue = Ext.getCmp('idfileupload').getForm().findField("idfudescription").getValue();
                            var fldnamevalue = Ext.getCmp('idfileupload').getForm().findField("idfuname").getValue();
                            var fldfnamecvalue = o.result.file
                            var masterid = "1";
                            var docdate = 'now()';
                            var docuser = BSSUserId;
                                //alert(filemode);
                            if(filemode == "Add"){
                            var sqlvalues = "'" + masterid + "','" + docuser + "','" + docdate + "','" + fldnamevalue + "','" +  flddescvalue    + "','" +  fldfnamecvalue + "')"
                            var sqlstring = "insert into Documents(masterid,documentuser,documentdate,documentname,documentdescription,filename)values(" + sqlvalues;
                           //   alert(sqlstring);
                            }else{  //CHECKIN
                                var sqlvalues = masterid + "','" + docuser + "','" + docdate + "','" + fldnamevalue + "','" +  flddescvalue    + "','" +  fldfnamecvalue + "')"
                                var sqlstring = "update documents(set documentuser = " + curuser + ",documentdate = " + dateval + ",documentname = '" + fldnamevalue + "',documentdescription = '" + flddescvalue  + "',filename = '" + fldfnamecvalue + "')";
                                //Add insert for fiel version table
                             //     alert(sqlstring);
                            }
                                Ext.getCmp('idfileupload').close();
                                absolutedoc.close();
                                GetDocuments();
                            }catch(e){alert(e.message);}
                            Ext.getCmp('idfileupload').close();
                        }
                    });
                }
            }
        },{
            text: 'Close',
            handler: function() {
                absolutedoc.close();
                this.up('form').getForm().close();
                Ext.getCmp('idfileupload').close();
                GetDocuments();
            }
        }]
    });

    absolutedoc = Ext.create('Ext.window.Window', {
     //  title: 'File Upload',
       width: 610,
       height: 220,
       layout:'absolute',
       defaults: {
       bodyStyle: 'padding:10px'
       },
       items: [fileupload]
       });

    absolutedoc.show();


}


function processDocumentCheckIn()
{

   // alert("Here in check in");

 //   {name: 'id', type: 'string'},
 //   {name: 'masterid', type: 'string'},
 //   {name: 'sequence', type: 'string'},
 //   {name: 'filename', type: 'string'},
 //   {name: 'documentuser', type: 'string'},
 //   {name: 'documentdate', type: 'string'},
 //   {name: 'documentname', type: 'string'},
 //   {name: 'checkoutuser', type: 'string'},
 //   {name: 'documentdescription', type: 'string'},
 //   {name: 'documentrevision', type: 'string'},
 //   {name: 'documentversion', type: 'string'}


    var filemode = "ZZZ";
    var sm = mastergrid.getSelectionModel();
    // if (sm.getSelection().getCount() = 0) {
    //     return;
    // }
    var selrecords = sm.getSelection();
    var fieldname = "id";



    var dm = documents.getSelectionModel();
    var seldocus = dm.getSelection();
    var BSSFileName = seldocus[0].get('documentname');
    var BSSDescription = seldocus[0].get('documentdescription');

    var BSSDocumentId = seldocus[0].get('id');
    var BSSCheckOutUser = seldocus[0].get('checkoutuser');

 //   alert(BSSDocumentId);

    if(BSSCheckOutUser.length == 0){
        alert("File is not checked out");
        return;
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


    var filecheckin = Ext.create('Ext.form.Panel', {
        //   renderTo: 'editor-grid',
        name: 'idfilecheckin',
        width: 600,
        frame: true,
        title: 'File Upload Form',
        bodyPadding: '10 10 0',

        defaults: {
            anchor: '100%',
            allowBlank: false,
            msgTarget: 'side',
            labelWidth: 70
        },

        items: [{
            name: 'idfunamecheckin',
            name: 'txtfilename',
            xtype: 'textfield',
            value: BSSFileName,
            fieldLabel: 'Name'
        },{
            name: 'idfudescriptioncheckin',
            name: 'txtdescription',
            xtype: 'textfield',
            value: BSSDescription,
            fieldLabel: 'Description'
        },
            {
                name: 'idfrevisioncheckin',
                name: 'txtrevision',
                xtype: 'textfield',
                fieldLabel: 'Revision'
            },
            {
                xtype: 'filefield',
                name: 'form-filecheckin',
                emptyText: 'Select a File',
                fieldLabel: 'File',
                name: 'photo-path',
                buttonText: '',
                buttonConfig: {
                    iconCls: 'upload-icon'
                }
            }],

        buttons: [{
            text: 'Check In',
            handler: function(){
                var form = this.up('form').getForm();
                if(form.isValid()){
                    var flddescvalue = Ext.getCmp('idfilecheckin').getForm().findField("idfudescriptioncheckin").getValue();
                    var fldnamevalue = Ext.getCmp('idfilecheckin').getForm().findField("idfunamecheckin").getValue();
                    form.submit({
                        somevar: 'TTTTTTT',
                        url: 'file-checkin.php?BSSUserId=' + BSSUserId +"&BSSMasterId=" + BSSDocumentId,
                        waitMsg: 'Checking your file in...',
                        success: function(fp, o) {
                            msg('Success', 'Processed file "' + o.result.file + '" on the server');
                            try{
                                var flddescvalue = Ext.getCmp('idfilecheckin').getForm().findField("idfudescriptioncheckin").getValue();
                                var fldnamevalue = Ext.getCmp('idfilecheckin').getForm().findField("idfunamecheckin").getValue();
                                var fldfnamecvalue = o.result.file
                                var masterid = "1";
                                var docdate = 'now()';
                                var docuser = BSSUserId;
                                //alert(filemode);
                                if(filemode == "Add"){
                                    var sqlvalues = "'" + masterid + "','" + docuser + "','" + docdate + "','" + fldnamevalue + "','" +  flddescvalue    + "','" +  fldfnamecvalue + "')"
                                    var sqlstring = "insert into Documents(masterid,documentuser,documentdate,documentname,documentdescription,filename)values(" + sqlvalues;
                                    //   alert(sqlstring);
                                }else{  //CHECKIN
                                    var sqlvalues = masterid + "','" + docuser + "','" + docdate + "','" + fldnamevalue + "','" +  flddescvalue    + "','" +  fldfnamecvalue + "')"
                                    //var sqlstring = "update documents(set documentuser = " + curuser + ",documentdate = " + dateval + ",documentname = '" + fldnamevalue + "',documentdescription = '" + flddescvalue  + "',filename = '" + fldfnamecvalue + "')";
                                    //Add insert for fiel version table
                                    //     alert(sqlstring);
                                }
                                Ext.getCmp('idfilecheckin').close();
                                absolutedoc.close();
                                GetDocuments();
                            }catch(e){alert(e.message);}
                            Ext.getCmp('idfilecheckin').close();
                            absolutedoc.close();
                        }
                    });
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
        height: 220,
        layout:'absolute',
        defaults: {
            bodyStyle: 'padding:10px'
        },
        items: [filecheckin]
    });

    absolutedoc.show();


}



function processDocumentGet()
{

    var sm = documents.getSelectionModel();
    var selrecords = sm.getSelection();

    if (sm.getCount() != 1) {
        return;
    }


    var vid = "";
    var filename = "";
    var version = "";
   // vid = selrecords[0].get('id');
   // filename = selrecords[0].get('filename');

    vid = selrecords[0].get('id');
    filename = selrecords[0].get('filename');
    version =  selrecords[0].get('documentversion');

     window.open("BSSDownloadFile.php?BSSid=" + vid + "&BSSFileName=" + filename + "&BSSVersion=" + version);


//    try{
//        var xmlHttp = null;
//        xmlHttp = new XMLHttpRequest();
//        xmlHttp.open( "GET", "BSSDownloadFile.php?BSSid=" + vid + "&BSSfilename=" +filename, true);
//        xmlHttp.send(null);

        // document.write("<p>"+ xmlHttp.responseText + "</p>");

//    }catch(e)
//    {
//        alert(e.message);
//    }

}


function processDocumentCheckOut()
{

    var sm = documents.getSelectionModel();
    var selrecords = sm.getSelection();

    if (sm.getCount() != 1) {
        return;
    }


    var vid = "";
    var filename = "";
    var version = "";
    var checkoutuser = "";

    vid = selrecords[0].get('id');
    filename = selrecords[0].get('filename');
    version = selrecords[0].get('documentversion');

    vid = selrecords[0].get('id');
    filename = selrecords[0].get('filename');
    checkoutuser = selrecords[0].get('checkoutuser');

  //  alert(version);

    if(checkoutuser != null & checkoutuser != 0)
    {
        alert("File is already checked out");
        return;
    }

    //alert("BSSCheckOutFile.php?BSSid=" + vid + "&BSSfilename=" + filename + "&BSSUserId=" + BSSUserId);
     // Make this a dialog

    // ADD HOT TO WAIT FOR DOWNLOAD TO FINISH

    window.open("BSSCheckOutFile.php?BSSid=" + vid + "&BSSfilename=" + filename + "&BSSUserId=" + BSSUserId  + "&BSSVersion=" + version);

    GetDocuments();

//    try{
//        var xmlHttp = null;
//        xmlHttp = new XMLHttpRequest();
//        xmlHttp.open( "GET", "BSSCheckOutFile.php?BSSid=" + vid + "&BSSfilename=" +filename+ "&BSSUserId=" + BSSUserId, true);
//        xmlHttp.send(null);
        // document.write("<p>"+ xmlHttp.responseText + "</p>");
//    }catch(e)
//    {
//        alert(e.message);
//    }

}


function processDocumentCancelCheckOut()
{

    var sm = documents.getSelectionModel();
    var selrecords = sm.getSelection();

    if (sm.getCount() != 1) {
        return;
    }


    var vid = "";
    var filename = "";
    var checkoutuser = "";

    vid = selrecords[0].get('id');
    filename = selrecords[0].get('filename');

    vid = selrecords[0].get('id');
    filename = selrecords[0].get('filename');
    checkoutuser = selrecords[0].get('cfvheckoutuser');

    //alert("BSSCheckOutFile.php?BSSid=" + vid + "&BSSfilename=" + filename + "&BSSUserId=" + BSSUserId);

    window.open("BSSCancelCheckOut.php?BSSid=" + vid + "&BSSfilename=" + filename + "&BSSUserId=" + BSSUserId);

    GetDocuments();

//    try{
//        var xmlHttp = null;
//        xmlHttp = new XMLHttpRequest();
//        xmlHttp.open( "GET", "BSSCheckOutFile.php?BSSid=" + vid + "&BSSfilename=" +filename+ "&BSSUserId=" + BSSUserId, true);
//        xmlHttp.send(null);
    // document.write("<p>"+ xmlHttp.responseText + "</p>");
//    }catch(e)
//    {
//        alert(e.message);
//    }


}


function processDocumentDelete()
{
    var sm = documents.getSelectionModel();
    documentStore.remove(sm.getSelection());

      if (documentStore.getCount() > 0) {
          sm.select(0);
      }

    var delrecords = documentStore.getRemovedRecords();

    var fieldname = "id";

  //"&id=" + delrecords[0].get('id'),

  try{
      var xmlHttp = null;
      xmlHttp = new XMLHttpRequest();
      xmlHttp.open( "GET", "BSSProcessDocumentDelete.php?BSSConfigName=" + "Documents" + "&id=" + delrecords[0].get('id'), false);
      xmlHttp.send(null);

      documentStore.removed = [];

     // document.write("<p>"+ xmlHttp.responseText + "</p>");

  }catch(e)
      {document.write("<p>" + e.message + "</p>");
  }

}



function processCheckInOutOperation(BSSOpType)
{
// alert(BSSOpType);

    try{
    var sm = documents.getSelectionModel();
    var selrecords = sm.getSelection();

    if (sm.getCount() != 1) {
            return;
    }
    var fieldname = "id";


    //add logic for already checkedout.
    if(selrecords[0].get('checkoutuser').length > 0 & BSSOpType == 'CheckOut'){
        alert("File is already checkedout");
    }else{
        processDocumentGet();
    }

    //add logic for already checkedout.
    if(selrecords[0].get('checkoutuser').length > 0 & BSSOpType == 'CheckIn'){

        processDocumentAdd("CHECKIN");

    }



      var xmlHttp = null;
      xmlHttp = new XMLHttpRequest();
      xmlHttp.open( "GET", "BSSDocCheckInOutOps.php?BSSOpType=" + BSSOpType + "&BSSUserId=" + BSSUserId + "&id=" + selrecords[0].get('id'), false);
      xmlHttp.send(null);

      //document.write("<p>"+ xmlHttp.responseText + "</p>");
      GetDocuments();

      //If check in add file upload

  }catch(e)
      {document.write("<p>" + e.message + "</p>");
  }

}




function formatDate(value){
    return value ? Ext.Date.dateFormat(value, 'Y-m-d H:i:s') : '';        //'Y-m-d H:i:s'      //'M d, Y'
}


function CreateWorkflow(){

    var varWorkflowId = comboWorkflow.getValue();
    var varRecordId;

    try{

        var sm = mastergrid.getSelectionModel();
        var selrecords = sm.getSelection();

        if(sm.getCount() > 0){
            varRecordId = selrecords[0].get('id');
         //   alert(varRecordId);
        }else
        {
            return;
        }

    }catch(e)
    {document.write(alert(e.message));
    }

   var URLString = 'BSSCreateWorkflow.php?ProcName=createadvworkflow&WorkflowId=' + varWorkflowId + "&BSSEnterpriseObjectID=" + BSSEnterpriseObjectId + "&RecordId="  + varRecordId;
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

    //Get the workflows
    try{
        //Get the data
        xmlHttp = new XMLHttpRequest();
        varQueryId = 0;
   //     xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "AdvWorkflowInstance" + "&BSSQueryId=" + "" + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id DESC", false );
        xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "AdvWorkflowInstance" + "&BSSQueryId=" + "" + "&BSSWhereClause=" + "id>0 and masterid = " + varRecordId + " and sequence = " + BSSEnterpriseObjectId + " ORDER BY sequence,id DESC", false );

        xmlHttp.send( null );
  //      alert(xmlHttp.responseText);
        var newdata = eval('[' + xmlHttp.responseText + ']');
        workflowinstanceStore.loadData(newdata,false);
    }catch(e)
    {document.write("<p>" + "Workflows Data Get ERROR: " + e.message + "</p>");
    }

}


function GetWorkflows()
{
    //Get the workflows



    var sm = mastergrid.getSelectionModel();
    var selrecords = sm.getSelection();

    if(sm.getCount() > 0){
        varRecordId = selrecords[0].get('id');
        //   alert(varRecordId);
    }else
    {
        return;
    }

    //alert(varRecordId);


    try{
        //Get the data
        xmlHttp = new XMLHttpRequest();
        varQueryId = 0;
        xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "AdvWorkflowInstance" + "&BSSQueryId=" + "" + "&BSSWhereClause=" + "id>0 and masterid = " + varRecordId + " and sequence = " + BSSEnterpriseObjectId + " ORDER BY sequence,id DESC", false );
        xmlHttp.send( null );
    //    alert(xmlHttp.responseText);
        var newdata = eval('[' + xmlHttp.responseText + ']');
        workflowinstanceStore.loadData(newdata,false);
    }catch(e)
    {document.write("<p>" + "Workflows Data Get ERROR: " + e.message + "</p>");
    }



}



function GetSignOffs()
{
    //Get the workflow

    try{

        var sm =  workflows.getSelectionModel();
        var selrecords = sm.getSelection();

        if(sm.getCount() > 0){

            varWorkflowId = selrecords[0].get('id');

            try{
                //Get the data
                xmlHttp = new XMLHttpRequest();
                varQueryId = 0;
                xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + "SignOffs" + "&BSSQueryId=" + "" + "&BSSWhereClause=" + "masterid = " + varWorkflowId + " ORDER BY sequence,id DESC", false );
                xmlHttp.send( null );
                //alert(xmlHttp.responseText);
                var newdata = eval('[' + xmlHttp.responseText + ']');
                signoffsStore.loadData(newdata,false);
            }catch(e)
            {alert("Signoff Data Get ERROR: " + e.message);
            }

            //   alert(varRecordId);
        }else
        {
            return;
        }

    }catch(e)
    {document.write(alert(e.message));
    }


}


 //   [{text: 'Approve',    handler : function() {ApproveWorkflow("Workflows");}},
 //   {text: 'Reject', handler : function() {RejectWorkflow("Workflows");}},
 //   {text: 'Cancel', handler : function() {CancelWorkflow("Workflows");}},
 //   {text: 'Delete', handler : function() {DeleteWorkflow("Workflows");}},
 //   {text: 'Next Status', handler : function() {PromoteWorkflow("Workflows");}}

function ApproveWorkflow()
{
  ProcessWorkflow("Approve");
}

function RejectWorkflow()
{
  ProcessWorkflow("Reject");
}

function CancelWorkflow()
{
  ProcessWorkflow("Cancel");
}

function DeleteWorkflow()
{

processDelete("AdvWorkflowInstance",workflows, workflowinstanceStore)

}

function OpenWorkflow()
{
// ProcessWorkflow("Promote");


    try{

        var sm =  workflows.getSelectionModel();
       // sm.select(0);
        var selrecords = sm.getSelection();

        if(sm.getCount() > 0){
            varWorkflowId = selrecords[0].get('id');
        }

       // alert(varWorkflowId);

        window.open("WorkflowReader.html?BSSWFID=" + varWorkflowId,height=200,width=150);
        //var win = Ext.create('Workflows');

    }catch(e){alert(e.message);}
}

function ProcessWorkflow(ProcessType)
{

    try{

        var sm =  workflows.getSelectionModel();
        sm.select(0);
        var selrecords = sm.getSelection();

        if(sm.getCount() > 0){

            varWorkflowId = selrecords[0].get('id');

           // alert(varWorkflowId);

            try{
                //Get the data
                xmlHttp = new XMLHttpRequest();
                varQueryId = 0;
                xmlHttp.open( "GET", "BSSProcessWorkflow.php?BSSWorkflowId=" + varWorkflowId + "&BSSProcessType=" + ProcessType + "&BSSUserId=" + BSSUserId + "&BSSComments=" + BSSComments + "&BSSJSONObject=" + GetBSSJSONObject(), false );
                xmlHttp.send( null );
                alert(xmlHttp.responseText);
               // var newdata = eval('[' + xmlHttp.responseText + ']');
               // signoffsStore.loadData(newdata,false);
                GetWorkflows();
            }catch(e)
            {alert("Signoff Data Get ERROR: " + e.message);
            }

        }else
        {
            return;
        }

    }catch(e)
    {alert(e.message);
    }


}



function AddApprovers()
{

    //Add get uers authorized to sign off
    //custom user store


    var sm = workflows.getSelectionModel();

  try{
     if (sm.getCount() == 0) {
         return;
     }

     var selrecords = sm.getSelection();
     var fieldname = "id";
     var BSSWorkflowId = selrecords[0].get('id');

    }catch(e)
        {
            alert(e.message);
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

    var getsignoffuser = Ext.create('Ext.form.Panel', {
        //   renderTo: 'editor-grid',
        name: 'idgetuser',
        width: 500,
        frame: true,
        title: 'Add Approver',
        bodyPadding: '10 10 0',

        defaults: {
            anchor: '100%',
            allowBlank: false,
            msgTarget: 'side',
            labelWidth: 70
        },

        items:[{
                name: 'idAddWorkflowApprover',
                //     disabled: false,
                //    width: 180,
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
               }
        ],

        buttons: [{
            text: 'Select',
            handler: function(){

                try{
                    var ApproverUserId = Ext.getCmp('idgetuser').getForm().findField("idAddWorkflowApprover").getValue();
                    var BSSSQLCommand = "INSERT INTO SignOffs(masterid,WorkflowApprover)VALUES(" + BSSWorkflowId + "," + ApproverUserId + ")";

                    //alert(BSSSQLCommand);

                    // iterate here on the ids in the sign offs tab  Google: How to iterate on a sencha data grid





                    var xmlHttp = null;
                    xmlHttp = new XMLHttpRequest();
                    xmlHttp.open( "GET", "BSSPerformSQLCommand.php?BSSSQLCommand=" + BSSSQLCommand + "&userid=" + BSSUserId, false );
                    xmlHttp.send(null);

                    //alert(xmlHttp.responseText);
                    //newdata = eval('[' + xmlHttp.responseText + ']');
                    //BSSStore.add(newdata);
                    GetSignOffs();
                    absoluteuser.close();
                    //this.up('form').getForm().close();
                    //Ext.getCmp('idgetuser').close();


                }catch(e)
                {document.write("<p>" + e.message + "</p>");
                }


            }
        },{
            text: 'Close',
            handler: function() {
                absoluteuser.close();
                this.up('form').getForm().close();
                Ext.getCmp('idgetuser').close();
                GetSignOffs();
            }
        }]
    });

    absoluteuser = Ext.create('Ext.window.Window', {
        //  title: 'File Upload',
        width: 510,
        height: 140,
        layout:'absolute',
        defaults: {
            bodyStyle: 'padding:10px'
        },
        items: [getsignoffuser]
    });


    try{
    absoluteuser.show();
    }catch(e){
        alert(e.message);
    }

}


function removeApprovers()
{


    var sm = signoffs.getSelectionModel();

    try{
        if (sm.getCount() == 0) {
            return;
        }
        var selrecords = sm.getSelection();
        var BSSWorkflowApproverId = selrecords[0].get('id');
        var BSSSignOffResult = selrecords[0].get('SignoffResult');
        var BSSSQLCommand = "DELETE FROM SignOffs WHERE id = " + BSSWorkflowApproverId;

        // add message do you wish to remove user: X

        if(BSSSignOffResult > 0){
            alert("User has already Signed Off");
            return;
        }

        //alert(BSSSQLCommand);

        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSPerformSQLCommand.php?BSSSQLCommand=" + BSSSQLCommand + "&userid=" + BSSUserId, false );
        xmlHttp.send(null);

        //alert(xmlHttp.responseText);

        GetSignOffs();


    }catch(e)
    {
        alert(e.message);
    }


}


function GetBSSJSONObject()
{


    try{
    var MasterId = "";
    var ChildId = "";
    var WorkflowId = "";
    var SignOffId = "";
    var DocumentId = "";
    var DiscussionId = "";
    var HistoryId = "";

    var mg = mastergrid.getSelectionModel();
        if (mg.getCount() > 0) {
            var masselrecords = mg.getSelection();
            var MasterId = masselrecords[0].get('id');
        }

    var cg = childgrid.getSelectionModel();
        if (cg.getCount() > 0) {
            var chsselrecords = cg.getSelection();
            var ChildId = chsselrecords[0].get('id');
        }

    var wf = workflows.getSelectionModel();
        if (wf.getCount() > 0) {
            var wfsselrecords = wf.getSelection();
            var WorkflowId = wfsselrecords[0].get('id');
        }

    var so = signoffs.getSelectionModel();
        if (so.getCount() > 0) {
            var sosselrecords = so.getSelection();
            var SignOffId = sosselrecords[0].get('id');
        }

    var doc = documents.getSelectionModel();
        if (doc.getCount() > 0) {
            var docsselrecords = doc.getSelection();
            var DocumentId = docsselrecords[0].get('id');
        }

    var disc = discussions.getSelectionModel();
        if (disc.getCount() > 0) {
            var discsselrecords = disc.getSelection();
            var DiscussionId = discsselrecords[0].get('id');
        }

    var hist = history.getSelectionModel();
        if (hist.getCount() > 0) {
            var histsselrecords = hist.getSelection();
            var HistoryId = histsselrecords[0].get('id');
        }

     BSSJSONObject = {MasterTableName:BSSMasterConfigName,ChildTableName:BSSChildConfigName,Masterid:MasterId,"Childid":ChildId,"WorkflowId":WorkflowId,"SignOffId":SignOffId,"DocumentId":DocumentId,"DiscussionId":DiscussionId,"HistoryId":HistoryId};

    //alert(BSSMasterConfigName + "  " + BSSChildConfigName + "  " + MasterId + "  " + ChildId + "  " + WorkflowId + "  " + SignOffId + "  " + DocumentId + "  " + DiscussionId + "  " + HistoryId);

     BSSJSONString = JSON.stringify(BSSJSONObject);


     return BSSJSONString;

    }catch(e)
    {
        alert(e.message);
    }

}


function DoAction(Action)
{
//    1 URL
//    2 NOTIFICATION
//    3 PHPCALL



    try{
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();

        //alert("BSSPerformAction.php?BSSActionId=" + Action + "&BSSUserId=" + BSSUserId + "&BSSJSONObject=" + GetBSSJSONObject());

        xmlHttp.open( "GET", "BSSPerformAction.php?BSSActionId=" + Action + "&BSSUserId=" + BSSUserId + "&BSSJSONObject=" + GetBSSJSONObject(), false );
        xmlHttp.send(null);

        //alert(xmlHttp.responseText);
        strResult = xmlHttp.responseText;

        if(strResult.substring(0,4)=="URL:"){
            window.open (strResult.substring(4,strResult.length),"mywindow");
        }

        if(strResult.substring(0,4)=="PHP:"){
            try{
                var xmlHttp = null;
                xmlHttp = new XMLHttpRequest();
                xmlHttp.open( "GET", "" + strResult.substring(4,strResult.length) + "&BSSJSONObject=" + GetBSSJSONObject(), false );
                xmlHttp.send(null);

                // Add show response logic
                alert(xmlHttp.responseText);


            }catch(e)
            {
                alert(e.message);
            }


        }


        if(strResult.substring(0,4)!="URL:" & strResult.substring(0,4)!="URL:"){

        alert("Notification Completed");

        }

    }catch(e)
    {
        alert(e.message);
    }

}


