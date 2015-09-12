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


var openwindows;   // mqke javascript arrary

var BSSConfigName = null;
var absolute = null;
BSSConfigName = 'Phone';
var bssTree;
var simple;
var loggedin = false;
var userid = "";

var BSSGlobalUser = 'AdminZZZ';


//Get the DataStore
var xmlHttp = null;
xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "BSSGetStore.php?BSSConfigName=" + BSSConfigName, false );
xmlHttp.send( null );
//alert("Store String:  " + xmlHttp.responseText);

try{
var masterStore = Ext.create('Ext.data.Store', eval('(' + xmlHttp.responseText + ')'));
}catch(e)
    {document.write("<p>" + e.message + "</p>");}

var gridx;
var gridy;
var rectabs;

Ext.require([
    'Ext.selection.CellModel',
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.util.*',
    'Ext.state.*',
    'Ext.form.*',
    'Ext.ux.CheckColumn'
]);


function formatDate(value) {
    return value ? Ext.Date.dateFormat(value, 'Y-m-d') : '';
    // document.write("<p>"+ "Me Goo" + "</p>");
}


function processUpdate()
{
    var updrecords = bssStore.getUpdatedRecords();

    var fieldname = "phone_type";
    var rec = new bssStore.model();

    jsenc = "";
    var fieldcount = rec.fields.getCount();

    var xfieldtype;
    var xfieldname;


    for(x = 0; x < fieldcount; x++){
         xfieldtype = rec.fields.getAt(x).type.type;
         xfieldname = rec.fields.getAt(x).name;

        switch(xfieldtype){
        case "date":
            jsenc = jsenc + formatDate(updrecords[0].get(xfieldname)) + "||";
        break;
        case "bool":
            if(updrecords[0].get(xfieldname).toString()=='true'){
                jsenc = jsenc + "1" + "||";
            }else{
                jsenc = jsenc + "0" + "||";
            }
        break;
        default:
        jsenc = jsenc + updrecords[0].get(xfieldname) + "||";
        }

    }


try{
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSPerformUpdate.php?BSSConfigName=" + BSSConfigName + "&id=" + jsenc, false);

      xmlHttp.open( "GET", "BSSPerformUpdate.php?BSSConfigName=" + BSSConfigName + "&id=" + jsenc, false);


    xmlHttp.send(null);
    //document.write("<p>"+ xmlHttp.responseText + "</p>");

     //REmove the red triangle
     bssStore.each(function(r){
      r.commit();
     });


}catch(e)
    {document.write("<p>" + e.message + "</p>");}
}

function Login(strUserName, strPassWord)
{
    //Login and Get the Tree Grid Configuration

    if(loggedin==true){
            alert('You are already logged in');
            return;
    }



    try{
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
 //   xmlHttp.open( "GET", "BSSLogin.php?BSSUserName="+strUserName+"&BSSPassword="+strPassWord, false );

    xmlHttp.open( "GET", "BSSLogin.php?BSSUserName="+strUserName+"&BSSPassword="+strPassWord, false );

    xmlHttp.send( null );
    userid = xmlHttp.responseText;
    }catch(e)
        {document.write("<p>" + e.message + "</p>");
    }


    if(userid.length <= 0){
        alert('Invalid Login');
        return;
    }

    loggedin = true;

    try{
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    //xmlHttp.open( "GET", "BSSGetTreeConfig.php?BSSUserId=" + userid, false );

    xmlHttp.open( "GET", "BSSGetTreeConfig.php?BSSUserId=" + userid, false );


    xmlHttp.send( null );
    // alert(xmlHttp.responseText);
    bssTree = Ext.create('Ext.tree.Panel', eval('(' + xmlHttp.responseText + ')'));
    }catch(e)
        {document.write("<p>" + e.message + "</p>");
    }

    absolute.add(bssTree);

 }

function Logout(strTest)
{
    absolute.remove(bssTree);
    loggedin = false;
}


/*
function processDelete()
{

      var sm = gridx.getSelectionModel();
      bssStore.remove(sm.getSelection());
        if (bssStore.getCount() > 0) {
            sm.select(0);
        }
      var delrecords = bssStore.getRemovedRecords();
      var fieldname = "id";

    try{
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSPerformDelete.php?BSSConfigName=" + BSSConfigName + "&id=" + delrecords[0].get('id'), false);
        xmlHttp.send(null);

        //document.write("<p>"+ xmlHttp.responseText + "</p>");

    }catch(e)
        {document.write("<p>" + e.message + "</p>");
    }


}

*/

/*
function processInsert()
{
    //  Get default data from config array

    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSPerformInsert.php?BSSConfigName=" + BSSConfigName, false );
    xmlHttp.send(null);

    newdata = eval('[' + xmlHttp.responseText + ']');

    bssStore.add(newdata);

}
*/

