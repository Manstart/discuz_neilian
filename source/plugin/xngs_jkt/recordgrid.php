<?php
 /*
  *��Ȩ����: �ó���Ϊ [ľϬ��] ������������, ����ӵ�иò�Ʒ֪ʶ��Ȩ,���д����Ȩ��[ľϬ��]����, �����ھ�Ϊ��ҵ����, ��Ϊ�������ṩʹ����Ȩ.
  *��������: δ���ٷ���Ȩʹ���޸Ļ��ߴ�������������Ȩ��Υ����Ϊ, ������׷��һ����ط�������.
  */
//��ѯ�����б��Ajax
	require '../../../source/class/class_core.php';
	$discuz = & discuz_core::instance();
	$discuz->init();
	if(!defined('IN_DISCUZ')) {//�鿴�Ƿ��dz�ں˵��ã���ֹ�Ƿ�����
    exit('Access Denied');
	}
	$recs;
	$flag=addslashes($_GET["flag"]);
	$schoolid=addslashes($_GET["schoolid"]);
	$sname=addslashes($_GET["sname"]);
	$cardnum=addslashes($_GET["cardnum"]);
	$fromtime=addslashes($_GET["fromtime"]);
	$totime=addslashes($_GET["totime"]);
	$record="xngs_jkt_record";
	$groupid=addslashes($_G["groupid"]);
	$schooltable="xngs_jkt_school";
	$signup_table="xngs_jkt_signup";
	$consql="";
	if(!empty($sname)&&$sname!="") $consql.=" and t1.sname ='".$sname."'";
	if(!empty($cardnum)&&$cardnum!="") $consql.=" and cardnum ='".$cardnum."'";
	if(!empty($fromtime)&&$fromtime!="")$consql.=" and  submittime >='".$fromtime."'";
	if(!empty($totime)&&$totime!="")$consql.=" and  submittime <='".$totime."'";
	if($flag=="findrecord"){
		if(!empty($schoolid)&&$schoolid!=""&&$groupid!=1){
				 //ѧУ��ʦ����ѧУ�ĳɼ�
				 $consql.=" and  school ='".$schoolid."'";
				//Ϊʲô����and substring(submittime,1,10) >='2013-12-23'�Ͳ�ѯ�������ˣ�
			    //����sql��ִ��select * from pre_xngs_jkt:_record where  substring(submittime,1,10)>='2013-12-22' order by submittime desc���ܲ�ѯ������
				$sql="select *,t1.sname stuname,t2.sname schoolname from ".DB::table($record)." t1,".DB::table($schooltable)." t2 where t1.school=t2.id and submittime<>'0' ".$consql." order by submittime desc";
				$recs=DB::fetch_all($sql);
				$str="";
			  	foreach ($recs as $key => $rec) {
			 		$str.="@{submittime: '$rec[submittime]',school: '$rec[schoolname]',sname: '$rec[stuname]',	onelevelname: '$rec[onelevelname]',jzmc: '$rec[jzmc]',score: '$rec[score]',time: '$rec[time]'}";
				}
		  }else if($groupid==1){
				//����Ա�鿴ȫ���ɼ�
				$sql="select *,t1.sname stuname,t2.sname schoolname from ".DB::table($record)." t1,".DB::table($schooltable)." t2 where t1.school=t2.id and submittime<>'0' ".$consql." order by submittime desc";
				$recs=DB::fetch_all($sql);
				$str="";
			  	foreach ($recs as $key => $rec) {
			 		$str.="@{submittime: '$rec[submittime]',school: '$rec[schoolname]',sname: '$rec[stuname]',	onelevelname: '$rec[onelevelname]',jzmc: '$rec[jzmc]',score: '$rec[score]',time: '$rec[time]'}";
				}
			}
	}
	//==����������==//
	if($flag=="exprecord"){
		//����
		if(!empty($schoolid)&&$schoolid!=""&&$groupid!=1){
				 //ѧУ��ʦ����ѧУ�ĳɼ�
				 $consql.=" and  school ='".$schoolid."'";
				//Ϊʲô����and substring(submittime,1,10) >='2013-12-23'�Ͳ�ѯ�������ˣ�
			    //����sql��ִ��select * from pre_xngs_jkt:_record where  substring(submittime,1,10)>='2013-12-22' order by submittime desc���ܲ�ѯ������
				$sql="select *,t1.sname stuname,t2.sname schoolname from ".DB::table($record)." t1,".DB::table($schooltable)." t2 where t1.school=t2.id and submittime<>'0' ".$consql." order by submittime desc";
				$recs=DB::fetch_all($sql);
		  }else if($groupid==1){
				//����Ա�鿴ȫ���ɼ�
				$sql="select *,t1.sname stuname,t2.sname schoolname from ".DB::table($record)." t1,".DB::table($schooltable)." t2 where t1.school=t2.id and submittime<>'0' ".$consql." order by submittime desc";
				$recs=DB::fetch_all($sql);
		 }
		//$filename="������ѯ���".strtotime(date('Y-d-m H:i:s')).'.csv'; 
		$filename="files".DIRECTORY_SEPARATOR."exp".DIRECTORY_SEPARATOR."query".DIRECTORY_SEPARATOR."������ѯ���".date('YdmHis').'.csv';
	   $fp = fopen($filename, 'w');
	   $titleStr="�ύ����,���ˣ���У��,�������˺ţ�,��Ŀ,����,�ɼ�,��ʱ";
	   fputcsv($fp, split(',', $titleStr));
	   foreach ($recs as $line) {
	   	  $lineStr="";
	   	  $lineStr.=$line[submittime];
	   	  $lineStr.=",".$line[schoolname];
	   	  $lineStr.=",".$line[stuname];
	   	  $lineStr.=",".$line[onelevelname];
	   	  $lineStr.=",".$line[jzmc];
	   	  $lineStr.= ",".$line[score];
	   	  $lineStr.=",".$line[time];
	   	  fputcsv($fp, split(',', $lineStr));
	   }
  	   fclose($fp);
  	   $str=$filename;
	}
	//�����ѯ������
	if($flag=="findcode"){
		$used=addslashes($_GET["used"]);
	    $exp=addslashes($_GET["exp"]);
	    $consql.=" and  used ='".$used."'";
		$consql.=" and  exp ='".$exp."'";
		if(!empty($schoolid)&&$schoolid!=""&&$groupid!=1){
				$sql="select * from ".DB::table($kscode)." t1,".DB::table($schooltable)." t2 where t1.schoolid=t2.Id and t2.Id=".$schoolid.$consql." order by createdate asc";
				$recs=DB::fetch_all($sql);
				$str="";
			  	foreach ($recs as $key => $rec) {
			 		$str.="@{code: '$rec[code]',sname: '$rec[sname]',createdate: '$rec[createdate]',	expdate: '$rec[expdate]',used: '$rec[used]',exp: '$rec[exp]'}";
				}
		  }else if($groupid==1){
				$sql="select * from ".DB::table($kscode)." t1,".DB::table($schooltable)." t2 where t1.schoolid=t2.Id ".$consql." order by createdate asc";
				$recs=DB::fetch_all($sql);
				$str="";
			  	foreach ($recs as $key => $rec) {
			 		$str.="@{code: '$rec[code]',sname: '$rec[sname]',createdate: '$rec[createdate]',	expdate: '$rec[expdate]',used: '$rec[used]',exp: '$rec[exp]'}";
				}
			}
	
	}
	//��֤�������Ƿ���Ч
	if($flag=="validatecode"){
		$code=addslashes($_GET["code"]);
		$codesql="select * from ".DB::table($kscode)." where code='".$code."' and used='0' and exp='0'";
		$tempcode=DB::fetch_first($codesql);
		if($tempcode["id"]>0){
			$str.="true";
		}else{
			$str.="false";
		}
		
	}
	//����
	if($flag=="validateSignup"){
		$str.="";
		$stuname=addslashes($_GET["stuname"]);
		$tel=addslashes($_GET["tel"]);
		$schoolid=addslashes($_GET["schoolid"]);
		$signsql="select * from ".DB::table($signup_table)." where stuname='".$stuname."'";
		$signrecord=DB::fetch_first($signsql);
		if($signrecord["id"]>0){
			$str.="-1";
		}else{
			$indata=array("stuname"=>$stuname,"schoolid"=>$schoolid,"tel"=>$tel);
	 	 	 DB::insert($signup_table,$indata,$return_insert_id = false, $replace = false, $silent = false);
	 	 	 $str.="1";
		}
	}
    echo $str;
?>