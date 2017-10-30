<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$sql = <<<EOF
CREATE TABLE `pre_dc_signin` (
  `uid` int(11) NOT NULL,
  `dateline` int(11) DEFAULT '0',
  `days` int(11) DEFAULT '0',
  `monthdays` int(11) DEFAULT '0',
  `monthcondays` int(11) DEFAULT NULL,
  `bcredit` int(11) DEFAULT '0',
  `credit` int(11) DEFAULT '0',
  `condays` int(11) DEFAULT '0',
  `username` varchar(45) DEFAULT NULL,
  `sgid` int(11) DEFAULT NULL,
  `emoticon` varchar(45) DEFAULT NULL,
  `xq` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`uid`)
);
CREATE TABLE `pre_dc_signin_emot` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `displayorder` int(11) DEFAULT '0',
  `icon` varchar(45) DEFAULT NULL,
  `count` int(11) DEFAULT '0',
  `name` varchar(20) DEFAULT NULL,
  `text` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
CREATE TABLE `pre_dc_signin_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grouptitle` varchar(45) DEFAULT NULL,
  `dayslower` int(11) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
CREATE TABLE `pre_dc_signin_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `xq` varchar(15) DEFAULT NULL,
  `say` varchar(255) DEFAULT NULL,
  `credit` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
);
EOF;
runquery($sql);
for($i=1;$i<=10;$i++){
	$data = array(
		'displayorder'=>$i,
		'icon'=>$i.'.jpg',
		'name'=>$installlang['emot'.$i][0],
		'text'=>$installlang['emot'.$i][1],
	);
	C::t('#dc_signin#dc_signin_emot')->insert($data);
}
foreach($installlang['group'] as $k=>$g){
	$data = array(
		'grouptitle'=>$g,
		'dayslower'=>$k,
	);
	C::t('#dc_signin#dc_signin_group')->insert($data);
}
$finish = TRUE;
?>