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


// retrieve variables
$templatename = JRequest::getVar('templatename');
$templateid = JRequest::getInt('templateid');
$wrapperwidth = JRequest::getInt('wrapperwidth');
$column1width = JRequest::getInt('column1width');
$column2width = JRequest::getInt('column2width');
$blocs = JRequest::getVar('blocs');
$blocs = str_replace("|di|", "#", $blocs);
$blocs = json_decode($blocs);

// save root folder
$path = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'projects' . DS . $templatename;


// define path to file
$templatecssdest = $path . DS . 'css' . DS . 'template.css';
$templatecss_rtldest = $path . DS . 'css' . DS . 'template_rtl.css';
$templatecss_mobiledest = $path . DS . 'css' . DS . 'mobile.css';

$templatecsstext = '';


// create css standard styles
$templatecsstext .= '/* ---------------------------------------
	Standard styles formatting
	created with Template Creator
        on http://www.template-creator.com
-----------------------------------------*/


html {
  height: 101%;
}

body {
  margin: 0;
  padding: 0;
}

* {
    padding: 0;
    margin: 0;
}

h1, h2, h3, h4, h5, h6, .contentheading, .componentheading {
  padding: 3px 0;
  margin: 0;
  line-height: 1.2;
  font-weight: bold;
  font-style: normal;
}
h1, .componentheading {
  font-size: 1.75em;
}
h2, .contentheading {
  font-size: 1.5em;
}
h3 {
  font-size: 1.25em;
}
h4 {
  font-size: 1em;
}

ul, ol {
  padding: .75em 0 .75em 0;
  margin: 0 0 0 35px;
}

ul.menu {
    margin: 0;
}

ul.menu li {
    list-style: none;
}

p {
  padding: 5px 0;
}

address {
  margin: .75em 0;
  font-style: normal;
}

a:focus {
    outline: none;
}

img {
  border: none;
}

em {
  font-style: italic;
}
strong {
  font-weight: bold;
}

form, fieldset {
  margin: 0;
  padding: 0;
  border: none;
}
input, button, select {
  vertical-align: middle;
}

.clr {
	clear : both;
}

#wrapper {
	margin: 0 auto;
}

.full {
	width: 100%;
}

.demi {
	width: 50%;
}

.tiers {
	width: 33.33%;
}

.quart {
	width: 25%;
}

.flexiblemodule, .column, .logobloc {
        float: left;
}

/* ---------------------------------------
	Custom styling
-----------------------------------------*/



';

$template_rtlcsstext = str_replace("float: left;" , "float: right;" , $templatecsstext);

$cssstyles = new CssStyles();

// create css for mobile responsive design
$cssmobilestyles = new CssMobileStyles();
$templatemobilecsstext = $cssmobilestyles->create($templateid, $wrapperwidth, $column1width, $column2width);

// create css for each bloc
foreach ($blocs as $bloc) {
    $templatecsstext .= $cssstyles->create($bloc, $bloc->ckid, 'archive');
    $template_rtlcsstext .= $cssstyles->create($bloc, $bloc->ckid, 'archive', 'rtl');
    //if ($bloc->ckid == 'wrapper') $wrapperwidth = $bloc->blocwidth;
}

// write CSS for mobile
$templatecss_mobiletext = '

/* ---------------------------------------
	Responsive design code
-----------------------------------------*/

@media screen and (max-width: 1024px) {

img {
	max-width: 100% !important;
        height: auto !important;
}

#wrapper {
	width: 950px !important;
}

.hidemobile4 {
	display: none !important;
}

'.$templatemobilecsstext->resolution4.'

}

@media screen and (max-width: 950px) {

#wrapper {
	width: 758px !important;
}

.hidemobile3 {
	display: none !important;
}

'.$templatemobilecsstext->resolution3.'

}

@media screen and (max-width: 758px) {

#wrapper {
	width: 524px !important;
}

.hidemobile2 {
	display: none !important;
}

/*.flexiblemodule {
	width: 50% !important;
}

.flexiblemodule > div.inner {
	margin: 5px !important;
}

.column .moduletable, .column .moduletable_menu {
	float: left;
	width: 45% !important;
	margin: 10px 0 0 0 !important;
	padding: 2% !important;
}

.column div.moduletable:first-child, .column div.moduletable_menu:first-child {
	margin-right: 2% !important;
}*/

'.$templatemobilecsstext->resolution2.'

}

@media screen and (max-width: 524px) {

#wrapper {
	width: 292px !important;
}

.hidemobile1 {
	display: none !important;
}

'.$templatemobilecsstext->resolution1.'

}
';


// create the file template.css
if (!JFile::write($templatecssdest, $templatecsstext)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_TEMPLATECSS') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_TEMPLATECSS') . '</p>';
}

echo $msg;

// create the file template_rtl.css
if (!JFile::write($templatecss_rtldest, $template_rtlcsstext)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_TEMPLATERTLCSS') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_TEMPLATERTLCSS') . '</p>';
}

echo $msg;

// create the file mobile.css
if (!JFile::write($templatecss_mobiledest, $templatecss_mobiletext)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_TEMPLATEMOBILECSS') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_TEMPLATEMOBILECSS') . '</p>';
}

echo $msg;


?>