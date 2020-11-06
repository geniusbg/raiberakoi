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
	protected $params;

	/**
	 * Display the view
	 */
	public function display($tpl = null) {

		$app = JFactory::getApplication();
		$user = JFactory::getUser();

		// include the classes
		include_once JPATH_COMPONENT . '/helpers/creatorck.php';
		include_once JPATH_COMPONENT . '/helpers/menustyles.php';
		include_once JPATH_COMPONENT . '/helpers/stylescss.php';
		include_once JPATH_COMPONENT . '/helpers/ZipArchiver.php';

		JText::script('TEMPLATE_MUST_HAVE_NAME');
		JText::script('TEMPLATE_MUST_HAVE_WIDTH');
		JText::script('CK_LOADING');
		JText::script('CK_LOAD_SUCCESS_STEP1');
		JText::script('CK_LOAD_FAILURE_STEP1');
		JText::script('CK_LOAD_SUCCESS_STEP_ARCHIVE');
		JText::script('CK_LOAD_FAILURE_STEP_ARCHIVE');
		JText::script('CK_LOAD_SUCCESS_STEP_XML');
		JText::script('CK_LOAD_FAILURE_STEP_XML');
		JText::script('CK_LOAD_SUCCESS_STEP_CSS');
		JText::script('CK_LOAD_FAILURE_STEP_CSS');
		JText::script('CK_PREVIEW_TEMPLATE');
		JText::script('CK_ONLY_ONE_COMPONENT');
		JText::script('CK_COPYTOCLIPBOARD');
		JText::script('CK_COPYFROMCLIPBOARD');
		JText::script('CK_CLIPBOARDEMPTY');
		JText::script('TEMPLATE_MUST_HAVE_CONTENT');
		JText::script('CK_INVALID_ID');
		JText::script('CK_ENTER_VALID_ID');
		JText::script('CK_ENTER_VALID_POSITION');
		JText::script('CK_ENTER_UNIQUE_ID');
		JText::script('CK_ENTER_UNIQUE_POSITION');
		JText::script('CK_POSITION_ALREADY_USED');
		JText::script('CK_CHOOSE_BLOC_TYPE');
		JText::script('CK_ERASE_WITH_NEW_THEME');

		$this->state = $this->get('State');
		$this->item = $this->get('Data');
		$this->form = $this->get('Form');
		$this->params = $app->getParams('com_templateck');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		if ($this->_layout == 'edit' || !$this->item->id) {
			$authorised = $user->authorise('core.edit.own', 'com_templateck');

			if ($authorised !== true) {
				// Redirect to the edit screen.
				$app->redirect(JURI::root() . 'index.php?option=com_templateck&view=login&template=templatecreatorck&tmpl=login&id=' . $this->item->id);
				return false;
			}
		}

		parent::display($tpl);
	}

	/**
	 * private function to load the fonts in the page
	 */
	function _callfontsSquirrel() {
		$fontstyles = '';
		$db = JFactory::getDBO();
		$query = "SELECT *
		FROM #__templateck_fonts";
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		if (!$rows)
			return false;
		foreach ($rows as $row) {
			$fontstyles .= str_replace("url('", "url('" . JURI::root() . "components/com_templateck/fonts/" . $row->name . "/", $row->styles);
		}
		echo "<style type=\"text/css\">" . $fontstyles . "</style>";
	}

}