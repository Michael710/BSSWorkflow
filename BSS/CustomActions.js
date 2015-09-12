/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/

var usergrid;
var childgrid;

var BSSCREATEMASTER_FLAG = false
var BSSREADMASTER_FLAG = false
var BSSUPDATEMASTER_FLAG = false
var BSSDELETEMASTER_FLAG = false
var BSSCREATECHILD_FLAG = false
var BSSREADCHILD_FLAG = false
var BSSUPDATECHILD_FLAG = false
var BSSDELETECHILD_FLAG = false
var BSSEnabledData;
var BSSEnabledStore;
var BSSUserData;
var BSSUserlistStore;

var BSSChildConfigName = "UserRoles";

       // create the data store
    var userstore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'Location', type: 'string'},
            {name: 'Category', type: 'string'},
            {name: 'Text', type: 'string'},
            {name: 'Figure', type: 'string'},
            {name: 'Color', type: 'string'},
            {name: 'Enabled', type: 'string'}
        ],
        data:
                   [['1','','','','','','','','']]
         });

    var childStore = Ext.create('Ext.data.Store', {
        fields: [
            {name: 'id', type: 'string'},
            {name: 'sequence', type: 'string'},
            {name: 'masterid', type: 'string'},
            {name: 'roleid', type: 'string'}
        ],
        data:
                   [['1','0','0','0']]
    });


BSSEnabledData = [
    { id:0, value: 'No'},
    { id:1, value: 'Yes'}
];


BSSEnabledStore = Ext.create('Ext.data.Store', {
        fields: [{name: 'id'}, {name: 'value'} ],
        data: BSSEnabledData
    }
);

BSSUserData = [ { id:1, value: 'A'},{ id:2, value: 'B'}];

BSSUserlistStore = Ext.create('Ext.data.Store', {
        fields: [{name: 'id'}, {name: 'value'} ],
        data: BSSUserData
    }
);

//Get the data
xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "DBServices/BSSGetComboStore.php?BSSSQLString=SELECT id, Email AS value FROM users", false );
xmlHttp.send( null );
//        alert("DATA: " + xmlHttp.responseText);
var bssUserEscalationData = eval('[' + xmlHttp.responseText + ']');
BSSUserlistStore.loadData(bssUserEscalationData,false);


