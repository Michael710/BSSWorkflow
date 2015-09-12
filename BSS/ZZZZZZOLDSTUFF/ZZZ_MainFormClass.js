/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/

//Ext.Loader.setConfig({
//    enabled: true
//});
//Ext.Loader.setPath('Ext.ux', '../ux');

Ext.define('MainFormClass', {
    name: 'Unknown',
    userid: '',

    constructor: function(name) {

        if (name) {
            this.name = name;
        }

        if (userid) {
            this.userid = userid;
        }


var mastergrid;
var masterStore;
var childStore;
var childgrid;
var arFormConfig;
var BSSMasterConfigName;
var BSSChildConfigName;
var BSSConfigName;
var btnact1;
var childtabs;
var documents;
var history;


Ext.require([
    'Ext.selection.CellModel',
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.util.*',
    'Ext.state.*',
    'Ext.form.*',
    'Ext.ux.CheckColumn',
    'Ext.form.field.File',
    'Ext.form.Panel',
    'Ext.window.MessageBox'
]);


    var documentStore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'documentuser', type: 'string'},
            {name: 'documentdate', type: 'string'},
            {name: 'documentname', type: 'string'},
            {name: 'checkoutuser', type: 'string'},
            {name: 'documendescription', type: 'string'}
        ],
        data:
                   [['1','','','','','','']]
         });

    var discussionStore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'discussionuser', type: 'string'},
            {name: 'discussiondate', type: 'string'},
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
            {name: 'historydate', type: 'string'},
            {name: 'historytext', type: 'string'}
        ],
        data:
                   [['1','','','','','']]
         });

//Get the form definition here
BSSFormName = 'Form A';

var xmlHttp = null;
xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "ZZZBSSGetForm.php?BSSFormName=" + BSSFormName, false );
xmlHttp.send( null );
//document.write("<p>"+ "Form Config String:  " + xmlHttp.responseText + "</p>");

//try{

arFormConfig = eval( "(" + xmlHttp.responseText + ")" );

//document.write("<p>"+ "Config Element:  " + arFormConfig.MasterTable + "</p>");


BSSMasterConfigName = arFormConfig.MasterTable;
BSSChildConfigName = arFormConfig.ChildTable;

//}catch(e)
 //   {document.write("<p>" + e.message + "</p>");}

//'{"FormName": "'. $FormName . '",' .
//'"FormDescription" :"' . $FormDescription . '",' .
//'"MasterTable" :"' . $MasterTable . '",' .
//'"ChildTable" :"' . $ChildTable . '",' .
//'"Action1" :"' . $Action1 . '",' .
//'"Action2" :"' . $Action2 . '",' .
//'"Action3" :"' . $Action3 . '",' .
//'"Action4" :"' . $Action4 . '",' .
//'"DocumentsEnabled" :"' . $DocumentsEnabled . '"}';



//Get the Master DataStore
var xmlHttp = null;
xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "BSSGetStore.php?BSSConfigName=" + arFormConfig.MasterTable, false );
xmlHttp.send( null );
//document.write("<p>"+ "Store String:  " + xmlHttp.responseText + "</p>");

try{
    masterStore = Ext.create('Ext.data.Store', eval('(' + xmlHttp.responseText + ')'));
}catch(e)
    {document.write("<p>" + e.message + "</p>");}

//document.write("<p>"+ "Store String:  " + "HERE2" + "</p>");




//Get the Child DataStore
if(arFormConfig.ChildTable.length > 0){
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSGetStore.php?BSSConfigName=" + arFormConfig.ChildTable, false );
    xmlHttp.send( null );
 //   document.write("<p>"+ "Store String:  " + xmlHttp.responseText + "</p>");

    try{
        childStore = Ext.create('Ext.data.Store', eval('(' + xmlHttp.responseText + ')'));
    }catch(e)
        {document.write("<p>" + e.message + "</p>");}
}

