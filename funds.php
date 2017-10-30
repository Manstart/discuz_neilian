<?php
define('APPTYPEID',12);
define("CURSCRIPT",'funds');

require './source/class/class_core.php';

$discuz = & discuz_core::instance();

if(empty($_GET['mod']) || !in_array($_GET['mod'],array('index')))
    $_GET['mod'] = 'index';
define('CURMODULE', $_GET['mod']);

$discuz -> init();

require_once libfile('funds/'.$_GET['mod'],'module');
