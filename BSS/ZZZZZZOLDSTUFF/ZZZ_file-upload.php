<?php
    sleep(1);

    $sqlstring = $_GET['BSSSqlString'];
    $tmp_name = $_FILES["photo-path"]["tmp_name"];
    $name = $_FILES["photo-path"]["name"];

    move_uploaded_file($tmp_name, "".$name);
echo $sqlstring;
   // $LastId = PerformSQLOperation($sqlstring);


    echo '{success:true, file:'.json_encode($_FILES['photo-path']['name']).'}';
?>