function CreateGrid(StrCURBSSConfigName)
{

    try{

        var win = Ext.create('TableWindowClass', StrCURBSSConfigName);

    }catch(e){alert(e.message);}



}


function RouteRequest(strRouting){

    strRoutingName = strRouting.substring(0,strRouting.indexOf("|"));
    strTaskName = strRouting.substring(strRouting.indexOf("|")+1, strRouting.length);

    //alert(strRoutingName);
    //alert(strTaskName);

    if(strRoutingName == "Enterprise Objects"){
        CreateEnterpriseObjects(strTaskName);
    }

    if(strRoutingName == "Reports"){
        CreateReport(strTaskName);
    }

    if(strRoutingName == "Tables"){
        CreateGrid(strTaskName);
    }

    if(strRoutingName == "Your Workflow Approvals"){
        MyWorkflows(strTaskName);
    }




    if(strRoutingName == "Admin"){
        switch(strTaskName){
            case "Enterprise Objects":
                ManageEnterpriseObjects();
                break;
            case "Tables":
                ManageTables('Tables');
                break;
            case "Actions":
                ManageActions();
                break;
            case "Queries":
                QueryMaintenance();
                break;
            case "Workflows":
                WorkflowMaintenance();
                break;
            case "Notifications":
                NotificationMaintenance();
                break;
            case "Reports":
                ReportMaintenance();
                break;
            case "Users":
                UserMaintenance();
                break;
            case "Roles":
                RoleMaintenance();
                break;
        }
    }
}

function CreateEnterpriseObjects(strObjectName){

    try{

        //  alert(strObjectName);

        // Add to public list so we do not open again.

        var win = Ext.create('EnterpriseObjectForm', strObjectName, "Object", userid);

    }catch(e){alert(e.message);}

}


function CreateReport(strReportName){

    try{

        var win = Ext.create('RunReportClass', strReportName);

    }catch(e){alert(e.message);}

}


function ManageEnterpriseObjects(){

    try{

        var win = Ext.create('EnterpriseObjectsClass');

    }catch(e){alert(e.message);}

}


function ManageTables(strTableName){

    try{

        var win = Ext.create('TableMaintenance', strTableName);

    }catch(e){alert(e.message);}

}

function ManageActions(){

    try{


        var win = Ext.create('ActionMaintenanceClass');

    }catch(e){alert(e.message);}

}


function QueryMaintenance(){
    try{

        var win = Ext.create('QueryClass');

    }catch(e){alert(e.message);}
}



function MyWorkflows(){
    try{

        var win = Ext.create('MyWorkflowsClass');

    }catch(e){alert(e.message);}
}

function WorkflowMaintenance(){
    try{

        window.open("WorkflowDesigner.html",height=200,width=150);
        //var win = Ext.create('Workflows');

    }catch(e){alert(e.message);}
}


function NotificationMaintenance(){
    try{

        var win = Ext.create('NotificationMaintenanceClass');

    }catch(e){alert(e.message);}
}


function ReportMaintenance(){
    try{

        var win = Ext.create('ReportsClass');

    }catch(e){alert(e.message);}

}

function UserMaintenance(){

    try{
        var strTableName = 'Users';
        var win = Ext.create('Users', strTableName);

    }catch(e){alert(e.message);}

}

function RoleMaintenance(){
    CreateGrid('Roles')
}


Ext.onReady(function() {

    Ext.QuickTips.init();
    var bd = Ext.getBody();

    simple = Ext.create('Ext.form.Panel', {

       // url:'save-form.php',
        id: 'loginform',
        frame:true,
        title: 'Login',
        bodyStyle:'padding:5px 5px 0',
        width: 200,
        fieldDefaults: {
            msgTarget: 'side',
            labelWidth: 50
        },
        defaultType: 'textfield',
        defaults: {
            anchor: '100%'
        },

        items: [{
            id: 'login',
            fieldLabel: 'Login',
            name: 'login',
            text: 'Mike',
            allowBlank:false
        },{
            id: 'password',
            fieldLabel: 'Password',
            name: 'password',
            inputType: 'password'
        }],

        buttons: [{
            text: 'Login',
            listeners: {
                        click: function() {
                        var username = Ext.getCmp('loginform').getForm().findField('login').getValue();
                        var password = Ext.getCmp('loginform').getForm().findField('password').getValue();
                        Login(username,password);
                        } }
        },{
        text: 'Logout',
            listeners: {
                        click: function() {
                        Logout(this.text);
                        } }
      }]
    });



   absolute = Ext.create('Ext.window.Window', {
       title: 'BSS Fast DB',
       x: 0,
       y:20,
       width: 210,
       height: 600,
       layout:'absolute',
       defaults: {
       bodyStyle: 'padding:5px'
   },
       items: [simple]
   });

   absolute.show();


   Ext.getCmp('loginform').getForm().findField('login').setValue('Mike');

});






