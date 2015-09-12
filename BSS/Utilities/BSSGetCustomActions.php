<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 6/2/13
 * Time: 10:06 PM
 * To change this template use File | Settings | File Templates.
 */


try{

//echo getcwd();

if ($handle = opendir(getcwd() . '/CustomActions')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            $page_name=substr($file, 0, strpos($file, "."));
            echo "$page_name<br>";
        }
    }
}
closedir($handle);

}catch(Exception $x){

    echo $x;

}


?>

