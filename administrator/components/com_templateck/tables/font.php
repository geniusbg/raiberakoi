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

class TableFont extends JTable {

	/** @var int Primary key */
	var $id = 0;

	/** @var string */
	var $name = '';

	/** @var string */
	var $styles = '';

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableFont(& $db) {
		parent::__construct('#__templateck_fonts', 'id', $db);
	}

}
