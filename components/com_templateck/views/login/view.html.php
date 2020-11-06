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

jimport('joomla.application.component.view');

/**
 * View to edit
 */
class TemplateckViewLogin extends JViewLegacy {

	protected $state;
	protected $item;
	protected $form;
	protected $params;

	/**
	 * Display the view
	 */
	public function display($tpl = null) {

		$app = JFactory::getApplication();
		$user = JFactory::getUser();

		$this->itemid = $app->input->get('id', '', 'int');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		// Check if an item was found.
//		if (!$this->itemid && $app->input->get('task') != 'logout') {
//			JError::raiseError(404, JText::_('Item not found'));
//			return false;
//		}

		$authorised = $user->authorise('core.edit.own', 'com_templateck');

		if ($authorised == true && $app->input->get('task') != 'logout') {
			// JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
			// Redirect to the edit screen.
			$app->redirect(JURI::root() . 'index.php?option=com_templateck&view=template&task=template.edit&template=templatecreatorck&id=' . $this->itemid);
			return false;
		}

		parent::display($tpl);
	}

}
