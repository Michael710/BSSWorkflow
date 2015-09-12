<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 8/12/12
 * Time: 10:27 AM
 * To change this template use File | Settings | File Templates.
 */

//include 'BSSSQLOperation.php';

//ini_set('display_errors', '1');


function processnotification($TableName,$RecordId,$NotificationId,$StatusId)
{

    $TableName = 'Cars1';
    $RecordId = 4;
    $NotificationId = 2;

    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DB);

    /* check connection */
    if (mysqli_connect_errno()) {
        echo "Connect failed: %s\n", mysqli_connect_error();
        exit();
    }

// Get the Message Subject and Body
    $messagesubjectstring = "";
    $messagebodystring = "";
    $sqlcmd = "call processnotificationmessagesubject('". $TableName . "'" . ','  . $RecordId  . ',' . $NotificationId .", @messagesubject,@messagebody); select @messagesubject; select @messagebody";

    $ivalue=1;
    $res = $mysqli->multi_query( $sqlcmd );
    if( $res ) {
        $results = 0;
        do {
            if ($result = $mysqli->store_result()) {
                while( $row = $result->fetch_row() ) {
                    $results++;
                    foreach( $row as $cell ){
                        // echo $cell, "&nbsp;";
                        If($results ==1){$messagesubjectstring = $cell;}
                        If($results ==2){$messagebodystring = $cell;}
                    }
                }
                $result->close();
                if( $mysqli->more_results() ) echo "<br/>";
            }
        } while( $mysqli->next_result() );
    }

    if(strlen($mysqli->error) > 10){
        echo $mysqli->error;
    }


// Get the Notification List
    $notificationlist = "";
    $sqlcmd = "call getnotificationusers(". $NotificationId .",@notificationusers); select @notificationusers";

    $ivalue=1;
    $res = $mysqli->multi_query( $sqlcmd );
    if( $res ) {
        $results = 0;
        do {
            if ($result = $mysqli->store_result()) {
                while( $row = $result->fetch_row() ) {
                    $results++;
                    foreach( $row as $cell ){
                        // echo $cell, "&nbsp;";
                        If($results ==1){$notificationlist = $cell;}
                    }
                }
                $result->close();
                if( $mysqli->more_results() ) echo "<br/>";
            }
        } while( $mysqli->next_result() );
    }

    if(strlen($mysqli->error) > 10){
        echo $mysqli->error;
    }

    $mysqli->close();

    echo "Notification List: " . $notificationlist;
    echo "SUBJECT: " . $messagesubjectstring;
    echo "BODY: " . $messagebodystring;

// Add Email Routine here.

    try{
       echo 'trying to mail';
        mail('reds2000@fastem.com', $messagesubjectstring, $messagebodystring);
        echo 'mail sent';
    }catch(Exception $e){
        echo $e->getMessage();
    }

    $CompleteSQL = 'UPDATE AdvWorkflowStepInstance SET Completed = now() WHERE id = ' . $StatusId;

    try{
        PerformSQLOperation($CompleteSQL);
    }catch(Exception $e){
        echo $e->getMessage();
    }

}