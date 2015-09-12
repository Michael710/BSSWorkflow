<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 1/8/12
 * Time: 5:02 PM
 * To change this template use File | Settings | File Templates.
 */
$InString = '{ "id": 6, "phone_type": "mobile", "phone_date": "06/10/11","phone_on": 1}';

//$InString = '{"a":1,"b":2,"c":3,"d":4,"e":5}';


var_dump(json_decode($InString));
var_dump(json_decode($InString, true));


echo strpos($InString,'{');
echo strpos($InString,':');
echo strpos($InString,',');


$SQL = "DELETE FROM " . $TableName . ' WHERE  ' . $arr[0]->tablename;

//echo $SQL;

//mysql_connect("localhost", "root", "root") or die(mysql_error());
//mysql_select_db("EXTJS") or die(mysql_error());
//$result = mysql_query($SQL);



?>