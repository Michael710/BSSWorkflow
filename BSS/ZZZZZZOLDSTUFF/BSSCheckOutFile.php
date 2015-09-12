<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 6/25/12
 * Time: 8:10 PM
 * To change this template use File | Settings | File Templates.
 */

include 'BSSSQLOperation.php';

$Id = $_GET['BSSid'];
$UserId = $_GET['BSSUserId'];
$Version = $_GET['BSSVersion'];
$FileName = $_GET['BSSfilename'];

$attachment_location =  $Id . $Version . $FileName;

if (file_exists($attachment_location)) {


    header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
    header("Cache-Control: public"); // needed for i.e.
    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: Binary");
    header("Content-Length:".filesize($attachment_location));
    header("Content-Disposition: attachment; filename=" . $FileName);

   // $fp = fopen("$yourfile", "r");
  //  fpassthru($fp);



    $SQLString = "UPDATE Documents Set checkoutuser = " . $UserId . " WHERE id = " . $Id;
    //echo $SQLString;
    $LastId = PerformSQLOperation($SQLString);

    readfile($attachment_location);

    die();
} else {
    die("Error: File not found. ".$attachment_location);
}