<?php /* Smarty version Smarty-3.1.11, created on 2016-06-15 15:07:47
         compiled from "..\template\modules\system\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:135965760fec3bcbae1-31658132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf6efbfc89beea86a896652da9252d7425a6d847' => 
    array (
      0 => '..\\template\\modules\\system\\login.tpl',
      1 => 1457923927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '135965760fec3bcbae1-31658132',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5760fec3d275b7_72598339',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5760fec3d275b7_72598339')) {function content_5760fec3d275b7_72598339($_smarty_tpl) {?><!DOCTYPE html>
<HTML class="login">
    <HEAD>
        <META content="IE=11.0000" http-equiv="X-UA-Compatible">
 
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon" />
<TITLE><?php echo L("集群通运营管理平台");?>
</TITLE> 
<STYLE>
    .none{
        display: none;
    }
    .tips{
    width: 100%;
    position: absolute;
    top: 25px;
    z-index: 5;
    text-align: center;
}
.tips > span{
    margin: 0 auto;
    background: rgb(168, 58, 57);
    color: #FFF;
    padding: 10px 15px;
    display: inline-block;
}
a.lock,a.lock:hover{
           cursor: not-allowed;
       }
.phcolor{ color:#ccc;}
body{
	background: #ebebeb;
	font-family: "Helvetica Neue","Hiragino Sans GB","Microsoft YaHei","\9ED1\4F53",Arial,sans-serif;
	color: #222;
	font-size: 12px;
}
*{
    padding: 0px;margin: 0px;
}
.top_div{
	background: #EBEBEB;
	width: 100%;
	height: 400px;
}
.ipt{
	border: 1px solid #d3d3d3;
	padding: 10px 10px;
	width: 290px;
	border-radius: 4px;
	padding-left: 35px;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
	-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s
}
.ipt:focus{
	border-color: #66afe9;
	outline: 0;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
	box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6)
}
.u_logo{
	background: url("images/username.png") no-repeat;
	padding: 10px 10px;
	position: absolute;
	top: 73px;
	left: 70px;

}
.p_logo{
	background: url("images/password.png") no-repeat;
	padding: 10px 10px;
	position: absolute;
	top: 12px;
	left: 70px;
}
a{
	text-decoration: none;
}
.tou{
	background: url("images/tou.png") no-repeat;
	width: 97px;
	height: 92px;
	position: absolute;
	top: -87px;
	left: 90px;
}
.left_hand{
	background: url("images/left_hand.png") no-repeat;
	width: 32px;
	height: 37px;
	position: absolute;
	top: -38px;
	left: 100px;
}
.right_hand{
	background: url("images/right_hand.png") no-repeat;
	width: 32px;
	height: 37px;
	position: absolute;
	top: -38px;
	right: -14px;
}
.initial_left_hand{
	background: url("images/hand.png") no-repeat;
	width: 30px;
	height: 20px;
	position: absolute;
	top: -12px;
	left: 50px;
}
.initial_right_hand{
	background: url("images/hand.png") no-repeat;
	width: 30px;
	height: 20px;
	position: absolute;
	top: -12px;
	right: -62px;
}
.left_handing{
	background: url("images/left-handing.png") no-repeat;
	width: 30px;
	height: 20px;
	position: absolute;
	top: -24px;
	left: 89px;
}
.right_handinging{
	background: url("images/right_handing.png") no-repeat;
	width: 30px;
	height: 20px;
	position: absolute;
	top: -21px;
	left: 160px;

}
div.logincontent{

        width: 100%;height: 100%;
        position: relative;
        top: 0;
        z-index: 100;
        text-align: center;
    }
._GQT_icon_logo_1x120_en_png{
    background-image: url("images/GQT_icon_logo_1x120_en.png")!important;
}
._GQT_icon_logo_1x120_png{
    background-image: url("images/GQT_icon_logo_1x120.png")!important;
}
section nav{
	display: inline-block;
	height: 34px;
	width: 150px;
	/*background: url("img/base/home_img_03.png");*/
	background: url("images/GQT_icon_logo_1x120.png") no-repeat 10px 10px;
	background-size: 120px auto;
	height: 70px;
}
section.ad{
    position: absolute;
    top: 30px;
    left: 30px;
}
section h1{
 font-size: 36px;
}
div.lang{
    position: absolute;
    background: #DDD;
    right: 5px;
    padding: 4px 5px;
    border-radius:  0 0px 2px 2px;
    z-index: 10;
}
div.lang a{
    cursor: pointer;
}
div.lang a:hover{
    text-decoration: underline;
}
</STYLE>
     

