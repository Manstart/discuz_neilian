<?php
/**
 * 		版权：大学考试试题
 * 		官网：www.dxksst.com
 *       QQ:2811931192
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
global $G;
$title=$_G['cache']['plugin']['dxksst_download']['title'];
if($_G['cache']['plugin']['dxksst_download']['login'])
if(!$_G['uid']){
	$navtitle=$title;
	include_once template("diy:common/header");
	echo"<h1><font color='#F26C4F'>".lang('plugin/dxksst_download', 'login').";<font></h1>";
echo "<script type='text/javascript'>
	showWindow('please login in','member.php?mod=logging&action=login');
	</script>";
exit;	    }
$inf=$_GET['inf'];
$inf=base64_decode($inf);
$infos=explode("|",$inf);
$mod=$infos[0];
$aidencode=$infos[1];
$ext=$infos[2];
if($infos[3]!=0)
$filesize=(int)($infos[3]/1024+1)."kb";
$downloads=$infos[4];
$filename=urldecode($infos[5]);
$need_pay=$infos[6];
$pay_href=$infos[7];
$navtitle=$title;
include_once template("diy:common/header"); //头部
if($need_pay)//Need Pay
{$download_href=$pay_href;}
else{$download_href="forum.php?mod=$mod&aid=".$aidencode;}	
$dxksst = $_G['cache']['plugin']['dxksst_download'];
$downtitle=$dxksst['dtitle'];
$downinfo=$dxksst['downinfo'];
$downinfo=explode("|",$downinfo);
$ad1=$dxksst["ad1"];$ad2=$dxksst["ad2"];$ad3=$dxksst["ad3"];
echo <<<EOT
<!--DaXueKaoShiShiTi www.dxksst.com-->
<div class="dxksst">
<div style="border:1px solid #D9D9D9;margin:10px 0 5px;">
        <p align="center">$ad1</p>
        <p style=" background:#F5F5F5; border:none"><em>$downinfo[0]</em><font color="#008000">$filename</font></p>
		<p><em>$downinfo[1]</em>$ext</p>
		<p><em>$downinfo[2]</em>$filesize</p>
		<p><em>$downinfo[3]</em>$downloads</p>
		<p><em>$downinfo[4]</em> $ad2 <a href="$download_href">$downtitle</a></p>
		<p align="center">$ad3</p>
		</div>
</div>
<style type="text/css">
.dxksst em{ color:#777}
.dxksst p{ border-top:1px solid #D9D9D9; padding:3px 10px 2px 10px}
.dxksst a{color:#369;}
</style>
<!--DaXueKaoShiShiTi www.dxksst.com-->
EOT;
include_once template("diy:common/footer"); //尾部
?>