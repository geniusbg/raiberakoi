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
class TemplateckViewTemplate extends JViewLegacy {

	protected $state;
	protected $item;
	protected $form;

	/**
	 * Display the view
	 */
	public function display($tpl = null) {
		$this->state = $this->get('State');
		$this->item = $this->get('Item');
		$this->form = $this->get('Form');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar() {
		require_once JPATH_COMPONENT . '/helpers/templateck.php';

		JRequest::setVar('hidemainmenu', true);

		$user = JFactory::getUser();
		$isNew = ($this->item->id == 0);
		if (isset($this->item->checked_out)) {
			$checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		} else {
			$checkedOut = false;
		}
		$canDo = TemplateckHelper::getActions();

		JToolBarHelper::title(JText::_('COM_TEMPLATECK_TITLE_TEMPLATE'), 'template.png');
		if ($this->_layout == 'edit') {
			// If not checked out, can save the item.
			if (!$checkedOut && ($canDo->get('core.edit') || ($canDo->get('core.create')))) {

				JToolBarHelper::apply('template.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('template.save', 'JTOOLBAR_SAVE');
			}
		}
		if (empty($this->item->id)) {
			JToolBarHelper::cancel('template.cancel', 'JTOOLBAR_CANCEL');
		} else {
			JToolBarHelper::cancel('template.cancel', 'JTOOLBAR_CLOSE');
		}
	}

}
