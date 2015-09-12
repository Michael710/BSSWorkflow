<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 3/9/13
 * Time: 12:10 AM
 * To change this template use File | Settings | File Templates.
 */

require_once('SendSMTPMail.php');

try{

SendMail('RedS2000@Fastem.com', 'John Smith', 'Test Subject', 'TextBody');

}catch(Exception $ex){
    echo $ex;
}

?>