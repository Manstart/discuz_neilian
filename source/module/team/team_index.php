<?php
if(!defined('IN_DISCUZ')){
    exit('Access Denied');
}
if(empty($_GET['mod'])){
    $_GET['mod'] = 'index';
}
if($_GET['action'] == 'index'){
    echo '这是介绍团队的页面';
}