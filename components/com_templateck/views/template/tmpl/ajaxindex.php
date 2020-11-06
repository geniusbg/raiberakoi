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

$bodycode = JRequest::getVar('bodycode', '', 'post', 'string', JREQUEST_ALLOWRAW);
$headcode = JRequest::getVar('headcode', '', 'post', 'string', JREQUEST_ALLOWRAW);
// $bodycode = $app->input->get('bodycode', null, null, JREQUEST_ALLOWRAW);
// $headcode = $app->input->get('headcode', null, null);
$joomlaversion = $app->input->get('joomlaversion');
$templatename = $app->input->get('templatename');
$creationdate = $app->input->get('creationdate');
$author = $app->input->get('author');
$authorEmail = $app->input->get('authorEmail');
$authorUrl = $app->input->get('authorUrl');
$copyright = $app->input->get('copyright');
$license = $app->input->get('license');
$version = $app->input->get('version');
$description = $app->input->get('description');
$makearchive = ($app->input->get('makearchive') != 'preview') ? true : false;
$blocs = $app->input->get('blocs', null, null);
$blocs = stripslashes(str_replace("|di|", "#", $blocs));
$blocs = json_decode($blocs);
$isFluid = (isset($blocs[0]->blocwrapperfluid) && $blocs[0]->blocwrapperfluid == 'fluid') ? true : false;
$loadBootstrap = (isset($blocs[0]->blocloadboostrap) && $blocs[0]->blocloadboostrap == '1') ? true : false;
$customcss = '';

// create root folder
$path = JPATH_ROOT . '/components/com_templateck/projects/' . $templatename;
$msg = '';

// test if a custom css exists
if (JFile::exists($path . '/css/custom.css')) {
	$customcss = JFile::read($path . '/css/custom.css');
}

// delete the entire folder if already exists
if (JFolder::exists($path)) {
	if (!JFolder::delete($path)) {
		$msg = '<p class="errorck">' . JText::_('CK_ERROR_DELETING_FOLDER_PROJECTS') . '</p>';
	} else {
		$msg = '<p class="successck">' . JText::_('CK_SUCCESS_DELETING_FOLDER_PROJECTS') . '</p>';
	}
}
echo $msg;

if (!JFolder::create($path)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_FOLDER_PROJECTS') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_FOLDER_PROJECTS') . '</p>';
}

echo $msg;

// create css folder
$pathcss = JPATH_ROOT . '/components/com_templateck/projects/' . $templatename . '/css';
if (!JFolder::create($pathcss)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_FOLDER_CSS') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_FOLDER_CSS') . '</p>';
}

echo $msg;

// create css folder
$pathfonts = JPATH_ROOT . '/components/com_templateck/projects/' . $templatename . '/css/fonts';
if (!JFolder::create($pathfonts)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_FOLDER_FONTS') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_FOLDER_FONTS') . '</p>';
}

echo $msg;

// create images folder
$pathimg = JPATH_ROOT . '/components/com_templateck/projects/' . $templatename . '/images';
if (!JFolder::create($pathimg)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_FOLDER_IMAGES') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_FOLDER_IMAGES') . '</p>';
}

echo $msg;

// create images system folder
$pathimgsystem = JPATH_ROOT . '/components/com_templateck/projects/' . $templatename . '/images/system';
if (!JFolder::create($pathimgsystem)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_FOLDER_IMAGES') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_FOLDER_IMAGES') . '</p>';
}

echo $msg;

if ($joomlaversion == 'j15') {
	// create params.ini file for joomla 1.5
	$paramsinicontent = '';
	if (!JFile::write($path . '/params.ini', $paramsinicontent)) {
		$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_PARAMSINI') . '</p>';
	} else {
		$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_PARAMSINI') . '</p>';
	}

	echo $msg;
}
// create default.css file
$defaultcsssrc = JPATH_ROOT . '/components/com_templateck/default.css';
$defaultcssdest = $path . '/css/default.css';

if (!JFile::copy($defaultcsssrc, $defaultcssdest)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_DEFAULTCSS_PROJECTS') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_DEFAULTCSS_PROJECTS') . '</p>';
}

echo $msg;

// create default_rtl.css file
$defaultcsssrc = JPATH_ROOT . '/components/com_templateck/default_rtl.css';
$defaultcssdest = $path . '/css/default_rtl.css';

