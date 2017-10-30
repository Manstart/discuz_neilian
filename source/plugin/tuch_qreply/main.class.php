<?php
	if(!defined('IN_DISCUZ')){
		exit('Access Denied');
	}
	class plugin_tuch_qreply{
		function __construct(){
			global $_G;
			$this->G = $_G;
		}
		function _permission(){
			$forums = unserialize($this->G['cache']['plugin']['tuch_qreply']['allow_forums']);
			$groups = unserialize($this->G['cache']['plugin']['tuch_qreply']['allow_group']);
			if(in_array($this->G['groupid'], $groups) && (in_array($this->G['fid'], $forums) || $this->G['forum']['status'] == '3')){
				return true;
			}
			return false;
		}
		function _replyelement(){
			$qreplyArr = explode("\r\n", $this->G['cache']['plugin']['tuch_qreply']['reply_content']);
			$option_str = "<option value='0'>".lang('plugin/tuch_qreply', 'choosecontent')."</option>";
			$tip = lang('plugin/tuch_qreply', 'qreply');
			for($i = 0; $i < count($qreplyArr); $i++){
				if(trim($qreplyArr[$i]) != ''){
					$option_str .= "<option>".dhtmlspecialchars($qreplyArr[$i], ENT_QUOTES)."</option>";
				}
			}
			$element = <<<EOF
				<script type='text/javascript'>
					function fillreplyarea(){
						var content = $('tuch_qreply').options[$('tuch_qreply').options.selectedIndex].text;
						if($('tuch_qreply').options[$('tuch_qreply').options.selectedIndex].value != 0){
							seditor_insertunit('fastpost', content);
						}
					}
				</script>
				$tip<select id="tuch_qreply" onchange="fillreplyarea()">$option_str</select>
EOF;
			return $element;
		}
	}
	class plugin_tuch_qreply_group extends plugin_tuch_qreply{
		function viewthread_fastpost_content(){
			if($this->G['cache']['plugin']['tuch_qreply']['element_place'] == '1' && $this->_permission()){
				return $this->_replyelement();
			}
		}
		function forumdisplay_fastpost_content(){
			if($this->G['cache']['plugin']['tuch_qreply']['element_place'] == '1' && $this->_permission()){
				//return $this->_replyelement();
			}
		}
		function viewthread_fastpost_func_extra(){
			if($this->G['cache']['plugin']['tuch_qreply']['element_place'] == '2' && $this->_permission()){
				return $this->_replyelement();
			}
		}
		function forumdisplay_fastpost_func_extra(){
			if($this->G['cache']['plugin']['tuch_qreply']['element_place'] == '2' && $this->_permission()){
				//return $this->_replyelement();
			}
		}
	}
	class plugin_tuch_qreply_forum extends plugin_tuch_qreply{
		function viewthread_fastpost_content(){
			if($this->G['cache']['plugin']['tuch_qreply']['element_place'] == '1' && $this->_permission()){
				return $this->_replyelement();
			}
		}
		function viewthread_fastpost_func_extra(){
			if($this->G['cache']['plugin']['tuch_qreply']['element_place'] == '2' && $this->_permission()){
				return $this->_replyelement();
			}
		}
	}
?>