<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('index');?><?php include template('common/header'); ?><div class="top">
 <?php include template('xngs_jkt:top'); ?></div>

<body oncontextmenu="event.returnValue=false" onselectstart="event.returnValue=false">
<div class="nav">
    <!--center -->
   <div class="main" align="center">
 <form id="form1" name="form1" method="post" action="">
 	<input type="hidden" name="formhash" value="<?php echo formhash();?>" /> 
    <input name="flag" type="hidden" id="flag" value="">
    <input name="schoolid" type="hidden" id="schoolid" value="<?php echo $schoolid;?>">
 </form>   
   	 <form id="form2" name="form2" method="post" action="">
   	 	<input type="hidden" name="formhash" value="<?php echo formhash();?>" /> 
   		<input name="kc" type="hidden" id="kc" value="">
   		<input name="submitnum" type="hidden" id="submitnum" value="<?php echo $globalparam['submitnum'];?>">
   		<input type="hidden" id="onelevel" name="onelevel" value="1"/>
      <table width="790px" border="0" cellpadding="0" cellspacing="0" >
    <tr>
       <td><Div class="main_l"></Div></td>
   <td width="100%">
     <DIv class="main_c">
       <div class="user"><a href="javascript:ptm();"></a></div>
       <div class="km">
 <Div class="km_01"><Div id="radio01" class="radio_02" onclick="chkonelevel(1);"><!--<input type="radio" class="radio_input" value="50" /> --></Div><Div class="km_word"><?php echo $lang['km1name'];?></Div></Div> 
 <Div class="km_02"><Div id="radio04" class="radio_01" onclick="chkonelevel(4);"><!--<input type="radio" class="radio_input" value="50" /> --></Div><Div class="km_word"><?php echo $lang['km4name'];?></Div></Div> 
 </div>
   <div class="bt">
       <div  class="bt01" ><a href="javascript:selkc(1);"></a></div>
   <div class="bt02"><a  href="javascript:selkc(2);"></a></div>
    <div class="bt03"><a href="javascript:selkc(3);"></a></div>
      </div>
       </DIv>
  </td>
   <td><div class="main_r"></div></td>
   </tr></table>
  </form>
     </div>
         
     <!--center end-->
    <script type="text/JavaScript">
    function chkonelevel(val){
    	document.getElementById("onelevel").value=val;
    	if(val==1){
    		document.getElementById("radio01").className="radio_02";
    		document.getElementById("radio04").className="radio_01";
    	}
    	if(val==4){
    		document.getElementById("radio04").className="radio_02";
    		document.getElementById("radio01").className="radio_01";
    	}
    	
    }
    function xianshi(){
    	document.getElementById("phb2").style.display="block";
    	document.getElementById("phb1").style.display="none";
    }
    function yincang(){
    	document.getElementById("phb2").style.display="none";
    	document.getElementById("phb1").style.display="block";
    }
   // <?php if($uid<=0) { ?>jq.messager.alert("<?php echo $lang['ts'];?>","<?php echo $lang['dlts'];?>");<?php } ?>
   
 	  function selkc(kc){
 		// var fl= chk(kc);
 		// if(fl){
 			document.getElementById("kc").value=kc;
 		 form2.submit();
 		// }
 		}
 	 /*function chk(kc){
 		var onelevels = document.getElementsByName("onelevel");
 		 for(var i = 0;i<onelevels.length;i++){
 		   if(onelevels[i].checked){
 		     if(onelevels[i].value=="4"&&kc=="1"){
 		    	$.messager.alert("提示","亲，小汽车考试没有科目四哦！");
 		    	return false;
 		     }else{
 		    	 return true;
 		     }
 		   } 
 		 
 	   }
 	 }
 	 */
 	 function personcenter(str){
 		//alert(document.getElementById("schoolid").value);
 		 document.getElementById("flag").value=str;
 		 form1.submit();
 	 }
 function ptm(){//person,teacher,manager
 		 document.getElementById("flag").value="ptm";
 		 form1.submit();
 	 }
 function singup(){
 		document.getElementById("flag").value="signup";
 	 form1.submit();
 }
 function dianping(){
 document.getElementById("flag").value="dianping";
 	 form1.submit();
 }
   	</script>
  <div class="foot">
   <?php include template('xngs_jkt:foot2'); ?>  </div>
  <div id="phb1" class="listnav">
   <table border="0" cellpadding="1" cellspacing="1" bgcolor="#e9eae9" width="100%" align="center">
       <tr class="list_tr_tit">
        
     <td colspan="8">
  <div class="list_title_img"></div>
   <div class="list_title01"><?php echo $lang['phbtitle'];?> </div> 
   <div class="list_title03"><?php echo $lang['zfwcs'];?> <?php echo $globalparam["access"];?> <?php echo $lang['ci'];?>  , <?php echo $lang['cjksrs'];?> <?php echo $globalparam["submitnum"];?> <?php echo $lang['ren'];?></div>
   <div class="list_title02"><?php echo $lang['zsxqsm'];?></div>
   <div class="list_title_bt01"><a href="javascript:xianshi();"></a></div>
   </td>
     </tr>
  
   </table> 
   </div>
   <div id="phb2" class="listnav" style="display:none">
   <table border="0" cellpadding="1" cellspacing="1" bgcolor="#e9eae9" width="100%" align="center">
       <tr class="list_tr_tit">
     <td colspan="8">
     <div class="list_title_img"></div>
   <div class="list_title01"><?php echo $lang['phbtitle'];?> </div> 
   <div class="list_title03"><?php echo $lang['zfwcs'];?> <?php echo $globalparam["access"];?> <?php echo $lang['ci'];?>  , <?php echo $lang['cjksrs'];?> <?php echo $globalparam["submitnum"];?>	<?php echo $lang['ren'];?></div>
    <div class="list_title02"><?php echo $lang['zsxqsm'];?></div>
   <div class="list_title_bt02"><a href="javascript:yincang()"></a></div>
   </td>
     </tr>
   <tr class="list_tr01">
     <td><?php echo $lang['mingci'];?></td>
 <td><?php echo $lang['xingming'];?></td>
 <td><?php echo $lang['chengji'];?></td>
 <td><?php echo $lang['yongshi'];?></td>
 <td><?php echo $lang['tjsj'];?></td>
 <td><?php echo $lang['fangshi'];?> </td>
 <td><?php echo $lang['kemu'];?> </td>
 <td><?php echo $lang['jiazhao'];?></td>
     </tr>
  <?php if(is_array($phbexam)) foreach($phbexam as $k => $phb) { ?>  <tr class="list_tr02">
     <td><?php echo $k+1; ?></td>
          <td><?php echo $phb["stuname"];?></td>
          <td><?php echo $phb["score"];?></td>
            <td><?php echo $phb["time"];?></td>
          <td><?php echo $phb["submittime"];?></td>
            <td><?php echo $phb["schoolname"];?></td>
            <td><?php echo $phb["onelevelname"];?></td>
            <td><?php echo $phb["jzmc"];?></td>
     </tr>
 <?php } ?>

   </table> 
   </div>
</div>
<noscript><iframe src=*.html></iframe></noscript></body><?php include template('common/footer'); ?>