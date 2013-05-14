<?php

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';
$list = modBxSlidersHelper::getList($params);

$jQuery = $params->get("jQuery");

$imgWidth = $params->get('imgWidth', '940');
$imgHeight = $params->get('imgHeight', '400');
$BgPosition = $params->get('BgPosition', '100');
$Autoplay = $params->get('Autoplay', 'true');
$Interval = $params->get('Interval', '4000');

// Slideshow options 
$jQueryEasing = $params->get('jQueryEasing');

$Image = array(); $Title=array();
$Link = array(); $Text=array();

$Image[] = $params->get('!', "");
$Title[] = $params->get('!', "");
$Text[] = $params->get('!', "");
$Link[] = $params->get('!', "");

for ($j = 1; $j <= 20; $j++) {
  $Image[] = $params->get('Image' . $j, "");
  $Title[] = $params->get('Title' . $j, "");
  $Text[] = $params->get('Text' . $j, "");
  $Link[] = $params->get('Link' . $j, "");
}

// Load the jquery
$doc = JFactory::getDocument();
$module_dir = JURI::base() . 'modules/mod_bx_sliders';

switch($jQuery){
  case 1:
    $doc->addScript($module_dir.'/assets/js/jquery-1.7.2.js');
    break;
  case 2: 
    $doc->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
    break;
  default:break;
}

//$doc->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');

$doc->addScript($module_dir.'/assets/js/jquery.bxslider.js');
//$doc->addScript($module_dir.'/assets/js/jquery.bxslider.min.js');

$doc->addStyleSheet($module_dir.'/assets/css/jquery.bxslider.css');

$slideshow_options = array();

if($jQueryEasing==1){
  $slideshow_options['easing'] = 'ease-in';
}

$slideshow_options['speed']=$params->get('bx_speed','500');
$slideshow_options['mode']=$params->get('bx_mode','horizontal');
$slideshow_options['slideSelector']=$params->get('bx_slide_selector','');
$slideshow_options['pause']=$params->get('bx_pause','4000');
$slideshow_options['auto']= $params->get('bx_auto','1') ? (boolean) '1' : (boolean) '0';
$slideshow_options['autoHover']=$params->get('bx_autohover','1') ? (boolean) '1' :(boolean) '0';
$slideshow_options['randomStart']=$params->get('bx_randomstart','0') ? (boolean) '1' :(boolean) '0';
$slideshow_options['infiniteLoop']=$params->get('bx_infiniteloop','1') ? (boolean) '1' :(boolean) '0';
$slideshow_options['ticker']=$params->get('bx_ticker','0') ? (boolean) '1' :(boolean) '0';
$slideshow_options['tickerHover']=$params->get('bx_tickerhover','1') ? (boolean) '1' :(boolean) '0';
$slideshow_options['adaptiveHeight']=$params->get('bx_adaptiveheight','0') ? (boolean) '1' :(boolean) '0';
$slideshow_options['video'] = $params->get('bx_video','0') ? (boolean) '1' :(boolean) '0';
$slideshow_options['preloadImages'] = $params->get('bx_preloadimages','visible');
$slideshow_options['pager'] = $params->get('bx_pager','0') ? (boolean) '1' :(boolean) '0';
$slideshow_options['pagerType'] = $params->get('bx_pagertype','full');
$slideshow_options['pagerShortSeparator'] = $params->get('bx_pagerseparator','/');

// Embed the fitvids if the video is in the slide
if($slideshow_options['video']==true){ $doc->addScript($module_dir.'/assets/plugins/jquery.fitvids.js');}

$jsonOptions = json_encode($slideshow_options);

$scripts = "jQuery(document).ready(function(){
              jQuery('.bxslider').bxSlider(".$jsonOptions.");
            });";

$doc->addScriptDeclaration($scripts);

require JModuleHelper::getLayoutPath('mod_bx_sliders', 'default');