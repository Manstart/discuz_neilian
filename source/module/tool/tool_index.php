<?php
//定义安全常量
if(!defined('IN_DISCUZ')){
    exit('zhangxingxing,Access Denied');
}
if(empty($_GET['mod'])){
    $_GET['mod'] = 'index';
}
if(empty($_GET['action'])){
    $_GET['action'] = 'index';
}
if($_GET['action'] == 'index'){
    include template('tool/tool_index');
    //tool.php?mod=index&action=index
}elseif($_GET['action'] == 'upload'){
    // echo '这是上传的页面';
    // debug($_G); 查询用户是否登录
    if($_G['uid'] == 0){
        showmessage('请先登录','member.php?mod=logging&action=login',array(),array('alert'=>'error','msgtype'=>2));
    }
    include template('tool/tool_upload');
}elseif($_GET['action'] == 'sql'){
    // $var = '慕课';
    // $num = 1;
    // $num1 = 2;
    // $var1 = 'muke';
    // include template('tool/tool_temp');
}elseif($_GET['action'] == 'save_upload_tool'){
    $add_tool = array();//add_tool用于存储上传的信息
    $add_tool['tool_user'] = $_G['username'];
    $add_tool['tool_uid'] = $_G['uid'];
    $add_tool['tool_tag'] = $_POST['tool_tag'];//用户通过表单上传用post
    $add_tool['tool_cat'] = $_POST['tool_cat'];
    $add_tool['tool_cost'] = $_POST['tool_cost'];
    $add_tool['tool_desc'] = $_POST['tool_desc'];
    $add_tool['tool_type'] = 1;
    $add_tool['tool_state'] = 20;
    $add_tool['tool_time'] = time();
    $add_tool['tool_name'] = $_POST['tool_name'];
    $up = new FileUpload();
    $up -> set('path',DISCUZ_ROOT.'./data/attachment/tool/tool_pic/');
    $up -> set('maxsize',10485760);
    $up -> set('allowtype',array('gif','png','jpg','jpeg'));
    $up -> set('israndname',true);
    $up -> upload('tool_pic');
    $add_tool['tool_pic'] = $up->getFileName();
    $up = new FileUpload();
    $up -> set('path',DISCUZ_ROOT.'./data/attachment/tool/tool_file/');
    $up -> set('maxsize',10485760);//这里以字节数为单位，10485760是1M
    $up -> set('allowtype',array('zip','rar'));
    $up -> set('israndname',true);
    $up -> upload('tool_filename');
    //$up -> getErrorMsg();可以返回错误的原因
    $add_tool['tool_file'] = $up->getFileName();
    $result = C::t('tool_info')->add_tool($add_tool);
    if($result){
        showmessage('上传成功，请等待审核','tool.php?mod=index&action=index',array(),array('alert'=>'right','msgtype'=>2));
    }else{
        showmessage('上传失败','tool.php?mod=index&action=index',array(),array('alert'=>'error','msgtype'=>2));
    }
}