<?php

/**
 * @name		Template Creator CK 3
 * @package		com_templateck
 * @copyright	Copyright (C) 2013. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */
// No direct access to this file
defined('_JEXEC') or die();

jimport('joomla.application.component.controllerform');

class TemplateckControllerFont extends JControllerForm {

	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct() {
		parent::__construct();
	}

	/**
	 * display input form to select a zip file
	 * @return void
	 */
	function installTheme() {
		JRequest::setVar('view', 'fonts');
		JRequest::setVar('layout', 'install');

		parent::display();
	}

	/**
	 * import a theme from a zip file
	 * @return void
	 */
	function importzip() {
		$model = $this->getModel('font');
		if (!$model->installFont()) {
			$msg = JText::_('CK_INSTALL_FONT_ERROR');
			$link = 'index.php?option=com_templateck&view=fonts&layout=install';
			$type = 'error';
		} else {
			$msg = JText::_('CK_FONT_INSTALLED');
			$link = 'index.php?option=com_templateck&view=fonts';
			$type = 'message';
		}

		$this->setRedirect($link, $msg, $type);
	}

}
