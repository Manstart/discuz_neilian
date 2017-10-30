<?php
// mod文件只能被入口文件引用，不能直接访问
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

// 游客不能发表心情的判断
if(!$_G['uid']) {
    showmessage('抱歉，您尚未登录，无法进行此操作', '', array(), array('login' => 1));
}

if(submitcheck('submit')) {
    $message = cutstr(dhtmlspecialchars(stripslashes($_POST['message'])), 150, ''); //截取150个字节的内容
    DB::query("INSERT INTO ".DB::table('mood_wall')." (uid, username, dateline, message) VALUES ('$_G[uid]', '$_G[username]', '".TIMESTAMP."', '".daddslashes($message)."')");
    showmessage('发表成功。', 'mood.php?mod=list');
}

//显示发布表单
include_once template("mood/publish");