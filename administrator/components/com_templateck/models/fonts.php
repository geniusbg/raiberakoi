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

jimport('joomla.application.component.modellist');
jimport('joomla.filesystem.file');

class TemplateckModelFonts extends JModelList {

	/**
	 * fonts data array
	 *
	 * @var array
	 */
	var $_data;

	/**
	 * Retrieves the fonts list
	 * @return array Array of objects containing the data from the database
	 */
	function getFonts() {
		// Lets load the data if it doesn't already exist
		if (empty($this->_data)) {

			// constructs the query
			$query = ' SELECT * '
					. ' FROM #__templateck_fonts';

			// retrieves the data
			$this->_data = $this->_getList($query);
		}

		return $this->_data;
	}

}
