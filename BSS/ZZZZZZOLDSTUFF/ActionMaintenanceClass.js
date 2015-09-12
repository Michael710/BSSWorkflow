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
var mastergrid;
var masterStore;


Ext.define('ActionMaintenanceClass', {
    name: 'Unknown',

    constructor: function(name) {

        if (name) {
            this.name = name;
       }
        //return this;

//Get the DataStore
var xmlHttp = null;
xmlHttp = new XMLHttpRequest();
xmlHttp.open( "GET", "BSSGetStore.php?BSSConfigName=" + BSSMasterConfigName, false );
xmlHttp.send( null );
//document.write("<p>"+ "Store String:  " + xmlHttp.responseText + "</p>");

try{
var masterStore = Ext.create('Ext.data.Store', eval('(' + xmlHttp.responseText + ')'));
}catch(e)
    {document.write("<p>" + e.message + "</p>");}


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

            //Get the Grid Configuration
            var xmlHttp = null;
            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "BSSGetConfig.php?BSSConfigName=" + BSSMasterConfigName + "&BSSConfigMode=MASTER", false );
            xmlHttp.send( null );
             // document.write("<p>"+ "TEST" + xmlHttp.responseText + "</p>");

            mastergrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));
            //gridx.addListener("click",ProcessEdit());

             //Get the data
             xmlHttp = new XMLHttpRequest();
             xmlHttp.open( "GET", "BSSGetJSData.php?BSSConfigName=" + BSSMasterConfigName + "&BSSWhereClause=" + "id>0", false );
             xmlHttp.send( null );

          // document.write("<p>"+ xmlHttp.responseText + "</p>");

             var newdata = eval('[' + xmlHttp.responseText + ']');
             masterStore.loadData(newdata,false);

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
                   items: [mastergrid]
               });

               absolute.show();


}

});


function formatDate(value) {
    return value ? Ext.Date.dateFormat(value, 'Y-m-d') : '';
    // document.write("<p>"+ "Me Goo" + "</p>");
}


function processUpdate(BSSMasterConfigName,mastergrid,masterStore)
{



    var updrecords = masterStore.getUpdatedRecords();
    
    //var fieldname = "phone_type";
    var rec = new masterStore.model();

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


try{
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "BSSPerformUpdate.php?BSSConfigName=" + BSSMasterConfigName + "&id=" + jsenc, false);
    xmlHttp.send(null);
    
    
    //document.write("<p>"+ xmlHttp.responseText + "</p>");

    
     //REmove the red triangle
     masterStore.each(function(r){
      r.commit();
     });
    

}catch(e)
    {document.write("<p>" + e.message + "</p>");}
}



function processDelete(BSSMasterConfigName,mastergrid,masterStore)
{
      var sm = mastergrid.getSelectionModel();
      masterStore.remove(sm.getSelection());
        if (masterStore.getCount() > 0) {
            sm.select(0);
        }
      var delrecords = masterStore.getRemovedRecords();
      var fieldname = "id";

    try{
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "BSSPerformDelete.php?BSSConfigName=" + BSSMasterConfigName + "&id=" + delrecords[0].get('id'), false);
        xmlHttp.send(null);
        
        //document.write("<p>"+ xmlHttp.responseText + "</p>");
        masterStore.removed = [];
    }catch(e)
        {document.write("<p>" + e.message + "</p>");
    }




}

function processInsert(BSSMasterConfigName,mastergrid,masterStore)
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

   