Ext.define('CustomActions', {
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
            xmlHttp.open( "GET", "DBServices/BSSGetJSData.php?BSSConfigName=" + "CustomActions" + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );
            xmlHttp.send( null );
            //alert("DATA: " + xmlHttp.responseText);
            var newdata = eval('[' + xmlHttp.responseText + ']');
            userstore.loadData(newdata,false);
        }catch(e)
            {document.write("<p>" + "ERROR: " + e.message + "</p>");
        }


        // to use for the editor at each header.

        usergrid = Ext.create('Ext.grid.Panel', {
            store: userstore,
            selModel: 'cellmodel',
            listeners: {
                      itemclick: function() {
                          GetChildData();
                    }},
            columns: [
                {//id: 'userid11',
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
                {//id: 'sequence111',
                header: 'Sequence',
                disabled: false,
                width: 0,
                dataIndex: 'sequence',
                editor: {
                allowBlank: false
                }
                },
                {//id: 'usermasterid1',
                header: 'Master Id',
                disabled: false,
                width: 0,
                dataIndex: 'masterid',
                editor: {
                allowBlank: false
                }
                },
                {
                //id: 'Department',
                header: 'Location',
                width: 200,
                dataIndex: 'Location',
                editor: {
                    allowBlank: false
                }
                },
                {//id: 'FirstName',
                header: 'Category',
                width: 200,
                editable: false,
                dataIndex: 'Category',
                editor: {
                    allowBlank: true
                }
                },
                {
                //id: 'LastName',
                header: 'Text',
                width: 50,
                dataIndex: 'Text',
                editor: {
                    allowBlank: false
                }
                },
                {
                //id: 'LastName',
                header: 'Figure',
                width: 100,
                dataIndex: 'Figure',
                editor: {
                    allowBlank: false
                }
                },
                {
                //id: 'LastName',
                header: 'Color',
                width: 100,
                dataIndex: 'Color',
                editor: {
                    allowBlank: false
                }
                },
                {
                    //
                    header: 'Enabled',
                    width: 60,
                    dataIndex: 'Enabled',
                    editor:
                    { xtype: 'combobox',
                        typeAhead: true,
                        selectOnTab: true,
                        triggerAction: 'all',
                        fields:['id','value'],
                        store: BSSEnabledStore, //[[1, 'GLOBAL'],[2, 'USER']],
                        valueField:'id',
                        displayField:'value',
                        multiSelect: false,
                        queryMode: 'local',
                        lazyRender: false,
                        listClass: 'x-combo-list-small'},
                    renderer: function(val) {var matching =  BSSEnabledStore.queryBy( function(rec){ return rec.data.id == val; }); return (matching.items[0]) ? matching.items[0].data.value : ''}

                }],
            width: 930,
            height: 350,
            x: 1,
            y: 1,
            title: 'Users',
            frame: true,
            tbar: [{text: 'Add',    handler : function() {processInsert("CustomActions",usergrid,userstore);}},
                   {text: 'Save',   handler : function() {processUpdate("CustomActions",usergrid,userstore);}},
                   {text: 'Inactivate', handler : function() {processDelete("CustomActions",usergrid,userstore);}}
                 //  {text: 'Reset Password', handler : function() {processResetPassword("CustomActions",usergrid,userstore);}}
            ],
            plugins: [cellEditing1]
        });


        try{

        //Get the Grid Configuration
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "DBServices/BSSGetConfig.php?BSSConfigName=UserRoles&BSSConfigMode=CHILD", false );
        xmlHttp.send( null );
      // alert("GRID" + xmlHttp.responseText);

       // childgrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));
        //gridx.addListener("click",ProcessEdit());
        }catch(e){alert(e.message);}


        try{
             //Get the data
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "DBServices/BSSGetJSData.php?BSSConfigName=" + "Users" + "&BSSWhereClause=" + "id>0 ORDER BY sequence,id", false );
            xmlHttp.send( null );
       //alert("DATA: " + xmlHttp.responseText);
            var newdata = eval('[' + xmlHttp.responseText + ']');
         //   userstore.loadData(newdata,false);
        }catch(e)
            {document.write("<p>" + "ERROR: " + e.message + "</p>");
        }


        absolute1 = Ext.create('Ext.window.Window', {
           title: 'User Maintenance',
           x:10,
           y:10,
           width: 940,
           height: 400,
           layout:'absolute',
           defaults: {
           bodyStyle: 'padding:10px'
           },
           items: [usergrid, childgrid]
           })

    absolute1.show();

      //  usergrid.setSelection(1);


    }

});

function processInsert(BSSConfigName, BSSGrid, BSSStore)
{
    //  Get default data from config array

    try{
    idval = 0;
    var sm = usergrid.getSelectionModel();
    var selrecords = sm.getSelection();
    if(sm.getCount() > 0){
        var fieldname = "id";
        var idval = selrecords[0].get('id')
        alert(idval);
    }

 //   return;

    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "DBServices/BSSPerformInsert.php?BSSConfigName=" + BSSConfigName+ "&masterid=" + idval, false );
    xmlHttp.send(null);

      alert(xmlHttp.responseText);

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
        xmlHttp.open( "GET", "DBServices/BSSPerformDelete.php?BSSConfigName=" + BSSConfigName + "&id=" + delrecords[0].get('id'), false);
        xmlHttp.send(null);

       // document.write("<p>"+ xmlHttp.responseText + "</p>");
        alert(xmlHttp.responseText);
     //   alert(delrecords[0].get('id'));
     //   alert(delrecords[1].get('id'));



        //var rLength = BSSStore.removed.length;
        //    for (var i = 0; i < rLength; i++)
        //     {
        //       BSSStore.insert(BSSStore.removed[i].lastIndex || 0, BSSStore.removed[i]);
        //     }

        BSSStore.removed = [];


    }catch(e)
        {    alert(e.message); //document.write("<p>" + e.message + "</p>");
    }


}

