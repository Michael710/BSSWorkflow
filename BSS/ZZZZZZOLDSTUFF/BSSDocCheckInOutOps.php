<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 4/4/12
 * Time: 8:28 AM
 * To change this template use File | Settings | File Templates.
 */


include 'BSSSQLConfig.php';
include 'BSSSQLOperation.php';

$Con = new SQLConfig();
$arr = $Con->getName($_GET['BSSConfigName'],'MASTER',$_GET['BSSUserId']);
$IdString = $_GET['id'];
$OperationType = $_GET['BSSOpType'];
$User = $_GET['BSSUserId'];

IF ($OperationType == 'CheckOut')
{
    $SQL = "UPDATE Documents SET CheckOutUser ". $User . " WHERE id = "  . $IdString;
}

IF ($OperationType == 'CancelCheckOut')
{
    $SQL = "UPDATE Documents SET CheckOutUser = null WHERE id = "  . $IdString;
}

IF ($OperationType == 'CheckIn')
{
    $SQL = "UPDATE Documents SET CheckOutUser = null WHERE id = "  . $IdString;
}

echo $SQL;

PerformSQLOperation($SQL);
