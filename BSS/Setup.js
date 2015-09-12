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



//Get the data
xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "DBServices/BSSGetComboStore.php?BSSSQLString=SELECT id, Email AS value FROM users", false );
xmlHttp.send( null );
 //alert("DATA: " + xmlHttp.responseText);
bssNewFlowManagerData = eval('[' + xmlHttp.responseText + ']');
flowmanagerStore.loadData(bssNewFlowManagerData,false);
// to use for the editor at each header.


//EnableLDAP
//ldaphost
//ldapdn

//
//
//
//emailhost
//emailport
//emailusername
//emailpassword
//NotificationTime
//EscalationTime




   // create the data store
var workflowstore = Ext.create('Ext.data.Store', {
    fields: [
        {name: 'id', type: 'string'},
        {name: 'EnableLDAP', type: 'string'},
        {name: 'ldaphost', type: 'string'},
        {name: 'ldapdn', type: 'string'},
        {name: 'ldapusergroup', type: 'string'},
        {name: 'ldapmanagergroup', type: 'string'},
        {name: 'ldapuserdomain', type: 'string'},
        {name: 'emailhost', type: 'string'},
        {name: 'emailport', type: 'string'},
        {name: 'emailusername', type: 'string'},
        {name: 'emailpassword', type: 'string'},
        {name: 'NotificationTime', type: 'string'},
        {name: 'EscalationTime', type: 'string'}

    ],
    data:
               [['1','','','','','','','','','','']]
});



