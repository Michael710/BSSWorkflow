<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 4/7/12
 * Time: 12:39 PM
 * To change this template use File | Settings | File Templates.
 */

include 'BSSSQLConfig.php';
include 'BSSSQLOperation.php';

session_start();

$UserName = $_GET['BSSUserName'];
$Password = $_GET['BSSPassword'];
//$UserName = 'Mike';

mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DB) or die(mysql_error());

$result = mysql_query("SELECT id, AdminUser FROM users WHERE
                        Login = '" . $UserName . "'");

$row = mysql_fetch_assoc($result);
$UserId = $row["id"];
$AdminUser = $row["AdminUser"];

$_SESSION['BSSUserId'] = $UserId;
$_SESSION['BSSAdminUser'] = $AdminUser;

echo $UserId;

?>