//document.write("<p>"+ "Store String:  " + "HERE3" + "</p>");






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


            var rowEditing = Ext.create('Ext.grid.plugin.RowEditing', {
                clicksToMoveEditor: 1,
                autoCancel: false
            });

            var rowEditing1 = Ext.create('Ext.grid.plugin.RowEditing', {
                clicksToMoveEditor: 1,
                autoCancel: false
            });

                // create the grid and specify what field you want

        //alert('here11');

        //alert('here2 ' . BSSMasterConfigName);

            //Get the Master Grid Configuration
            try{
            var xmlHttp = null;
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetConfig.php?BSSConfigName=" + arFormConfig.MasterTable + "&BSSConfigMode=MASTER", false );
            xmlHttp.send( null );
            //document.write("<p>"+ xmlHttp.responseText + "</p>");

            mastergrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));

        }catch(e)
             {document.write("<p>" + 'Master Grid Config Error: ' +e.message + "</p>");
         }


            //alert(arFormConfig.MasterTable);

            //Get the Child Grid Configuration

            try{
            var xmlHttp = null;
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetConfig.php?BSSConfigName=" + arFormConfig.ChildTable + "&BSSConfigMode=CHILD", false );
            xmlHttp.send( null );
              //document.write("<p>"+ xmlHttp.responseText + "</p>");

            childgrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));

        }catch(e)
             {document.write("<p>" + 'Child Grid Config Error: ' + e.message + "</p>");
         }




            try{
                 //Get the data
                xmlHttp = new XMLHttpRequest();
                xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + arFormConfig.MasterTable + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );
                xmlHttp.send( null );
                //document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
                var newdata = eval('[' + xmlHttp.responseText + ']');
                masterStore.loadData(newdata,false);
            }catch(e)
                {document.write("<p>" + "Master Data Get ERROR: " + e.message + "</p>");
            }


            btnact1 = Ext.create('Ext.Button', {
                id: 'Action1',
                x: 700,
                y: 60,
                width: 100,
                text: 'Action 1',
                handler: function() {
                    alert('You clicked the button!')
                }
            });

            btnact2 = Ext.create('Ext.Button', {
                id: 'Action2',
                x: 700,
                y: 90,
                width: 100,
                text: 'Action 2',
                handler: function() {
                    alert('You clicked the button!')
                }
            });

            btnact3 = Ext.create('Ext.Button', {
                id: 'Action3',
                x: 700,
                y: 120,
                width: 100,
                text: 'Action 3',
                handler: function() {
                    alert('You clicked the button!')
                }
            });

            btnact4 = Ext.create('Ext.Button', {
                id: 'Action4',
                x: 700,
                y: 150,
                width: 100,
                text: 'Action 4',
                handler: function() {
                    alert('You clicked the button!')
                }
            });

            btnact5 = Ext.create('Ext.Button', {
                id: 'Action5',
                x: 700,
                y: 180,
                width: 100,
                text: 'Action 5',
                handler: function() {
                    alert('You clicked the button!')
                }
            });

            btnact6 = Ext.create('Ext.Button', {
                id: 'Action6',
                x: 700,
                y: 210,
                width: 100,
                text: 'Action 6',
                handler: function() {
                    alert('You clicked the button!')
                }
            });


                // to use for the editor at each header.
            documents = Ext.create('Ext.grid.Panel', {
                id: 'documentgrid',
                store: documentStore,
                selModel: 'cellmodel',
                columns: [
                    {id: 'iddoc',
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
                    {id: 'masteriddocs',
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
                    },{id: 'sequencedocs',
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
                    {id: 'idDocumentUser',
                    header: 'Document User',
                    disabled: false,
                    width: 300,
                    dataIndex: 'documentuser',
                    editor: {
                    allowBlank: false
                    }
                    },
                    {id: 'idDocDescription',
                    header: 'Document Date',
                    disabled: false,
                    width: 400,
                    dataIndex: 'documentdate',
                    editor: {
                    allowBlank: false
                    }
                    },
                    {id: 'idDocName',
                    header: 'Document Name',
                    disabled: false,
                    width: 400,
                    dataIndex: 'documentname',
                    editor: {
                       allowBlank: false
                    }
                    },
                    {id: 'idCheckOutUser',
                    header: 'Check Out User',
                    width: 200,
                    editable: false,
                    dataIndex: 'checkoutuser',
                    editor: {
                        allowBlank: true
                    }
                    },
                    {id: 'idDocDescription',
                    header: 'Document Description',
                    disabled: false,
                    width: 400,
                    dataIndex: 'documentdescription',
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
                tbar: [{text: 'Add',    handler : function() {processDocumentAdd("Add");}},
                       {text: 'Update', handler : function() {processDocumentUpdate();}},
                       {text: 'Delete', handler : function() {processDocumentDelete();}},
                       {text: 'Get',   handler : function() {processDocumentGet();}},
                       {text: 'Check Out', handler : function() {processCheckInOutOperation("CheckOut");}},
                       {text: 'Cancel Check Out', handler : function() {processCheckInOutOperation("CancelCheckOut");}},
                       {text: 'Check In', handler : function() {processCheckInOutOperation("CheckIn");}},
                       {text: 'Versions', handler : function() {processViewVersions();}}
                ],
                plugins: [cellEditing2]
            });


                    // to use for the editor at each header.
            discussions = Ext.create('Ext.grid.Panel', {
                id: 'discussiongrid',
                store: discussionStore,
                selModel: 'cellmodel',
                columns: [
                    {id: 'iddisc',
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
                    {id: 'masteriddisc',
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
                    },{id: 'sequencedisc',
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
                    {id: 'idDiscussionUser',
                    header: 'Document User',
                    disabled: false,
                    width: 200,
                    dataIndex: 'documentuser',
                    editor: {
                    allowBlank: false
                    }
                    },
                    {id: 'idDiscussionDate',
                    header: 'Discussion Date',
                    disabled: false,
                    width: 400,
                    dataIndex: 'discussiondate',
                    editor: {
                    allowBlank: false
                    }
                    },
                    {id: 'iddiscussiontext',
                    header: 'Discussion Text',
                    width: 100,
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
                tbar: [{text: 'Add',    handler : function() {processInsert("Discussions",discussions,discussionStore);}},
                       {text: 'Udpate', handler : function() {processUpdate("Discussions",discussions,discussionStore);}},
                       {text: 'Delete', handler : function() {processDelete("Discussions",discussions,discussionStore);}}
                ],
                plugins: [cellEditing3]
            });


                        // to use for the editor at each header.
            history = Ext.create('Ext.grid.Panel', {
                id: 'historygrid',
                store: historyStore,
                selModel: 'cellmodel',
                columns: [
                    {id: 'idhist',
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
                    {id: 'masteridhist',
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
                    },{id: 'sequencehist',
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
                    {id: 'idHistoryUser',
                    header: 'History User',
                    disabled: false,
                    width: 200,
                    dataIndex: 'historyuser',
                    editor: {
                    allowBlank: false
                    }
                    },
                    {id: 'idhistorydate',
                    header: 'Date',
                    width: 100,
                    editable: false,
                    dataIndex: 'historydate',
                    editor: {
                        allowBlank: true
                    }
                    },
                    {id: 'idHistoryText',
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


                childtabs = Ext.createWidget('tabpanel', {
                renderTo: document.body,
                activeTab: 0,
                x: 20,
                y: 340,
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
                        title: 'Workflow'
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





            absolute1 = Ext.create('Ext.window.Window', {
               title: 'Table Maintenance',
               width: 1200,
               height: 800,
               layout:'absolute',
               defaults: {
               bodyStyle: 'padding:10px'
               },
               items: [mastergrid, childtabs, btnact1, btnact2, btnact3, btnact4, btnact5, btnact6]
               });

            absolute1.show();

           // mastergrid.setSelection(1);




        if (name) {
            this.name = name;
        }
        return this;
    },

    eattest: function() {
        alert('made it here');
        return this;
    },

    eat: function(foodType) {
        alert(this.name + " is eating: " + foodType);
        eattest();
        return this;
    }

});


function processInsert(BSSConfigName, BSSGrid, BSSStore)
{
// alert(BSSChildConfigName);
//  alert(BSSMasterConfigName);
  alert(BSSConfigName);
var idval;
idval = 0;

if(BSSConfigName == BSSChildConfigName || BSSConfigName == 'Discussions'){
try{


    var sm = mastergrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(sm.getCount() > 0){
        var fieldname = "id";
        idval = selrecords[0].get('id');
        alert(idval);
    }

}catch(e)
    {document.write(alert(e.message));
}}


try{
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
        xmlHttp.open( "GET", "BSSPerformDelete.php?BSSConfigName=" + delBSSConfigName + "&id=" + delrecords[0].get('id'), false);
        xmlHttp.send(null);

       // document.write("<p>"+ xmlHttp.responseText + "</p>");

    }catch(e)
        {document.write("<p>" + e.message + "</p>");
    }


}

function ProcessChildTab()
{
    //childtabs.getActiveTab().title)\

    alert('here we is');
    switch(childtabs.getActiveTab().title){
    case "Children":
        GetChildData();
    break;
    case "Workflow":
      //  GetWorkflow();
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
    var sm = mastergrid.getSelectionModel();
   // if (sm.getSelection().getCount() = 0) {
   //     return;
   // }
    var selrecords = sm.getSelection();
    var fieldname = "id";

    try{
         //Get the data
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + arFormConfig.ChildTable + "&BSSWhereClause=" + "masterid=" +  selrecords[0].get('id'), false );
        xmlHttp.send( null );
        //document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
        var newdata1 = eval('[' + xmlHttp.responseText + ']');
        childStore.loadData(newdata1,false);
        }catch(e)
            {document.write("<p>" + "ERROR: " + e.message + "</p>");
        }

}


function GetHistory()
{

//    alert('Here' + childtabs.getActiveTab().title);

    var sm = mastergrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(selrecords == ''){return;}
    var fieldname = "id";

    try{

         //Get the history data
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=History&BSSWhereClause=masterid="+  selrecords[0].get('id'),false);
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
    var sm = mastergrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(selrecords == ''){return;}
    var fieldname = "id";

    try{
         //Get the history data
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=Discussions&BSSWhereClause=masterid="+  selrecords[0].get('id'),false);
        xmlHttp.send( null );
       // document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
        var newdata1 = eval('[' + xmlHttp.responseText + ']');
        discussionStore.loadData(newdata1,false);
        }catch(e)
            {document.write("<p>" + "ERROR: " + e.message + "</p>");
        }
}

function GetDocuments()
{

    var sm = mastergrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(selrecords == ''){return;}
    var fieldname = "id";

    try{
         //Get the document data
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=Documents&BSSWhereClause=masterid="+  selrecords[0].get('id'),false);
        xmlHttp.send( null );
       // document.write("<p>" + "DATA: " + xmlHttp.responseText + "</p>");
        var newdata1 = eval('[' + xmlHttp.responseText + ']');
        documentStore.loadData(newdata1,false);
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
    //document.write("<p>"+ jsenc + "</p>");

try{
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSPerformUpdate.php?BSSConfigName=" + BSSConfigName + "&id=" + jsenc, false);
    xmlHttp.send(null);
    document.write("<p>"+ xmlHttp.responseText + "</p>");

     //REmove the red triangle
    BSSStore.each(function(r){
      r.commit();
     });


}catch(e)
    {document.write("<p>" + e.message + "</p>");}
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
        id: 'idfileupload',
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
            id: 'idfuname',
            name: 'txtfilename',
            xtype: 'textfield',
            fieldLabel: 'Name'
        },{
            id: 'idfudescription',
            name: 'txtdescription',
            xtype: 'textfield',
            fieldLabel: 'Description'
             },

            {
            xtype: 'filefield',
            id: 'form-file',
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
                    form.submit({
                        url: 'file-upload.php',
                        waitMsg: 'Uploading your photo...',
                        success: function(fp, o) {
                            msg('Success', 'Processed file "' + o.result.file + '" on the server');
                            try{
                            var flddescvalue = Ext.getCmp('idfileupload').getForm().findField("idfudescription").getValue();
                            var fldnamevalue = Ext.getCmp('idfileupload').getForm().findField("idfuname").getValue();
                            var fldfnamecvalue = o.result.file
                            var masterid = "1";
                            var docdate = '';
                            var docuser = '1';
                                //alert(filemode);
                            if(filemode == "Add"){
                            var sqlvalues = masterid + "','" + docuser + "','" + docdate + "','" + fldnamevalue + "','" +  flddescvalue    + "','" +  fldfnamecvalue + "')"
                            var sqlstring = "insert into documents(masterid,documentuser,documentdate,documentname,documentdescription,filename)values(" + sqlvalues;
                              alert(sqlstring);
                            }else{  //CHECKIN
                                var sqlvalues = masterid + "','" + docuser + "','" + docdate + "','" + fldnamevalue + "','" +  flddescvalue    + "','" +  fldfnamecvalue + "')"
                                var sqlstring = "update documents(set documentuser = " + curuser + ",documentdate = " + dateval + ",documentname = '" + fldnamevalue + "',documentdescription = '" + flddescvalue  + "',filename = '" + fldfnamecvalue + "')";
                                //Add insert for fiel version table
                                  alert(sqlstring);
                            }
                            }catch(e){alert(e.message);}
                            Ext.getCmp('idfileupload').close();
                        }
                    });
                }
            }
        },{
            text: 'Close',
            handler: function() {
                this.up('form').getForm().close();
            }
        }]
    });

    absolutedoc = Ext.create('Ext.window.Window', {
     //  title: 'File Upload',
       width: 610,
       height: 200,
       layout:'absolute',
       defaults: {
       bodyStyle: 'padding:10px'
       },
       items: [fileupload]
       });

    absolutedoc.show();


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

     // document.write("<p>"+ xmlHttp.responseText + "</p>");

  }catch(e)
      {document.write("<p>" + e.message + "</p>");
  }

}



function processCheckInOutOperation(BSSOpType)
{
alert(BSSOpType);

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
    }


    //add logic for already checkedout.
    if(selrecords[0].get('checkoutuser').length > 0 & BSSOpType == 'CheckIn'){

        processDocumentAdd("CHECKIN");


    }





      var xmlHttp = null;
      xmlHttp = new XMLHttpRequest();
      xmlHttp.open( "GET", "BSSDocCheckInOutOps.php?BSSOpType=" + BSSOpType + "&id=" + selrecords[0].get('id'), false);
      xmlHttp.send(null);

      //document.write("<p>"+ xmlHttp.responseText + "</p>");
        GetDocuments();

      //If check in add file upload

  }catch(e)
      {document.write("<p>" + e.message + "</p>");
  }

}


function formatDate(value){
    return value ? Ext.Date.dateFormat(value, 'M d, Y') : '';
}









