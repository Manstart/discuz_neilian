<?php
/**
 * 		版权：大学考试试题
 * 		官网：www.dxksst.com
 *       QQ:2811931192
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_dxksst_download {} 
class plugin_dxksst_download_forum extends plugin_dxksst_download{	
 function viewthread_posttop_output(){  //Function
 global $_G,$postlist;
 $dxksst = $_G['cache']['plugin']['dxksst_download'];
 $dxksst_group=$dxksst['group'];
 if($_G['fid']!=$dxksst_group)return array();
  $dxksst_user=$dxksst['user'];
 if($_G['groupid']!=$dxksst_user)return array();
  require_once libfile('str_preg','plugin/dxksst_download');
 //*****************************************************Search hide attach
if($_G['uid']){//need uid 
$hideattach=array(); 
foreach($postlist as $id => $post){   //Each Post
if($post['position']==1){
$query = DB::query("SELECT message FROM ".DB::table('forum_post').' where pid='.$post['pid']);
$mood = DB::fetch($query);$message=$mood['message'];
$num=preg_match_all("/\[hide\].*?\[\/hide\]/i",$message,$match);
$str='<!--DaXueKaoShiShiTi www.dxksst.com-->';
if($num!=0){//num
$jstr='<script type="text/javascript">function dxksst_attach(aid){
var time=1000;	
var o=setInterval(function(){var s=document.getElementById("attach_"+aid);
if(s){var attach_a=s.childNodes;attnum=attach_a.length;for(num=0;num<attnum;num++){if((attach_a[num].nodeName)=="A")
{hide_a=attach_a[num];break;}};var d=document.getElementById("dxksst_attach_"+aid);
hide_a.href=d.href;hide_a.removeAttribute("onclick");window.clearInterval(o);}},time);}';
	foreach($match[0] as $k=>$v){//hide match
		$snum=preg_match_all("/\[attach\]\d*?\[\/attach\]/i",$v,$smatch);
		if($snum==0)continue;
		foreach($smatch[0] as $sk=>$sv){//hide-attch
			$aid=explode(']',$sv);
			$aid=explode('[',$aid[1]);
			$aid=(int)$aid[0];
			$attachment=$post['attachments'][$aid];
			$inf="attachment".$is_archive."|".packaids($attachment)."|".$attachment["ext"]."|".$attachment["filesize"];
            $inf=$inf."|".$attachment["downloads"]."|".urlencode($attachment["filename"]);
	        $pay_href="";$need_pay=0;
			if($attachment["price"]&&!$attachment["payed"]){  // Need Pay Attach 
            $need_pay=1;
            $pay_href="forum.php?mod=misc&action=attachpay&aid=".$attachment["aid"]."&tid=".$attachment["tid"];
            }//END Need Pay Attach
            $inf=$inf."|".$need_pay."|".$pay_href;
            $inf=base64_encode($inf);
			$Myhref='plugin.php?id=dxksst_download:download&inf='.$inf;
			$str=$str.'<a id="dxksst_attach_'.$aid.'" style="visibility:hidden;" href="'.$Myhref.'"></a>';
			$jstr=$jstr.'dxksst_attach('.$aid.');';
			}//End hide-attch
		}//End hide match	
$jstr=$jstr.'</script>';		
	}//End num
$str=$str.'<!--DaXueKaoShiShiTi www.dxksst.com-->';	
$hideattach[]=$str.$jstr;
}
 }//END Each Post
 }//End need uid
//*****************************************************End Search hide attach 
foreach($postlist as $id => $post){   //Each Post
//*****************************************************NetDisk attach
//<a href="http://www.kuaipan.cn/file/id_129589445472026631.htm?f=127.0.0.1" target="_blank">审帖.png</a>
if($dxksst['netdisk']){//JinShan
require_once libfile('netdisk','plugin/dxksst_download');
$postlist[$id]["message"]=jinshan($postlist[$id]["message"]);
$postlist[$id]["message"]=HuaWei($postlist[$id]["message"]);	
	}//End JinShan


//*****************************************************End NetDisk attach
//*****************************************************Free post attch
$num=preg_match_all("/\"forum.php\?mod\=attachment.*\" /U",$postlist[$id]["message"],$match);
if($num!=0){//Post Attach
 foreach($match[0] as $match_id =>$href){ //Each Post Attach
	 $mid=explode("aid=",$href);
	 $aidcode=explode('"',$mid[1]);
	 $aidcode=$aidcode[0];
	 $aid=base64_decode($aidcode);
	 $aid=explode("|",$aid);
	 $aid=$aid[0];
  foreach($post["attachments"] as $a_id => $attachment){//Search Attach Information
    $a_id=$attachment["aid"];
	if($a_id==$aid){
    $inf="attachment".$is_archive."|".$aidcode."|".$attachment["ext"]."|".$attachment["filesize"];
    $inf=$inf."|".$attachment["downloads"]."|".urlencode($attachment["filename"]);
	$pay_href="";$need_pay=0;
    $inf=$inf."|".$need_pay."|".$pay_href;
    $inf=base64_encode($inf);
	break;
		 }
	 
	 }//END Search Attach Information
$Myhref='"plugin.php?id=dxksst_download:download&inf='.$inf.'"';
$postlist[$id]["message"]=preg_replace("/\"forum.php\?mod\=attachment.*?aid\=".$aidcode."\" /",$Myhref,$postlist[$id]["message"]);//Replace Href
 }//End Each Post Attach
 
}//End Post Attach
//End free post attch
//***********************************************************Need pay post attch
$num=preg_match_all("/\"forum.php\?mod\=misc.*?action=attachpay.*?\" /",$postlist[$id]["message"],$match);
if($num!=0){//Post Attach
 foreach($match[0] as $match_id =>$href){ //Each Post Attach
	 $mid=explode("aid=",$href);
	 $aid=explode('&',$mid[1]);
	 $aid=$aid[0];
  foreach($post["attachments"] as $a_id => $attachment){//Search Attach Information
	if($attachment["aid"]==trim($aid)){
    $inf="attachment".$is_archive."|".$aidcode."|".$attachment["ext"]."|".$attachment["filesize"];
    $inf=$inf."|".$attachment["downloads"]."|".urlencode($attachment["filename"]);
	$need_pay=1; $pay_href="forum.php?mod=misc&action=attachpay&aid=".$attachment["aid"]."&tid=".$attachment["tid"]."";
    $inf=$inf."|".$need_pay."|".$pay_href;
    $inf=base64_encode($inf);
	break;
		 }
	 
	 }//END Search Attach Information
$Myhref='"plugin.php?id=dxksst_download:download&inf='.$inf.'">';
$postlist[$id]["message"]=preg_replace("/\"forum.php\?mod\=misc.*?action=attachpay.*?aid=".$aid.".*\"\>/",$Myhref,$postlist[$id]["message"]);//Replace Href
 }//End Each Post Attach
}//End Post Attach
//**************************************************End need pay post attch
if(!empty($post["attachments"])){//Common Attach
foreach($post["attachments"] as $a_id => $attachment){//Each attach
	$inf="attachment".$is_archive."|".packaids($attachment)."|".$attachment["ext"]."|".$attachment["filesize"];
    $inf=$inf."|".$attachment["downloads"]."|".urlencode($attachment["filename"]);
    $need_pay=0;
if($attachment["price"]&&!$attachment["payed"]){  // Need Pay Attach 
    $need_pay=1;
    $postlist[$id]["attachments"][$a_id]["payed"]=1;
    $pay_href="forum.php?mod=misc&action=attachpay&aid=".$attachment["aid"]."&tid=".$attachment["tid"]."";
}//END Need Pay Attach
    $inf=$inf."|".$need_pay."|".$pay_href;
    $inf=base64_encode($inf);
	$str=<<<EOT
<script type="text/javascript">
  var dxksst_a=document.getElementsByTagName('a');
  var num=dxksst_a.length-1;
  var dxksst_b=dxksst_a[num];
  dxksst_b.href="plugin.php?id=dxksst_download:download&inf=$inf";

</script>
EOT;
?><?php	 
$postlist[$id]["attachments"][$a_id]["filename"]=$postlist[$id]["attachments"][$a_id]["filename"].$str; 
 }//END Each Attach
}//END Common Attach
 }//END Each Post
return $hideattach;
}//END Function
}
?>
