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
require_once('../Utilities/SendSMTPMail.php');

session_start();

$Stack = array();
echo '1';
$UserId = $_SESSION['BSSUserId'];

$WorkflowId = $_GET['BSSWorkflowId'];

$WorkflowMode = $_GET['BSSWorkflowMode'];

$QueryType = 'USER';


echo $WorkflowMode;

if ($WorkflowMode == "Design") {
    $AdvWorkflowTable = "AdvWorkflow";
    $AdvWorkflowStepTable = "AdvWorkflowStep";
    $AdvWorkflowLineTable = "AdvWorkflowLine";
    $AdvWorkflowSignOffTable = "AdvWorkflowSignOffs";
}
 else{
    $AdvWorkflowTable = "AdvWorkflowInstance";
    $AdvWorkflowStepTable = "AdvWorkflowStepInstance";
    $AdvWorkflowLineTable = "AdvWorkflowLineInstance";
    $AdvWorkflowSignOffTable = "AdvWorkflowSignOffsInstance";
}



if($QueryType = 'USER') {
    // $SQLQuery = "SELECT fromnode, tonode FROM AdvWorkflowLines WHERE workflowid = " . $WorkflowId;

    $SQLQuery = "SELECT fromnode, tonode, fromstep.Category " . " FROM " . $AdvWorkflowLineTable . " INNER JOIN " . $AdvWorkflowStepTable . " fromstep ON " . $AdvWorkflowLineTable . ".fromnode = fromstep.stepkey AND " . $AdvWorkflowLineTable . ".workflowid = fromstep.workflowid  AND fromstep.Category <> 'REJECTED' WHERE " . $AdvWorkflowLineTable . ".workflowid = " . $WorkflowId;

    $arr[1]->field  = 'from';
    $arr[2]->field  = 'to';
    $mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
    mysql_select_db(DB, $mysql) or die(mysql_error());
    //echo $SQLQuery;
    $result = mysql_query($SQLQuery);

}

$Y = 0;
$StartNode = 0;
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
 //   $DATASTRING = "";
    for($x = 1; $x <= 3; $x++)
    {

        if($x==1){$from[$Y] =  $row[$x-1];}
        if($x==2){$to[$Y] =  $row[$x-1];}
        if($x==3){$CatVal =  $row[$x-1];}

        if($CatVal == 'START'){$StartNode = $Y; echo "BBBBBBB";}


    }
    $CatVal = '';

    echo "ZZZZZZz_STARTNODE = " . $StartNode;

    echo 'LEVEL:  ' . $Y;
    echo '<br>';
    echo '     ';
    echo '<br>';
    echo 'FROM: ' . $from[$Y];
    echo '<br>';
    echo 'TO: ' . $to[$Y];
    echo '<br>';
    echo 'CATEGORY: ' . $CatVal;
    echo '<br>';
    $Y++;
}

 echo "StartNode_XXXXX: = " . $StartNode;
// echo '<br>';

mysql_free_result($result);

// Find the node that has the Start Status Type
$StartNodeStepKey = $StartNode;


$Level = 1;

GetSteps($from,  $to, $StartNodeStepKey,$Level);



