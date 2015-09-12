<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 12/30/11
 * Time: 3:19 PM
 * To change this template use File | Settings | File Templates.
 */

include 'BSSSQLConfig.php';
include 'BSSSQLOperation.php';
include 'BSSCreateHistoryEntry.php';


$Con = new SQLConfig();
$Masterid = $_GET['masterid'];

//$Sequence = $_GET['sequence'];


$Userid = 8; //$_GET['userid'];
$EnterpriseObjectId = $_GET['EnterpriseObjectId'];

$arr = $Con->getName($_GET['BSSConfigName'],'MASTER', $Userid);



//Create SQL Insert Statement
if(trim($Masterid) == ''){$Masterid='0';}
if(trim($EnterpriseObjectId) == ''){$EnterpriseObjectId='0';}


$SQLString = '';
$DefaultString = $Masterid . ',' . $EnterpriseObjectId . ',';

for($x = 2; $x <= count($arr); $x++)
{
    $SQLString =  $SQLString . chr(96) . $arr[$x]->field . chr(96) . ",";
}
$SQLString = substr($SQLString,0,strlen($SQLString)-4);

for($x = 4; $x <= count($arr)-1; $x++)
{


    if($arr[$x]->renderedas <> 'Date' and $arr[$x]->renderedas <> 'UserId'){
        $DefaultString =  $DefaultString . "'" . $arr[$x]->defaultvalue . "', ";
    }

    if($arr[$x]->renderedas == 'Date'){
        $DATADATE = date("m/d/y");     //Set THIS to now()
      //  $DefaultString =  $DefaultString . "'" . $DATADATE . "', ";
        $DefaultString =  $DefaultString . "now(), ";


    }

    if($arr[$x]->renderedas == 'UserId'){
        $DefaultString =  $DefaultString . "'" . $Userid . "', ";
    }


}
$DefaultString = substr($DefaultString,0,strlen($DefaultString)-2);

$TableName = $arr[0]->tablename;

$SQL = "INSERT INTO " . CHR(96) . $TableName . CHR(96) . "(" . $SQLString . ')VALUES(' . $DefaultString . ")";

// echo $SQL;

$LastId = PerformSQLOperation($SQL);

//echo $LastId;

if(substr($LastId,0,5)=="ERROR"){
    echo $LastId;
    return;
}

$MasterLast = 0;
if($Masterid == 0)
{
    $MasterLast = $LastId;
}else
{
    $MasterLast = $Masterid;
}

$resit = CreateHistory($EnterpriseObjectId,$MasterLast,$Userid, $TableName." Record Created",$SQL);

//echo($resit);




//Create data record for insert on grid
$DataString = "";
for($x = 1; $x <= count($arr)-1; $x++)
{
    if($x==1){
    $DataString =  $DataString . $arr[$x]->field . ": " . $LastId . ", ";
    }

     //Handle the master id
    if($x==2){
    $DataString =  $DataString . $arr[$x]->field . ": " . $Masterid . ", ";
    }

    // Handle the sequence id
    if($x==3){
        $DataString =  $DataString . $arr[$x]->field . ": " . $EnterpriseObjectId . ", ";
    }


    if($x>3){

        if($arr[$x]->renderedas <> 'Date' and $arr[$x]->renderedas <> 'UserId'){
            $DataString =  $DataString . $arr[$x]->field . ": '" .  $arr[$x]->defaultvalue . "', ";        }

        if($arr[$x]->renderedas == 'Date'){
            $DATADATE = date("Y-m-d H:i:s");
            $DataString =  $DataString . $arr[$x]->field . ": '" .  $DATADATE . "', ";        }

        if($arr[$x]->renderedas == 'UserId'){
            $DataString =  $DataString . $arr[$x]->field . ": '" .  $Userid . "', ";        }



        //  $DataString =  $DataString . $arr[$x]->field . ": '" .  $arr[$x]->defaultvalue . "', ";


    }

}

$DataString = '{' . substr($DataString,0,strlen($DataString)-2) . '}';

echo $DataString;


?>

