<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('funds_list');?><?php include template('common/header'); ?><style>
.list_style{padding-left: 16px;}
</style>
<div id="ct" class="wp cl">
        <div class="bm">
        <?php if($list) { ?> 
            <?php if(is_array($list)) foreach($list as $funds) { ?>               <a class="list_style"><?php echo $funds['app_name'];?></a>于<?php echo $funds['app_date'];?>申请<?php echo $funds['app_money'];?>元资金，理由是<?php echo $funds['app_reason'];?><hr>
        
            <?php } ?>
        <?php echo $multi;?>
        <?php } else { ?>
            <p class="emp">暂时没有记录...</p>
        <?php } ?>
        </div>      
</div><?php include template('common/footer'); ?>