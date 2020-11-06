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

/**
 * Templateck helper.
 */
class TemplateckHelper {

	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '') {
		JSubMenuHelper::addEntry(
				JText::_('COM_TEMPLATECK_TITLE_TEMPLATES'), 'index.php?option=com_templateck&view=templates', $vName == 'templates'
		);
		JSubMenuHelper::addEntry(
				JText::_('CK_SUBMENU_FONTS'), 'index.php?option=com_templateck&view=fonts', $vName == 'fonts'
		);
		JSubMenuHelper::addEntry(
				JText::_('CK_ABOUT'), 'index.php?option=com_templateck&view=about', $vName == 'about'
		);
		JSubMenuHelper::addEntry(
				JText::_('CK_HELP'), 'index.php?option=com_templateck&view=help', $vName == 'help'
		);
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions() {
		$user = JFactory::getUser();
		$result = new JObject;

		$assetName = 'com_templateck';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}

}
