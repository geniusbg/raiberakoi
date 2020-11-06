<?php

/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.ck-web-creation-alsace.com
 * http://www.joomlack.fr
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.filesystem.file');
//jimport( 'joomla.document.html.html' );



// retrieve variables
$templatename   = JRequest::getVar('templatename');

// check if the template vide exists
if (JFolder::exists(JPATH_ROOT . DS . 'templates' . DS . 'templatecreatorck')) {
    header('Location: index.php?templatename='. $templatename .'&template=templatecreatorck');
}

// store root folder
$path = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'projects' . DS . $templatename;

// store template params
$params['template'] = $templatename;
$params['directory'] = str_replace(DS.$templatename,'',$path);
$params['file'] = 'index.php';

// render the template
$rendering = JDocumentHTML::getInstance();
$renderedtemplate = $rendering->render(false,$params);

// replace variables to link css
$renderedtemplate = str_replace('templates','components/com_templateck/projects',$renderedtemplate);

// output the template in the page
echo $renderedtemplate;


?>
