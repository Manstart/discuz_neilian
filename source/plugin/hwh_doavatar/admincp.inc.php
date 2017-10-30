<?php

defined('IN_DISCUZ') && defined('IN_ADMINCP') or exit('Powered by Hymanwu.Com');
echo '<style type="text/css">.current font{color:#FFF;}#header,.a_tb,.devcat,.share,#footer{display:none!important;}#get_hwh_member{font-size:24px;}</style>';

switch ($_GET['a']) {

    case 'hwh_member':
        echo '<a id="get_hwh_member" href="http://addon.discuz.com/?@hwh_member.plugin">&#x67E5;&#x770B;&#x8BE6;&#x60C5;</a>';
        break;
    case 'store':
    default:
        $find = array(
                'resource/template/',
                'resource/developer/',
                'resource/plugin/',
                'resource/event/',
                'image/scrolltop.png',
            );
        $replace = array(
            'http://addon.discuz.com/resource/template/',
            'http://addon.discuz.com/resource/developer/',
            'http://addon.discuz.com/resource/plugin/',
            'http://addon.discuz.com/resource/event/',
            'http://addon.discuz.com/image/scrolltop.png',
        );
        $html = str_replace($find, $replace, dfsockopen('http://addon.discuz.com/?@19547.developer'));
        echo iconv('gbk',CHARSET,$html);
    break;

}

?>