<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 6/28/12
 * Time: 9:02 AM
 * To change this template use File | Settings | File Templates.
 */


    include 'BSSSQLOperation.php';

    $Id = $_GET['BSSid'];
    $UserId = $_GET['BSSUserId'];
    $Version = $_GET['BSSVersion'];
    $FileName = $_GET['BSSfilename'];

    $SQLString = "UPDATE Documents Set checkoutuser = null WHERE id = " . $Id;
    //echo $SQLString;
    $LastId = PerformSQLOperation($SQLString);