Ext.define('Setup', {
    name: 'Unknown',
    calltype: 'Unknown',


    constructor: function(name,calltype) {

        if (name) {
            this.name = name;
       }

        if (calltype) {
            this.calltype = calltype;
        }

       // create the grid and specify what field you want


        //Get the data
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "Workflow/BSSGetAdvWorkflowSetupData.php", false );
        xmlHttp.send( null );
        //alert("DATA: " + xmlHttp.responseText);
        var wsdata =eval('[' + xmlHttp.responseText + ']');

        var BSSLDAPHost = wsdata[0].ldaphost;
        var BSSLDAPDN = wsdata[0].ldapdn;
        var BSSLDAPUG = wsdata[0].ldapusergroup;
        var BSSLDAPMG = wsdata[0].ldapmanagergroup;
        var BSSLDAPUD = wsdata[0].ldapuserdomain;
        var BSSEMAILHOST = wsdata[0].emailhost;
        var BSSEMAILPORT = wsdata[0].emailport;
        var BSSEMAILUSERNAME = wsdata[0].emailusername;
        var BSSEMAILPASSWORD = wsdata[0].emailpassword;
        var BSSNOTIFICATIONTIME = wsdata[0].NotificationTime;
        var BSSESCALATIONTIME = wsdata[0].EscalationTime;


        var setup = Ext.create('Ext.form.Panel', {
            //   renderTo: 'editor-grid'
            id: 'idsetup',
            name: 'idsetup',
            width: 390,
            frame: true,
            title: 'Setup',
            bodyPadding: '10 10 0',

            defaults: {
                anchor: '100%',
                allowBlank: false,
                msgTarget: 'side',
                labelWidth: 70
            },
            items: [
             {
                name: 'ldaphost',
                xtype: 'textfield',
                dataIndex: 'ldaphost',
                value: BSSLDAPHost,
                fieldLabel: 'LDAP Host'
             },
             {
                name: 'ldapdn',
                xtype: 'textfield',
                value: BSSLDAPDN,
                dataIndex: 'ldapdn',
                fieldLabel: 'LDAP DN String'
             },
             {
                name: 'ldapusergroup',
                xtype: 'textfield',
                value: BSSLDAPUG,
                dataIndex: 'ldapusergroup',
                fieldLabel: 'LDAP User Group'
             },
             {
                name: 'ldapmanagergroup',
                xtype: 'textfield',
                value: BSSLDAPMG,
                dataIndex: 'ldapmanagergroup',
                fieldLabel: 'LDAP Manager Group'
             },
             {
                name: 'ldapuserdomain',
                xtype: 'textfield',
                value: BSSLDAPUD,
                dataIndex: 'ldapuserdomain',
                fieldLabel: 'LDAP User Domain'
             },
             {
                name: 'emailhost',
                xtype: 'textfield',
                value: BSSEMAILHOST,
                dataIndex: 'emailhost',
                fieldLabel: 'Email Host'
             },
             {
                name: 'emailport',
                xtype: 'textfield',
                value: BSSEMAILPORT,
                dataIndex: 'emailport',
                fieldLabel: 'Email Port'
             },
             {
                name: 'emailusername',
                xtype: 'textfield',
                value: BSSEMAILUSERNAME,
                dataIndex: 'emailusername',
                fieldLabel: 'Email Username'
             },
             {
                name: 'emailpassword',
                xtype: 'textfield',
                value: BSSEMAILPASSWORD,
                dataIndex: 'emailpassword',
                fieldLabel: 'Email Password'
             },
             {
                name: 'NotificationTime',
                xtype: 'textfield',
                value: BSSNOTIFICATIONTIME,
                dataIndex: 'NotificationTime',
                fieldLabel: 'Notification Time'
             },
             {
                name: 'EscalationTime',
                xtype: 'textfield',
                value: BSSESCALATIONTIME,
                dataIndex: 'EscalationTime',
                fieldLabel: 'Escalation Time'
             }
        ],

            buttons: [{
                text: 'Save',
                handler: function(){

                    idval = 0;

                    try{

                        var varldaphost = Ext.getCmp('idsetup').getForm().findField("ldaphost").getValue();
                        var varldapdn = Ext.getCmp('idsetup').getForm().findField("ldapdn").getValue();
                        var varldapusergroup = Ext.getCmp('idsetup').getForm().findField("ldapusergroup").getValue();
                        var varldapmanagergroup = Ext.getCmp('idsetup').getForm().findField("ldapmanagergroup").getValue();
                        var varldapuserdomain = Ext.getCmp('idsetup').getForm().findField("ldapuserdomain").getValue();
                        var varemailhost = Ext.getCmp('idsetup').getForm().findField("emailhost").getValue();
                        var varemailport = Ext.getCmp('idsetup').getForm().findField("emailport").getValue();
                        var varemailusername = Ext.getCmp('idsetup').getForm().findField("emailusername").getValue();
                        var varemailpassword = Ext.getCmp('idsetup').getForm().findField("emailpassword").getValue();
                        var varNotificationTime = Ext.getCmp('idsetup').getForm().findField("NotificationTime").getValue();
                        var varEscalationTime = Ext.getCmp('idsetup').getForm().findField("EscalationTime").getValue();


                        var SQLString = "UPDATE Setup Set"
                        + " ldaphost = '" + varldaphost + "',"
                        + " ldapdn = '" + varldapdn + "',"
                        + " ldapusergroup = '" + varldapusergroup + "',"
                        + " ldapmanagergroup = '" + varldapmanagergroup + "',"
                        + " ldapuserdomain = '" + varldapuserdomain + "',"
                        + " emailhost = '" + varemailhost + "',"
                        + " emailport = '" + varemailport + "',"
                        + " emailusername = '" + varemailusername + "',"
                        + " emailpassword = '" + varemailpassword + "',"
                        + " NotificationTime = '" + varNotificationTime + "',"
                        + " EscalationTime = '" + varEscalationTime + "'";


                        alert(SQLString);

                        try{
                            var xmlHttp = null;
                            xmlHttp = new XMLHttpRequest();
                            xmlHttp.open( "GET", "DBServices/BSSPerformSQLCommand.php?BSSSQLCommand=" + SQLString + "&userid=0", false );
                            xmlHttp.send(null);

                            // alert(xmlHttp.responseText);

                        }catch(e)
                        {document.write("<p>" + "Master Data Get ERROR: " + e.message + "</p>");
                        }


                        Ext.getCmp('idsetup').close();
                        absolutedoc.close();

                    }catch(e)
                    {
                        alert(e.message);
                    }


                }
            },{
                text: 'Close',
                handler: function() {
                    absolutedoc.close();
                    this.up('form').getForm().close();
                    Ext.getCmp('idfilecheckin').close();
                }
            }]
        });

        absolutedoc = Ext.create('Ext.window.Window', {
            //  title: 'File Upload',
            width: 400,
            height: 500,
            layout:'absolute',
            defaults: {
                bodyStyle: 'padding:10px'
            },
            items: [setup]
        });

        absolutedoc.show();



    }

});



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







