<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 1/22/12
 * Time: 1:01 PM
 * To change this template use File | Settings | File Templates.
 */

 //   $DBTYPE = "MYSQL";
 //   $HOST =  "localhost";
 //   $USERNAME = "root";
 //   $PASSWORD = "root";
  //  $DB = DB;

define('DBTYPE','MYSQL');
define('HOST','localhost');
define('USERNAME','root');
define('PASSWORD','root');
define('DB','BSSADVWF1');

define('MAILSERVER','localhost');
define('MAILUSER','admin@locahost.com');
define('MAILPW','password');




function PerformSQLOperation($SQLString){

    $DBTYPE = DBTYPE;
  //  $HOST =  "localhost";
  //  $USERNAME = "root";
  //  $PASSWORD = "root";
 //   $DB = DB;
    

if($DBTYPE == "MYSQL"){

    $con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
    mysql_select_db(DB) or die(mysql_error());
    $result = mysql_query($SQLString);

    if(!$result) {
        $LastId =   "ERROR: " . mysql_error();
    }else{
    $LastId =  mysql_insert_id($con);
    }
    mysql_free_result($result);

}

if($DBTYPE == "SQLSERVER"){

    mssql_connect(HOST, USERNAME, PASSWORD) or die(mssql_error());
    mssql_select_db(DB) or die(mssql_error());
    $result = mssql_query($SQLString);
    $LastId =  mssql_insert_id();
    mssql_free_result($result);

}

if($DBTYPE == "ORACLE"){

    mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
    mysql_select_db(DB) or die(mysql_error());
    $result = mysql_query($SQLString);
    $LastId =  mysql_insert_id();
    mysql_free_result($result);

}
    return $LastId;
}



function ProcessTable($TableName){

 //   $DBTYPE = "MYSQL";
 //   $HOST =  "localhost";
 //   $USERNAME = "root";
 //   $PASSWORD = "root";
 //   $DB = "DB";


if(DBTYPE == "MYSQL"){

//    mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
//    mysql_select_db(DB) or die(mysql_error());
//    echo "call processtable(" . $TableName . ");";
//    $ProcessResult = mysql_query("call processtable('" . $TableName . "');");
 //   $LastId =  mysql_insert_id();
//    mysql_free_result($ProcessResult);

$mysqli = new MySQLI(HOST,USERNAME,PASSWORD,DB);
$mysqli->autocommit(TRUE);
echo "TB: " . $TableName;
$stmt = $mysqli->prepare("CALL processtable('" . $TableName . "')");
$stmt->execute();
if(strlen($mysqli->error) > 10){
echo $mysqli->error;
}else{
echo 'Table Processed';
}
$mysqli->close();

}

if(DBTYPE == "SQLSERVER"){

    mssql_connect(HOST, USERNAME, PASSWORD) or die(mssql_error());
    mssql_select_db(DB) or die(mssql_error());
    $ProcessResult = mssql_query("CALL processtable('" . $TableName . "');");
    $LastId =  mssql_insert_id();
    mssql_free_result($ProcessResult);

}

if(DBTYPE == "ORACLE"){

    mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
    mysql_select_db(DB) or die(mysql_error());
    $ProcessResult = mysql_query("call processtable('" . $TableName . "');");
    $LastId =  mysql_insert_id();
    mysql_free_result($ProcessResult);

}
    return $ProcessResult;
}





function CallSQLRoutine($procname,$arg1,$arg2,$arg3,$arg4){

    //   $DBTYPE = "MYSQL";
    //   $HOST =  "localhost";
    //   $USERNAME = "root";
    //   $PASSWORD = "root";
    //   $DB = "DB";


    if(DBTYPE == "MYSQL"){

//    mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
//    mysql_select_db(DB) or die(mysql_error());
//    echo "call processtable(" . $TableName . ");";
//    $ProcessResult = mysql_query("call processtable('" . $TableName . "');");
        //   $LastId =  mysql_insert_id();
//    mysql_free_result($ProcessResult);

        $CallString = 'CALL ' . $procname . '('.$arg1.','.$arg2.','.$arg3.','.$arg4.')';

        echo  "MMM: " .$CallString;

        $mysqli = new MySQLI(HOST,USERNAME,PASSWORD,DB);
        $mysqli->autocommit(TRUE);
        //echo "Called: " . $CallString;
        $stmt = $mysqli->prepare($CallString);
        $stmt->execute();
        if(strlen($mysqli->error) > 10){
            echo $mysqli->error;
        }else{
            echo 'Routine Processed';
        }
        $mysqli->close();

    }

    $TableName = "";

    if(DBTYPE == "SQLSERVER"){

        mssql_connect(HOST, USERNAME, PASSWORD) or die(mssql_error());
        mssql_select_db(DB) or die(mssql_error());
        $ProcessResult = mssql_query("CALL processtable('" . $TableName . "');");
        $LastId =  mssql_insert_id();
        mssql_free_result($ProcessResult);

    }

    if(DBTYPE == "ORACLE"){

        mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
        mysql_select_db(DB) or die(mysql_error());
        $ProcessResult = mysql_query("call processtable('" . $TableName . "');");
        $LastId =  mysql_insert_id();
        mysql_free_result($ProcessResult);

    }
    return $ProcessResult;
}
