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

class TemplateckController extends JControllerLegacy {

	/**
	 * Method to display a view.
	 *
	 * @param	boolean			$cachable	If true, the view output will be cached
	 * @param	array			$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false) {
		require_once JPATH_COMPONENT . '/helpers/templateck.php';

		// Load the left sidebar.
		TemplateckHelper::addSubmenu(JRequest::getCmd('view', 'templates'));

		$input = new JInput();
		$view = $input->get('view', 'templates');
		$input->set('view', $view);

		parent::display();

		return $this;
	}

}
