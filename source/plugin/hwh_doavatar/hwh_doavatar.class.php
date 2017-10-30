<?php

defined('IN_DISCUZ') or exit('Powered by Hymanwu.Com');

class hwh_doavatar_common {

    protected $cfg = array();
    protected $in_mobile,$siteurl,$avatarstatus;

    function __construct() {
        global $_G;
        $this->in_mobile = defined('IN_MOBILE') ? true : false;
        $this->cfg = $_G['cache']['plugin']['hwh_doavatar'];
        $this->member = $_G['member'];
    }

    function _get_js() {
        global $ac;
        if ($this->in_mobile) {
            $open = $this->cfg['open_m'];
            $url = $this->siteurl.'plugin.php?id=hwh_member';
        } else {
            $open = $this->cfg['open'];
            $url = $this->siteurl.'home.php?mod=spacecp&ac=avatar';
        }

        if (!getcookie('hwh_doavatar_time') || $this->cfg['time']==0) {
            if ( $open && $ac!='avatar' && $this->member['uid'] && !$this->member['avatarstatus']) {
                $function = $this->in_mobile ? 'popup.open("'.$this->cfg['tip_str'].'","confirm","'.$url.'");' : 'showDialog("'.$this->cfg['tip_str'].'","confirm","",function(){window.location.href="'.$url.'";},0)';
                $js = '<script type="text/javascript">'.$function.'</script>';
                dsetcookie('hwh_doavatar_time',1,$this->cfg['time']*60);
            }
        }

        return $js;
    }

}

class plugin_hwh_doavatar extends hwh_doavatar_common {

    function __construct() {
        parent::__construct();
    }

    function global_footer(){
            $js = $this->_get_js();
            return $js;
    }

}

class mobileplugin_hwh_doavatar extends hwh_doavatar_common {

    function __construct() {
        parent::__construct();
    }

    function global_footer_mobile() {
            $js = $this->_get_js();
            return $js;
    }

}

?>