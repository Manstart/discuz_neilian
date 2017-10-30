<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF
DROP TABLE IF EXISTS `pre_xngs_jkt_area`;
DROP TABLE IF EXISTS `pre_xngs_jkt_examlb`;
DROP TABLE IF EXISTS `pre_xngs_jkt_global`;
DROP TABLE IF EXISTS `pre_xngs_jkt_kscode`;
DROP TABLE IF EXISTS `pre_xngs_jkt_question`;
DROP TABLE IF EXISTS `pre_xngs_jkt_questionitem`;
DROP TABLE IF EXISTS `pre_xngs_jkt_questiontype`;
DROP TABLE IF EXISTS `pre_xngs_jkt_record`;
DROP TABLE IF EXISTS `pre_xngs_jkt_record_detail`;
DROP TABLE IF EXISTS `pre_xngs_jkt_school`;
DROP TABLE IF EXISTS `pre_xngs_jkt_section`;
EOF;


runquery($sql);

$finish = TRUE;

?>