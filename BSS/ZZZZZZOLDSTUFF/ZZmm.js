/**
 * Created with JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 10/6/12
 * Time: 9:07 PM
 * To change this template use File | Settings | File Templates.
 */



    //var BSSWorkflowId = 0;


Ext.onReady(function() {




    var simple = Ext.widget({
        xtype: 'form',
        layout: 'form',
        collapsible: true,
        id: 'simpleForm',
        url: 'save-form.php',
        frame: true,
        title: 'Simple Form',
        bodyPadding: '5 5 0',
        width: 350,
        fieldDefaults: {
            msgTarget: 'side',
            labelWidth: 75
        },
        defaultType: 'textfield',
        items: [{
            fieldLabel: 'First Name',
            name: 'first',
            allowBlank:false
        },{
            fieldLabel: 'Last Name',
            name: 'last'
        },{
            fieldLabel: 'Company',
            name: 'company'
        }, {
            fieldLabel: 'Email',
            name: 'email',
            vtype:'email'
        }, {
            fieldLabel: 'DOB',
            name: 'dob',
            xtype: 'datefield'
        }, {
            fieldLabel: 'Age',
            name: 'age',
            xtype: 'numberfield',
            minValue: 0,
            maxValue: 100
        }, {
            xtype: 'timefield',
            fieldLabel: 'Time',
            name: 'time',
            minValue: '8:00am',
            maxValue: '6:00pm'
        }],

        buttons: [{
            text: 'Save'
        },{
            text: 'Cancel'
        }]
    });


    //  alert('here trying to setup window A');
    simple.render(document.body);
});