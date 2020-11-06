<?php

/**
 * @name		Template Creator CK 3
 * @package		com_templateck
 * @copyright	Copyright (C) 2013. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Templates list controller class.
 */
class TemplateckControllerFonts extends JControllerAdmin {

	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function getModel($name = 'Font', $prefix = 'TemplateckModel') {
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

	/**
	 * display input form to select a zip file
	 * @return void
	 */
	public function installTheme() {
		JRequest::setVar('view', 'fonts');
		JRequest::setVar('layout', 'install');

		parent::display();
	}

	public function install() {
		die();
	}

}
