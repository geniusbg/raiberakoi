<?php

/**
 * @name		Template Creator CK 3
 * @package		com_templateck
 * @copyright	Copyright (C) 2013. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');


$app = JFactory::getApplication();
$fields = $app->input->get('fields', null, null);



$id = JRequest::getVar('objid');
$class = JRequest::getVar('objclass');
$fields = stripslashes(JRequest::getVar('fields'));
$fields = json_decode($fields); //test
$action = JRequest::getVar('action');
$cssstyles = new CssStyles();
$styles = $cssstyles->create($fields, $id, $action, $class);

if ($action == 'preview') {
	echo '<style>' . $styles . '</style>';
} else {
	return $styles;
}