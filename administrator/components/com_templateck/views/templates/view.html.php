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
jimport('joomla.filesystem.folder');

/**
 * View class for a list of Templateck.
 */
class TemplateckViewTemplates extends JViewLegacy {

	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null) {
		$this->state = $this->get('State');
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');

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
	 *
	 * @since	1.6
	 */
	protected function addToolbar() {
		require_once JPATH_COMPONENT . '/helpers/templateck.php';

		$state = $this->get('State');
		$canDo = TemplateckHelper::getActions($state->get('filter.category_id'));

		JToolBarHelper::title(JText::_('COM_TEMPLATECK_TITLE_TEMPLATES'), 'templates.png');

		//Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/template';
		if (file_exists($formPath)) {

			if ($canDo->get('core.create')) {
				JToolBarHelper::addNew('template.add', 'JTOOLBAR_NEW');
			}

			if ($canDo->get('core.edit')) {
				JToolBarHelper::editList('template.edit', 'JTOOLBAR_EDIT');
				JToolBarHelper::custom('template.copy', 'copyTemplate', 'copyTemplate', JText::_('CK_COPY_TEMPLATE'));
				JToolBarHelper::custom('template.installGabarit', 'installGabarit', 'installGabarit', JText::_('CK_INSTALL_GABARIT'), false);
				JToolBarHelper::custom('template.exportGabarit', 'exportGabarit', 'exportGabarit', JText::_('CK_EXPORT_GABARIT'), true);
			}
		}

		if ($canDo->get('core.edit.state')) {

			if (isset($this->items[0]->state)) {
				JToolBarHelper::divider();
			} else {
				//If this component does not use state then show a direct delete button as we can not trash
				JToolBarHelper::trash('templates.delete');
			}



			if (isset($this->items[0]->state)) {
				JToolBarHelper::divider();
			}
		}

		//Show trash and delete for components that uses the state field
		if (isset($this->items[0]->state)) {
			if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
				// JToolBarHelper::deleteList('', 'templates.delete','JTOOLBAR_EMPTY_TRASH');
				JToolBarHelper::divider();
			} else if ($canDo->get('core.edit.state')) {
				JToolBarHelper::trash('templates.delete', 'JTOOLBAR_TRASH');
				JToolBarHelper::divider();
			}
		}

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_templateck');
		}
	}

	/**
	 * private function to check if the template templatecreatorck is installed
	 */
	function _checkIfTemplateInstalled() {
		$app = JFactory::getApplication();
		if (JFolder::exists(JPATH_ROOT . '/templates/templatecreatorck')) {
			return;
		} else {
			$app->enqueueMessage(JText::_('TEMPLATE_TEMPLATECREATORCK_NOT_INSTALLED'), 'error');
		}

		return;
	}

}
