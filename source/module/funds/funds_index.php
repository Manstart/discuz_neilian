<?php
if(!defined('IN_DISCUZ')){
    exit('Access Denied');
}
if(empty($_GET['mod'])){
    $_GET['mod'] = 'index';
}
if($_GET['action'] == 'index'){
    if($_G['uid'] == 0){
        showmessage('请先登录','member.php?mod=logging&action=login',array(),array('alert'=>'error','msgtype'=>2));
    }
    include template('funds/funds_index');
}elseif($_GET['action'] == 'save_funds'){    
        $add_funds = array();
        //$add_funds[app_id]为自增，不用写
        $add_funds[app_name] = $_G['username'];
        $add_funds[app_date] = $_POST['app_date'];
        $add_funds[app_reason] = $_POST['app_reason'];
        $add_funds[app_money] = $_POST['app_money'];
        $result = C::t('app_funds')->add_funds($add_funds);
        if($result){
            showmessage('申请成功，请等待审核','funds.php?mod=index&action=index',array(),array('alert'=>'right','msgtype'=>2));
        }else{
            showmessage('申请失败','funds.php?mod=index&action=index',array(),array('alert'=>'error','msgtype'=>2));
        }
}elseif($_GET['action'] == 'funds_list'){
    $list = array();
    $username = $_G['username'];
    $list = C::t('app_funds')->funds_list($username);

    $page = empty($_GET['page'])?1:intval($_GET['page']);
    if($page<1) $page=1;

    //分页
    $perpage = 5;
    $start = ($page-1)*$perpage;
    //获得一个简单的分页，只有上一页和下一页，这个不需要count()数据表中的所有记录
    $multi = simplepage(count($list), $perpage, $page, 'funds.php?mod=index');
    //数据准备完毕，引入相应的模板，准备输出
    include_once template("funds/funds_list");
}

if($_GET['action'] == 'index_per'){
    if($_G['uid'] == 0){
        showmessage('请先登录','member.php?mod=logging&action=login',array(),array('alert'=>'error','msgtype'=>2));
    }
    include template('funds/personal_app');
}elseif($_GET['action'] == 'personal_app'){
    $add_personalApp = array();
    $add_personalApp[personalApp_name] = $_G['username'];
    $add_personalApp[personalApp_date] = $_POST['personalApp_date'];
    $add_personalApp[personalApp_return] = $_POST['personalApp_return'];
    $add_personalApp[personalApp_reason] = $_POST['personalApp_reason'];
    $result = C::t('personal_app')->add_personalApp($add_personalApp);
    if($result){
        showmessage('申请成功，请等待审核','funds.php?mod=index&action=index_per',array(),array('alert'=>'right','msgtype'=>2));
    }else{
        showmessage('申请失败','funds.php?mod=index&action=index_per',array(),array('alert'=>'error','msgtype'=>2));
    }
}elseif($_GET['action'] == 'personal_list'){
    $list = array();
    $pageshow = 2;

    $username = $_G['username'];
    
    $page = intval($_GET['page']);
    if($page<=0){$page = 1;}elseif($page>$maxpage){$page=$maxpage;}
  
    //分页   
    $pagesize = ($page-1)*$pageshow;

    $all_list = C::t('personal_app')->all_personal_list($username);

    //想做分页，但是没成功，还有table_personal_app.php中的personal_list函数
    $list = C::t('personal_app')->personal_list($username,$pagesize,$pageshow);
    
    $totalnum = count($all_list);

    $maxpage = ceil($totalnum/$pageshow); //有多少页

    //数据准备完毕，引入相应的模板，准备输出
    include_once template("funds/personal_list");
}
