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
$app = JFactory::getApplication();
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

$blocs = $app->input->get('theme', null, null);
$path = JPATH_ROOT . '/components/com_templateck/themes';
$themename = JRequest::getVar('themename');
$exportfiledest = $path . '/' . $themename . '.hck';
$exportfiletext = $blocs;

if (!JFile::write($exportfiledest, $exportfiletext)) {
	$msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_EXPORTFILE') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_EXPORTFILE') . '</p>';
}
echo '<p>' . $msg . '</p>';

// create button to download the package
echo '<p style="padding: 15px;"><a class="ckdownload" target="_blank" href="' . JURI::root() . 'components/com_templateck/themes/' . $themename . '.hck">' . JText::_('CK_DOWNLOAD_THEME') . '</a></p>';