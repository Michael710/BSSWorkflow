/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/

var BSSConfigName;

Ext.define('RunReportClass', {
    name: 'Unknown',


    constructor: function(name) {

        if (name) {
            this.name = name;
        }
        //return this;

       var mastergrid;
       var BSSReportConfigName = this.name;


            var cellEditing1 = Ext.create('Ext.grid.plugin.CellEditing', {
                clicksToEdit:1
            });

   //         var rowEditing = Ext.create('Ext.grid.plugin.RowEditing', {
   //             clicksToMoveEditor: 1,
   //             autoCancel: false
   //         });

            //Get the DataStore
            try{
                var xmlHttp = null;
                xmlHttp = new XMLHttpRequest();
                xmlHttp.open( "GET", "BSSGetReportStore.php5?BSSReportName=" + BSSReportConfigName, false );
                xmlHttp.send( null );
              //  alert("Store String:  " + xmlHttp.responseText);

                var masterStore = Ext.create('Ext.data.Store', eval('(' + xmlHttp.responseText + ')'));
            }catch(e)
            {alert(e.message);}


            try{

                //Get the Grid Configuration
                var xmlHttp = null;
                xmlHttp = new XMLHttpRequest();
                xmlHttp.open( "GET", "BSSGetReportConfig.php?BSSReportName=" + BSSReportConfigName, false );
                xmlHttp.send( null );
               // alert("Report Grid Config" + xmlHttp.responseText);

                mastergrid = new Ext.grid.Panel(eval('(' + xmlHttp.responseText + ')'));

                 //Get the data
                xmlHttp = new XMLHttpRequest();
                xmlHttp.open( "GET", "BSSGetReportData.php5?BSSReportName=" + BSSReportConfigName + "&BSSWhereClause=" + "id>0", false );
                xmlHttp.send( null );

                //alert("Report Data:"+ xmlHttp.responseText);

                var newdata = eval('[' + xmlHttp.responseText + ']');
                masterStore.loadData(newdata,false);

           // document.write("<p>"+ newdata + "</p>");

            }catch(e){alert(e.message);}


            absolute = Ext.create('Ext.window.Window', {
                   title: 'Reports',
                   x: 150,
                   y:20,
                   width: 940,
                   height: 650,
                   layout:'anchor',
                   defaults: {
                   bodyStyle: 'padding:5px'
               },
                   items: [mastergrid]
               });

               absolute.show();


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


function formatDate(value) {
    return value ? Ext.Date.dateFormat(value, 'Y-m-d') : '';
    // document.write("<p>"+ "Me Goo" + "</p>");
}


   





