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
$bodycode = JRequest::getVar('bodycode', '', 'post', 'string', JREQUEST_ALLOWRAW);
$headcode = JRequest::getVar('headcode', '', 'post', 'string', JREQUEST_ALLOWRAW);
$joomlaversion = JRequest::getVar('joomlaversion');
$templatename = JRequest::getVar('templatename');
$creationdate = JRequest::getVar('creationdate');
$author = JRequest::getVar('author');
$authorEmail = JRequest::getVar('authorEmail');
$authorUrl = JRequest::getVar('authorUrl');
$copyright = JRequest::getVar('copyright');
$license = JRequest::getVar('license');
$version = JRequest::getVar('version');
$description = JRequest::getVar('description');
$makearchive = JRequest::getVar('makearchive');
$theme = JRequest::getVar('theme');
$blocs = JRequest::getVar('blocs');
$blocs = str_replace("|di|", "#", $blocs);
$blocs = json_decode($blocs);
$customcss = '';


// create root folder
$path = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'projects' . DS . $templatename;
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
$pathcss = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'projects' . DS . $templatename . DS . 'css';
if (!JFolder::create($pathcss)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_FOLDER_CSS') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_FOLDER_CSS') . '</p>';
}

echo $msg;

// create css folder
$pathfonts = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'projects' . DS . $templatename . DS . 'css' . DS . 'fonts';
if (!JFolder::create($pathfonts)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_FOLDER_FONTS') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_FOLDER_FONTS') . '</p>';
}

echo $msg;


// create images folder
$pathimg = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'projects' . DS . $templatename . DS . 'images';
if (!JFolder::create($pathimg)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_FOLDER_IMAGES') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_FOLDER_IMAGES') . '</p>';
}

echo $msg;


// create images system folder
$pathimgsystem = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'projects' . DS . $templatename . DS . 'images' . DS . 'system';
if (!JFolder::create($pathimgsystem)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_FOLDER_IMAGES') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_FOLDER_IMAGES') . '</p>';
}

echo $msg;

if ($joomlaversion == 'j15') {
    // create params.ini file for joomla 1.5
    $paramsinicontent = '';
    if (!JFile::write($path . DS . 'params.ini', $paramsinicontent)) {
        $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_PARAMSINI') . '</p>';
    } else {
        $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_PARAMSINI') . '</p>';
    }

    echo $msg;
}
// create default.css file
$defaultcsssrc = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'default.css';
$defaultcssdest = $path . DS . 'css' . DS . 'default.css';

if (!JFile::copy($defaultcsssrc, $defaultcssdest)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_DEFAULTCSS_PROJECTS') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_DEFAULTCSS_PROJECTS') . '</p>';
}

echo $msg;

// create default_rtl.css file
$defaultcsssrc = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'default_rtl.css';
$defaultcssdest = $path . DS . 'css' . DS . 'default_rtl.css';

if (!JFile::copy($defaultcsssrc, $defaultcssdest)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_DEFAULTCSS_PROJECTS') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_DEFAULTCSS_PROJECTS') . '</p>';
}

echo $msg;

// create custom.css file if exists
if ($customcss) {
    if (!JFile::write($path . '/css/custom.css', $customcss)) {
        $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_CUSTOMCSS') . '</p>';
        echo $msg;
    }
}

// create index.html file (root)
$indexhtmlsrc = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'index.html';
$indexhtmldest = $path . DS . 'index.html';

if (!JFile::copy($indexhtmlsrc, $indexhtmldest)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_INDEXHTML_PROJECTS') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_INDEXHTML_PROJECTS') . '</p>';
}

echo $msg;

// create index.html file (css)
$indexhtmldest = $path . DS . 'css' . DS . 'index.html';

if (!JFile::copy($indexhtmlsrc, $indexhtmldest)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_INDEXHTML_CSS') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_INDEXHTML_CSS') . '</p>';
}

echo $msg;

// create index.html file (css)
$indexhtmldest = $path . DS . 'css' . DS . 'fonts' . DS . 'index.html';

if (!JFile::copy($indexhtmlsrc, $indexhtmldest)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_INDEXHTML_CSS') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_INDEXHTML_CSS') . '</p>';
}

