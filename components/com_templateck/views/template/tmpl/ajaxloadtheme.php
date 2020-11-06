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

$path = JPATH_ROOT . '/components/com_templateck/themes/';
$themename = JRequest::getVar('themename');
$theme = JFile::read($path . $themename . '.hck');
echo $theme;