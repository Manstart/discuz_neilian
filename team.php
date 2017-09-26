<?php
define('APPTYPEID',11);
define("CURSCRIPT",'team');

require './source/class/class_core.php';

$discuz = C::app();
$discuz -> init();

if(empty($_GET['mod']) || !in_array($_GET['mod'],array('index')))
    $_GET['mod'] = 'index';
define('CURMODULE', $_GET['mod']);
$_G['disabledwidthauto'] = 1;
require_once libfile('team/'.$_GET['mod'],'module');