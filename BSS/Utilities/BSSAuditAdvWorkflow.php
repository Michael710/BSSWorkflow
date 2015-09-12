<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 3/5/13
 * Time: 1:33 PM
 * To change this template use File | Settings | File Templates.
 */

include "../DBServices/BSSSQLConfig.php";
include "../DBServices/BSSSQLOperation.php";

$BSSWorkflowId = $_GET['BSSWorkflowId'];

$mysqli = new mysqli(HOST, USERNAME, PASSWORD, DB);
$res = $mysqli->multi_query( "CALL auditadvworkflow($BSSWorkflowId,@x,'A','A');SELECT @x" );

if( $res ) {
    $results = 0;
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



