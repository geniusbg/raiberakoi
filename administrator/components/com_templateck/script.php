<?php
/**
 * @copyright	Copyright (C) 2010 Cédric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * @license		GNU/GPL
**/


// no direct access
defined('_JEXEC') or die('Restricted access');

class com_templateckInstallerScript {
	function update( $parent ) {
		// Installing component manifest file version
		//$this->release = $parent->get( "manifest" )->version;
		$oldversion = $this->getParam('version');
		if (version_compare($oldversion, '2.1.0') >= 0) {
			//echo 'Update script loaded you have the last version';
			return;
		}
		//echo ' | update script loaded, you have a old version';
		$this->updateTable();
	}

	/*
	 * get a variable from the manifest file (actually, from the manifest cache).
	 */
	function getParam( $name ) {
		$db = JFactory::getDbo();
		$db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "templateck"');
		$manifest = json_decode( $db->loadResult(), true );
		return $manifest[ $name ];
	}

	/*
	* update the table
	*/
	function updateTable() {
		$db = JFactory::getDbo();
		// test for order column title depending on virtuemart version
        $db = & JFactory::getDBO();

		// test if the columns not exists
        $query = "SHOW COLUMNS FROM #__templateck LIKE 'htmlcode_responsive'";
        $db->setQuery($query);
        if ($db->query()) {
            if ( $db->loadResult()) {
				//echo 'existe deja!';return;
			} else {
				// add the SQL field to the main table
				$db->setQuery('ALTER TABLE `#__templateck` ADD `htmlcode_responsive` longtext NOT NULL;');
				if (!$db->query()) {
					echo '<p>Error during table templateck update process !</p>';
				} else {
					echo '<p>Table templateck updated !</p>';
				}
			}
        } else {
            echo 'Erreur de données SQL - Test si champ responsive existe';
            return false;
        }

		$db->setQuery('CREATE TABLE IF NOT EXISTS `#__templateck_mobile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resolution1` longtext NOT NULL,
  `resolution2` longtext NOT NULL,
  `resolution3` longtext NOT NULL,
  `resolution4` longtext NOT NULL,
  `templateid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;');
		if (!$db->query()) {
			echo '<p>Error during table templateck_mobile creation process !</p>';
		} else {
			echo '<p>Table templateck_mobile created !</p>';
		}


	}

}