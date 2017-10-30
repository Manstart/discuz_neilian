<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if($_GET['fromversion'] < "v1.2.1") {
$sql = <<<EOF


EOF;
runquery($sql);
}

$finish = TRUE;
?>