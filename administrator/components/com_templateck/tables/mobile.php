<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.template-creator.com
 * Component Template Creator CK
 * @license		GNU/GPL
 * */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class TableMobile extends JTable
{
	/** @var int Primary key */
	var $id	= 0;
	/** @var string */
	var $resolution1 = '';
	/** @var string */
	var $resolution2 = '';
	/** @var string */
	var $resolution3 = '';
	/** @var string */
	var $resolution4 = '';
        


	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableMobile(& $db) {
		parent::__construct('#__templateck_mobile', 'id', $db);
	}
}
?>