if (!JFile::copy($defaultcsssrc, $defaultcssdest)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_DEFAULTCSS_PROJECTS') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_DEFAULTCSS_PROJECTS') . '</p>';
}
echo $msg;

// create bootstrap.css file
if ($loadBootstrap == '1') {
	$defaultcsssrc = JPATH_ROOT . '/components/com_templateck/assets/bootstrap.css';
	$defaultcssdest = $path . '/css/bootstrap.css';

	if (!JFile::copy($defaultcsssrc, $defaultcssdest)) {
		$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_BOOTSTRAPCSS_PROJECTS') . '</p>';
	} else {
		$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_BOOTSTRAPCSS_PROJECTS') . '</p>';
	}
	echo $msg;

	$defaultimgfoldersrc = JPATH_ROOT . '/components/com_templateck/img';
	$defaultimgfoldersrcdest = $path . '/img';

	if (!JFolder::copy($defaultimgfoldersrc, $defaultimgfoldersrcdest)) {
		$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_BOOTSTRAP_IMG_FOLDER_PROJECTS') . '</p>';
	} else {
		$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_BOOTSTRAP_IMG_FOLDER_PROJECTS') . '</p>';
	}
	echo $msg;
}

// create custom.css file if exists
if ($customcss) {
	if (!JFile::write($path . '/css/custom.css', $customcss)) {
		$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_CUSTOMCSS') . '</p>';
		echo $msg;
	}
}

// create index.html file (root)
$indexhtmlsrc = JPATH_ROOT . '/components/com_templateck/index.html';
$indexhtmldest = $path . '/index.html';

if (!JFile::copy($indexhtmlsrc, $indexhtmldest)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_INDEXHTML_PROJECTS') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_INDEXHTML_PROJECTS') . '</p>';
}
echo $msg;

// create index.html file (css)
$indexhtmldest = $path . '/css/index.html';

if (!JFile::copy($indexhtmlsrc, $indexhtmldest)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_INDEXHTML_CSS') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_INDEXHTML_CSS') . '</p>';
}
echo $msg;

// create index.html file (css)
$indexhtmldest = $path . '/css/fonts/index.html';

if (!JFile::copy($indexhtmlsrc, $indexhtmldest)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_INDEXHTML_CSS') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_INDEXHTML_CSS') . '</p>';
}
echo $msg;

// create the file font.css
$fontscontent = '';
if (!JFile::write($path . '/css/fonts/fonts.css', $fontscontent)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_FONTSCSS') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_FONTSCSS') . '</p>';
}
echo $msg;


// create index.html file (images)
$indexhtmldest = $path . '/images/index.html';

if (!JFile::copy($indexhtmlsrc, $indexhtmldest)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_INDEXHTML_IMAGES') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_INDEXHTML_IMAGES') . '</p>';
}
echo $msg;


// create index.html file (images system)
$indexhtmldest = $path . '/images/system/index.html';

if (!JFile::copy($indexhtmlsrc, $indexhtmldest)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_INDEXHTML_IMAGES') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_INDEXHTML_IMAGES') . '</p>';
}
echo $msg;

