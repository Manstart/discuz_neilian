<?php
require 'class/class_xngs_jkt.php';
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
loadcache('plugin');
$navtitle=$_G['cache']['plugin']['xngs_jkt']['seotitle'];
$metakeywords = $_G['cache']['plugin']['xngs_jkt']['seokeywords'];
$metadescription = $_G['cache']['plugin']['xngs_jkt']['seodescription'];
$qnum=$_G['cache']['plugin']['xngs_jkt']['qnum'];
$submitnum=addslashes($_POST['submitnum']);
//$admingroupid=$_G['cache']['plugin']['xngs_jkt']['admingroupid'];
$username=addslashes($_G["username"]);
$uid=addslashes($_G["uid"]);
$groupid=addslashes($_G["groupid"]);
$schoolid=addslashes($_POST['schoolid']);
$jxname=addslashes($_POST['jxname']);
$flag=addslashes($_POST['flag']);
$onelevel=addslashes($_POST['onelevel']);
$onelevelname=addslashes($_POST['onelevelname']);
$twolevel=addslashes($_POST['twolevel']);
$kc=addslashes($_POST['kc']);
$personorschool=addslashes($_POST['personorschool']);
$jzmc=addslashes($_POST['jzmc']);
$tb=addslashes($_POST['tb']);
$rid=addslashes($_POST['rid']);
$question="xngs_jkt_question";
$quesitem="xngs_jkt_questionitem";
$record="xngs_jkt_record";
$teacher="xngs_jkt_teacher";
$schooltable="xngs_jkt_school";
$record_detail="xngs_jkt_record_detail";
$kscode="xngs_jkt_kscode";
$globaltable="xngs_jkt_global";
$signup_table="xngs_jkt_signup";
$lang=lang('plugin/xngs_jkt');
//
	
	 if($onelevel!=""&&$kc!=""&&submitcheck('formhash')){
	      if($onelevel=="1"){
	 			  $onelevelname=$lang['km1name'];
	 			  if($kc=="1"){
	 			 	  $twolevel="3";
	 			 	  $jzmc=$lang['c1c2'];
	 			 	  $tb="01";
	 			 	}elseif($kc=="2"){
	 			 		$twolevel="4";
	 			 		 $jzmc=$lang['a1b2'];
	 			 		 $tb="02";
	 			 	}elseif($kc=="3"){
	 			 		$twolevel="5";
	 			 		 $jzmc=$lang['a1a3b1'];
	 			 		 $tb="03";
	 			 	}
	 			}elseif($onelevel=="4"){
	 			 $onelevelname=$lang['km4name'];
	 			  if($kc=="1"){
	 			 	  $twolevel="6";
	 			 	 $jzmc=$lang['c1c2'];
	 			 	  $tb="01";
	 			 	}elseif($kc=="2"){
	 			 		$twolevel="7";
	 			 		 $jzmc=$lang['a1b2'];
	 			 		 $tb="02";
	 			 	}elseif($kc=="3"){
	 			 		$twolevel="8";
	 			 		 $jzmc=$lang['a1a3b1'];
	 			 		$tb="03";
	 			 	}
	 			}	 		
	 		//include template('xngs_jkt:second');
	 	    include template('xngs_jkt:moniexam');
	 	
	 	}elseif($flag=="ksfs"&&submitcheck('formhash')){
	 		$fangshi=addslashes($_POST['fangshi']);
	 		if($fangshi=="moniexam"){
	 			include template('xngs_jkt:moniexam');
	 		}
	 	}elseif($twolevel!=""&&$personorschool==1&&submitcheck('formhash')){
	 		$examadvurl=$_G['cache']['plugin']['xngs_jkt']['examadvurl'];
	 		$examadvurl_list = trim($examadvurl);  
            $examadvurl_arr = explode("\r\n", $examadvurl_list);  
			$examadvlink=$_G['cache']['plugin']['xngs_jkt']['examadvlink'];
			$examadvlink_list = trim($examadvlink);  
            $examadvlink_arr = explode("\r\n", $examadvlink_list);
	 		 $qarray="";
	 		 $sname=addslashes($_POST['sname']);
	 		 if($sname=="")$sname=$username;
			 $cardnum=addslashes($_POST['cardnum']);
			 $tel=addslashes($_POST['tel']);
			 if($schoolid=="")$schoolid="1";
			  $code=addslashes($_POST['code']);
			  if($code!=""){
			  DB::update($kscode, array('used'=>'1','usetime'=>date('Y-m-d	H:i:s')),array('code'=>$code));
			  }
	 		 $recdata=array("onelevel"=>$onelevel,"onelevelname"=>$onelevelname,"jzmc"=>$jzmc,"sname"=>$sname,"sname"=>$sname,"cardnum"=>$cardnum,"tel"=>$tel,"school"=>$schoolid,"userid"=>$uid,"starttime"=>date('Y-m-d  H:i:s'));// echo strtotime(date('Y-d-m H:i:s'));时间戳
	         DB::insert($record,$recdata,$return_insert_id = true, $replace = false, $silent = false);
	         $rid=DB::insert_id();
	 		 $sql="";
	 		 if($onelevel=="1"){
	 		 	$sql.="(select * from ".DB::table($question)." where onelevel=".$onelevel." and examlb like '%".$twolevel."%' and typeid=2 ORDER BY rand() LIMIT 40)";
		     	$sql.=" union ";
		     	$sql.="(select * from ".DB::table($question)." where onelevel=".$onelevel." and examlb like '%".$twolevel."%' and typeid=1 ORDER BY rand() LIMIT 60)";
		     	//$sql="select * from pre_xngs_jkt_question where examlb='3,4,5' and  qid in ('111')";
	 		 }else if($onelevel=="4"){
	 		 	$sql.="(select * from ".DB::table($question)." where onelevel=".$onelevel." and examlb like '%".$twolevel."%' and typeid=2 ORDER BY rand() LIMIT 22)";
		     	$sql.=" union ";
		     	$sql.="(select * from ".DB::table($question)." where onelevel=".$onelevel." and examlb like '%".$twolevel."%' and typeid=1 ORDER BY rand() LIMIT 22)";
		     	$sql.=" union ";
		     	$sql.="(select * from ".DB::table($question)." where onelevel=".$onelevel." and examlb like '%".$twolevel."%' and typeid=3 ORDER BY rand() LIMIT 6)";
		     	//$sql="select * from pre_xngs_jkt_question where examlb='6,7,8' and qid in('89','90','99','113','164','198','201','448','461','535','627','656','657')" ;
	 		 }
		     $datas=DB::fetch_all($sql);
	         //foreach($datas as $data) {      	 
	       	 // $indata=array("rid"=>$rid,"qid"=>$data["id"],"trueanswer"=>$data["trueanswer"]);
	         // DB::insert($record_detail,$indata,$return_insert_id = false, $replace = false, $silent = false);
	         // }
		      $questionArray=array();
		      //
		     foreach ($datas as $key => $data) {
		    	  $itemsql="select id,content from ".DB::table($quesitem)." where  qid=".$data["qid"]." and onelevel =".$onelevel." order by Id";
		          $items=DB::fetch_all($itemsql);
	               //
		          $qArray=array();
		          $qArray["id"]=$data["qid"];
		          $qArray["title"]=$data["title"];
		          $qArray["typeid"]=$data["typeid"];
		          $qArray["trueanswer"]=$data["trueanswer"];
		          $qArray["content"]=$data["content"];
		          $qArray["attachtype"]=$data["attachtype"];
		          $qArray["onelevel"]=$data["onelevel"];
		          $qArray["items"]=$items;
		          $questionArray[]=$qArray;
		          unset($itemArray);
		          unset($qArray);
	         	 if($data["typeid"]=="3"){
	    		 	$indata=array("onelevel"=>$onelevel,"rid"=>$rid,"qid"=>$data["qid"],"trueanswer"=>$data["trueanswer"]);
	         	 }else{
	         	 	$indata=array("onelevel"=>$onelevel,"rid"=>$rid,"qid"=>$data["qid"],"trueanswer"=>$data["trueanswer"]);
	         	 }
	    		 DB::insert($record_detail,$indata,$return_insert_id = false, $replace = false, $silent = false);
			}
	 		 //$table="xngs_jkt:_record_detail";
			 //$data=array("title"=>$title,"con"=>$con,"username"=>$username);
			 //$in_id=DB::insert($table, $data, $return_insert_id =true, $replace = false, $silent = false);
			if($onelevel=="1"){
	 			include template('xngs_jkt:exam');	
			}else if($onelevel=="4"){ 	
				include template('xngs_jkt:examkm4');	
			}	
	 	}elseif($personorschool==2&&$twolevel!=""&&submitcheck('formhash')){
	 		 xngs_jkt::updateexpstate();
			 xngs_jkt::delkscode();
	 		 $schoolsql="select * from ".DB::table($schooltable)." where areaid=1 and Id!=0";
		     $schools=DB::fetch_all($schoolsql);
	 		include template('xngs_jkt:addexaminfo');

	 	}elseif($flag=="subm"&&$rid!=""&&submitcheck('formhash')){
	 		  $sumsql="select sum(score) as totalscore from ".DB::table($record_detail)." where rid=".$rid;
  			  $sumscore=DB::fetch_first($sumsql);
  			  $donesql="select count(*) as donenum from ".DB::table($record_detail)." where done=1 and rid=".$rid;
  			  $done=DB::fetch_first($donesql);
  			  $timesql="select starttime  from ".DB::table($record)." where id=".$rid;
  		      $starttime=DB::fetch_first($timesql);
  		      $starttime=$starttime["starttime"];
			  $endtime=date('Y-m-d  H:i:s');
			  $minute=floor((strtotime($endtime)-strtotime($starttime))%86400/60);
			  $second=floor((strtotime($endtime)-strtotime($starttime))%86400%60);
			  $time=$minute.$lang['feng'].$second.$lang['miao'];
  			  DB::update($record, array('donenum'=>$done["donenum"],'score'=>$sumscore["totalscore"],'submittime'=>$endtime,'time'=>$time),array('userid'=>$uid,'id'=>$rid));
  			  DB::update($globaltable, array('submitnum'=>$submitnum+1));
  			  include template('xngs_jkt:result');

	 	}elseif($flag=="resultdetail"&&submitcheck('formhash')){
	 		$examadvurl=$_G['cache']['plugin']['xngs_jkt']['examadvurl'];
	 		$examadvurl_list = trim($examadvurl);  
            $examadvurl_arr = explode("\r\n", $examadvurl_list);  
			$examadvlink=$_G['cache']['plugin']['xngs_jkt']['examadvlink'];
			$examadvlink_list = trim($examadvlink);  
            $examadvlink_arr = explode("\r\n", $examadvlink_list);
	 		$recsql="select * from ".DB::table($record)." where id=".$rid;
	 		$rec=DB::fetch_first($recsql);
	 		$jzmc=$rec["jzmc"];
	 		$score=$rec["score"];
	 		$donenum=$rec["donenum"];
	 		$onelevelname=$lang['km1name'];
	 		$truenum=$score;
  			  if($rec["onelevel"]==4){
  			  	$truenum=$score/2;
  			  	$onelevelname=$lang['km4name'];
  			  }
	 		$submittime=$rec["submittime"];
	 		$detailsql="select * from ".DB::table($record_detail)." t1,".DB::table($question)." t2 where t1.qid=t2.qid and t1.onelevel=t2.onelevel and t1.rid=".$rid." order by t1.id";
		     $datas=DB::fetch_all($detailsql);
		      $questionArray=array();
	      	  foreach ($datas as $key => $data) {
		    	  $itemsql="select id,content from ".DB::table($quesitem)." where  qid=".$data["qid"]." and onelevel=".$data["onelevel"];
		          $items=DB::fetch_all($itemsql);
		          $qArray=array();
		          $qArray["id"]=$data["qid"];
		          $qArray["title"]=$data["title"];
		          $qArray["typeid"]=$data["typeid"];
		          $qArray["trueanswer"]=$data["trueanswer"];
		          $qArray["myanswer"]=$data["myanswer"];
		          $qArray["done"]=$data["done"];
		          $qArray["istrue"]=$data["istrue"];
		          $qArray["content"]=$data["content"];
		          $qArray["tip1"]=$data["tip1"];
		          $qArray["tip2"]=$data["tip2"];
		          $qArray["items"]=$items;
		          $questionArray[]=$qArray;
		          unset($itemArray);
		          unset($qArray);
	      	  }
	 		include template('xngs_jkt:resultdetail');
		
	 	}elseif($flag=="ptm"&&submitcheck('formhash')){
	 		$sql="select id from ".DB::table($record)." where submittime='0' and starttime<='".date('Y-m-d')."'";
	 	    $lajidatas=DB::fetch_all($sql);
		    foreach ($lajidatas as $key => $ljdata) {
			 $ljid=$ljdata["id"];
			 DB::delete($record, array('id'=>$ljid));
			 DB::delete($record_detail, array('rid'=>$ljid));
		    }
			include template('xngs_jkt:ptm');
	 	
	 	}elseif($flag=="historyexam"&&submitcheck('formhash')){
	 		DB::delete($record, array('submittime'=>'0','userid'=>$uid));
	 		$sql="select *,t1.sname stuname,t2.sname schoolname from ".DB::table($record)." t1 , ".DB::table($schooltable)." t2  where t1.school=t2.id and userid=$uid and submittime<>'0' order by submittime desc limit 0,10 ";
	 		$hisexam=DB::fetch_all($sql);
	 		include template('xngs_jkt:ptm');
	 	 }else{
	 			//if(($uid>0)&&($groupid==1)){
		 	 	$phbsql="select *,CASE t1.sname WHEN '' THEN '游客' ELSE  t1.sname END stuname,t2.sname schoolname from ".DB::table($record)."  t1,".DB::table($schooltable)." t2 where t1.school=t2.id and submittime<>'0' order by score desc,time asc limit 0,10";
		 	 	$phbexam=DB::fetch_all($phbsql);
		 	    $globalsql="select * from ".DB::table($globaltable);
  			    $globalparam=DB::fetch_first($globalsql);
		 	 	DB::update($globaltable, array('access'=>$globalparam["access"]+1)); 
		 	 	//} 	
		 		//phpinfo();
			 	//
				 if(($uid>0)&&($groupid==$teachergid)){
					$teachersql="select * from ".DB::table($teacher)." where userid=$uid";
					$teacherifo=DB::fetch_first($teachersql);
					$schoolid=$teacherifo["schoolid"];
				 }
				include template('xngs_jkt:index');
  }

//	 

?>