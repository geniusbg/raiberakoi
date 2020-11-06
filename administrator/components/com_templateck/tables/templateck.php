<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.template-creator.com
 * Component Template Creator CK
 * @license		GNU/GPL
 * */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class TableTemplateck extends JTable
{
	/** @var int Primary key */
	var $id	= 0;
	/** @var string */
	var $joomlaversion = '';
        /** @var string */
	var $name = '';
	/** @var int */
	var $ordering = '';
	/** @var int */
	var $published = '1';
        /** @var string */
	var $creationDate = '';
        /** @var string */
	var $author = '';
        /** @var string */
	var $authorEmail = '';
        /** @var string */
	var $authorUrl = '';
        /** @var string */
	var $copyright = '';
        /** @var string */
	var $license = '';
        /** @var string */
	var $version = '';
        /** @var string */
	var $description = '';
        /** @var string */
	var $htmlcode = '';
        /** @var string */
	var $cssparams = '';
        /** @var string */
	var $theme = '';
        /** @var string */
	var $htmlcode_responsive = '';


	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableTemplateck(& $db) {
		parent::__construct('#__templateck', 'id', $db);
	}
}
?>