$pieIds = Array();
foreach ($blocs as $bloc) {

	$systemimages = array(
		"emailsystemimageurl",
		"printsystemimageurl",
		"ratingblanksystemimageurl",
		"ratingfilledsystemimageurl",
		"editsystemimageurl",
		"arrowsystemimageurl",
		"faviconsystemimageurl",
		"template_thumbnailsystemimageurl",
		"template_previewsystemimageurl");
	foreach ($systemimages as $systemimage) {
		if (isset($bloc->$systemimage) AND $bloc->$systemimage) {
			if ($systemimage == 'emailsystemimageurl')
				$destimgname = 'images/system/emailButton.png';
			if ($systemimage == 'printsystemimageurl')
				$destimgname = 'images/system/printButton.png';
			if ($systemimage == 'ratingblanksystemimageurl')
				$destimgname = 'images/system/rating_star_blank.png';
			if ($systemimage == 'ratingfilledsystemimageurl')
				$destimgname = 'images/system/rating_star.png';
			if ($systemimage == 'editsystemimageurl')
				$destimgname = 'images/system/edit.png';
			if ($systemimage == 'arrowsystemimageurl')
				$destimgname = 'images/system/arrow.png';
			if ($systemimage == 'faviconsystemimageurl')
				$destimgname = 'favicon.ico';
			if ($systemimage == 'template_thumbnailsystemimageurl')
				$destimgname = 'template_thumbnail.png';
			if ($systemimage == 'template_previewsystemimageurl')
				$destimgname = 'template_preview.png';
			$imgurl = $bloc->$systemimage;

			$imgname = explode("/", $bloc->$systemimage);
			$imgname = end($imgname);

			$imagesdest = $path . '/' . $destimgname;
			$imagessrc = JPATH_ROOT . '/' . $imgurl;

			if (!JFile::copy($imagessrc, $imagesdest)) {
				$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_IMAGEFILES') . ' ' . $imgname . '</p>';
			} else {
				$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_IMAGEFILES') . ' ' . $imgname . '</p>';
			}
			echo $msg;
		}
	}

	$bloc->ckid = $bloc->ckid . ' > div.inner';

	// check if it needs some css pie for IE
	$PIEproperties = array(
		"backgroundopacity",
		"borderradiustopleft",
		"borderradiustopright",
		"borderradiusbottomleft",
		"borderradiusbottomright",
		"backgroundcolorend",
		"shadowcolor");

	foreach ($PIEproperties as $PIEproperty) {
		$blocPIEproperty = "bloc" . $PIEproperty;
		$modulePIEproperty = "module" . $PIEproperty;
		$moduletitlePIEproperty = "moduletitle" . $PIEproperty;
		$level0bgPIEproperty = "level0bg" . $PIEproperty;
		$level0itemPIEproperty = "level0item" . $PIEproperty;
		$level0itemhoverPIEproperty = "level0itemhover" . $PIEproperty;
		$level0itemactivePIEproperty = "level0itemactive" . $PIEproperty;
		$level1bgPIEproperty = "level1bg" . $PIEproperty;
		$level1itemPIEproperty = "level1item" . $PIEproperty;
		$level1itemhoverPIEproperty = "level1itemhover" . $PIEproperty;
		$level1itemactivePIEproperty = "level1itemactive" . $PIEproperty;
		$level2bgPIEproperty = "level2bg" . $PIEproperty;
		$h1titlePIEproperty = "h1title" . $PIEproperty;
		$h2titlePIEproperty = "h2title" . $PIEproperty;
		$h3titlePIEproperty = "h3title" . $PIEproperty;
		$h4titlePIEproperty = "h4title" . $PIEproperty;
		$h5titlePIEproperty = "h5title" . $PIEproperty;
		$h6titlePIEproperty = "h6title" . $PIEproperty;
		$pagenavbuttonPIEproperty = "pagenavbutton" . $PIEproperty;
		$pagenavbuttonhoverPIEproperty = "pagenavbuttonhover" . $PIEproperty;
		$readmorebuttonPIEproperty = "readmorebutton" . $PIEproperty;
		$readmorebuttonhoverPIEproperty = "readmorebuttonhover" . $PIEproperty;
		$buttonbuttonPIEproperty = "buttonbutton" . $PIEproperty;
		$buttonbuttonhoverPIEproperty = "buttonbuttonhover" . $PIEproperty;
		$inputfieldbuttonPIEproperty = "inputfieldbutton" . $PIEproperty;
		$inputfieldbuttonactivePIEproperty = "inputfieldbuttonactive" . $PIEproperty;

		// test if the block needs some css pie
		if (isset($bloc->$blocPIEproperty) AND $bloc->$blocPIEproperty AND !in_array("#" . $bloc->ckid, $pieIds))
			$pieIds[] = "#" . $bloc->ckid;
		if (isset($bloc->$modulePIEproperty) AND $bloc->$modulePIEproperty AND !in_array("#" . $bloc->ckid . " .module," . "#" . $bloc->ckid . " .moduletable," . "#" . $bloc->ckid . " .module_menu," . "#" . $bloc->ckid . " .moduletable_menu", $pieIds))
			$pieIds[] = "#" . $bloc->ckid . " .module," . "#" . $bloc->ckid . " .moduletable," . "#" . $bloc->ckid . " .module_menu," . "#" . $bloc->ckid . " .moduletable_menu";
		if (isset($bloc->$moduletitlePIEproperty) AND $bloc->$moduletitlePIEproperty AND !in_array("#" . $bloc->ckid . " .module h3," . "#" . $bloc->ckid . " .moduletable h3," . "#" . $bloc->ckid . " .module_menu h3," . "#" . $bloc->ckid . " .moduletable_menu h3", $pieIds))
			$pieIds[] = "#" . $bloc->ckid . " .module h3," . "#" . $bloc->ckid . " .moduletable h3," . "#" . $bloc->ckid . " .module_menu h3," . "#" . $bloc->ckid . " .moduletable_menu h3";
		if (isset($bloc->$level0bgPIEproperty) AND $bloc->$level0bgPIEproperty AND !in_array("#" . $bloc->ckid . " ul.menu", $pieIds))
			$pieIds[] = "#" . $bloc->ckid . " ul.menu";
		if (!in_array("#" . $bloc->ckid . " ul.menu > li > a", $pieIds) AND (isset($bloc->$level0itemPIEproperty) AND $bloc->$level0itemPIEproperty) OR (isset($bloc->$level0itemhoverPIEproperty) AND $bloc->$level0itemhoverPIEproperty) OR (isset($bloc->$level0itemactivePIEproperty) AND $bloc->$level0itemactivePIEproperty))
			$pieIds[] = "#" . $bloc->ckid . " ul.menu > li > a";
		if (isset($bloc->$level1bgPIEproperty) AND $bloc->$level1bgPIEproperty AND !in_array("#" . $bloc->ckid . " ul.menu ul", $pieIds))
			$pieIds[] = "#" . $bloc->ckid . " ul.menu ul";
		if (!in_array("#" . $bloc->ckid . " ul.menu li ul li a", $pieIds) AND (isset($bloc->$level1itemPIEproperty) AND $bloc->$level1itemPIEproperty) OR (isset($bloc->$level1itemhoverPIEproperty) AND $bloc->$level1itemhoverPIEproperty) OR (isset($bloc->$level1itemactivePIEproperty) AND $bloc->$level1itemactivePIEproperty))
			$pieIds[] = "#" . $bloc->ckid . " ul.menu li ul li a";
		if (isset($bloc->$level2bgPIEproperty) AND $bloc->$level2bgPIEproperty AND !in_array("#" . $bloc->ckid . " ul.menu ul ul", $pieIds))
			$pieIds[] = "#" . $bloc->ckid . " ul.menu ul ul";
		if (isset($bloc->$h1titlePIEproperty) AND $bloc->$h1titlePIEproperty AND !in_array("h1", $pieIds))
			$pieIds[] = "h1";
		if (isset($bloc->$h2titlePIEproperty) AND $bloc->$h2titlePIEproperty AND !in_array("h2", $pieIds))
			$pieIds[] = "h2";
		if (isset($bloc->$h3titlePIEproperty) AND $bloc->$h3titlePIEproperty AND !in_array("h3", $pieIds))
			$pieIds[] = "h3";
		if (isset($bloc->$h4titlePIEproperty) AND $bloc->$h4titlePIEproperty AND !in_array("h4", $pieIds))
			$pieIds[] = "h4";
		if (isset($bloc->$h5titlePIEproperty) AND $bloc->$h5titlePIEproperty AND !in_array("h5", $pieIds))
			$pieIds[] = "h5";
		if (isset($bloc->$h6titlePIEproperty) AND $bloc->$h6titlePIEproperty AND !in_array("h6", $pieIds))
			$pieIds[] = "h6";
		if (!in_array("#" . $bloc->ckid . " ul.menu > li > a", $pieIds) AND (isset($bloc->$pagenavbuttonPIEproperty) AND $bloc->$pagenavbuttonPIEproperty) OR (isset($bloc->$pagenavbuttonhoverPIEproperty) AND $bloc->$pagenavbuttonhoverPIEproperty))
			$pieIds[] = ".pagenav a";
		if (!in_array("#" . $bloc->ckid . " ul.menu > li > a", $pieIds) AND (isset($bloc->$readmorebuttonPIEproperty) AND $bloc->$readmorebuttonPIEproperty) OR (isset($bloc->$readmorebuttonhoverPIEproperty) AND $bloc->$readmorebuttonhoverPIEproperty))
			$pieIds[] = ".readmore a";
		if (!in_array("#" . $bloc->ckid . " ul.menu > li > a", $pieIds) AND (isset($bloc->$buttonbuttonPIEproperty) AND $bloc->$buttonbuttonPIEproperty) OR (isset($bloc->$buttonbuttonhoverPIEproperty) AND $bloc->$buttonbuttonhoverPIEproperty))
			$pieIds[] = ".button";
		if (!in_array("#" . $bloc->ckid . " ul.menu > li > a", $pieIds) AND (isset($bloc->$inputfieldbuttonPIEproperty) AND $bloc->$inputfieldbuttonPIEproperty) OR (isset($bloc->$inputfieldbuttonactivePIEproperty) AND $bloc->$inputfieldbuttonactivePIEproperty))
			$pieIds[] = "input.inputbox, .registration input, .login input, .contact input, .contact textarea";
	}
}

