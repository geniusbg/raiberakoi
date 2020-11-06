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

jimport('joomla.application.component.view');

/**
 * Templatecks View
 */
class TemplateckViewFonts extends JViewLegacy {

	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Fonts view display method
	 * @return void
	 * */
	function display($tpl = null) {
		JToolBarHelper::title(JText::_('CK_FONTS_MANAGER'), 'home_templateck');
		require_once JPATH_COMPONENT . '/helpers/templateck.php';
		$input = new JInput();
		if ($input->get('layout') == 'install') {
			JToolBarHelper::cancel('font.cancel', 'JTOOLBAR_CANCEL');
		} else {
			JToolBarHelper::trash('fonts.delete');
			JToolBarHelper::custom('font.installTheme', 'installTheme', 'installTheme', JText::_('CK_INSTALL_FONTS'), false);
		}

		// Get categories from the model
		$fonts = $this->get('fonts');
		$this->assignRef('fonts', $fonts);

		parent::display($tpl);
	}

	/**
	 * Load the fonts from the db and inject the css in the page
	 * @return void
	 */
	function _callfontsSquirrel() {
		$fontstyles = '';
		$db = JFactory::getDBO();
		$query = "SELECT *
		FROM #__templateck_fonts
		  ";
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
