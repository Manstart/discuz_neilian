<?php
if(!defined('IN_DISCUZ')){
    exit('Access Denied');
}
class plugin_test{
    function global_header(){
        // return '<script>alert("hello discuz!")</script>';
    }
    function global_footer(){
        global $_G;
        $html = '<div>welcome to android!</div>';
        // return $html;
    }
}