// Construct the PIE string and call to the script
$pieIds = implode(',', $pieIds);
$indexphppie = '';
if ($pieIds) {
	$piehtcsrc = JPATH_ROOT . '/components/com_templateck/pie.htc';
	$piehtcdest = $path . '/pie.htc';

	if (!JFile::copy($piehtcsrc, $piehtcdest)) {
		$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_PIEHTC') . '</p>';
	} else {
		$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_PIEHTC') . '</p>';
	}

	echo $msg;

	if (!$makearchive) {
		$indexphppie = "<!--[if lte IE 8]>
  \t<style type=\"text/css\">
  \t" . $pieIds . " { behavior: url(" . JURI::root() . "components/com_templateck/projects/" . $templatename . "/pie.htc) }
  \t</style>
  \t<![endif]-->";
	} else {
		$indexphppie = "<!--[if lte IE 8]>
  \t<style type=\"text/css\">
  \t" . $pieIds . " { behavior: url(<?php echo \$this->baseurl ?>/templates/<?php echo \$this->template ?>/pie.htc) }
  \t</style>
  \t<![endif]-->";
	}

	$indexphppie = '<?php if ($this->params->get(\'usecsspie\',\'1\')) { ?>' . $indexphppie . '<?php } ?>';
}

/* * * create index.php ** */

