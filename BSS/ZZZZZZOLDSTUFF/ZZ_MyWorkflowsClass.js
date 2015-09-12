/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/


//ActionMaintenanceClass

var BSSMasterConfigName = null;
BSSMasterConfigName = 'Actions';

var myworkflowgrid;
var myworkflowtore;

// create the data store
myworkflowtore = Ext.create('Ext.data.Store', {
    fields: [
        {name: 'id', type: 'string'},
        {name: 'WorkflowName', type: 'string'},
        {name: 'WorkflowDescription', type: 'string'},
        {name: 'xloc', type: 'string'}
    ],
    data:
        [['1','','','']]
});


Ext.define('MyWorkflowsClass', {
    name: 'Unknown',

    constructor: function(name) {

        if (name) {
            this.name = name;
       }
        //return this;

        var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
                clicksToEdit:1
            });

            var cellEditing1 = Ext.create('Ext.grid.plugin.CellEditing', {
                clicksToEdit:1
            });
            var rowEditing = Ext.create('Ext.grid.plugin.RowEditing', {
                clicksToMoveEditor: 1,
                autoCancel: false
            });

            try{

                myworkflowgrid = Ext.create('Ext.grid.Panel', {
                    store: myworkflowtore,
                    selModel: 'cellmodel',
                    listeners: {
                        itemclick: function() {
                            GetChildData();
                        }},
                    columns: [
                        {id: 'id111',
                            header: 'Workflow Id',
                            disabled: true,
                            editable: false,
                            width: 80,
                            dataIndex: 'id'
                        },
                        {id: 'WorkflowName',
                            header: 'Workflow Name',
                            disabled: true,
                            editable: false,
                            width: 250,
                            dataIndex: 'WorkflowName'
                        },
                        {id: 'WorkflowDescription',
                            header: 'Workflow Description',
                            disabled: true,
                            editable: false,
                            width: 350,
                            dataIndex: 'WorkflowDescription'
                        },
                        {id: 'xloc',
                            header: 'X Location',
                            width: 100,
                            disabled: true,
                            editable: false,
                            dataIndex: 'xloc'
                        }

                    ],
                    width: 920,
                    height: 390,
                    x: 10,
                    y: 10,
                    title: 'Open Workflows',
                    frame: true,
                    tbar: [{text: 'Launch Workflow',    handler : function() {LaunchWorkflow("Tables",tablegrid,tablestore);}}
                    ],
                    plugins: [cellEditing1]
                });

         //   mastergrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));
            //gridx.addListener("click",ProcessEdit());

             //Get the data
             xmlHttp = new XMLHttpRequest();
             xmlHttp.open( "GET", "BSSGetWorkflowJSData.php?BSSConfigName=" + BSSMasterConfigName + "&BSSWhereClause=" + "id>0", false );
             xmlHttp.send( null );

            //alert(xmlHttp.responseText);

             var newdata = eval('[' + xmlHttp.responseText + ']');
             myworkflowtore.loadData(newdata,false);

           // document.write("<p>"+ newdata + "</p>");

            }catch(e){alert(e.message);}

            absolute = Ext.create('Ext.window.Window', {
                   title: 'BSS Fast DB',
                   x: 0,
                   y:0,
                   width: 950,
                   height: 440,
                   layout:'anchor',
                   defaults: {
                   bodyStyle: 'padding:5px'
               },
                   items: [myworkflowgrid]
               });

               absolute.show();


}

});


function formatDate(value) {
    return value ? Ext.Date.dateFormat(value, 'Y-m-d') : '';
    // document.write("<p>"+ "Me Goo" + "</p>");
}



function LaunchWorkflow(BSSMasterConfigName,mastergrid,masterStore)
{
    //  Get default data from config array

    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSPerformInsert.php?BSSConfigName=" + BSSMasterConfigName, false );
    xmlHttp.send(null);

    newdata = eval('[' + xmlHttp.responseText + ']');

    masterStore.add(newdata);

}


function formatDate(value) {
    return value ? Ext.Date.dateFormat(value, 'Y-m-d') : '';
    // document.write("<p>"+ "Me Goo" + "</p>");
}

   




