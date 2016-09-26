<?php 
require_once 'class/Securimage.php';

$img = new Securimage();
	    
	    $img->ttf_file        = realpath(".").'/resources/AHGBold.ttf';
	    $img->code_length  = 4;
        //$img->captcha_type    = Securimage::SI_CAPTCHA_MATHEMATIC; // show a simple math problem instead of text
        //$img->case_sensitive  = true;                              // true to use case sensitve codes - not recommended
        $img->image_height    = 35;                                // height in pixels of the image
        $img->image_width     = 125;          // a good formula for image size based on the height
        $img->font_ratio  = 0.7;
        //$img->perturbation    = .75;                               // 1.0 = high distortion, higher numbers = more distortion
        $img->image_bg_color  = new Securimage_Color("#91241F");   // image background color
        $img->text_color      = new Securimage_Color("#CFAA42");   // captcha text color
        $img->num_lines       = 2;                                 // how many lines to draw over the image
        $img->line_color      = new Securimage_Color("#A26621");   // color of lines over the image
        //$img->image_type      = SI_IMAGE_JPEG;                     // render as a jpeg image
        //$img->signature_color = new Securimage_Color(rand(0, 64),
        //                                             rand(64, 128),
        //                                             rand(128, 255));  // random signature color
        $img ->no_exit = true;
        // set namespace if supplied to script via HTTP GET
        //if (!empty($this->_getParam('namespace'))) $img->setNamespace($this->_getParam('namespace'));
        
        
        
        $img->show();  // outputs the image and content headers to the browser
        
        //$captchaImage = new Zend_Session_Namespace('captchaImage');
        $_SESSION["captchar"] = $img->getCode();
?>