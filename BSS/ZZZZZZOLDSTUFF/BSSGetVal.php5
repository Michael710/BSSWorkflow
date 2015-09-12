<?php

require_once('config.php');

//{ store: teamStore, selModel: 'cellmodel', columns:[ { id:'common', header:'Common NameZZZ', dataIndex:'common', flex:1, editor:{ allowBlank:false } }], width: //400, renderTo:'editor-grid', height: 300 }

$phpval = '{"store": "teamStore", "selModel": "cellmodel"}';

//$phpval = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
	
var_dump(json_decode($phpval));
//var_dump(



?>