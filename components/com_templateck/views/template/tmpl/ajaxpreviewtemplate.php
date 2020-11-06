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
jimport('joomla.filesystem.folder');
// retrieve variables
$templatename = JRequest::getVar('templatename');
var_dump($templatename);
// check if the template vide exists
if (JFolder::exists(JPATH_ROOT . '/templates/templatecreatorck')) {
	header('Location: index.php?templatename=' . $templatename . '&template=templatecreatorck&tmpl=preview');
}

// store root folder
$path = JPATH_ROOT . '/components/com_templateck/projects/' . $templatename;
// store template params
$params['template'] = $templatename;
$params['directory'] = str_replace('/' . $templatename, '', $path);
$params['file'] = 'index.php';

// render the template
$rendering = JDocumentHTML::getInstance();
$renderedtemplate = $rendering->render(false, $params);

// replace variables to link css
$renderedtemplate = str_replace('templates', 'components/com_templateck/projects', $renderedtemplate);

// output the template in the page
echo $renderedtemplate;