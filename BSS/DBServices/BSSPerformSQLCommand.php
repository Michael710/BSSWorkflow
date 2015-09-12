<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 8/1/12
 * Time: 10:04 PM
 * To change this template use File | Settings | File Templates.
 */
include 'BSSSQLOperation.php';

$SQLCommand = stripcslashes($_GET['BSSSQLCommand']);

mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DB) or die(mysql_error());
$result = mysql_query($SQLCommand);

echo $SQLCommand;

echo " RESULT:    ";

echo $result;