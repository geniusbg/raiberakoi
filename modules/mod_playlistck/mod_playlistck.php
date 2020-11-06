<?php

/**
 * @copyright	Copyright (C) 2013 Cedric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * Module Playlist CK
 * @license		GNU/GPL
 * */
// no direct access
defined('_JEXEC') or die;
global $ckjqueryisloaded;

require_once dirname(__FILE__) . '/helper.php';
if ($params->get('playlistckvirtuemart_enable', '0') == '1') {
	if (JFile::exists(JPATH_ROOT . '/plugins/system/playlistckvirtuemart/helper/helper_playlistckvirtuemart.php')) {
		require_once JPATH_ROOT . '/plugins/system/playlistckvirtuemart/helper/helper_playlistckvirtuemart.php';
		$items = modPlaylistckvirtuemartHelper::getItems($params);
	} else {
		echo '<p style="color:red;font-weight:bold;">File /plugins/system/playlistckvirtuemart/helper/helper_playlistckvirtuemart.php not found ! Please download the patch for Slideshow CK - Virtuemart on <a href="http://www.joomlack.fr">http://www.joomlack.fr</a></p>';
		return false;
	}
} else if ($params->get('playlistckhikashop_enable', '0') == '1') {
	if (JFile::exists(JPATH_ROOT . '/plugins/system/playlistckhikashop/helper/helper_playlistckhikashop.php')) {
		require_once JPATH_ROOT . '/plugins/system/playlistckhikashop/helper/helper_playlistckhikashop.php';
		$items = modPlaylistckhikashopHelper::getItems($params);
	} else {
		echo '<p style="color:red;font-weight:bold;">File /plugins/system/playlistckhikashop/helper/helper_playlistckhikashop.php not found ! Please download the patch for Slideshow CK - Hikashop on <a href="http://www.joomlack.fr">http://www.joomlack.fr</a></p>';
		return false;
	}
} else {
	switch ($params->get('slidesssource', 'slidesmanager')) {
		case 'folder':
			$items = modPlaylistckHelper::getItemsFromfolder($params);
			break;
		case 'autoloadfolder':
			$items = modPlaylistckHelper::getItemsAutoloadfolder($params);
			break;
		case 'autoloadarticlecategory':
			$items = modPlaylistckHelper::getItemsAutoloadarticlecategory($params);
			break;
		default:
			$items = modPlaylistckHelper::getItems($params);
			break;
	}
//	if ($params->get('slidesssource', 'slidesmanager') == 'folder') {
//		$items = modPlaylistckHelper::getItemsFromfolder($params);
//	} else if ($params->get('slidesssource', 'slidesmanager') == 'autoloadfolder') {
//		$items = modPlaylistckHelper::getItemsAutoloadfolder($params);
//	} else if ($params->get('slidesssource', 'slidesmanager') == 'autoloadarticlecategory') {
//		$items = modPlaylistckHelper::getItemsAutoloadfolder($params);
//	} else {
//		$items = modPlaylistckHelper::getItems($params);
//	}

	if ($params->get('displayorder', 'normal') == 'shuffle')
		shuffle($items);
}

$document = JFactory::getDocument();
if ($params->get('loadjquery', '1') && !$ckjqueryisloaded) {
	$document->addScript(JURI::base(true) . '/modules/mod_playlistck/assets/jquery.min.js');
	$ckjqueryisloaded = 1;
}
if ($params->get('loadjqueryeasing', '1')) {
	$document->addScript(JURI::base(true) . '/modules/mod_playlistck/assets/jquery.easing.1.3.js');
}
$document->addScript(JURI::base(true) . '/modules/mod_playlistck/assets/jquery.ui.1.8.js');
if ($params->get('loadjquerymobile', '1')) {
	$document->addScript(JURI::base(true) . '/modules/mod_playlistck/assets/jquery.mobile.customized.min.js');
}

$document->addScript(JURI::base(true) . '/modules/mod_playlistck/assets/playlistck.js');

$theme = $params->get('theme', 'default');
$langdirection = $document->getDirection();
if ($langdirection == 'rtl' && JFile::exists('modules/mod_playlistck/themes/' . $theme . '/css/playlistck_rtl.css')) {
	$document->addStyleSheet(JURI::base(true) . '/modules/mod_playlistck/themes/' . $theme . '/css/playlistck_rtl.css');
} else {
	$document->addStyleSheet(JURI::base(true) . '/modules/mod_playlistck/themes/' . $theme . '/css/playlistck.css');
}

if (JFile::exists('modules/mod_playlistck/themes/' . $theme . '/css/playlistck_ie.css')) {
	echo '
		<!--[if lte IE 7]>
		<link href="' . JURI::base(true) . '/modules/mod_playlistck/themes/' . $theme . '/css/playlistck_ie.css" rel="stylesheet" type="text/css" />
		<![endif]-->';
}

if (JFile::exists('modules/mod_playlistck/themes/' . $theme . '/css/playlistck_ie8.css')) {
	echo '
		<!--[if IE 8]>
		<link href="' . JURI::base(true) . '/modules/mod_playlistck/themes/' . $theme . '/css/playlistck_ie8.css" rel="stylesheet" type="text/css" />
		<![endif]-->';
}

