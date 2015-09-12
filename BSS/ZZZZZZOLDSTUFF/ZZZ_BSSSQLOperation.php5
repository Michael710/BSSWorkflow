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
  //  $DB = "EXTJS";

define('DBTYPE','MYSQL');
define('HOST','localhost');
define('USERNAME','root');
define('PASSWORD','root');
define('DB','EXTJS');


function PerformSQLOperation($SQLString){

    $DBTYPE = "MYSQL";
    $HOST =  "localhost";
    $USERNAME = "root";
    $PASSWORD = "root";
    $DB = "EXTJS";    
    

if($DBTYPE == "MYSQL"){

    mysql_connect($HOST, $USERNAME, $PASSWORD) or die(mysql_error());
    mysql_select_db($DB) or die(mysql_error());
    $result = mysql_query($SQLString);
    $LastId =  mysql_insert_id();
    mysql_free_result($result);

}

if($DBTYPE == "SQLSERVER"){

    mssql_connect($HOST, $USERNAME, $PASSWORD) or die(mssql_error());
    mssql_select_db($DB) or die(mssql_error());
    $result = mssql_query($SQLString);
    $LastId =  mssql_insert_id();
    mssql_free_result($result);

}

if($DBTYPE == "ORACLE"){

    mysql_connect($HOST, $USERNAME, $PASSWORD) or die(mysql_error());
    mysql_select_db($DB) or die(mysql_error());
    $result = mysql_query($SQLString);
    $LastId =  mysql_insert_id();
    mysql_free_result($result);

}
    return $LastId;
}


function PerformSQLGetVal($SQLString){

    $DBTYPE = "MYSQL";
    $HOST =  "localhost";
    $USERNAME = "root";
    $PASSWORD = "root";
    $DB = "EXTJS";


    if($DBTYPE == "MYSQL"){

        mysql_connect($HOST, $USERNAME, $PASSWORD) or die(mysql_error());
        mysql_select_db($DB) or die(mysql_error());
        $result = mysql_query($SQLString);

        $row = mysql_fetch_array($result, MYSQL_NUM);

        $resultval = $row[0];
       // $LastId =  mysql_insert_id();
      //  mysql_free_result($result);

    }

    if($DBTYPE == "SQLSERVER"){

        mssql_connect($HOST, $USERNAME, $PASSWORD) or die(mssql_error());
        mssql_select_db($DB) or die(mssql_error());
        $result = mssql_query($SQLString);
       // $LastId =  mssql_insert_id();
      //  mssql_free_result($result);

    }

    if($DBTYPE == "ORACLE"){

        mysql_connect($HOST, $USERNAME, $PASSWORD) or die(mysql_error());
        mysql_select_db($DB) or die(mysql_error());
        $result = mysql_query($SQLString);
       // $LastId =  mysql_insert_id();
    //    mysql_free_result($result);

    }
    return $resultval;
}
