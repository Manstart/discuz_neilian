<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('personal_list');?><?php include template('common/header'); ?><style>
.list_style{padding-left: 16px;}
</style>
<div id="ct" class="wp cl">
        <div class="bm">
        <?php if($all_list) { ?> 

            <?php if(is_array($all_list)) foreach($all_list as $per_app) { ?>               <a class="list_style"><?php echo $per_app['personalApp_name'];?></a>于<?php echo $per_app['personalApp_date'];?>申请个人使用<?php echo $per_app['personalApp_reason'];?>，归还日期为<?php echo $per_app['personalApp_return'];?><hr>
            <?php } ?>
            <a href="{<?php echo $_SERVER['PHP_SELF'];?>.?page=(<?php echo $page;?>-1)}">上一页</a>
            <a href="{<?php echo $_SERVER['PHP_SELF'];?>.?page=(<?php echo $page;?>+1)}">下一页</a>
        <?php } else { ?>
            <p class="emp">暂时没有记录...</p>
        <?php } ?>
        </div>      
</div><?php include template('common/footer'); ?>