try{

    sort($Stack);



foreach ($Stack as $value) {
    echo 'LEVEL: ' . substr($value,0,stripos($value,','));
    echo '<br>';
    echo 'FROM: ' . substr($value,stripos($value,',')+1,strrpos($value,',')-stripos($value,',')-1);
    echo '<br>';
    echo 'TO: ' . substr($value,strrpos($value,',')+1,strlen($value) - strrpos($value,','));
    echo '<br>';
    echo '<br>';
}




    $X = 0;
    $CurrentLevel = 0;
    $BreakVal = false;

    foreach ($Stack as $value) {

        echo 'YYYYYY: ' . substr($value,0,stripos($value,','));
        echo '<br>';
        echo 'FROM: ' . substr($value,stripos($value,',')+1,strrpos($value,',')-stripos($value,',')-1);
        echo '<br>';
        echo 'TO: ' . substr($value,strrpos($value,',')+1,strlen($value) - strrpos($value,','));
        echo '<br>';


   //     echo "Current Level is: " . $CurrentLevel;
   //    echo '<br>';
   //     echo "Level is: " . substr($value,0,stripos($value,','));
   //     echo '<br>';
   //     echo "Break Val: " . $BreakVal;
   //     echo '<br>';



     //   if($CurrentLevel <> substr($value,0,stripos($value,',')) AND $BreakVal == true){
        if( $BreakVal == true){

        echo "BREAKING EXECUTION";

       //     break;
        }

        $CurrentLevel = substr($value,0,stripos($value,','));


        //Completed is NULL AND
        $SQLQuery = "SELECT Category,stepkey,ActionURL,ApproverUserId,Instructions,IFNULL(Completed,'01-01-1910'),ReviewPolicy,status FROM ". $AdvWorkflowStepTable . " WHERE  status <> 8 AND workflowid = " . $WorkflowId . " and Category <> 'REJECTED'  AND stepkey = '" . substr($value,strrpos($value,',')+1,strlen($value) - strrpos($value,','))."'";
  //      $arr[1]->field  = 'Category';
  //      $arr[2]->field  = 'stepkey';
  //      $arr[3]->field  = 'ActionURL';
  //      $arr[4]->field  = 'ApproverUserId';
  //      $arr[5]->field  = 'Instructions';
  //      $arr[6]->field  = 'Completed';

      //  echo $SQLQuery;
    //    echo '<br>';


        $mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
        mysql_select_db(DB, $mysql) or die(mysql_error());

        $result = mysql_query($SQLQuery);

      //  $Y = 0;
        while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
            for($x = 1; $x <= 8; $x++)
            {
                if($x==1){$Category =  $row[$x-1];}
                if($x==2){$stepkey =  $row[$x-1];}
                if($x==3){$ActionURL =  $row[$x-1];}
                if($x==4){$ApproverUserId =  $row[$x-1];}
                if($x==5){$Instructions =  $row[$x-1];}
                if($x==6){$Completed =  $row[$x-1];}
                if($x==7){$ReviewPolicy =  $row[$x-1];}
                if($x==8){$Status =  $row[$x-1];}
            }
         //   $Y++;

        }
        mysql_free_result($result);

  //      echo '<br>';
  //      echo 'Category: '. $Category;
  //      echo '<br>';
  //      echo 'WorkFlow: '. $WorkflowId;
  //      echo '<br>';
  //      echo 'stepkey: '. $stepkey;
  //      echo '<br>';
  //      echo 'ActionURL: '. $ActionURL;
  //      echo '<br>';
  //      echo 'ApproverUserId: '. $ApproverUserId;
  //      echo '<br>';
  //      echo '$Instructions: '. $Instructions;
  //      echo '<br>';
  //      echo '$Completed: '. $Completed;
  //      echo '<br>';

    //    $Category = $Category[0];
    //    $stepkey =  $stepkey[0];
   //     $ActionURL = $ActionURL[0];
   //     $ApproverUserId = $ApproverUserId[0];
   //     $Instructions = $Instructions[0];
    //    $Completed = $Completed[0];

        If($Category == 'ACTION')
        {

            echo 'In ACTION  ';
            echo $ActionURL;

            //echo UpdateStep('INPROCESS', $MessageResult, $WorkflowId, $stepkey);

            if(UpdateStep('INPROCESS', $MessageResult, $WorkflowId, $stepkey,$AdvWorkflowTable,$AdvWorkflowStepTable,$AdvWorkflowLineTable, $AdvWorkflowSignOffTable) == "PriorNodeNotComplete"){return;}

            echo "Processing Action";

            $cmp_date = "1980-01-01";
            // $todays_date = date("Y-m-d");
            // $today = strtotime($todays_date);
            $complete_comparedate = strtotime($cmp_date);
            $completed_date = strtotime($Completed);
            echo $complete_currentdate;

       //     If($completed_date < $complete_comparedate){


                try{
                    echo 'Executing PHP URL: ./PHPActions/' . $ActionURL . '?BSSWorkflowId=' . $WorkflowId . '&BSSStepKey='.$stepkey;

                    $execute = include('../PHPActions/' . $ActionURL);

                    echo 'ACTION EXECUTION RESULT: ' . $execute;

                    if(substr($execute,0,7) == 'SUCCESS'){
                        UpdateStep('SUCCESS', $MessageResult, $WorkflowId, $stepkey,$AdvWorkflowTable,$AdvWorkflowStepTable,$AdvWorkflowLineTable, $AdvWorkflowSignOffTable);
                        AddHistoryToStep($UserId, $MessageResult, $WorkflowId, $stepkey);

                    }else{
                        UpdateStep('ERROR', $MessageResult, $WorkflowId, $stepkey,$AdvWorkflowTable,$AdvWorkflowStepTable,$AdvWorkflowLineTable, $AdvWorkflowSignOffTable);
                        AddHistoryToStep($UserId, $MessageResult, $WorkflowId, $stepkey);
                        $BreakVal = true;
                        //break;
                    }


                }catch(Exception $ex){
                    echo $ex;
                }
         //   }

                //execute the Action URL
        }

        If($Category == 'NOTIFY')
        {
            echo 'IN NOTIFY';
      //      UpdateStep('INPROCESS', $MessageResult, $WorkflowId, $stepkey);

            if(UpdateStep('INPROCESS', $MessageResult, $WorkflowId, $stepkey,$AdvWorkflowTable,$AdvWorkflowStepTable,$AdvWorkflowLineTable, $AdvWorkflowSignOffTable) == "PriorNodeNotComplete"){return;}

            $cmp_date = "1980-01-01";
            //Do Emails
            $complete_comparedate = strtotime($cmp_date);
            $completed_date = strtotime($Completed);
            echo $complete_currentdate;

            // Add notification date check

            If($completed_date < $complete_comparedate){


                $SQLQuery = "SELECT FirstName, LastName,Email " . "FROM users JOIN AdvWorkflowSignOffs ON AdvWorkflowSignOffs.workflowid = " . $WorkflowId .  " AND AdvWorkflowSignOffs.stepkey = " . $stepkey .  " AND AdvWorkflowSignOffs.WorkflowApprover = users.id";

                $arr[1]->field  = 'FirstName';
                $arr[2]->field  = 'LastName';
                $arr[3]->field  = 'Email';
                echo '<br>';
         //       echo '<br>';
         //        echo $SQLQuery;
         //        echo '<br>';
                echo '<br>';
                $mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
                mysql_select_db(DB, $mysql) or die(mysql_error());
                $result = mysql_query($SQLQuery);
                //$row = mysql_fetch_array($result, MYSQL_NUM);

                while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                    //   $DATASTRING = "";
                    for($x = 1; $x <= 3; $x++)
                    {

                        if($x==1){$FirstName =  $row[$x-1];}
                        if($x==2){$LastName =  $row[$x-1];}
                        if($x==3){$Email =  $row[$x-1];}

                    }
                }

                $GeneratedSubject = "";
                $GeneratedBody = "";
                if(strlen($ActionURL) > 3){  //Generate the subject and body
                    echo 'Executing PHP URL: ./MsgGen/' . $ActionURL . '?BSSWorkflowId=' . $WorkflowId . '&BSSStepKey='.$stepkey;
                    $execute = include('./MsgGen/' . $ActionURL);
                    echo 'MSGEN EXECUTION RESULT: ' . $execute;
                    $Subject = $GeneratedSubject;
                    $Instructions = $GeneratedBody;
                 }

                $MessageResult = SendMail($Email, $FirstName . ' ' . $LastName, $Subject, $Instructions);

                if(substr($MessageResult,0,7) <> 'SUCCESS'){
                    UpdateStep('ERROR', $MessageResult, $WorkflowId, $stepkey,$AdvWorkflowTable,$AdvWorkflowStepTable,$AdvWorkflowLineTable, $AdvWorkflowSignOffTable);
                    AddHistoryToStep($UserId, $MessageResult, $WorkflowId, $stepkey);
                    $BreakVal = true;
                    //break;
                }else{
                    UpdateStep('SUCCESS', $MessageResult, $WorkflowId, $stepkey,$AdvWorkflowTable,$AdvWorkflowStepTable,$AdvWorkflowLineTable, $AdvWorkflowSignOffTable);
                    AddHistoryToStep($UserId, $MessageResult, $WorkflowId, $stepkey);
                }

                mysql_free_result($result);

            }

        }

        If($Category == 'REVIEW')
        {

            UpdateStep('INPROCESS', $MessageResult, $WorkflowId, $stepkey,$AdvWorkflowTable,$AdvWorkflowStepTable,$AdvWorkflowLineTable, $AdvWorkflowSignOffTable);

            echo "$$$$$$$$ IN REVIEW";

            echo "STATUS IS " . $Status;

            //Do Emails
            $cmp_date = "1980-01-01";
            // $todays_date = date("Y-m-d");
            // $today = strtotime($todays_date);
            $complete_comparedate = strtotime($cmp_date);
            $completed_date = strtotime($Completed);
            echo $complete_currentdate;

            // Do notification date check

            If($completed_date < $complete_comparedate){

                $SQLQuery = "SELECT FirstName, LastName,Email " . "FROM users JOIN AdvWorkflowSignOffs ON AdvWorkflowSignOffs.workflowid = " . $WorkflowId .  " AND AdvWorkflowSignOffs.stepkey = " . $stepkey .  " AND AdvWorkflowSignOffs.WorkflowApprover = users.id";

                $arr[1]->field  = 'FirstName';
                $arr[2]->field  = 'LastName';
                $arr[3]->field  = 'Email';

                //  echo $SQLQuery;
                //  echo '<br>';
                $mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
                mysql_select_db(DB, $mysql) or die(mysql_error());
                $result = mysql_query($SQLQuery);
                //$row = mysql_fetch_array($result, MYSQL_NUM);

                while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                    //   $DATASTRING = "";
                    for($x = 1; $x <= 3; $x++)
                    {
                        if($x==1){$FirstName =  $row[$x-1];}
                        if($x==2){$LastName =  $row[$x-1];}
                        if($x==3){$Email =  $row[$x-1];}
                    }
                }
                    $MessageResult = SendMail($Email, $FirstName . ' ' . $LastName, $Subject, $Instructions);

                    if(substr($MessageResult,0,7) <> 'SUCCESS'){
                        $BreakVal = true;
                        UpdateStep('ERROR', $MessageResult, $WorkflowId, $stepkey,$AdvWorkflowTable,$AdvWorkflowStepTable,$AdvWorkflowLineTable, $AdvWorkflowSignOffTable);
                        AddHistoryToStep($UserId, $MessageResult, $WorkflowId, $stepkey);

                    }else{
                        AddHistoryToStep($UserId, $MessageResult, $WorkflowId, $stepkey);
                        //break;
                    }
            }

            // The review sp call
            $ApprovalResult = 0;

            try{

                echo 'AA';
                $connection = mysqli_connect(HOST, USERNAME, PASSWORD, DB);
                echo 'BB';
                //run the store proc
                $result = mysqli_query($connection,
                    "CALL CheckReviewStatus('" . $WorkflowId. "','" . $stepkey . "',@id)") or die("Query fail: ");
                echo 'CC';
                //loop the result set
                //while ($row = mysqli_fetch_array($result)){
                 //   echo "VALUE IS " . $row[0];
                //}

                $row = mysqli_fetch_array($result);

                $ApprovalResult = $row[0];

                echo "VALUEZ IS " . $row[0];

                echo 'DD';



/*
                $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DB);
                $rs = $mysqli->query( "CALL CheckReviewStatus('" . $WorkflowId. "','" . $stepkey . "',@id)");
                echo "CALL CheckReviewStatus('" . $WorkflowId. "','" . $stepkey . "',@id)";

                $rs = $mysqli->query( "SELECT @id AS id");
                echo '1';
                $row = $rs->fetch_object();
                echo '2';
                $ApprovalResult = $row->id;
                echo '3';
                ECHO "THE APPROVAL VALUE: " . $row->id;
                echo '4';
  */


            }catch(Exception $ex){
                echo $ex;
            }

            echo '5';
      //      $mysqli->close();

            echo "The Approval Result is: " . $ApprovalResult;
            echo '6';

            if($ApprovalResult == "0"){
                //break;  //Review step is not completed
                $BreakVal = true;
            }


            if($ApprovalResult == "1"){   // Review Complete and Approved

                UpdateStep('SUCCESS', "Review Step Approved", $WorkflowId, $stepkey,$AdvWorkflowTable,$AdvWorkflowStepTable,$AdvWorkflowLineTable, $AdvWorkflowSignOffTable);

                AddHistoryToStep($UserId, "Review Step Completed", $WorkflowId, $stepkey);

                $SQLQuery = "SELECT stepkey FROM " . $AdvWorkflowStepTable  . " WHERE stepkey in(SELECT tonode FROM " . $AdvWorkflowLineTable . " WHERE workflowid = '" . $WorkflowId . "' AND fromnode = '" .  $stepkey . "') AND Category = 'REJECTED' AND workflowid = '" . $WorkflowId . "'";

                echo '<br>';

                echo $SQLQuery;

                $mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
                mysql_select_db(DB, $mysql) or die(mysql_error());
                $result = mysql_query($SQLQuery);
                $row = mysql_fetch_array($result, MYSQL_NUM);
                $RejectNode  = $row[0];

                echo "REJECT NODE IS:  " . $RejectNode;

                $SQLQuery = "UPDATE " . $AdvWorkflowStepTable . " SET status = 0 WHERE stepkey = '".  $RejectNode . "' AND Category = 'REJECTED' AND workflowid = '" . $WorkflowId . "'";
                //     echo $SQLQuery;

                //     echo '<br>';
                     $mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
                     mysql_select_db(DB, $mysql) or die(mysql_error());
                     $result = mysql_query($SQLQuery);

            }

            if($ApprovalResult == "2"){   // <> Is for the designer.

                UpdateStep('ERROR', "Review Step Rejected", $WorkflowId, $stepkey,$AdvWorkflowTable,$AdvWorkflowStepTable,$AdvWorkflowLineTable, $AdvWorkflowSignOffTable);

                AddHistoryToStep($UserId, "Review Step Rejected", $WorkflowId, $stepkey);


                if($Status >= 0){
                    //Call the attached reject node and run it if found


                    //Find the node
                    echo "PROCESS REJECT STEP RRRRR";
                    echo "STATUS IS:  ". $Status;

                    $SQLQuery = "SELECT stepkey FROM " . $AdvWorkflowStepTable . " WHERE stepkey in(SELECT tonode FROM " . $AdvWorkflowLineTable . " WHERE workflowid = '" . $WorkflowId . "' AND fromnode = '" .  $stepkey . "') AND Category = 'REJECTED' AND workflowid = '" . $WorkflowId . "'";

                    echo '<br>';

                    echo $SQLQuery;

                    $mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
                    mysql_select_db(DB, $mysql) or die(mysql_error());
                    $result = mysql_query($SQLQuery);
                    $row = mysql_fetch_array($result, MYSQL_NUM);
                    $RejectNode  = $row[0];

                    echo "REJECT NODE IS:  " . $RejectNode;


                    //Set the reject node status
                  //  if($Status <> 3){
                   //
                   //     echo "SETTING TO GREY HERE:   ";

                   //     $SQLQuery = "UPDATE AdvWorkflowStep SET status = 0 WHERE stepkey = '".  $RejectNode . "' AND Category = 'REJECTED' AND workflowid = '" . $WorkflowId . "'";
                   //     echo $SQLQuery;

                   //     echo '<br>';
                   //     $mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
                   //     mysql_select_db(DB, $mysql) or die(mysql_error());
                   //     $result = mysql_query($SQLQuery);
                   // }



                //    if($Status == 3){

                        echo "SETTING TO RED HERE:   ";


                    $SQLQuery = "UPDATE " . $AdvWorkflowStepTable . " SET status = 3 WHERE stepkey = '".  $RejectNode . "' AND Category = 'REJECTED' AND workflowid = '" . $WorkflowId . "'";
                        echo $SQLQuery;

                        echo '<br>';
                        $mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
                        mysql_select_db(DB, $mysql) or die(mysql_error());
                        $result = mysql_query($SQLQuery);


                        // Do the notifications

                        $SQLQuery = "SELECT FirstName, LastName,Email " . "FROM users JOIN AdvWorkflowSignOffs ON AdvWorkflowSignOffs.workflowid = " . $WorkflowId .  " AND AdvWorkflowSignOffs.stepkey = " . $RejectNode .  " AND AdvWorkflowSignOffs.WorkflowApprover = users.id";

                        $arr[1]->field  = 'FirstName';
                        $arr[2]->field  = 'LastName';
                        $arr[3]->field  = 'Email';
                        echo '<br>';
                        //       echo '<br>';
                        //        echo $SQLQuery;
                        //        echo '<br>';
                        echo '<br>';
                        $mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
                        mysql_select_db(DB, $mysql) or die(mysql_error());
                        $result = mysql_query($SQLQuery);
                        //$row = mysql_fetch_array($result, MYSQL_NUM);

                        while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                            //   $DATASTRING = "";
                            for($x = 1; $x <= 3; $x++)
                            {

                                if($x==1){$FirstName =  $row[$x-1];}
                                if($x==2){$LastName =  $row[$x-1];}
                                if($x==3){$Email =  $row[$x-1];}

                            }
                        }

                        $GeneratedSubject = "";
                        $GeneratedBody = "";
                        if(strlen($ActionURL) > 3){  //Generate the subject and body
                            echo 'Executing PHP URL: ./MsgGen/' . $ActionURL . '?BSSWorkflowId=' . $WorkflowId . '&BSSStepKey='.$RejectNode;
                            $execute = include('./MsgGen/' . $ActionURL);
                            echo 'MSGEN EXECUTION RESULT: ' . $execute;
                            $Subject = $GeneratedSubject;
                            $Instructions = $GeneratedBody;
                        }

                        $MessageResult = SendMail($Email, $FirstName . ' ' . $LastName, $Subject, $Instructions);

                        if(substr($MessageResult,0,7) <> 'SUCCESS'){
                            //        UpdateStep('ERROR', $MessageResult, $WorkflowId, $stepkey);
                            AddHistoryToStep($UserId, $MessageResult, $WorkflowId, $stepkey);
                            $BreakVal = true;
                            //break;
                        }else{
                            //       UpdateStep('SUCCESS', $MessageResult, $WorkflowId, $stepkey);
                            AddHistoryToStep($UserId, $MessageResult, $WorkflowId, $stepkey);
                        }

                        mysql_free_result($result);

                        //Run the PHP Script

                        echo 'Executing PHP URL: ./PHPActions/' . $ActionURL . '?BSSWorkflowId=' . $WorkflowId . '&BSSStepKey='.$stepkey;

                        $execute = include('./PHPActions/' . $ActionURL);

                        echo 'ACTION EXECUTION RESULT: ' . $execute;

                        if(substr($execute,0,7) == 'SUCCESS'){
                            //     UpdateStep('SUCCESS', $MessageResult, $WorkflowId, $stepkey);
                            AddHistoryToStep($UserId, $MessageResult, $WorkflowId, $stepkey);

                        }else{
                            //    UpdateStep('ERROR', $MessageResult, $WorkflowId, $stepkey);
                            AddHistoryToStep($UserId, $MessageResult, $WorkflowId, $stepkey);
                            $BreakVal = true;
                            //break;
                        }

                        mysql_free_result($result);

               //     }

                }





            }




        }

        If($Category == 'SUBMIT' OR $Category == 'URL' OR $Category == 'TASK')
        {
            // Send the notification

            echo "IN SUBMIT";

           // UpdateStep('INPROCESS', $MessageResult, $WorkflowId, $stepkey);

            $cmp_date = "1980-01-01";
           // $todays_date = date("Y-m-d");
           // $today = strtotime($todays_date);
            $complete_comparedate = strtotime($cmp_date);
            $completed_date = strtotime($Completed);
            echo $complete_currentdate;

            If($completed_date < $complete_comparedate){

                If($Category == 'SUBMIT'){$Subject = 'Workflow Has Been Submitted';}
                If($Category == 'URL'){$Subject = 'Workflow URL has been sent to you';}
                If($Category == 'TASK'){$Subject = 'Workflow task has been sent to you';}

                if(strlen($Instructions) == 0){$Instructions = " ";}

                $SQLQuery = "select FirstName, LastName,Email from users WHERE id= " . $ApproverUserId;
                echo '<br>';
               //   echo $SQLQuery;
                  echo '<br>';
                $mysqlm = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
                mysql_select_db(DB, $mysqlm) or die(mysql_error());
                $emresult = mysql_query($SQLQuery);
                $emrow = mysql_fetch_array($emresult, MYSQL_NUM);

                $FirstName =  $emrow[0];
                $LastName =  $emrow[1];
                $Email =  $emrow[2];

                mysql_free_result($emresult);


          //      echo $Subject;
          //      echo $Instructions;

                $MessageResult = SendMail($Email, $FirstName . ' ' . $LastName, $Subject, $Instructions);

           //     echo "MessageResult: ". $MessageResult . "   :   " . substr($MessageResult,0,7);


                if(substr($MessageResult,0,7) == 'SUCCESS'){
                    UpdateStep('INPROCESS', $MessageResult, $WorkflowId, $stepkey,$AdvWorkflowTable,$AdvWorkflowStepTable,$AdvWorkflowLineTable, $AdvWorkflowSignOffTable);
                    AddHistoryToStep($UserId, $MessageResult, $WorkflowId, $stepkey);

                    echo "Set Step to In Process";

                    $BreakVal = true;
                   // break;
                }else{
                    echo "Message Failed";
                    AddHistoryToStep($UserId, $MessageResult, $WorkflowId, $stepkey);
                    $BreakVal = true;
                    //break;
                }

            }



        }

        If($Category == 'EXTACTION')
        {
        //Run the process for the custom step

        }


        If($Category == 'END')
        {
           // Add code to complete the workflow in instance process.
  //          $SQLQuery = "UPDATE AdvWorkflowStep SET status = 3, ErrorResult = '" . $MessageText . "' WHERE workflowid =" . $UPDWorkflowId ." and stepkey = " . $UPDStepKey;
  //          echo $SQLQuery;

  //          $mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
  //          mysql_select_db(DB, $mysql) or die(mysql_error());
  //          $result = mysql_query($SQLQuery);

        }


        }



    //Process the workflow
    //Iterate on the sorted array
    //find the from step and see if its complete
    //If not process it
    //Break if fails
    //continue
