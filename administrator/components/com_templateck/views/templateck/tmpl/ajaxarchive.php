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



// retrieve variables
$templatename = JRequest::getVar('templatename');
$saveintemplate = JRequest::getVar('saveintemplate');




// save root folder
//$path = JPATH_COMPONENT . DS . 'projects' . DS . $templatename;
$path = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'projects' . DS . $templatename;

// list files to archive
$files = JFolder::files($path, false, true, true);


//  Create archiver and archive file
include_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'classes' . DS . 'ZipArchiver.php';

// create zip archive
$exporter = new ZipArchiver();
$isSuccess = $exporter->archive($files, $templatename . '.zip', $path, true, $templatename);

// return message after creating the zip archive
if (!$isSuccess && $exporter->getError()) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_ARCHIVE') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_ARCHIVE') . '</p>';
}

echo $msg;

if ($saveintemplate == "true") {
    $defaulttemplatesrc = JPATH_ROOT . '/components/com_templateck/projects/' . $templatename;
    $defaulttemplatedest = JPATH_ROOT . '/templates/' . $templatename;

    // check if template aldready intalled
    if (!JFolder::exists($defaulttemplatedest)) {
        $msg = '<p class="error">' . JText::_('CK_ERROR_TEMPLATECOPY_TEMPLATENOTINSTALLED') . '</p>';
    } else {
        if (!JFolder::copy($defaulttemplatesrc, $defaulttemplatedest, '', true)) {
            $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_TEMPLATECOPY') . '</p>';
        } else {
            $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_TEMPLATECOPY') . '</p>';
        }
    }
    echo $msg;
}

// create button to download the package
echo '<p style="padding: 15px;"><a class="ckdownload" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '.zip">' . JText::_('CK_DOWNLOAD_TEMPLATE') . '</a></p>';

