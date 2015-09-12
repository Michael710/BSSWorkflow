<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 4/4/12
 * Time: 8:26 AM
 * To change this template use File | Settings | File Templates.
 */

include 'BSSSQLConfig.php';
include 'BSSSQLOperation.php';

$Con = new SQLConfig();
$arr = $Con->getName($_GET['BSSConfigName'],'MASTER');
$IdString = $_GET['id'];

$TableName = $arr[0]->tablename;

$SQL = "DELETE FROM Documents WHERE id = "  . $IdString;

PerformSQLOperation($SQL);

//move deleted file