// print_r($Stack);

}catch(Exception $ex){
     echo $ex;
}



function GetSteps($FromNodes, $ToNodes, $Val, $Level) {

global $Stack;

    try{
   // echo  'NODES:   ' .$Level . ',' .$FromNodes[$Val] . ',' . $ToNodes[$Val];

    array_push($Stack, $Level . ',' .$FromNodes[$Val] . ',' . $ToNodes[$Val]);

    $NextNode = array_keys($FromNodes, $ToNodes[$Val]);    // Get the from keys for the passed in node

    for($x=0; $x < count($NextNode); $x=$x+1){  // Iterate on the keys on the passed in node
          $Val =  $NextNode[$x];
          $Level = $Level + 1;
          GetSteps($FromNodes, $ToNodes, $Val, $Level);    // call recursively
          $Level = $Level - 1;
    }

}catch(Exception $ex){
    echo $ex;
}
}

function UpdateStep($UpdateType, $MessageText, $UPDWorkflowId, $UPDStepKey,$AdvWorkflowTable,$AdvWorkflowStepTable,$AdvWorkflowLineTable, $AdvWorkflowSignOffTable){


   //     if (s >= 3) return "red";                // Failed / Rejected
   //     if (s >= 2) return "rgb(20, 240, 20)";             // Completed

   //     if (s >= 1) return "yellow";   // In Process
   //     return "black";                          // Not Started

echo 'UPDATE TYPE: ' . $UpdateType;

if($UpdateType=='INPROCESS'){

    // Check all prior nodes for completion



$CheckSQLString = "SELECT count(*) FROM  " . $AdvWorkflowLineTable .
" INNER JOIN " . $AdvWorkflowStepTable . " fromstep ON " . $AdvWorkflowLineTable . ".fromnode = fromstep.stepkey
        AND " . $AdvWorkflowLineTable . ".workflowid = fromstep.workflowid
 INNER JOIN " . $AdvWorkflowStepTable . " tostep ON " . $AdvWorkflowLineTable . ".tonode = tostep.stepkey
        AND " . $AdvWorkflowLineTable . ".workflowid = tostep.workflowid
 WHERE fromstep.Completed IS NULL AND fromstep.Category <> 'START'
        AND fromstep.workflowid = " . $UPDWorkflowId .
           " AND tostep.workflowid = " . $UPDWorkflowId .
               " AND tostep.stepkey = '" . $UPDStepKey . "';";


echo $CheckSQLString;

    $mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
    mysql_select_db(DB, $mysql) or die(mysql_error());
    $result = mysql_query($CheckSQLString);
    //$row = mysql_fetch_array($result, MYSQL_NUM);

    $row = mysql_fetch_array($result, MYSQL_NUM);
     if($row[0] <> 0){ return "PriorNodeNotComplete";}      // Prior Nodes are not complete.  Do not process.


    $SQLQuery = "UPDATE " . $AdvWorkflowStepTable . " SET status = 1 WHERE workflowid =" . $UPDWorkflowId ." and stepkey = " . $UPDStepKey;
}

if($UpdateType=='SUCCESS'){
    $SQLQuery = "UPDATE " . $AdvWorkflowStepTable . " SET Completed = CURDATE(), status = 2" . ", ErrorResult = '" . $MessageText . "' WHERE workflowid =" . $UPDWorkflowId ." and stepkey = " . $UPDStepKey;
}

if($UpdateType=='ERROR'){
    $SQLQuery = "UPDATE " . $AdvWorkflowStepTable . " SET status = 3, ErrorResult = '" . $MessageText . "' WHERE workflowid =" . $UPDWorkflowId ." and stepkey = " . $UPDStepKey;
}
//echo $SQLQuery;
//  echo '<br>';
$mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
mysql_select_db(DB, $mysql) or die(mysql_error());
$result = mysql_query($SQLQuery);



}


function AddHistoryToStep($HISUserId, $MessageText, $HISWorkflowId, $HISStepKey){

    $SQLQuery = "insert into History "."(historyuser,historydate,historytext,workflowid,stepkey)values( " . $HISUserId . ",now(),'". $MessageText . "','" . $HISWorkflowId . "','" . $HISStepKey . "')";

    // echo $SQLQuery;

    $mysql = mysql_connect(HOST, USERNAME, PASSWORD, false, 65536) or die(mysql_error());
    mysql_select_db(DB, $mysql) or die(mysql_error());
    $result = mysql_query($SQLQuery);

}

?>