function GetChildData()
{

    var sm = usergrid.getSelectionModel();
   // if (sm.getSelection().getCount() = 0) {
   //     return;
   // }

    var selrecords = sm.getSelection();
    var fieldname = "id";
    //selrecords[0].get('id')
    try{
             //Get the data
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "DBServices/BSSGetJSData.php?BSSConfigName=" + "UserRoles" + "&BSSWhereClause=" + "masterid=" +  selrecords[0].get('id'), false );
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
    xmlHttp.open( "GET", "DBServices/BSSPerformUpdate.php?BSSConfigName=" + BSSConfigName + "&id=" + jsenc, false);
    xmlHttp.send(null);
 //   document.write("<p>"+ xmlHttp.responseText + "</p>");

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


function processResetPassword(BSSConfig,usergrid,userstore)
{


    var passwordresetform = Ext.create('Ext.form.Panel', {
        //   renderTo: 'editor-grid'
        // id: 'idsetup',
        id: 'idpasswordreset',
        width: 390,
        frame: true,
        title: 'Password Reset',
        bodyPadding: '10 10 0',

        defaults: {
            anchor: '100%',
            allowBlank: false,
            msgTarget: 'side',
            labelWidth: 70
        },
        items: [
            {
                name: 'password1',
                xtype: 'textfield',
                dataIndex: 'password1',
                value: "",
                fieldLabel: 'Password'
            },
            {
                name: 'password2',
                xtype: 'textfield',
                value: "",
                dataIndex: 'password2',
                fieldLabel: 'ReType Password'
            }
        ],

        buttons: [{
            text: 'Reset',
            handler: function(){

                idval = 0;

                try{

                    idval = 0;
                    var sm = usergrid.getSelectionModel();
                    var selrecords = sm.getSelection();
                    if(sm.getCount() > 0){
;
                        var BSSSelectedUserId = selrecords[0].get('id');
                      //  alert(BSSSelectedUserId);
                    }

                    var varpassword1 = Ext.getCmp('idpasswordreset').getForm().findField("password1").getValue();
                    var varpassword2 = Ext.getCmp('idpasswordreset').getForm().findField("password2").getValue();

                    if(varpassword1 != varpassword2){
                        alert("Passwords do not match");
                        return;
                    }

                        if(varpassword1 == varpassword2){
                        var SQLString = "UPDATE users Set Password = '" + varpassword1 + "' WHERE id = " + BSSSelectedUserId;
                        //alert(SQLString);

                        try{
                            var xmlHttp = null;
                            xmlHttp = new XMLHttpRequest();
                            xmlHttp.open( "GET", "DBServices/BSSPerformSQLCommand.php?BSSSQLCommand=" + SQLString + "&userid=0", false );
                            xmlHttp.send(null);

                            // alert(xmlHttp.responseText);


                        }catch(e)
                        {alert("Password Reset Update ERROR: " + e.message);
                        }
                      }


                    Ext.getCmp('idpasswordreset').close();
                    passwordreset.close();

                }catch(e)
                {
                    alert(e.message);
                }


            }
        },{
            text: 'Close',
            handler: function() {
                passwordreset.close();
                this.up('form').getForm().close();
                Ext.getCmp('idpasswordreset').close();
            }
        }]
    });

    passwordreset = Ext.create('Ext.window.Window', {
        //  title: 'File Upload',
        width: 400,
        height: 200,
        layout:'absolute',
        defaults: {
            bodyStyle: 'padding:10px'
        },
        items: [passwordresetform]
    });

    passwordreset.show();


}