// set the navigation variables
switch ($params->get('navigation', '2')) {
	case 0:
		// aucune
		$navigation = "navigationHover: false,
                navigation: false,
                playPause: false,";
		break;
	case 1:
		// toujours
		$navigation = "navigationHover: false,
                navigation: true,
                playPause: true,";
		break;
	case 2:
	default:
		// on mouseover
		$navigation = "navigationHover: true,
                navigation: true,
                playPause: true,";
		break;
}

$thumnails = ($params->get('showthumbnails', 'imagetext') == 'imagetext' || $params->get('showthumbnails', 'imagetext') == 'image') ? '1' : '0';
$showthumbcaption = ($params->get('showthumbnails', 'imagetext') == 'imagetext' || $params->get('showthumbnails', 'imagetext') == 'text') ? '1' : '0';
$thumbcaptiontitle = ($params->get('thumbnailtext', 'titledesc') == 'titledesc' || $params->get('thumbnailtext', 'titledesc') == 'title') ? '1' : '0';
$thumbcaptiondesc = ($params->get('thumbnailtext', 'titledesc') == 'titledesc' || $params->get('thumbnailtext', 'titledesc') == 'desc') ? '1' : '0';

// load the slideshow script
$js = "<script type=\"text/javascript\"> <!--
       jQuery(function(){
        jQuery('#playlistck_wrap_" . $module->id . "').playlistck({
                height: '" . $params->get('height', '62%') . "',
                minHeight: '',
                pauseOnClick: false,
                hover: " . $params->get('hover', '1') . ",
                fx: '" . implode(",", $params->get('effect', array('linear'))) . "',
                loader: '" . $params->get('loader', 'pie') . "',
                pagination: " . $params->get('pagination', '0') . ",
                thumbnails: " . $thumnails . ",
                time: " . $params->get('time', '7000') . ",
                transPeriod: " . $params->get('transperiod', '1500') . ",
                alignment: '" . $params->get('alignment', 'center') . "',
                autoAdvance: " . $params->get('autoAdvance', '1') . ",
                mobileAutoAdvance: " . $params->get('autoAdvance', '1') . ",
                barDirection: '" . $params->get('barDirection', 'leftToRight') . "',
                imagePath: '" . JURI::base(true) . "/modules/mod_playlistck/images/',
                lightbox: '" . $params->get('lightboxtype', 'mediaboxck') . "',
				thumbscontwidth: '" . $params->get('thumbscontwidth', '35%') . "',
				thumbsposition: '" . $params->get('thumbsposition', 'right') . "',
				showthumbcaption: " . $showthumbcaption . ",
				thumbcaptiontitle: " . $thumbcaptiontitle . ",
				thumbcaptiondesc: " . $thumbcaptiondesc . ",
				thumbnailtextdesclength: '" . $params->get('thumbnailtextdesclength', '100') . "',
				" . $navigation . "
                barPosition: '" . $params->get('barPosition', 'bottom') . "'
        });
}); //--> </script>";

echo $js;

// load some css
$css = "";
$css .= "#playlistck_wrap_" . $module->id . " .playlistck_thumbs_cont .playlistck_thumbs_li img {width:" . $params->get('thumbnailzoom', '100%') . " !important;}\n";
$css .= "#playlistck_wrap_" . $module->id . " .playlistck_thumbs_caption {width:" . $params->get('thumbscaptionwidth', '50%') . ";}\n";
$css .= "#playlistck_wrap_" . $module->id . " .playlistck_thumbs_image {width:" . $params->get('thumbnailwidth', '50%') . ";height:" . $params->get('thumbnailheight', '98%') . ";}\n";

// load the caption styles
$captioncss = modPlaylistckHelper::createCss($params, 'captionstyles');
$fontfamily = ($params->get('captionstylesusefont', '0') && $params->get('captionstylestextgfont', '0')) ? "font-family:'" . $params->get('captionstylestextgfont', 'Droid Sans') . "';" : '';
if ($fontfamily) {
	$gfonturl = str_replace(" ", "+", $params->get('captionstylestextgfont', 'Droid Sans'));
	$document->addStylesheet('https://fonts.googleapis.com/css?family=' . $gfonturl);
}

$css .= "
#playlistck_wrap_" . $module->id . " .playlistck_caption {
	display: block;
	position: absolute;
}
#playlistck_wrap_" . $module->id . " .playlistck_caption > div {
	" . $captioncss['padding'] . $captioncss['margin'] . $captioncss['background'] . $captioncss['gradient'] . $captioncss['borderradius'] . $captioncss['shadow'] . $captioncss['border'] . $captioncss['fontcolor'] . $captioncss['fontsize'] . $fontfamily . "
}
#playlistck_wrap_" . $module->id . " .playlistck_caption > div div.slideshowck_description {
	" . $captioncss['descfontcolor'] . $captioncss['descfontsize'] . "
}
";

$document->addStyleDeclaration($css);

// display the module
require JModuleHelper::getLayoutPath('mod_playlistck', $params->get('layout', 'default'));
