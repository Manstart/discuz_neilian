<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('exam_check');?><?php include template('common/header'); ?> 
<style type="text/css">
    .divForm{border: 2px solid #CDCDC1;width: 600px;height:auto;margin: 10px auto;text-align: center;font-size: 18px;}
    .wri_t{font-size: 24px;text-align: center;}
    .topic{width:335px;}
    .space{margin-left: 65px;}
    .space_d{margin-left: 36px;}
    .answerA{width:324px;}
    .answerB,.answerC,.answerD{width:324px;}
    input{margin-bottom: 15px;}
    .btn{background-color: #555555;color:#fff;border-radius: 12px;padding:10px;}
</style>
    <div class="divForm">11
    <?php if($list) { ?>
        <?php if(is_array($list)) foreach($list as $exam) { ?>        <form class="divForm" action="" method="post" enctype="multi/form-data" >
            <div class="wri_t">审核<?php echo $_G['username'];?>的考题</div><br>
            您所在的位置：<?php echo $exam['direction'];?>><?php echo $exam['mold'];?>><?php echo $exam['difficulty'];?><br>
            题目：<?php echo $exam['topic'];?><br>
            选项：A<?php echo $exam['optionA'];?><br>
            B<?php echo $exam['optionB'];?><br>
            C<?php echo $exam['optionC'];?><br>
            D<?php echo $exam['optionD'];?><br>
            答案：<?php echo $exam['answer'];?><br>
            解析：<?php echo $exam['explains'];?><br>
        <input type="submit" value="通过审核" class="btn" onclick="javascript:this.form.action='exam.php?mod=index&action=save_exam'"/>
        <input type="submit" value="拒绝录入" class="btn" onclick="javascript:this.form.action='exam.php?mod=index&action=del_exam'"/>
       
        </form>
        <?php } ?>
    <?php } else { ?>
        <p class="emp">暂时没有待审核的考题...</p>
    <?php } ?>
          
    </div><?php include template('common/footer'); ?>