<?php

/**
 * @name		Template Creator CK 3
 * @package		com_templateck
 * @copyright	Copyright (C) 2013. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Template controller class.
 */
class TemplateckControllerTemplate extends JControllerForm {

	function __construct() {
		$this->view_list = 'templates';
		parent::__construct();
	}

	/**
	 * copy an existing template
	 * @return void
	 */
	function copy() {
		$model = $this->getModel('template');
		$input = new JInput();
		$input = $input->get('cid', '', 'array');
		JRequest::setVar('id', (int) $input[0]);
		if (!$model->copy()) {
			$msg = JText::_('CK_TEMPLATE_COPY_ERROR');
			$type = 'error';
		} else {
			$msg = JText::_('CK_TEMPLATE_COPIED');
			$type = 'message';
		}

		$this->setRedirect('index.php?option=com_templateck', $msg, $type);
	}

	/**
	 * display input form to select a file
	 * @return void
	 */
	function installGabarit() {
		$link = 'index.php?option=com_templateck&view=template&layout=install';
		$this->setRedirect($link);
	}

	/**
	 * import a theme from a zip file
	 * @return void
	 */
	function importtck() {
		$model = $this->getModel('template');
		if (!$model->installGabarit()) {
			$msg = JText::_('CK_INSTALL_GABARIT_ERROR');
			$link = 'index.php?option=com_templateck&view=template&layout=install';
			$type = 'error';
		} else {
			$msg = JText::_('CK_GABARIT_INSTALLED');
			$link = 'index.php?option=com_templateck&view=templates';
			$type = 'message';
		}

		$this->setRedirect($link, $msg, $type);
	}

	/**
	 * display input form to select a file
	 * @return void
	 */
	function exportGabarit() {
		JRequest::setVar('view', 'template');
		JRequest::setVar('layout', 'export');
		$input = new JInput();
		$input = $input->get('cid', '', 'array');
		JRequest::setVar('id', (int) $input[0]);

		parent::display();
	}

}