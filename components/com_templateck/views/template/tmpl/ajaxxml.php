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
$joomlaversion = JRequest::getVar('joomlaversion');
$creationdate = JRequest::getVar('creationdate');
$author = JRequest::getVar('author');
$authorEmail = JRequest::getVar('authorEmail');
$authorUrl = JRequest::getVar('authorUrl');
$copyright = JRequest::getVar('copyright');
$license = JRequest::getVar('license');
$version = JRequest::getVar('version');
$description = JRequest::getVar('description');
$positions = JRequest::getVar('positions');

// create head lines
$xmltext = '<?xml version="1.0" encoding="utf-8"?>';
if ($joomlaversion == 'j15') {
	$xmltext .= '
<!DOCTYPE install PUBLIC "-//Joomla! 1.5//DTD template 1.0//EN" "http://www.joomla.org/xml/dtd/1.5/template-install.dtd">
<install version="1.5" type="template" method="upgrade">';
} elseif ($joomlaversion == 'j17') {
	$xmltext .= '
<!DOCTYPE install PUBLIC "-//Joomla! 1.7//DTD template 1.0//EN" "http://www.joomla.org/xml/dtd/1.7/template-install.dtd">
<extension version="1.7" type="template" client="site" method="upgrade">';
} elseif ($joomlaversion == 'j25') {
	$xmltext .= '
<!DOCTYPE install PUBLIC "-//Joomla! 2.5//DTD template 1.0//EN" "http://www.joomla.org/xml/dtd/2.5/template-install.dtd">
<extension version="2.5" type="template" client="site" method="upgrade">';
} else {
	$xmltext .= '
<!DOCTYPE install PUBLIC "-//Joomla! 2.5//DTD template 1.0//EN" "http://www.joomla.org/xml/dtd/2.5/template-install.dtd">
<extension version="3.0" type="template" client="site" method="upgrade">';
}

$xmltext .='
	<name>' . $templatename . '</name>
	<creationDate>' . $creationdate . '</creationDate>
	<author>' . $author . '</author>
	<authorEmail>' . $authorEmail . '</authorEmail>
	<authorUrl>' . $authorUrl . '</authorUrl>
	<copyright>' . $copyright . '</copyright>
	<license>' . $license . '</license>
	<version>' . $version . '</version>
	<description>' . $description . '</description>

';

// save root folder
$path = JPATH_ROOT . '/components/com_templateck/projects/' . $templatename;

// list files to archive
$files = JFolder::files($path, false, true, true);

$xmltext .= "\t<files>\r\n";

$tmppath = str_replace('\\', '/', $path);
foreach ($files as $file) {
	$tmpfile = str_replace('\\', '/', $file);
	$tmpfile = str_replace($tmppath, '', $tmpfile);
	$tmpfile = trim($tmpfile, '/');
	$xmltext .= "\t\t<filename>" . $tmpfile . "</filename>\r\n";
}

$xmltext .= "\t</files>\r\n";

// list all positions
$xmltext .= "\t<positions>\r\n";

foreach ($positions as $position) {
	if ($position)
		$xmltext .= "\t\t<position>" . $position . "</position>\r\n";
}

$xmltext .= "\t</positions>\r\n";

// add admin params
if ($joomlaversion == 'j15') {
	$openparams = "\t<params>\r\n";
	$openfield = "\t\t<param";
	$closefield = "\t\t</param>\r\n";
	$closeparams = "\t</params>\r\n";
} else {
	$openparams = "\t<config>
		<fields name=\"params\">
			<fieldset name=\"advanced\">\r\n";
	$openfield = "\t\t\t\t<field";
	$closefield = "\t\t\t\t</field>\r\n";
	$closeparams = "\t\t\t</fieldset>
		</fields>
	</config>\r\n";
}

$xmltext .= $openparams;

$xmltext .= $openfield . " name=\"logolink\" type=\"text\" default=\"\" label=\"Logo link\" description=\"If you want to redirect the page on the logo click\" />\r\n";
$xmltext .= $openfield . " name=\"logotitle\" type=\"text\" default=\"\" label=\"Logo title\" description=\"Choose the alt tag that will be added to the image\" />\r\n";
$xmltext .= $openfield . " name=\"logodescription\" type=\"text\" default=\"\" label=\"Logo description\" description=\"Text that will be added under the logo\" />\r\n";
$xmltext .= $openfield . " name=\"usecsspie\" type=\"radio\" default=\"1\" label=\"Use CSS PIE\" description=\"Launch a script to emulate the CSS3 styles for Internet Explorer\" >\r\n"
		. "\t\t\t\t\t\t<option value=\"1\">JYES</option>\r\n"
		. "\t\t\t\t\t\t<option value=\"0\">JNO</option>\r\n"
		. $closefield;

$xmltext .= $openfield . " name=\"useresponsive\" type=\"radio\" default=\"1\" label=\"Use Responsive mode\" description=\"Adapt your template design for mobile resolutions\" >\r\n"
		. "\t\t\t\t\t\t<option value=\"1\">JYES</option>\r\n"
		. "\t\t\t\t\t\t<option value=\"0\">JNO</option>\r\n"
		. $closefield;

if ($joomlaversion == 'j3') {
	$xmltext .= $openfield . " name=\"usebootstrap\" type=\"radio\" default=\"0\" label=\"Load Bootstrap\" description=\"Add the Bootstrap framework into the template\" >\r\n"
			. "\t\t\t\t\t\t<option value=\"1\">JYES</option>\r\n"
			. "\t\t\t\t\t\t<option value=\"0\">JNO</option>\r\n"
			. $closefield;
}

$xmltext .= $closeparams;

// close the file
if ($joomlaversion == 'j15') {
	$xmltext .= '</install>';
} else {
	$xmltext .= '</extension>';
}

// define path to file
$xmldest = $path . '/templateDetails.xml';

// create the file templateDetails.xml
if (!JFile::write($xmldest, $xmltext)) {
	$msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_TEMPLATEDETAILSXML') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_TEMPLATEDETAILSXML') . '</p>';
}
echo $msg;