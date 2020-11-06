<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.ck-web-creation-alsace.com
 * http://www.joomlack.fr
 * Module Parallax_CK for Joomla! 1.6
 * @license		GNU/GPL
**/

// no direct access
defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).DS.'helper.php');
$items = modParallaxckHelper::GenParallax($params);
require(JModuleHelper::getLayoutPath('mod_parallaxck'))
?>