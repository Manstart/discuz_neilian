<?php
class xngs_jkt{
  function generatecode( $length = 4 ) {  
	// 密码字符集，可任意添加你需要的字符  
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';  
	$password ='';
	for ( $i = 0; $i < $length; $i++ )  
	{  
	// 这里提供两种字符获取方式  
	// 第一种是使用 substr 截取$chars中的任意一位字符；  
	// 第二种是取字符数组 $chars 的任意元素  
	// $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);  
	$password .= $chars[ mt_rand(0, strlen($chars) - 1) ];  
	}  
	return $password;  
  }
  
  function updateexpstate(){
	DB::query("update ".DB::table('xngs_jkt:_kscode')." set exp=1 where expdate<'".date('Y-m-d')."'");  	
  }
  
  function delkscode() {  //删除已经过期未使用
  	DB::query("delete from ".DB::table('xngs_jkt:_kscode')." where exp=1 and used=0");
  }
}
?>