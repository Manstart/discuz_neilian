<?php
 /*
  *版权声明: 该程序为 [木犀网] 独立自主开发, 依法拥有该产品知识产权,所有代码版权归[木犀网]所有, 程序内均为商业代码, 仅为购买者提供使用授权.
  *法律声明: 未经官方授权使用修改或者传播都是属于侵权和违法行为, 依法将追究一切相关法律责任.
  */
//做题的Ajax
require '../../../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();
if(!defined('IN_DISCUZ')) {//查看是否从dz内核调用，防止非法调用
    exit('Access Denied');
}
  $rid=addslashes($_GET["rid"]);
  //$iid=$_GET["iid"];
  $qid=addslashes($_GET["qid"]);
  $myanswer=addslashes($_GET["myanswer"]);
  $k=addslashes($_GET["k"]);//当前用户选择选项的序号0,1,2,3
  //$allmychk=$_GET["allmychk"];
  $truek=addslashes($_GET["truek"]);//正确选项的序号0,1,2,3,
  $onelevel=addslashes($_GET['onelevel']);
  $trueanswer=addslashes($_GET["trueanswer"]);
  $typeid=addslashes($_GET["typeid"]);//试题类别id
  $condition=array("rid"=>$rid,"qid"=>$qid);//" rid=$rid and qid=$qid ";
  $xngs_jkt_record_detail="xngs_jkt_record_detail";
  $lang=lang('plugin/xngs_jkt');
  $score=1;
  if($onelevel==4) $score=2;//科目四，每道题2分
  
   //==单选题和判断题==//
  if($typeid==1||$typeid==2){
 	   DB::update($xngs_jkt_record_detail, array('myanswer'=>$myanswer),array('qid'=>$qid,'rid'=>$rid),$unbuffered = true, $low_priority = false);
   		//回答正确
	  if($trueanswer==$myanswer){
	  	DB::update($xngs_jkt_record_detail, array('istrue'=>1,'score'=>$score,'done'=>1),array('qid'=>$qid,'rid'=>$rid));
	  }else{//echo  " ，回答错误";
	  	if($typeid==1){//选择题
	 			 $tip1="";
	  			if($truek==0) {
	  		    	$tip1="A";
	  		    }elseif($truek==1) {
	  		    	$tip1="B";
	  		    } elseif($truek==2) {
	  		    	$tip1="C";
	  		    }elseif($truek==3) {
	  		    	$tip1="D";
	  		    }
	  		     $tip2="";
	  		    if($k==0) {
	  		    	$tip2="A";
	  		    }elseif($k==1) {
	  		    	$tip2="B";
	  		    } elseif($k==2) {
	  		    	$tip2="C";
	  		    }elseif($k==3) {
	  		    	$tip2="D";
	  		    }
	  	}elseif($typeid==2){//判断题
	  	 		$tip1="";
	  			if($truek==0) {
	  		    	$tip1=$lang['dui'];
	  		    }elseif($truek==1) {
	  		    	$tip1=$lang['dui'];
	  		     $tip2="";
	  		    }
	  		    if($k==0) {
	  		    	$tip2=$lang['dui'];
	  		    }elseif($k==1) {
	  		    	$tip2=$lang['cuo'];
	  		    } 
	  	}
	  	DB::update($xngs_jkt_record_detail, array('istrue'=>-1,'score'=>0,'tip1'=>$tip1,'tip2'=>$tip2,'done'=>1),array('qid'=>$qid,'rid'=>$rid));
	  }
   //======多选题======//
  }else if($typeid==3){
  		$tip1="";
   		if(strpos($truek,"0")>0){
   			$tip1.="A";
   		}
   		if(strpos($truek,"1")>0){
   			$tip1.="B";
   		}
  		if(strpos($truek,"2")>0){
   			$tip1.="C";
   		}
  		if(strpos($truek,"3")>0){
   			$tip1.="D";
   		}
   		 $tip2="";
        if(strpos($k,"0")>0){
   			$tip2.="A";
   		}
   		if(strpos($k,"1")>0){
   			$tip2.="B";
   		}
  		if(strpos($k,"2")>0){
   			$tip2.="C";
   		}
  		if(strpos($k,"3")>0){
   			$tip2.="D";
   		}
   		//回答正确
   		if($tip1==$tip2){
   			DB::update($xngs_jkt_record_detail, array('myanswer'=>$myanswer,'istrue'=>1,'score'=>$score,'tip1'=>$tip1,'tip2'=>$tip2,'done'=>1),array('qid'=>$qid,'rid'=>$rid));
   		}else{
   			DB::update($xngs_jkt_record_detail, array('myanswer'=>$myanswer,'istrue'=>-1,'score'=>0,'tip1'=>$tip1,'tip2'=>$tip2,'done'=>1),array('qid'=>$qid,'rid'=>$rid));
   		}
  }	
?>