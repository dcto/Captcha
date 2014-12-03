<?php
# @PAOCMS & PAOPHP
# @Author:  Wasing.tao (陶之11) 
# @Contact: admin@paophp.com;
# @Package: PAOPHP Captcha;
# @Support: http://bbs.paophp.com/thread-41-1-1.html
# @Copyright: (c) 2014 Paophp.com All rights reserved.
# @Description: The Captcha Style Copyright by Paocms
# @欢迎加入【珠三角PHP联盟群】: 5579345 (汇集高端PHP大牛技术交流)
# @参数说明及使用方法请看：bbs.paophp.com;

session_start();
require_once('./Captcha.class.php');
$captcha = new Captcha();
$captcha->width = 90;
$captcha->height = 28;
$captcha->Generate();