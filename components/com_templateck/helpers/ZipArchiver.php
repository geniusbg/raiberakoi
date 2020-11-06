<?php

/**
 * Modified for Template Creator CK by Cédric KEIFLIN
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.template-creator.com
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access
defined('_JEXEC') or die('Restricted access');
// jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
include_once JPATH_COMPONENT . '/helpers/zip.php';

class ZipArchiver extends JObject {
	/* creates a compressed zip file */

	function create($files = array(), $destination = '', $path, $overwrite = true) {
		$ds = DIRECTORY_SEPARATOR;
		$files = JFolder::files($path, false, true, true);

		if (file_exists($path . $destination) && !$overwrite) {
			return false;
		}

		//  Check to see if directory for archive exists
		if (!JFolder::exists($path)) {
			//  Try to create the directory if it does not exists
			if (!JFolder::create($path)) {
				//  Raise error, unable to create dir
				$this->setError('Unable to create directory for archive');
				return false;
			}
		}

		//  Check if archive exists
		$archiveFilePath = $path . $destination;
		if (JFile::exists($archiveFilePath)) {
			//  If overwrite flag is set
			if ($overwrite) {
				//  Delete archive
				JFile::delete($archiveFilePath);
			} else {
				//  Set error and return
				$this->setError('Archive exists');
				return false;
			}
		}

		//  Prepare files for the zip archiver
		$filesToZip = array();
		$path = $this->cleanPath($path);
		foreach ($files as $file) {
			if (JFile::exists($file)) {
				$file = $this->cleanPath($file);
				$filename = str_replace($path . '/', '', $file);
				$filesToZip[] = array(
					'data' => JFile::read($file),
					'name' => $filename
				);
			}
		}

		//  Create ZIP archiver
		$archiver = new CKArchiveZip();

		//  Create Archive
		$isSuccess = $archiver->create($archiveFilePath, $filesToZip);

		//  Check of operation was successful
		if (!$isSuccess) {
			//  Set Error
			$this->setError('Unable to create archive');
		}

		//
		return $isSuccess;
	}

	protected function cleanPath($path) {
//		$ds = DIRECTORY_SEPARATOR;
//		$path = str_replace("/", $ds, $path);
		$path = str_replace("\\", '/', $path);

		return $path;
	}

}