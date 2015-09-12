Ext.Loader.setConfig({
    enabled:true
});
Ext.Loader.setPath('Ext.ux', '../ux');

try {
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

} catch (e) {
    alert(e.message);
}


//var openwindows;   // mqke javascript arrary


var absolute = null;
var bssTree;
var simple;
var loggedin = false;
var BSSUserid = "";
var BSSLoginResult = "";

var BSSGlobalUser = 'AdminZZZ';


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
}


function Login(strUserName, strPassWord) {
    //Login and Get the Tree Grid Configuration
    if (loggedin == true) {
        alert('You are already logged in');
        return;
    }

    try {
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", "Utilities/BSSLogin.php?BSSUserName=" + strUserName + "&BSSPassword=" + strPassWord, false);
        xmlHttp.send(null);
        BSSLoginResult = xmlHttp.responseText;
        alert(BSSLoginResult);
    } catch (e) {
        document.write("<p>" + e.message + "</p>");
    }

    if (BSSLoginResult.length > 30) {
        window.open(BSSLoginResult);
        return;
    }

    if (BSSLoginResult.length < 10) {
        BSSUserid = BSSLoginResult;
    }

    if (BSSUserid.length <= 0) {
        alert('Invalid Login');
        return;
    }

    loggedin = true;

    try {
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", "DBServices/BSSAdvWorkflowTreeConfig.php?BSSUserId=" + BSSUserid, false);
        xmlHttp.send(null);
        //alert(xmlHttp.responseText);
        bssTree = Ext.create('Ext.tree.Panel', eval('(' + xmlHttp.responseText + ')'));
    } catch (e) {
        document.write("<p>" + e.message + "</p>");
    }
    absolute.add(bssTree);
}

function Logout(strTest) {
    absolute.remove(bssTree);
    loggedin = false;
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "Utilities/BSSGoogleLogout.php", false);
    xmlHttp.send(null);	
	
	
}


function CreateGrid(StrCURBSSConfigName) {
    try {
        var win = Ext.create('TableWindowClass', StrCURBSSConfigName);
    } catch (e) {
        alert(e.message);
    }
}


function RouteRequest(strRouting) {

    strRoutingName = strRouting.substring(0, strRouting.indexOf("|"));
    strTaskName = strRouting.substring(strRouting.indexOf("|") + 1, strRouting.length);

    if (strRoutingName == "Reports") {
        CreateReport(strTaskName);
    }

    if (strRoutingName == "Create Workflows") {
        WorkflowMaint(strTaskName);
    }

    if (strRoutingName == "Your Workflows") {
        WorkflowMaint(strTaskName);
    }

    if (strRoutingName == "Admin") {
        switch (strTaskName) {
            case "Workflow Designer":
                WorkflowMaintenance();
                break;
            case "All Workflow Instances":
                WorkflowInstances();
                break;
            case "All Late Workflows":
                LateWorkflowInstances();
                break;
            case "Reports":
                ReportMaintenance();
                break;
            case "Users":
                UserMaintenance();
                break;
            case "Setup":
                SetupMaintenance();
                break;
            case "Custom Actions":
                CustomActionMaintenance();
                break;
        }
    }
}


function WorkflowMaint(strWorkflowType) {
    try {
        var win = Ext.create('AdvWorkflows', strWorkflowType, strWorkflowType, BSSUserid);
    } catch (e) {
        alert(e.message);
    }
}


function CreateReport(strReportName) {
    try {
        alert('test');
        var win = Ext.create('RunReportClass', strReportName);
    } catch (e) {
        alert(e.message);
    }
}

function LateWorkflowInstances() {
    try {
        var win = Ext.create('AdvWorkflows', 'All Late Workflows', 'All Late Workflows',BSSUserid);
    } catch (e) {
        alert(e.message);
    }
}


function WorkflowInstances() {
    try {
        var win = Ext.create('AdvWorkflows', 'All Workflow Instances', 'All Workflow Instances',BSSUserid);
    } catch (e) {
        alert(e.message);
    }
}

function MyWorkflows() {
    try {
        var win = Ext.create('MyWorkflowsClass');
    } catch (e) {
        alert(e.message);
    }
}

function WorkflowMaintenance() {
    try {
        window.open("NEWWorkflowDesigner.html?foo=Design", height = 200, width = 150);
    } catch (e) {
        alert(e.message);
    }
}

function ReportMaintenance() {
    try {
        var win = Ext.create('ReportsClass');
    } catch (e) {
        alert(e.message);
    }
}

function UserMaintenance() {
    try {
		
	var w = new Ext.Window({
    autoLoad: {
    url: "GooglePicker1.html",
//    params: { 
 //     firstName: "Shuman", 
 //     lastName: "Human"
 //   },
   // callback: someCallbackFuncion,
    //scope: someObjectObject,
    discardUrl: true,
    nocache: true,
    text: "Loading...",
    timeout: 60,
			expandOnShow: true,
		modal: true,
		plain: true,
		renderTo: this.body,
    scripts: true 
  },
  height: 300,
  width: 600
});	
		
	w.show();
		
		
      //  var strTableName = 'Users';
       // var win = Ext.create('Users', strTableName);
    } catch (e) {
        alert(e.message);
    }
}

function SetupMaintenance() {
    try {
        var strTableName = 'Setup';
        var win = Ext.create('Setup', strTableName);
    } catch (e) {
        alert(e.message);
    }
}

function CustomActionMaintenance() {
    try {
        var strTableName = 'CustomActions';
        var win = Ext.create('CustomActions', strTableName);
    } catch (e) {
        alert(e.message);
    }
}


Ext.onReady(function () {
    Ext.QuickTips.init();
    var bd = Ext.getBody();
    simple = Ext.create('Ext.form.Panel', {
        // url:'save-form.php',
        id:'loginform',
        frame:true,
        title:'Login',
        bodyStyle:'padding:5px 5px 0',
        width:200,
        fieldDefaults:{
            msgTarget:'side',
            labelWidth:50
        },
        defaultType:'textfield',
        defaults:{
            anchor:'100%'
        },
        items:[
            {
                id:'login',
                fieldLabel:'Login',
                name:'login',
                allowBlank:false
            },
            {
                id:'password',
                fieldLabel:'Password',
                name:'password',
                inputType:'password',
                allowBlank:false
            }
        ],
        buttons:[
            {
                text:'Login',
                listeners:{
                    click:function () {
                        var username = Ext.getCmp('loginform').getForm().findField('login').getValue();
                        var password = Ext.getCmp('loginform').getForm().findField('password').getValue();
                        Login(username, password);
                    } }
            },
            {
                text:'Logout',
                listeners:{
                    click:function () {
                        Logout(this.text);
                    } }
            }
        ]
    });

    absolute = Ext.create('Ext.window.Window', {
        title:'BSS Advanced Workflows',
        x:0,
        y:20,
        width:210,
        height:600,
        layout:'absolute',
        defaults:{
            bodyStyle:'padding:5px'
        },
        items:[simple]
    });

    absolute.show();

    Ext.getCmp('loginform').getForm().findField('login').setValue('Mike');
    Ext.getCmp('loginform').getForm().findField('password').setValue('Test');

});






