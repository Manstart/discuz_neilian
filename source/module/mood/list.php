<?php
// mod文件只能被入口文件引用，不能直接访问
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

//初始化当前页码
$page = empty($_GET['page'])?1:intval($_GET['page']);
if($page<1) $page=1;

//分页
$perpage = 5;
$start = ($page-1)*$perpage;

//获取当前页的留言数据
$list = array();
$query = DB::query("SELECT * FROM ".DB::table('mood_wall')." WHERE 1 ORDER BY dateline DESC LIMIT $start, $perpage");
while($mood = DB::fetch($query)) {
    $mood['dateline'] = dgmdate($mood['dateline'], 'u');
    $list[] = $mood;
}
//获得一个简单的分页，只有上一页和下一页，这个不需要count()数据表中的所有记录
$multi = simplepage(count($list), $perpage, $page, 'mood.php?mod=list');
//数据准备完毕，引入相应的模板，准备输出
include_once template("mood/list");