echo $msg;

// create the file font.css
$fontscontent = '';
if (!JFile::write($path . DS . 'css' . DS . 'fonts' . DS . 'fonts.css', $fontscontent)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_FONTSCSS') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_FONTSCSS') . '</p>';
}

echo $msg;


// create index.html file (images)
$indexhtmldest = $path . DS . 'images' . DS . 'index.html';

if (!JFile::copy($indexhtmlsrc, $indexhtmldest)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_INDEXHTML_IMAGES') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_INDEXHTML_IMAGES') . '</p>';
}

echo $msg;


// create index.html file (images system)
$indexhtmldest = $path . DS . 'images' . DS . 'system' . DS . 'index.html';

if (!JFile::copy($indexhtmlsrc, $indexhtmldest)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_INDEXHTML_IMAGES') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_INDEXHTML_IMAGES') . '</p>';
}

echo $msg;


// create index.html file (images system)
$logosrc = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . "projects" . DS . 'logo.png';
$logodest = $path . DS . 'images' . DS . 'logo.png';

if (!JFile::copy($logosrc, $logodest)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_LOGO_IMAGES') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_LOGO_IMAGES') . '</p>';
}

echo $msg;

// copy all images from background image
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
            if ($systemimage == 'emailsystemimageurl') $destimgname = 'images' . DS . 'system' . DS . 'emailButton.png';
            if ($systemimage == 'printsystemimageurl') $destimgname = 'images' . DS . 'system' . DS . 'printButton.png';
            if ($systemimage == 'ratingblanksystemimageurl') $destimgname = 'images' . DS . 'system' . DS . 'rating_star_blank.png';
            if ($systemimage == 'ratingfilledsystemimageurl') $destimgname = 'images' . DS . 'system' . DS . 'rating_star.png';
            if ($systemimage == 'editsystemimageurl') $destimgname = 'images' . DS . 'system' . DS . 'edit.png';
            if ($systemimage == 'arrowsystemimageurl') $destimgname = 'images' . DS . 'system' . DS . 'arrow.png';
            if ($systemimage == 'faviconsystemimageurl') $destimgname = 'favicon.ico';
            if ($systemimage == 'template_thumbnailsystemimageurl') $destimgname = 'template_thumbnail.png';
            if ($systemimage == 'template_previewsystemimageurl') $destimgname = 'template_preview.png';
            $imgurl = str_replace("/", DS, $bloc->$systemimage);

            $imgname = explode("/", $bloc->$systemimage);
            $imgname = end($imgname);

            $imagesdest = $path . DS . $destimgname;
            $imagessrc = JPATH_ROOT . DS . $imgurl;

            if (!JFile::copy($imagessrc, $imagesdest)) {
                $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_IMAGEFILES') . ' ' . $imgname . '</p>';
            } else {
                $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_IMAGEFILES') . ' ' . $imgname . '</p>';
            }
            echo $msg;
        }
    }
    // copy the background image in the template folder
    /* if (isset($bloc->blocbackgroundimageurl) AND $bloc->blocbackgroundimageurl) {
      $bgimgurl = str_replace("/", DS, $bloc->blocbackgroundimageurl);

      $bgimgname = explode("/", $bloc->blocbackgroundimageurl);
      $bgimgname = end($bgimgname);

      $imagesdest = $path . DS . 'images' . DS . $bgimgname;
      $imagessrc = JPATH_ROOT . DS . $bgimgurl;

      if (!JFile::copy($imagessrc, $imagesdest)) {
      $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_IMAGEFILES') . '</p>';
      } else {
      $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_IMAGEFILES') . '</p>';
      }
      echo $msg;
      } */

    if ((isset($bloc->class) AND
            ((stristr($bloc->class, 'flexiblemodule'))
            OR (stristr($bloc->class, 'maincenter'))
            OR (stristr($bloc->class, 'center '))
            OR (stristr($bloc->class, 'column')))))
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
        if (!in_array("#" . $bloc->ckid . " ul.menu > li > a", $pieIds) AND (isset($bloc->$level0itemPIEproperty) AND $bloc->$level0itemPIEproperty)
                OR (isset($bloc->$level0itemhoverPIEproperty) AND $bloc->$level0itemhoverPIEproperty)
                OR (isset($bloc->$level0itemactivePIEproperty) AND $bloc->$level0itemactivePIEproperty))
            $pieIds[] = "#" . $bloc->ckid . " ul.menu > li > a";
        if (isset($bloc->$level1bgPIEproperty) AND $bloc->$level1bgPIEproperty AND !in_array("#" . $bloc->ckid . " ul.menu ul", $pieIds))
            $pieIds[] = "#" . $bloc->ckid . " ul.menu ul";
        if (!in_array("#" . $bloc->ckid . " ul.menu li ul li a", $pieIds) AND (isset($bloc->$level1itemPIEproperty) AND $bloc->$level1itemPIEproperty)
                OR (isset($bloc->$level1itemhoverPIEproperty) AND $bloc->$level1itemhoverPIEproperty)
                OR (isset($bloc->$level1itemactivePIEproperty) AND $bloc->$level1itemactivePIEproperty))
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
        if (!in_array("#" . $bloc->ckid . " ul.menu > li > a", $pieIds) AND (isset($bloc->$pagenavbuttonPIEproperty) AND $bloc->$pagenavbuttonPIEproperty)
                OR (isset($bloc->$pagenavbuttonhoverPIEproperty) AND $bloc->$pagenavbuttonhoverPIEproperty))
            $pieIds[] = ".pagenav a";
        if (!in_array("#" . $bloc->ckid . " ul.menu > li > a", $pieIds) AND (isset($bloc->$readmorebuttonPIEproperty) AND $bloc->$readmorebuttonPIEproperty)
                OR (isset($bloc->$readmorebuttonhoverPIEproperty) AND $bloc->$readmorebuttonhoverPIEproperty))
            $pieIds[] = ".readmore a";
        if (!in_array("#" . $bloc->ckid . " ul.menu > li > a", $pieIds) AND (isset($bloc->$buttonbuttonPIEproperty) AND $bloc->$buttonbuttonPIEproperty)
                OR (isset($bloc->$buttonbuttonhoverPIEproperty) AND $bloc->$buttonbuttonhoverPIEproperty))
            $pieIds[] = ".button";
        if (!in_array("#" . $bloc->ckid . " ul.menu > li > a", $pieIds) AND (isset($bloc->$inputfieldbuttonPIEproperty) AND $bloc->$inputfieldbuttonPIEproperty)
                OR (isset($bloc->$inputfieldbuttonactivePIEproperty) AND $bloc->$inputfieldbuttonactivePIEproperty))
            $pieIds[] = "input.inputbox, .registration input, .login input, .contact input, .contact textarea";
    }
}