<META name="GENERATOR" content="MSHTML 11.00.9600.17496"></HEAD> 
<body class="lang_<?php echo $_COOKIE['lang'];?>
 none_select">
    <div class="nosuper none"></div>
 <div class="login_content">
            <div class="lang">
                <a class="lang" data="cn_ZH">中文版</a>
                <span class='sep'>|</span>
                <a class="lang" data="en_US">English</a>
                <span class='sep'>|</span>
                <a class="lang" data="zh_TW">繁體中文</a>
            </div>
            <div class="tips animated <?php if ($_smarty_tpl->tpl_vars['msg']->value==''){?>none<?php }?>"><span><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</span></div>
	<form name="login" id="login1" action="?m=login_check" method="post">
                                    <DIV class="top_div"></DIV>
		<DIV style="background: rgb(255, 255, 255); margin: -100px auto auto; border: 1px solid rgb(231, 231, 231); border-image: none; width: 700px; height: 250px; text-align: center;">
			
                                                    <div class="logincontent" style="float:left;width: 250px; height: 250px;">
			    <section class="ad">
				    <nav  class="<?php if ($_COOKIE['lang']=='en_US'){?>_GQT_icon_logo_1x120_en_png<?php }else{ ?>_GQT_icon_logo_1x120_png<?php }?>">
				        <a></a>
				    </nav>
				    <h1><?php echo L("运营管理平台");?>
</h1>
				</section>
			</div>
                                
			<div style="float:left;width: 450px; height: 250px;">
                            <DIV style="width: 165px; height: 96px; position: absolute;" class="none">
					<DIV class="tou"></DIV>
					<DIV class="initial_left_hand" id="left_hand"></DIV>
					<DIV class="initial_right_hand" id="right_hand"></DIV>
				</DIV>
				<P style="padding: 60px 0px 10px; position: relative;">
					<SPAN class="u_logo"></SPAN>         
					<input class="ipt autosend" type="text" name="username" autocomplete="off" placeholder="<?php echo L("输入帐号");?>
" value="" /> 
				</P>
				<P style="position: relative;">
					<SPAN class="p_logo"></SPAN>         
					<input class="ipt autosend" id="password" name="password" autocomplete="off" type="password" placeholder="<?php echo L("输入密码");?>
" value="" />   
				</P>
				<!--  -->
				<DIV style="height: 50px; line-height: 50px; margin-top: 30px; border-top-color: rgb(231, 231, 231); border-top-width: 0px; border-top-style: solid;">
					<P style="margin: 0px 35px 20px 45px;">
						<!-- <SPAN style="float: left;">
							<A style="color: rgb(204, 204, 204);" href="#">忘记密码?</A>
						</SPAN> -->
				       	<SPAN style="">
				       		<!-- <A style="color: rgb(204, 204, 204); margin-right: 10px;" href="#">注册</A> --> 
                                                <a class="submit login button" style="background: rgb(168, 58, 57); padding: 9px 40px; border-radius: 4px; border: 1px solid rgb(168, 58, 57); border-image: none; color: rgb(255, 255, 255); font-size: 16px;font-weight: bold;" ><?php echo L("登录");?>
</a>
				       </SPAN>         
				   	</P>
				</DIV>
			</div>
		</DIV>
	</form>
	</div>
           <br />
	   	
  <div class='bkimg animated fadeIn'></div>
  <?php echo scriptmodule('login');?>

 <SCRIPT src="layer/layer.js" type="text/javascript"></SCRIPT>
<script src="script/com.js"></script>
<SCRIPT type="text/javascript">
$(function(){
    //得到焦点
    $("#password").focus(function(){
            $("#left_hand").animate({
                    left: "100",
                    top: " -38"
            },{
                step: function(){
                    if(parseInt($("#left_hand").css("left"))>90){
                            $("#left_hand").attr("class","left_hand");
                    }
                }
        }, 2000);
            $("#right_hand").animate({
                    right: "-14",
                    top: "-38px"
            },{
                    step: function(){
                        if(parseInt($("#right_hand").css("right"))> -20){
                                $("#right_hand").attr("class","right_hand");
                        }
                }
            }, 2000);
    });
    //失去焦点
    $("#password").blur(function(){
            $("#left_hand").attr("class","initial_left_hand");
            $("#left_hand").attr("style","left:50px;top:-12px;");
            $("#right_hand").attr("class","initial_right_hand");
            $("#right_hand").attr("style","right:-62px;top:-12px");
    });
});
</SCRIPT>
 
</body>
</html>
<?php }} ?>