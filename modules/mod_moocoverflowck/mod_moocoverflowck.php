<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.ck-web-creation-alsace.com
 * http://www.joomlack.fr
 * Module moocoverflowck pour Joomla! 1.6
 * @license		GNU/GPL
**/

// no direct access
defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).DS.'helper.php');
$items = modMoocoverflowckHelper::getMenu($params, $module);
require(JModuleHelper::getLayoutPath('mod_moocoverflowck'));
?>