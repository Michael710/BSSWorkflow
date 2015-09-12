

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 1/27/13
 * Time: 11:03 PM
 * To change this template use File | Settings | File Templates.
 */


include '../DBServices/BSSSQLConfig.php';
include '../DBServices/BSSSQLOperation.php';
$WorkflowId = '2';
$stepkey = '-4';


//define('DBTYPE','MYSQL');
//define('HOST','localhost');
//define('USERNAME','root');
//define('PASSWORD','root');
//define('DB','EXTJS');

echo HOST;
echo USERNAME;
echo PASSWORD;
echo DB;

/*
try{
$mysqli = new mysqli(  $HOST, $USERNAME, $PASSWORD, $DB);
$res = $mysqli->multi_query("CALL CheckReviewStatus(" . $WorkflowId. ",'" . $stepkey . "',@id)");
$res = $mysqli->multi_query("SELECT @id AS id" );

echo '2';
if( $res ) {
    $results = 0;
    echo '3';
    do {
        if ($result = $mysqli->store_result()) {
            //     printf( "<b>Result #%u</b>:<br/>", ++$results );
            while( $row = $result->fetch_row() ) {
                foreach( $row as $cell ) echo $cell;
            }
            $result->close();
            if( $mysqli->more_results() ) echo "<br/>";
        }
    } while( $mysqli->next_result() );
}
$mysqli->close();

}catch(Exception $ex){
    echo $ex;
}

*/

try{
$mysqli = new mysqli(HOST, USERNAME, PASSWORD, DB);
//$rs =  $mysqli->multi_query( "CALL CheckReviewStatus('" . $WorkflowId. "','" . $stepkey . "',@id);SELECT @id AS id" );

echo "CALL CheckReviewStatus('" . $WorkflowId. "','" . $stepkey . "',@id);";

$rs = $mysqli->query("CALL CheckReviewStatus('" . $WorkflowId. "','" . $stepkey . "',@id)");
ECHO "ZZZ";
$rs = $mysqli->query("SELECT @id AS id");

echo "AFTER THE CALL";

//echo $mysqli->field_count;
//$mysqli->next_result();
//flush the null RS from the call

ECHO "Z1";
$row = $rs->fetch_object();
ECHO "Z2";
var_dump($row);
ECHO "THE VALUE IS " . $row->id;

}catch(Exception $ex){
echo $ex->getMessage();
}
