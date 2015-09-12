<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 4/15/12
 * Time: 10:26 PM
 * To change this template use File | Settings | File Templates.
 */

//get the combo box store
mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DB) or die(mysql_error());
$SQLCOMBOSTRING = "SELECT " . $arr[$i]->foreignkey . ", " .  $arr[$i]->foreignkeyfield . " FROM " . $arr[$i]->foreignkeytable;
//echo $SQLCOMBOSTRING;
$result = mysql_query($SQLCOMBOSTRING);
//$result = mysql_query("SELECT id, phone_type FROM phone_type");

$BSSCBSTORE = "";
$BSSCBDATA = "";

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {

        $BSSCBSTORE = $BSSCBSTORE . '[' . $row[0] . ", '" . $row[1] . "'],";

        $BSSCBDATA = $BSSCBDATA . '{ id:' . $row[0] . ", value: '" . $row[1] . "'},";

}

$BSSCBSTORE = substr($BSSCBSTORE,0,strlen($BSSCBSTORE)-1);
//$BSSCBDATA = substr($BSSCBDATA,0,strlen($BSSCBDATA)-1);

echo $BSSCBSTORE;