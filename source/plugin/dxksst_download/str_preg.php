<?
function str_preg($str){
	$ar=str_split($str);
	$tn="$^*()+={}[]|/:<>.?'\"";
	$tn=str_split($tn);
	$re="/";
	foreach($ar as $k=>$v){
	 if(in_array($v,$tn)){$v="\\".$v;}
	 $re.=$v;}
	 $re=$re."/";
	 return $re;
	}
?>	