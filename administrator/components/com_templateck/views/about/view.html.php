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
 * About View
 */
class TemplateckViewAbout extends JViewLegacy {

	/**
	 * About view display method
	 * @return void
	 * */
	function display($tpl = null) {
		JToolBarHelper::title(JText::_('CK_ABOUT'), 'home_templateck');
		$this->tckversion = $this->getParam('version');
		parent::display($tpl);
	}

	/*
	 * get a variable from the manifest file (actually, from the manifest cache).
	 */

	function getParam($name) {
		$db = JFactory::getDbo();
		$db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "com_templateck"');
		$manifest = json_decode($db->loadResult(), true);
		return $manifest[$name];
	}

}
