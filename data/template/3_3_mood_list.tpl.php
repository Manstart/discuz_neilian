<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('list');?>
<!--//说明: 显示公共头部模板--><?php include template('common/header'); ?><!--//说明: 开始显示留言-->
<div id="ct" class="wp cl">
    <h1 class="mt">心情墙 - <?php if($_G['uid']) { ?><a href="mood.php?mod=publish" style="color:blue;">发表心情</a><?php } ?></h1> 
    <div class="bm">
        <?php if($list) { ?>
            <!--//说明: loop 循环一个数组 相当于foreach(){}-->
            <?php if(is_array($list)) foreach($list as $mood) { ?>                <a href="home.php?mod=space&amp;uid=<?php echo $mood['uid'];?>" target="_blank"><?php echo avatar($value[authorid],small);?></a><br>
                <a href="home.php?mod=space&amp;uid=<?php echo $mood['uid'];?>" title="<?php echo $mood['username'];?>" target="_blank" class="xi2"><?php echo $mood['username'];?></a> 发表于: <?php echo $mood['dateline'];?>
                <br>
                心情: <?php echo $mood['message'];?>
                <hr>
            <?php } ?>
            <!--//说明: 显示准备好的分页链接-->
            <?php echo $multi;?>
        <?php } else { ?>
            <p class="emp">暂时没有记录...</p>
        <?php } ?>
    </div>
</div>

<!--//说明: 显示公共尾部模板--><?php include template('common/footer'); ?>