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
jimport('joomla.filesystem.folder');

class TemplateckModelFont extends JModelList {

	/**
	 * path to the fonts foler
	 *
	 * @var string
	 */
	var $_path;

	/**
	 * Theme object
	 *
	 * @var object
	 */
	var $_data;

	/**
	 * Constructor that retrieves the name from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct() {
		parent::__construct();

		$this->_path = JPATH_ROOT . '/' . 'components' . '/' . 'com_templateck' . '/' . 'fonts';
		$this->_data = null;
	}

	/**
	 * Method to store a record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function store($name, $styles, $fontfamilies) {

		$row = & $this->getTable();
		$data['name'] = $name;
		$data['styles'] = $styles;
		$data['fontfamilies'] = $fontfamilies;

		// Bind the form fields to the table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the table to the database
		if (!$row->store()) {
			$this->setError($row->getErrorMsg());
			return false;
		}

		return true;
	}

	/**
	 * Method to delete record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function delete() {
		$cids = JRequest::getVar('cid', array(0), 'post', 'array');
		$destpath = JPATH_ROOT . '/' . 'components' . '/' . 'com_templateck' . '/' . 'fonts';

		$row = & $this->getTable();
		if (count($cids)) {
			foreach ($cids as $cid) {
				$query = ' SELECT name '
						. ' FROM #__templateck_fonts WHERE id=' . $cid;

				// retrieves the data
				$this->_db->setQuery($query);
				$fontname = $this->_db->loadResult();

				// delete the folder
				if (!JFolder::delete($destpath . '/' . $fontname)) {
					$this->setError('CK_ERROR_DELETING_FONT');
					return false;
				}

				// delete the records from the db
				if (!$row->delete($cid)) {
					$this->setError($row->getErrorMsg());
					return false;
				}
			}
		}
		return true;
	}

	/**
	 * Method to install a font
	 *
	 * @access	public
	 * @return	true on success
	 */
	function installFont() {
		if (is_array(JRequest::getVar('file', '', 'files', 'array'))) {

			// include file and zip archive libraries
			jimport('joomla.filesystem.file');
			// require_once JPATH_LIBRARIES . '/' . 'joomla' . '/' . 'archive' . '/' . 'zip.php';
			require_once JPATH_ROOT . '/components/com_templateck/helpers/zip.php';

			//Clean up filename to get rid of strange characters like spaces etc
			$file = JRequest::getVar('file', '', 'files', 'array');
			$filename = JFile::makeSafe($file['name']);

			// declare some variables
			$app = JFactory::getApplication();
			$destpath = JPATH_ROOT . '/' . 'components' . '/' . 'com_templateck' . '/' . 'fonts' . '/' . JFile::stripExt($filename);

			// check if the theme already exists
			if (JFolder::exists($destpath)) {
				$msg = JText::_('CK_INSTALL_FONT_ALREADY_EXISTS');
				$app->redirect("index.php?option=com_templateck&view=fonts&layout=install", $msg, 'error');
				return false;
			}

			//Set up the source and destination of the file
			$src = $file['tmp_name'];

			//First check if the file has the right extension, we need jpg only
			if (strtolower(JFile::getExt($filename)) != 'zip') {
				$msg = JText::_('CK_INSTALL_FONT_MUST_BE_ZIP');
				$app->redirect("index.php?option=com_templateck&view=fonts&layout=install", $msg, 'error');
				return false;
			}

			// extract the files
			$archiver = new CKArchiveZip();
			if (!$isSuccess = $archiver->extract($src, $destpath)) {
				$msg = JText::_('CK_INSTALL_FONT_EXTRACT_ERROR');
				$app->redirect("index.php?option=com_templateck&view=fonts&layout=install", $msg, 'error');
				return false;
			}

			// get the content of the file styles.css
			if (!$stylescontent = JFile::read($destpath . '/stylesheet.css')) {
				// delete the folder
				if (!JFolder::delete($destpath)) {
					$this->setError('CK_ERROR_DELETING_FONT');
					return false;
				}

				$msg = JText::_('CK_GET_STYLESCONTENT_FAILED');
				$app->redirect("index.php?option=com_templateck&view=fonts&layout=install", $msg, 'error');
				return false;
			}

			$regex = "#font-family: '(.*?)';#s"; // masque de recherche
			preg_match_all($regex, $stylescontent, $fontfamilies);
			foreach ($fontfamilies[1] as $fontfamily) {
				$stylescontent = str_replace($fontfamily, strtolower($fontfamily), $stylescontent);
			}

			// store in db
			$this->store(JFile::stripExt($filename), $stylescontent, strtolower(implode(",", $fontfamilies[1])));
		}
		return true;
	}

}
