<?php
class xngs_jkt{
  function generatecode( $length = 4 ) {  
	// �����ַ������������������Ҫ���ַ�  
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';  
	$password ='';
	for ( $i = 0; $i < $length; $i++ )  
	{  
	// �����ṩ�����ַ���ȡ��ʽ  
	// ��һ����ʹ�� substr ��ȡ$chars�е�����һλ�ַ���  
	// �ڶ�����ȡ�ַ����� $chars ������Ԫ��  
	// $password .= substr($chars, mt_rand(0, strlen($chars) �C 1), 1);  
	$password .= $chars[ mt_rand(0, strlen($chars) - 1) ];  
	}  
	return $password;  
  }
  
  function updateexpstate(){
	DB::query("update ".DB::table('xngs_jkt:_kscode')." set exp=1 where expdate<'".date('Y-m-d')."'");  	
  }
  
  function delkscode() {  //ɾ���Ѿ�����δʹ��
  	DB::query("delete from ".DB::table('xngs_jkt:_kscode')." where exp=1 and used=0");
  }
}
?>