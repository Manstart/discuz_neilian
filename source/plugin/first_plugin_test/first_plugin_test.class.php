<?php
if(!defined('IN_DISCUZ')){
        exit('Access Denied');
}

class plugin_first_plugin_test {  //此处类名 plugin_XXXXX   必须与文件名 XXXXX.class.php 一致
     function global_header() {
          global $_G;
          $sendConfig = array();
          $sendConfig = $_G['cache']['plugin']['first_plugin_test'];  //缓存插件变量值
                
          if( intval($sendConfig['status']) == 1 ) {  //是否启动插件
              if( isset($_POST['regsubmit']) ) { //会员注册后
                   $uid = intval($_G['member']['uid']);
                   if( $uid ){
                         $jinbi_num = intval($sendConfig['jinbi_num']);  //送金币数量
                         updatemembercount($uid,array("extcredits2" => $jinbi_num)); //更新金币数 （这个是function_core.php的现成函数）
                         //这里可以进行任何数据库的操作
                    }
               }
          }
      }
}

class plugin_first_plugin_test_member extends plugin_first_plugin_test{
    function register_input(){
        $lang = lang('plugin/first_plugin_test');
        $bind = "<a href='javascript:void(0);' onClick=\"alert('别点我');\">".$lang['info']."</a>";
        return $bind;
    }
}

