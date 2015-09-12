<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 4/7/12
 * Time: 7:08 PM
 * To change this template use File | Settings | File Templates.
 */


include 'BSSSQLConfig.php';
include 'BSSSQLOperation.php';

$TableName = $_GET['BSSTableName'];

ProcessTable($TableName);


?>