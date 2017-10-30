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
    include template('exam/exam_in');
}elseif($_GET['action'] == 'check_exam'){   
    $examins = array();
    //$examins[id]为自增，不用写
    $examins[direction] = $_POST['direction'];
    $examins[mold] = $_POST['mold'];
    $examins[difficulty] = $_POST['difficulty'];
    $examins[topic] = $_POST['topic'];
    $examins[optionA] = $_POST['optionA'];
    $examins[optionB] = $_POST['optionB'];
    $examins[optionC] = $_POST['optionC'];
    $examins[optionD] = $_POST['optionD'];
    $examins[answer] = $_POST['answer'];
    $examins[explains] = $_POST['explains'];
    $result = C::t('examin_transit')->save_transit($examins);
    if($result){
        showmessage('申请成功，请等待审核','exam.php?mod=index&action=index',array(),array('alert'=>'right','msgtype'=>2));
    }else{
        showmessage('申请失败','exam.php?mod=index&action=index',array(),array('alert'=>'error','msgtype'=>2));
    }
}elseif($_GET['action'] == 'exam_check'){
    $list = C::t('examin_transit')->list_transit();

    include template('exam/exam_check');
}elseif($_GET['action'] == 'save_exam'){
    echo "111";
    $result = C::t('examin_transit')->list_transit();
    $result_final = C::t('examin_fianl')->add_examin($result);
    
}elseif($_GET['action'] == 'del_exam'){
    echo "222";
}


