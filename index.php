<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>泡PHP验证码PAOPHP.Captcha v1 - PHP源码分享、发布 -  泡PHP - 性感时尚PHP编程生活社区</title>
<meta name="keywords" content="验证码,PHP源码分享、发布,泡PHP,php,php论坛,php编程,php学习,php源码,php大牛,php招聘,php求职,php生活" />
<meta name="description" content="泡PHP验证码类PAOPHP.Captcha v1,泡PHP验证码类PAOPHP.Captcha v1 ,泡PHP" />
<style type="text/css">
h3{border-bottom:1px solid #ccc;color: #bbb}
.fr{float: right;}
img{vertical-align: middle;}
.form{padding-left: 140px;}
.red{color: #ff0000;font-size: 16px;font-weight: bold;}
.des{padding-top: 50px; padding-left: 110px;color: #bbb;font-size: 14px;line-height: 30px;}
</style>
</head>
<!--
# @PAOCMS & PAOPHP
# @Author:  Wasing.tao (陶之11) 
# @Contact: admin@paophp.com;
# @Package: PAOPHP Captcha;
# @Support: http://bbs.paophp.com/thread-41-1-1.html
# @Copyright: (c) 2014 Paophp.com All rights reserved.
# @Description: The Captcha Style Copyright by Paocms
# @欢迎加入【珠三角PHP联盟群】: 5579345 (汇集高端PHP大牛技术交流)
# @参数说明及使用方法请看：bbs.paophp.com;
-->
<body>
<h3>泡PHP验证码PAOPHP.Captcha v1<span class="fr">paophp.com</span></h3>
<div class="form">

<?php 
session_start();
require_once('Captcha.class.php');

if(isset($_POST['captcha'])){
	if(Captcha::Verify($_POST['captcha'])){
		echo "<script>alert('验证成功!');</script>";
	}else{
		echo "<script>alert('验证失败!');</script>";
	}
}
?>
<form name="paophp" method="POST">
  <label>验证码: </label>
  <input type="text" name="captcha" autocomplete="off" style="width:100px;" />
  <span id="captcha"></span>
  <input type="submit" value="提交" />
</form>  
</div>
<div class="des">
	<ul>
		<li>泡PHP验证码可以随机字体。</li>
		<li>并由用户字定义字符串大小、宽度、高度。</li>
		<li>泡PHP验证码已集成验证方法。无须重写，简化操作</li>
		<li>欢迎加入【珠三角PHP联盟群】：<a class="red" href="http://url.cn/QB0KaG">5579345</a><span>(汇集高端PHP大牛技术交流)</span></li>
		<li>参数说明及使用方法请看：<a href="http://bbs.paophp.com/thread-41-1-1.html">http://bbs.paophp.com/thread-41-1-1.html</a></li>
	</ul>
</div>
<script type="text/javascript">
window.onload=function(){
 document.getElementById('captcha').innerHTML='<img alt="点击刷新验证码" src="captcha.php" style="cursor:pointer" onclick="this.src=this.src+\'?\'" />';
}
</script>
</body>
</html>