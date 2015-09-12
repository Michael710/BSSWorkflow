<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 6/21/12
 * Time: 6:25 PM
 * To change this template use File | Settings | File Templates.
 */

//$attachment_location = $_SERVER["DOCUMENT_ROOT"] . "/10e20498.pdf";



$Id = $_GET['BSSid'];
//$Version = $_GET['BSSVersion'];
$FileName = $_GET['BSSFileName'];
//$Version = $_GET['BSSVersion'];


$attachment_location =  $Id . $FileName;

if (file_exists($attachment_location)) {

    header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
    header("Cache-Control: public"); // needed for i.e.
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: Binary");
    header("Content-Length:".filesize($attachment_location));
    header("Content-Disposition: attachment; filename=" . $FileName);
    readfile($attachment_location);
    die();
} else {
    die("Error: File not found. ".$attachment_location);
}