<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 4/3/12
 * Time: 12:13 AM
 * To change this template use File | Settings | File Templates.
 */

    header('Content-type: text/');
    header('Content-Disposition: attachment; filename="MM107AAA.properties"');
    readfile('MM107.properties');
     //assuming that the files are stored in a directory, not in a database
?>