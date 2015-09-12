/*
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Picker</title>

    <script type="text/javascript">
*/


Ext.Loader.setConfig({
    enabled: true
});
Ext.Loader.setPath('Ext.ux', '../ux');


Ext.define('GooglePicker', {
    name: 'Unknown',
    calltype: 'Unknown',
    userid: 0,

    constructor: function(name,calltype,userid) {

        if (name) {
            this.name = name;
       }

        if (calltype) {
            this.calltype = calltype;
        }

        if (userid) {
            this.userid = userid;
        }

        BSSUserId = this.userid;

        // The Browser API key obtained from the Google Developers Console.
        var developerKey = 'AIzaSyCK_XeYcqfhkjWP5YrQsY2S02lnRE1Jh-g';

        // The Client ID obtained from the Google Developers Console. Replace with your own Client ID.
        var clientId = "324261092842-2td2v8j1kilsfg9qbsnb302dj8t9ncmu.apps.googleusercontent.com";

        // Scope to use to access user's photos.
        var scope = ['https://www.googleapis.com/auth/drive'];

        var pickerApiLoaded = false;
        var oauthToken;

        // Use the API Loader script to load google.picker and gapi.auth.
        function onApiLoad() {
            gapi.load('auth', {'callback': onAuthApiLoad});
            gapi.load('picker', {'callback': onPickerApiLoad});
        }

        function onAuthApiLoad() {
            window.gapi.auth.authorize(
                    {
                        'client_id': clientId,
                        'scope': scope,
                        'immediate': false
                    },
                    handleAuthResult);
        }

        function onPickerApiLoad() {
            pickerApiLoaded = true;
            createPicker();
        }

        function handleAuthResult(authResult) {
            if (authResult && !authResult.error) {
                oauthToken = authResult.access_token;
                createPicker();
            }
        }

        // Create and render a Picker object for picking user Docs.
        function createPicker() {
            if (pickerApiLoaded && oauthToken) {
                var view = new google.picker.DocsView(google.picker.ViewId.DOCS);
         		view.setMode(google.picker.DocsViewMode.LIST);
                var picker = new google.picker.PickerBuilder().
                       // addView(google.picker.ViewId.DOCS).
                        addView(view).
                        setOAuthToken(oauthToken).
                        setDeveloperKey(developerKey).
                        setCallback(pickerCallback).
                        build();
                picker.setVisible(true);
            }
        }

        // A simple callback implementation.
        function pickerCallback(data) {
            var url = 'nothing';
            var file = 'nothing';

            if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
                var doc = data[google.picker.Response.DOCUMENTS][0];
                url = doc[google.picker.Document.URL];
                var fileId = data[google.picker.Response.DOCUMENTS][0].id;

            }
            var message = 'You picked2: ' + url;
            //alert("10");
        //    downloadFile(url,msgcomplete);
            //alert("11");
            document.getElementById('result').innerHTML = message;

        }

        function downloadFile(url, callback) {
            //alert("51");
            if (url != "") {
                //alert("52" + url);
                var accessToken = gapi.auth.getToken().access_token;
                //alert("53");
                var xhr = new XMLHttpRequest();
                //alert("54");

                url = "https://drive.google.com/uc?export=download&id=0ByKjP1Jz2XFIQktaM1N4eFpCc28";

                xhr.open('GET', url);
                //alert("55: " + url);
                 xhr.setRequestHeader('Authorization', 'Bearer ' + accessToken);
                //xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
                alert("56" + url);
				
                xhr.onload = function() {
                    callback(xhr.responseText);
                };
                xhr.onerror = function() {
                    callback("There was an error" + xhr.statusText);
                };
                xhr.send();
				
                //alert("57");
            } else {
                callback("Crashed");
            }
        }

        function msgcomplete(errortxt){
            alert('Download Complete: '  + errortxt);
        }

	}
	
	

/*
    </script>
</head>
<body>
<div id="result"></div>

<!-- The Google API Loader script. -->
<script type="text/javascript" src="https://apis.google.com/js/api.js?onload=onApiLoad"></script>

</body>
</html>

*/