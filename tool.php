<?php
define('APPTYPEID', 10);
define('CURSCRIPT', 'tool');

require './source/class/class_core.php';
//初始化操作
$discuz = C::app();
$discuz ->init();

//引入第三方类库
require './source/class/upload/class.upload.php';
//逻辑分发处理
if(empty($_GET['mod']) || !in_array($_GET['mod'],array('index')))
    $_GET['mod'] = 'index';
define('CURMODULE', $_GET['mod']);
//设置全局变量
$_G['disabledwidthauto'] = 1;
//根据Mod参数分发到对应模块
require_once libfile('tool/'.$_GET['mod'],'module');