// Construct the PIE string and call to the script
$pieIds = implode(',', $pieIds);
$indexphppie = '';
if ($pieIds) {
    $piehtcsrc = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'pie.htc';
    $piehtcdest = $path . DS . 'pie.htc';

    if (!JFile::copy($piehtcsrc, $piehtcdest)) {
        $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_PIEHTC') . '</p>';
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
        <div class="item-page"><h1>Titre de la page H1</h1>
		<h2>
                    <a href="">Joomla! - Titre H2</a>
                </h2>
		<ul class="actions">
			<li class="print-icon">
				<a href="" title="Imprimer" onclick="window.open(this.href,\'win2\',\'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no\'); return false;" rel="nofollow"><img src="/joomla1.6.0dev/media/system/images/printButton.png" alt="Imprimer"  /></a>				</li>

			<li class="email-icon">
				<a href="" title="E-mail" onclick="window.open(this.href,\'win2\',\'width=400,height=350,menubar=yes,resizable=yes\'); return false;"><img src="/joomla1.6.0dev/media/system/images/emailButton.png" alt="E-mail"  /></a>				</li>
		</ul>
                <span class="content_rating">Note utilisateur:<img src="/joomla1.6.0dev/media/system/images/rating_star_blank.png" alt=""  /><img src="/joomla1.6.0dev/media/system/images/rating_star_blank.png" alt=""  /><img src="/joomla1.6.0dev/media/system/images/rating_star_blank.png" alt=""  /><img src="/joomla1.6.0dev/media/system/images/rating_star_blank.png" alt=""  /><img src="/joomla1.6.0dev/media/system/images/rating_star_blank.png" alt=""  />&#160;/&#160;0</span>
                <br />
                <form method="post" action=""><span class="content_vote">Mauvais<input type="radio" alt="vote 1 star" name="user_rating" value="1" /><input type="radio" alt="vote 2 star" name="user_rating" value="2" /><input type="radio" alt="vote 3 star" name="user_rating" value="3" /><input type="radio" alt="vote 4 star" name="user_rating" value="4" /><input type="radio" alt="vote 5 star" name="user_rating" value="5" checked="checked" />Très bien&#160;<input class="button" type="submit" name="submit_vote" value="Note" /></span></form>

                <dl class="article-info">
                <dt class="article-info-term">Détails</dt>
		<dd class="category-name">
										Catégorie : <a href="/joomla1.6.0dev/index.php/utiliser-joomla/utiliser-extensions/composants/composant-contenu/articles-categorie-liste">Joomla!</a>						</dd>
		<dd class="published">
		Publié le Samedi, 10 juillet 2010 21:00		</dd>
                <dd class="createdby">

							Écrit par Joomla!				</dd>

		<dd class="hits">
		Affichages : 7		</dd>

                </dl>

                <h3>Titre H3</h3>
                <h4>Titre H4</h4>
                <h5>Titre H5</h5>
                <h6>Titre H6</h6>
                <p>Félicitations, vous venez de créer un site Joomla.</p>
                <p>Joomla rend facile la création d\'un site tel que vous le rêvez et simplifie les mises à jour et la maintenance.</p>
                <p>Joomla est une plateforme flexible et puissante, que vous ayez   besoin de créer un petit site pour vous-même ou un énorme site recevant   des centaines de milliers de visiteurs.</p>
                <p>Joomla est Open Source, ce qui   signifie que vous pouvez l\'utiliser comme vous le souhaitez.</p>
                <p class="readmore">
			<a href="">Lire la suite&nbsp;: Joomla!</a>
		</p>

				<ul class="pagenav">
					<li class="pagenav-prev">
						<a href="" rel="next">&lt; Précédent</a>

					</li>
					<li class="pagenav-next">
						<a href="" rel="prev">Suivant &gt;</a>
					</li>
				</ul>
	</div>

', $bodycode);
    $bodycode = str_replace('<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>', JURI::root() . 'components/com_templateck/projects/' . $templatename, $bodycode);
    // check if need to include a theme layout
    $layout = $theme != 'aucun' ? '<link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/layout.css" type="text/css" />' : '';
    $stylesheet = '<?php if ($this->direction == \'rtl\') { ?>
		<link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/default_rtl.css" type="text/css" />
		<link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/template_rtl.css" type="text/css" />
    <?php } else { ?>
		<link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/default.css" type="text/css" />
		<link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/template.css" type="text/css" />
	<?php } ?>

    <link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/fonts/fonts.css" type="text/css" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0" />
    <link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/mobile.css" type="text/css" />';

    if ($customcss) {
    $stylesheet .= '
    <link rel="stylesheet" href="' . JURI::root() . 'components/com_templateck/projects/' . $templatename . '/css/custom.css" type="text/css" />';
}
} else {
    // check if need to include a theme layout
    $layout = $theme != 'aucun' ? '<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/layout.css" type="text/css" />' : '';
    $stylesheet = '<?php if ($this->direction == \'rtl\') { ?>
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
$indexphpdest = $path . DS . 'index.php';

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
$indexphptext .= $headcode;

// close header and open body
$indexphptext .= '</head>
<body>
<div id="wrapper">
';





// inject html code
$indexphptext .= $bodycode;

// close body and html page
$indexphptext .= '
</div>
<jdoc:include type="modules" name="debug" />
</body>
</html>';

// create the file index.php
if (!JFile::write($indexphpdest, $indexphptext)) {
    $msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_INDEXPHP') . '</p>';
} else {
    $msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_INDEXPHP') . '</p>';
}

echo $msg;
?>
