<?php
function jinshan($str){//JinShan
$num=preg_match_all("/\<a href\=\"http\:\/\/www\.kuaipan\.cn\/file\/id_\d*?.htm.*?\<\/a\>.*?\)/i",$str,$match);	
if($num!=0){
 foreach($match[0] as $match_id => $a){ 
 $href=explode('href="',$a);
 $href=explode('"',$href[1]);
 $href=$href[0];
 $title=explode('>',$a);
 $title=explode('<',$title[1]);
 $title=$title[0];
 $whole=explode('.',$title);
 $title=$whole[0];
 $ext=$whole[1];
 $size=explode('(',$a);
 $size=explode(')',$size[1]);
 $size=$size[0];
    $inf="attachment".$is_archive."|".$aidcode."|".$ext."|".$size;
    $inf=$inf."|".""."|".urlencode($title);
	$pay_href=$href;$need_pay=1;
    $inf=$inf."|".$need_pay."|".$pay_href;
    $inf=base64_encode($inf);
$Myhref='plugin.php?id=dxksst_download:download&inf='.$inf;
$str=preg_replace(str_preg($href),$Myhref,$str);//Replace Href 
 }	
	}	
return $str;	
}//End JinShan
function HuaWei($str){//HuaWei
$num=preg_match_all("/\<a href\=\"http\:\/\/dl\.vmall\.com\/.*?\<\/a\>/i",$str,$match);	
if($num!=0){
 foreach($match[0] as $match_id => $a){ 
 $href=explode('href="',$a);
 $href=explode('"',$href[1]);
 $href=$href[0];
 $title=explode('>',$a);
 $title=explode('<',$title[1]);
 $title=$title[0];
 $whole=explode('.',$title);
 $title=$whole[0];
 $ext=$whole[1];
    $inf="attachment".$is_archive."|".$aidcode."|".$ext."|".$size;
    $inf=$inf."|".""."|".urlencode($title);
	$pay_href=$href;$need_pay=1;
    $inf=$inf."|".$need_pay."|".$pay_href;
    $inf=base64_encode($inf);
$Myhref='plugin.php?id=dxksst_download:download&inf='.$inf;
$str=preg_replace(str_preg($href),$Myhref,$str);//Replace Href 
 }	
	}	
return $str;	
}//End HuaWei
?>   