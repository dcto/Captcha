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

class Captcha{
    var $image  = null;
    var $fonts  = './Fonts/';
    var $width  = 100;
    var $height = 30;
    var $length = 4;
    var $phrase = null;
    var $string = array('A','B','C','D','E','F','H','J','K','L','M','N','P','R','S','T','U','V','W','X','Y','Z');    
    

    public function __construct()
    { 
        if (!extension_loaded("gd")) exit("Captcha Unable Load GD Library Copyright paophp.com");                
         
    }

    
    public function Phrase()
    {
        if (strlen($this->phrase) != $this->length) {
            $phrase = null;
            $rand = array_rand($this->string, $this->length);
            foreach ($rand as $index)
                $phrase .= $this->string[$index];
            $this->phrase = $phrase;
        }
        return $this->phrase;
    }     
    
    public function Generate()
    {
        $image = is_resource($this->image) ? $this->image : $this->GenerateImage();
            header("Content-type: image/png");
            imagepng($image);
            imagedestroy($image);        
    }
    
    private function CreateImage()
    {
        if (!is_resource($this->image)) {

            $this->image = imagecreatetruecolor($this->width, $this->height);
            $color1 = imagecolorallocate($this->image, mt_rand(200, 255),mt_rand(200, 255), mt_rand(150, 255));
            $color2 = imagecolorallocate($this->image, mt_rand(200, 255),mt_rand(200, 255), mt_rand(150, 255));
            $color1 = imagecolorsforindex($this->image, $color1);
            $color2 = imagecolorsforindex($this->image, $color2);
            $steps = $this->width;

            $r1 = ($color1['red'] - $color2['red']) / $steps;
            $g1 = ($color1['green'] - $color2['green']) / $steps;
            $b1 = ($color1['blue'] - $color2['blue']) / $steps;

            $x1 = 0; $y1 =& $i; $x2 = $this->width; $y2 =& $i;

            for ($i = 0; $i <= $steps; $i++) {
                $r2 = $color1['red'] - floor($i * $r1);
                $g2 = $color1['green'] - floor($i * $g1);
                $b2 = $color1['blue'] - floor($i * $b1);
                $color = imagecolorallocate($this->image, $r2, $g2, $b2);
                imageline($this->image, $x1, $y1, $x2, $y2, $color);
            }

            for ($i = 0, $count = mt_rand(10, 20); $i < $count; $i++) {
                $color = imagecolorallocatealpha($this->image, mt_rand(20, 255), mt_rand(20, 255),
                                                 mt_rand(100, 255), mt_rand(80, 120));
                imageline($this->image, mt_rand(0, $this->width), 0,
                          mt_rand(0, $this->width), $this->height, $color);
            }
        }
        return $this->image;
    }
    
    public function GenerateImage($phrase = null)
    {
        $image = $this->CreateImage();
        $phrase == null && $phrase = $this->Phrase();                      
        $fontsize = min($this->width, $this->height * 2) / (strlen($phrase));
        $spacing = (integer) ($this->width * 0.9 / strlen($phrase));
        is_dir($this->fonts) && $this->fonts = glob($this->fonts.'*.{ttf,otf}', GLOB_BRACE);  
        for ($i = 0, $strlen = strlen($phrase); $i < $strlen; $i++) {
            $font = $this->fonts[array_rand($this->fonts)];
            $color = imagecolorallocate($image, mt_rand(0, 160), mt_rand(0, 160), mt_rand(0, 160));
            $angle = mt_rand(-30, 30);
            $size = $fontsize / 12 * mt_rand(12, 14);
            $box = imageftbbox($size, $angle, $font, $phrase[$i]);
            $x = $spacing / 4 + $i * $spacing + 2;
            $y = $this->height / 2 + ($box[2] - $box[5]) / 4;
            imagefttext($image, $size, $angle, $x, $y, $color, $font, $phrase[$i]);
        }
        $this->image = $image;
        $_SESSION['PAOPHP_CAPTCHA_KEY'] = $phrase;
        return $this->image;
    }           
    
    public static function Verify($str = null)
    {
        $key = $_SESSION['PAOPHP_CAPTCHA_KEY'];
        if(!empty($_SESSION['PAOPHP_CAPTCHA_KEY']) && !empty($str) && strtolower($str) === strtolower($key)){
          $_SESSION['PAOPHP_CAPTCHA_KEY'] = null;
          unset($_SESSION['PAOPHP_CAPTCHA_KEY']);
          return true;
        }else{
          return false;
        }
      
    }                        
}