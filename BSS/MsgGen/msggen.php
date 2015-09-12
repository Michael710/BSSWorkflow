<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michaelmclaughlin
 * Date: 11/27/12
 * Time: 8:54 AM
 * To change this template use File | Settings | File Templates.
 */

ECHO 'GENERATING MESSAGE SUBJECT AND BODY FOR: ' . $WorkflowId ,' AND StepKey: ' . $stepkey;

$GeneratedSubject = "This is the BSS Generated Subject";

$GeneratedBody = "This is the BSS Generated Body";

RETURN 'SUCCESS';    // Set to SUCCESS if GOOD.  Anything else will indicate a failure.

?>