<?php
# @PAOCMS & PAOPHP
# @Author:  Wasing.tao (��֮11) 
# @Contact: admin@paophp.com;
# @Package: PAOPHP Captcha;
# @Support: http://bbs.paophp.com/thread-41-1-1.html
# @Copyright: (c) 2014 Paophp.com All rights reserved.
# @Description: The Captcha Style Copyright by Paocms
# @��ӭ���롾������PHP����Ⱥ��: 5579345 (�㼯�߶�PHP��ţ��������)
# @����˵����ʹ�÷����뿴��bbs.paophp.com;

session_start();
require_once('./Captcha.class.php');
$captcha = new Captcha();
$captcha->width = 90;
$captcha->height = 28;
$captcha->Generate();