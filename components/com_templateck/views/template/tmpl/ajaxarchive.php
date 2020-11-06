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
jimport('joomla.filesystem.file');

$templatename = JRequest::getVar('templatename');
$saveintemplate = JRequest::getVar('saveintemplate') == 'copy' ? true : false;
$path = JPATH_ROOT . '/components/com_templateck/projects/' . $templatename;

if ($saveintemplate == true) {
	$defaulttemplatesrc = JPATH_ROOT . '/components/com_templateck/projects/' . $templatename;
	$defaulttemplatedest = JPATH_ROOT . '/templates/' . $templatename;

	// check if template aldready intalled
	if (!JFolder::exists($defaulttemplatedest)) {
		$msg = '<p class="errorck">' . JText::_('CK_ERROR_TEMPLATECOPY_TEMPLATENOTINSTALLED') . '</p>';
	} else {
		if (!JFolder::copy($defaulttemplatesrc, $defaulttemplatedest, '', true)) {
			$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_TEMPLATECOPY') . '</p>';
		} else {
			$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_TEMPLATECOPY') . '</p>';
		}
	}
	echo $msg;
} else {
	$files = JFolder::files($path, false, true, true);
	$exporter = new ZipArchiver();
	$isSuccess = $exporter->create($files, '.zip', $path, true);

	// return message after creating the zip archive
	if (!$isSuccess && $exporter->getError()) {
		$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_ARCHIVE') . '</p>';
	} else {
		$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_ARCHIVE') . '</p>';
	}

	echo $msg;

	// create button to download the package
	echo '<p style="padding: 15px;"><a class="ckdownload  ckbuttonstyle" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '.zip">' . JText::_('CK_DOWNLOAD_TEMPLATE') . '</a></p>';
}