// make code for special characters
$headcode = str_replace('|lt|', '<', $headcode);
$headcode = str_replace('|gt|', '>', $headcode);
$headcode = str_replace("|rr|", "\r\n", $headcode);
$headcode = str_replace("|tab|", "\t", $headcode);
$headcode = str_replace("|plus|", "+", $headcode);
$headcode = str_replace("|di|", "#", $headcode);

// make code for special characters
$bodycode = str_replace('|lt|', '<', $bodycode);
$bodycode = str_replace('|gt|', '>', $bodycode);
$bodycode = str_replace("|rr|", "\r\n", $bodycode);
$bodycode = str_replace("|tab|", "\t", $bodycode);
$bodycode = str_replace("|di|", "#", $bodycode);


if (!$makearchive) {
	$bodycode = str_replace('<jdoc:include type="component" />', '
        <div class="item-page">

            <div class="page-header">
                <h2>
                    <a href="javascript:void(0)">Article title - H2</a>
                </h2>
                <div class="btn-group pull-right">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"> <span class="icon-cog"></span> <span class="caret"></span> </a>
                    <ul class="dropdown-menu actions">
                        <li class="print-icon"> <a href="javascript:void(0);" title="Imprimer"><span class="icon-print"></span>&#160;Imprimer&#160;</a> </li>
                        <li class="email-icon"> <a href="javascript:void(0);" title="E-mail"><span class="icon-envelope"></span> E-mail</a> </li>
                    </ul>
                </div>
                <div class="article-info muted">
                    <dl class="article-info">
                        <dt class="article-info-term">Détails</dt>
                        <dd class="createdby">Written by Joomla</dd>
                        <dd class="category-name">Category : <a href="javascript:void(0)">Joomla!</a></dd>
                        <dd class="published"><span class="icon-calendar"></span>Published: 01 January 2011</dd>
                        <dd class="hits"><span class="icon-eye-open"></span>Hits: 2</dd>
                    </dl>
                </div>
                <p>Congratulations! You have a Joomla site! Joomla makes it easy to build a website just the way you want it and keep it simple to update and maintain.</p>
<p>Joomla is a flexible and powerful platform, whether you are building a small site for yourself or a huge site with hundreds of thousands of visitors. Joomla is open source, which means you can make it work just the way you want it to.</p>
<p>The content in this installation of Joomla has been designed to give you an in depth tour of Joomla features.</p>
                <p class="readmore">
                    <a class="btn" href="javascript:void(0)"> <span class="icon-chevron-right"></span>Readmore&nbsp;: Joomla</a>
                </p>
                <h1>H1 title</h1>
                <h2>H2 title</h2>
                <h3>H3 title</h3>
                <h4>H4 title</h4>
                <h5>H5 title</h5>
                <h6>H6 title</h6>
				<ul class="pager pagenav">
					<li class="previous">
						<a href="javascript:void(0)" rel="prev">&lt; Prev</a>
					</li>
					<li class="next">
						<a href="javascript:void(0)" rel="next">Next &gt;</a>
					</li>
				</ul>
            </div>
        </div>

', $bodycode);
	$bodycode = str_replace('<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>', JURI::root() . 'components/com_templateck/projects/' . $templatename, $bodycode);
	$layout = '<link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/layout.css" type="text/css" />';
	$stylesheet = '<?php if ($this->params->get(\'usebootstrap\',\'' . $loadBootstrap . '\')) { ?>
        <?php JHtml::_(\'bootstrap.framework\'); ?>
        <link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/bootstrap.css" type="text/css" />
        <?php JHtmlBootstrap::loadCss($includeMaincss = false, $this->direction); ?>
    <?php } ?>
    <?php if ($this->direction == \'rtl\') { ?>
		<link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/default_rtl.css" type="text/css" />
		<link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/template_rtl.css" type="text/css" />
    <?php } else { ?>
		<link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/default.css" type="text/css" />
		<link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/template.css" type="text/css" />
	<?php } ?>

    <link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/fonts/fonts.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/mobile.css" type="text/css" />';

	if ($customcss) {
		$stylesheet .= '
    <link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/custom.css" type="text/css" />';
	}
} else {
	$layout = '<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/layout.css" type="text/css" />';
	$stylesheet = '<?php if ($this->params->get(\'usebootstrap\',\'' . $loadBootstrap . '\')) { ?>
        <?php JHtml::_(\'bootstrap.framework\'); ?>
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/bootstrap.css" type="text/css" />
        <?php JHtmlBootstrap::loadCss($includeMaincss = false, $this->direction); ?>
    <?php } ?>
    <?php if ($this->direction == \'rtl\') { ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/default_rtl.css" type="text/css" />
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template_rtl.css" type="text/css" />
    <?php } else { ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/default.css" type="text/css" />
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
	<?php } ?>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/fonts/fonts.css" type="text/css" />
    <?php if ($this->params->get(\'useresponsive\',\'1\')) { ?>
        <meta name="viewport" content="width=device-width; initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/mobile.css" type="text/css" />
    <?php } ?>';

	if ($customcss) {
		$stylesheet .= '
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/custom.css" type="text/css" />';
	}
}



// define path to file
$indexphpdest = $path . '/index.php';

// create header
$indexphptext = '<?php

/**
 * @copyright	' . $copyright . '
 * ' . $authorUrl . '
 * Template made with the joomla component Template Creator CK - http://www.joomlack.fr
 * ' . $templatename . '
 * @license ' . $license . '
 * @version ' . $version . '
 * */

// No direct access to this file
defined(\'_JEXEC\') or die(\'Restricted access\');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
    <jdoc:include type="head" />
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
    ' . $stylesheet . '
    ' . $indexphppie . '
';

// inject php code in document head
$indexphptext .= stripslashes($headcode);
$containerClass = $isFluid ? 'container-fluid' : 'container';
$indexphptext .= '</head>
<body>
';

// inject html code
$indexphptext .= stripslashes($bodycode);

// close body and html page
$indexphptext .= '
    </div>
</div>
<jdoc:include type="modules" name="debug" />
</body>
</html>';

// create the file index.php
if (!JFile::write($indexphpdest, $indexphptext)) {
	$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_INDEXPHP') . '</p>';
} else {
	$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_INDEXPHP') . '</p>';
}
echo $msg;