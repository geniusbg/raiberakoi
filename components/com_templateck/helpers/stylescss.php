<?php

/**
 * @name		Template Creator CK 3
 * @package		com_templateck
 * @copyright	Copyright (C) 2013. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */
// No direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.file');

/**
 * CssStyles is a class to manage the styles
 *
 * @author Cedric KEIFLIN http://www.joomlack.fr
 */
class CssStyles extends JObject {

	/**
	 * Test if there is already a unit, else add the px
	 *
	 * @param string $value
	 * @return string
	 */
	function testUnit($value, $defaultunit = "px") {

		if ((stristr($value, 'px')) OR (stristr($value, 'em')) OR (stristr($value, '%')))
			return $value;

		return $value . $defaultunit;
	}

	public function create($fields, $id, $action = 'preview', $class = '', $direction = 'ltr') {

		if (!$id)
			return "";

		if (!$fields)
			$fields = new stdClass();

		$cssparams = $fields;
		if ($action == 'preview') {
			$cssparams->class = $class;
		}

		// define prefixes
		if ($id == 'body') {
			$prefixes = array(
				"pagenavbutton",
				"pagenavbuttonhover",
				"readmorebutton",
				"readmorebuttonhover",
				"buttonbutton",
				"buttonbuttonhover",
				"inputfieldbutton",
				"inputfieldbuttonactive",
				"level0bg",
				"level0item",
				"level0itemhover",
				"level0itemactive",
				"level1bg",
				"level1item",
				"level1itemhover",
				"level1itemactive",
				"level2bg",
				"h1title",
				"h2title",
				"h3title",
				"h4title",
				"h5title",
				"h6title",
				"bloc",
				"module",
				"moduletitle",
				"body");
		} else {
			$prefixes = array(
				"level0bg",
				"level0item",
				"level0itemhover",
				"level0itemactive",
				"level1bg",
				"level1item",
				"level1itemhover",
				"level1itemactive",
				"level2bg",
				"bloc",
				"module",
				"moduletitle",
				"body");
		}

		$cssstyles = new stdClass();
		foreach ($prefixes as $prefix) {
			$cssstyles->$prefix = new stdClass();
			$cssstyles->$prefix->css = CssStyles::genCss($cssparams, $prefix, $action, $id, $direction);
		}

		if (isset($cssparams->class) AND
				stristr($cssparams->class, 'bannerlogo')) {
			$cssstyles->logodesc = new stdClass();
			$cssstyles->logodesc->css = CssStyles::genCss($cssparams, 'logodesc', $action, $id, $direction);
		}

		if (isset($cssparams->class) && stristr($cssparams->class, 'bannerlogo')) {
			$cssstyles->bloc->css['height'] = "";
			$cssstyles->bloc->css['width'] = "";
		}
		$id = ($id == 'body' AND $action != 'preview') ? 'body' : "#" . $id;

		if (isset($cssparams->class) AND
				stristr($cssparams->class, 'body')) {
			$idbloc = $id;
		} else {
			$idbloc = $id . ' > div.inner';
		}

		$styles = "";

		if (isset($cssparams->class) && stristr($cssparams->class, 'body')) {
			$styles .= ".container, .container-fluid {
\tmargin: 0 auto;
}
";
		}

		if ($cssstyles->bloc->css['width'] && isset($cssparams->class) && !stristr($cssparams->class, 'body')) {
			$styles .= "
" . $id . " {
"
					. $cssstyles->bloc->css['width']
					. "}
";
			$cssstyles->bloc->css['width'] = '';
		} else if ($cssstyles->bloc->css['width'] && stristr($cssparams->class, 'body')) {
			$styles .= "
.container {
"
					. $this->testUnit($cssstyles->bloc->css['width'], 'px')
					. "}

.container-fluid {
"
					. "\tmax-" . trim($this->testUnit($cssstyles->bloc->css['width'], 'px'))
					. "
}
";
			$cssstyles->bloc->css['width'] = '';
		}

		if (isset($cssparams->class) AND stristr($cssparams->class, 'wrapper')) {
			if (isset($cssstyles->body) && ($cssstyles->body->css['background'] OR $cssstyles->body->css['gradient'] OR $cssstyles->body->css['borders'] OR $cssstyles->body->css['borderradius'] OR $cssstyles->body->css['height'] OR $cssstyles->body->css['width'] OR $cssstyles->body->css['color'] OR $cssstyles->body->css['margins'] OR $cssstyles->body->css['paddings'] OR $cssstyles->body->css['alignement'] OR $cssstyles->body->css['shadow'] OR $cssstyles->body->css['fontbold'] OR $cssstyles->body->css['fontitalic'] OR $cssstyles->body->css['fontunderline'] OR $cssstyles->body->css['fontuppercase'] OR $cssstyles->body->css['letterspacing'] OR $cssstyles->body->css['wordspacing'] OR $cssstyles->body->css['textindent'] OR $cssstyles->body->css['lineheight'] OR $cssstyles->body->css['fontsize'] OR $cssstyles->body->css['fontfamily'] OR $cssstyles->body->css['custom'])) {
				$styles .= "
" . $id . " {
"
						. $cssstyles->body->css['background']
						. $cssstyles->body->css['gradient']
						. $cssstyles->body->css['borders']
						. $cssstyles->body->css['borderradius']
						. $cssstyles->body->css['height']
						. $cssstyles->body->css['width']
						. $cssstyles->body->css['color']
						. $cssstyles->body->css['margins']
						. $cssstyles->body->css['paddings']
						. $cssstyles->body->css['alignement']
						. $cssstyles->body->css['shadow']
						. $cssstyles->body->css['fontbold']
						. $cssstyles->body->css['fontitalic']
						. $cssstyles->body->css['fontunderline']
						. $cssstyles->body->css['fontuppercase']
						. $cssstyles->body->css['letterspacing']
						. $cssstyles->body->css['wordspacing']
						. $cssstyles->body->css['textindent']
						. $cssstyles->body->css['lineheight']
						. $cssstyles->body->css['fontsize']
						. $cssstyles->body->css['fontfamily']
						. $cssstyles->body->css['custom']
						//. "overflow: hidden;
						. "
                    }
";
			}
		}

		if (isset($cssparams->class) AND
				stristr($cssparams->class, 'bannerlogo')) {

			if ($cssstyles->logodesc->css['background'] OR $cssstyles->logodesc->css['gradient'] OR $cssstyles->logodesc->css['borders'] OR $cssstyles->logodesc->css['borderradius'] OR $cssstyles->logodesc->css['height'] OR $cssstyles->logodesc->css['width'] OR $cssstyles->logodesc->css['color'] OR $cssstyles->logodesc->css['margins'] OR $cssstyles->logodesc->css['paddings'] OR $cssstyles->logodesc->css['alignement'] OR $cssstyles->logodesc->css['shadow'] OR $cssstyles->logodesc->css['fontbold'] OR $cssstyles->logodesc->css['fontitalic'] OR $cssstyles->logodesc->css['fontunderline'] OR $cssstyles->logodesc->css['fontuppercase'] OR $cssstyles->logodesc->css['letterspacing'] OR $cssstyles->logodesc->css['wordspacing'] OR $cssstyles->logodesc->css['textindent'] OR $cssstyles->logodesc->css['lineheight'] OR $cssstyles->logodesc->css['fontsize'] OR $cssstyles->logodesc->css['fontfamily'] OR $cssstyles->logodesc->css['custom']) {
				$styles .= "
" . $idbloc . " > .bannerlogodesc {
"
						. $cssstyles->logodesc->css['background']
						. $cssstyles->logodesc->css['gradient']
						. $cssstyles->logodesc->css['borders']
						. $cssstyles->logodesc->css['borderradius']
						. $cssstyles->logodesc->css['height']
						. $cssstyles->logodesc->css['width']
						. $cssstyles->logodesc->css['color']
						. $cssstyles->logodesc->css['margins']
						. $cssstyles->logodesc->css['paddings']
						. $cssstyles->logodesc->css['alignement']
						. $cssstyles->logodesc->css['shadow']
						. $cssstyles->logodesc->css['fontbold']
						. $cssstyles->logodesc->css['fontitalic']
						. $cssstyles->logodesc->css['fontunderline']
						. $cssstyles->logodesc->css['fontuppercase']
						. $cssstyles->logodesc->css['letterspacing']
						. $cssstyles->logodesc->css['wordspacing']
						. $cssstyles->logodesc->css['textindent']
						. $cssstyles->logodesc->css['lineheight']
						. $cssstyles->logodesc->css['fontsize']
						. $cssstyles->logodesc->css['fontfamily']
						. $cssstyles->logodesc->css['custom']
						. "}
";
			}
		}

		if ($cssstyles->bloc->css['background'] OR $cssstyles->bloc->css['gradient'] OR $cssstyles->bloc->css['borders'] OR $cssstyles->bloc->css['borderradius'] OR $cssstyles->bloc->css['height'] OR $cssstyles->bloc->css['width'] OR $cssstyles->bloc->css['color'] OR $cssstyles->bloc->css['margins'] OR $cssstyles->bloc->css['paddings'] OR $cssstyles->bloc->css['alignement'] OR $cssstyles->bloc->css['shadow'] OR $cssstyles->bloc->css['fontbold'] OR $cssstyles->bloc->css['fontitalic'] OR $cssstyles->bloc->css['fontunderline'] OR $cssstyles->bloc->css['fontuppercase'] OR $cssstyles->bloc->css['letterspacing'] OR $cssstyles->bloc->css['wordspacing'] OR $cssstyles->bloc->css['textindent'] OR $cssstyles->bloc->css['lineheight'] OR $cssstyles->bloc->css['fontsize'] OR $cssstyles->bloc->css['fontfamily'] OR $cssstyles->bloc->css['custom']) {
			$styles .= "
" . $idbloc . " {
"
					. $cssstyles->bloc->css['background']
					. $cssstyles->bloc->css['gradient']
					. $cssstyles->bloc->css['borders']
					. $cssstyles->bloc->css['borderradius']
					. $cssstyles->bloc->css['height']
					. $cssstyles->bloc->css['width']
					. $cssstyles->bloc->css['color']
					. $cssstyles->bloc->css['margins']
					. $cssstyles->bloc->css['paddings']
					. $cssstyles->bloc->css['alignement']
					. $cssstyles->bloc->css['shadow']
					. $cssstyles->bloc->css['fontbold']
					. $cssstyles->bloc->css['fontitalic']
					. $cssstyles->bloc->css['fontunderline']
					. $cssstyles->bloc->css['fontuppercase']
					. $cssstyles->bloc->css['letterspacing']
					. $cssstyles->bloc->css['wordspacing']
					. $cssstyles->bloc->css['textindent']
					. $cssstyles->bloc->css['lineheight']
					. $cssstyles->bloc->css['fontsize']
					. $cssstyles->bloc->css['fontfamily']
					. $cssstyles->bloc->css['custom']
					. "}
";
		}

		if ($id != 'body' && $id != '#wrapper' && ((isset($cssparams->class) && !stristr($cssparams->class, 'bannerlogo')) OR !isset($cssparams->class))) {
			if ($cssstyles->module->css['background'] OR $cssstyles->module->css['gradient'] OR $cssstyles->module->css['borders'] OR $cssstyles->module->css['borderradius'] OR $cssstyles->module->css['height'] OR $cssstyles->module->css['width'] OR $cssstyles->module->css['color'] OR $cssstyles->module->css['margins'] OR $cssstyles->module->css['paddings'] OR $cssstyles->module->css['alignement'] OR $cssstyles->module->css['shadow'] OR $cssstyles->module->css['fontbold'] OR $cssstyles->module->css['fontitalic'] OR $cssstyles->module->css['fontunderline'] OR $cssstyles->module->css['fontuppercase'] OR $cssstyles->module->css['letterspacing'] OR $cssstyles->module->css['wordspacing'] OR $cssstyles->module->css['textindent'] OR $cssstyles->module->css['lineheight'] OR $cssstyles->module->css['fontsize'] OR $cssstyles->module->css['fontfamily'] OR $cssstyles->module->css['custom']) {
				$styles .= "
" . $id . " div.moduletable, " . $id . " div.module,
" . $id . " div.moduletable_menu, " . $id . " div.module_menu {
"
						. $cssstyles->module->css['background']
						. $cssstyles->module->css['gradient']
						. $cssstyles->module->css['borders']
						. $cssstyles->module->css['borderradius']
						. $cssstyles->module->css['height']
						. $cssstyles->module->css['width']
						. $cssstyles->module->css['color']
						. $cssstyles->module->css['margins']
						. $cssstyles->module->css['paddings']
						. $cssstyles->module->css['alignement']
						. $cssstyles->module->css['shadow']
						. $cssstyles->module->css['fontbold']
						. $cssstyles->module->css['fontitalic']
						. $cssstyles->module->css['fontunderline']
						. $cssstyles->module->css['fontuppercase']
						. $cssstyles->module->css['letterspacing']
						. $cssstyles->module->css['wordspacing']
						. $cssstyles->module->css['textindent']
						. $cssstyles->module->css['lineheight']
						. $cssstyles->module->css['fontsize']
						. $cssstyles->module->css['fontfamily']
						. $cssstyles->module->css['custom']
						. "}
";
			}

			if ($cssstyles->moduletitle->css['background'] OR $cssstyles->moduletitle->css['gradient'] OR $cssstyles->moduletitle->css['borders'] OR $cssstyles->moduletitle->css['borderradius'] OR $cssstyles->moduletitle->css['height'] OR $cssstyles->moduletitle->css['width'] OR $cssstyles->moduletitle->css['color'] OR $cssstyles->moduletitle->css['margins'] OR $cssstyles->moduletitle->css['paddings'] OR $cssstyles->moduletitle->css['alignement'] OR $cssstyles->moduletitle->css['shadow'] OR $cssstyles->moduletitle->css['fontbold'] OR $cssstyles->moduletitle->css['fontitalic'] OR $cssstyles->moduletitle->css['fontunderline'] OR $cssstyles->moduletitle->css['fontuppercase'] OR $cssstyles->moduletitle->css['letterspacing'] OR $cssstyles->moduletitle->css['wordspacing'] OR $cssstyles->moduletitle->css['textindent'] OR $cssstyles->moduletitle->css['lineheight'] OR $cssstyles->moduletitle->css['fontsize'] OR $cssstyles->moduletitle->css['fontfamily'] OR $cssstyles->moduletitle->css['custom']) {
				$styles .= "
" . $id . " div.moduletable h3, " . $id . " div.module h3,
" . $id . " div.moduletable_menu h3, " . $id . " div.module_menu h3 {
"
						. $cssstyles->moduletitle->css['background']
						. $cssstyles->moduletitle->css['gradient']
						. $cssstyles->moduletitle->css['borders']
						. $cssstyles->moduletitle->css['borderradius']
						. $cssstyles->moduletitle->css['height']
						. $cssstyles->moduletitle->css['width']
						. $cssstyles->moduletitle->css['color']
						. $cssstyles->moduletitle->css['margins']
						. $cssstyles->moduletitle->css['paddings']
						. $cssstyles->moduletitle->css['alignement']
						. $cssstyles->moduletitle->css['shadow']
						. $cssstyles->moduletitle->css['fontbold']
						. $cssstyles->moduletitle->css['fontitalic']
						. $cssstyles->moduletitle->css['fontunderline']
						. $cssstyles->moduletitle->css['fontuppercase']
						. $cssstyles->moduletitle->css['letterspacing']
						. $cssstyles->moduletitle->css['wordspacing']
						. $cssstyles->moduletitle->css['textindent']
						. $cssstyles->moduletitle->css['lineheight']
						. $cssstyles->moduletitle->css['fontsize']
						. $cssstyles->moduletitle->css['fontfamily']
						. $cssstyles->moduletitle->css['custom']
						. "}
";
			}

			if ($cssstyles->bloc->css['normallinkcolor'] OR $cssstyles->bloc->css['normallinkfontbold'] OR $cssstyles->bloc->css['normallinkfontitalic'] OR $cssstyles->bloc->css['normallinkfontunderline'] OR $cssstyles->bloc->css['normallinkfontuppercase']) {
				$styles .= "
" . $id . " a {
"
						. $cssstyles->bloc->css['normallinkcolor']
						. $cssstyles->bloc->css['normallinkfontbold']
						. $cssstyles->bloc->css['normallinkfontitalic']
						. $cssstyles->bloc->css['normallinkfontunderline']
						. $cssstyles->bloc->css['normallinkfontuppercase']
						. "}

";
			}

			if ($cssstyles->bloc->css['hoverlinkcolor'] OR $cssstyles->bloc->css['hoverlinkfontbold'] OR $cssstyles->bloc->css['hoverlinkfontitalic'] OR $cssstyles->bloc->css['hoverlinkfontunderline'] OR $cssstyles->bloc->css['hoverlinkfontuppercase']) {
				$styles .= "
" . $id . " a:hover {
"
						. $cssstyles->bloc->css['hoverlinkcolor']
						. $cssstyles->bloc->css['hoverlinkfontbold']
						. $cssstyles->bloc->css['hoverlinkfontitalic']
						. $cssstyles->bloc->css['hoverlinkfontunderline']
						. $cssstyles->bloc->css['hoverlinkfontuppercase']
						. "}
";
			}
		}

		/** css pour le body seulement * */
		if (stristr($id, 'body')) {
			$id = $action == 'preview' ? "#body " : "";
			/* ------------------ styles des liens --------------------- */
			if ($cssstyles->bloc->css['normallinkcolor'] OR $cssstyles->bloc->css['normallinkfontbold'] OR $cssstyles->bloc->css['normallinkfontitalic'] OR $cssstyles->bloc->css['normallinkfontunderline'] OR $cssstyles->bloc->css['normallinkfontuppercase']) {
				$styles .= "
" . $id . "a {
"
						. $cssstyles->bloc->css['normallinkcolor']
						. $cssstyles->bloc->css['normallinkfontbold']
						. $cssstyles->bloc->css['normallinkfontitalic']
						. $cssstyles->bloc->css['normallinkfontunderline']
						. $cssstyles->bloc->css['normallinkfontuppercase']
						. "}

";
			}

			if ($cssstyles->bloc->css['hoverlinkcolor'] OR $cssstyles->bloc->css['hoverlinkfontbold'] OR $cssstyles->bloc->css['hoverlinkfontitalic'] OR $cssstyles->bloc->css['hoverlinkfontunderline'] OR $cssstyles->bloc->css['hoverlinkfontuppercase']) {
				$styles .= "
" . $id . "a:hover {
"
						. $cssstyles->bloc->css['hoverlinkcolor']
						. $cssstyles->bloc->css['hoverlinkfontbold']
						. $cssstyles->bloc->css['hoverlinkfontitalic']
						. $cssstyles->bloc->css['hoverlinkfontunderline']
						. $cssstyles->bloc->css['hoverlinkfontuppercase']
						. "}
";
			}

			/* ---------- styles pour titres de page H1 ------------- */
			if ($cssstyles->h1title->css['background'] OR $cssstyles->h1title->css['gradient'] OR $cssstyles->h1title->css['borders'] OR $cssstyles->h1title->css['borderradius'] OR $cssstyles->h1title->css['height'] OR $cssstyles->h1title->css['width'] OR $cssstyles->h1title->css['color'] OR $cssstyles->h1title->css['margins'] OR $cssstyles->h1title->css['paddings'] OR $cssstyles->h1title->css['alignement'] OR $cssstyles->h1title->css['shadow'] OR $cssstyles->h1title->css['fontbold'] OR $cssstyles->h1title->css['fontitalic'] OR $cssstyles->h1title->css['fontunderline'] OR $cssstyles->h1title->css['fontuppercase'] OR $cssstyles->h1title->css['letterspacing'] OR $cssstyles->h1title->css['wordspacing'] OR $cssstyles->h1title->css['textindent'] OR $cssstyles->h1title->css['lineheight'] OR $cssstyles->h1title->css['fontsize'] OR $cssstyles->h1title->css['fontfamily'] OR $cssstyles->h1title->css['custom']) {
				$styles .= "
" . $id . "h1, div.componentheading {
"
						. $cssstyles->h1title->css['background']
						. $cssstyles->h1title->css['gradient']
						. $cssstyles->h1title->css['borders']
						. $cssstyles->h1title->css['borderradius']
						. $cssstyles->h1title->css['height']
						. $cssstyles->h1title->css['width']
						. $cssstyles->h1title->css['color']
						. $cssstyles->h1title->css['margins']
						. $cssstyles->h1title->css['paddings']
						. $cssstyles->h1title->css['alignement']
						. $cssstyles->h1title->css['shadow']
						. $cssstyles->h1title->css['fontbold']
						. $cssstyles->h1title->css['fontitalic']
						. $cssstyles->h1title->css['fontunderline']
						. $cssstyles->h1title->css['fontuppercase']
						. $cssstyles->h1title->css['letterspacing']
						. $cssstyles->h1title->css['wordspacing']
						. $cssstyles->h1title->css['textindent']
						. $cssstyles->h1title->css['lineheight']
						. $cssstyles->h1title->css['fontsize']
						. $cssstyles->h1title->css['fontfamily']
						. $cssstyles->h1title->css['custom']
						. "}
";
			}

			if ($cssstyles->h1title->css['normallinkcolor'] OR $cssstyles->h1title->css['normallinkfontbold'] OR $cssstyles->h1title->css['normallinkfontitalic'] OR $cssstyles->h1title->css['normallinkfontunderline'] OR $cssstyles->h1title->css['normallinkfontuppercase']) {
				$styles .= "
" . $id . "h1 a, div.componentheading a {
"
						. $cssstyles->h1title->css['normallinkcolor']
						. $cssstyles->h1title->css['normallinkfontbold']
						. $cssstyles->h1title->css['normallinkfontitalic']
						. $cssstyles->h1title->css['normallinkfontunderline']
						. $cssstyles->h1title->css['normallinkfontuppercase']
						. "}

";
			}

			if ($cssstyles->h1title->css['hoverlinkcolor'] OR $cssstyles->h1title->css['hoverlinkfontbold'] OR $cssstyles->h1title->css['hoverlinkfontitalic'] OR $cssstyles->h1title->css['hoverlinkfontunderline'] OR $cssstyles->h1title->css['hoverlinkfontuppercase']) {
				$styles .= "
" . $id . "h1 a:hover, div.componentheading a:hover {
"
						. $cssstyles->h1title->css['hoverlinkcolor']
						. $cssstyles->h1title->css['hoverlinkfontbold']
						. $cssstyles->h1title->css['hoverlinkfontitalic']
						. $cssstyles->h1title->css['hoverlinkfontunderline']
						. $cssstyles->h1title->css['hoverlinkfontuppercase']
						. "}
";
			}

			/* ---------- styles pour titres de page H2 ------------- */

			if ($cssstyles->h2title->css['background'] OR $cssstyles->h2title->css['gradient'] OR $cssstyles->h2title->css['borders'] OR $cssstyles->h2title->css['borderradius'] OR $cssstyles->h2title->css['height'] OR $cssstyles->h2title->css['width'] OR $cssstyles->h2title->css['color'] OR $cssstyles->h2title->css['margins'] OR $cssstyles->h2title->css['paddings'] OR $cssstyles->h2title->css['alignement'] OR $cssstyles->h2title->css['shadow'] OR $cssstyles->h2title->css['fontbold'] OR $cssstyles->h2title->css['fontitalic'] OR $cssstyles->h2title->css['fontunderline'] OR $cssstyles->h2title->css['fontuppercase'] OR $cssstyles->h2title->css['letterspacing'] OR $cssstyles->h2title->css['wordspacing'] OR $cssstyles->h2title->css['textindent'] OR $cssstyles->h2title->css['lineheight'] OR $cssstyles->h2title->css['fontsize'] OR $cssstyles->h2title->css['fontfamily'] OR $cssstyles->h2title->css['custom']) {
				$styles .= "
" . $id . "h2, div.contentheading {
"
						. $cssstyles->h2title->css['background']
						. $cssstyles->h2title->css['gradient']
						. $cssstyles->h2title->css['borders']
						. $cssstyles->h2title->css['borderradius']
						. $cssstyles->h2title->css['height']
						. $cssstyles->h2title->css['width']
						. $cssstyles->h2title->css['color']
						. $cssstyles->h2title->css['margins']
						. $cssstyles->h2title->css['paddings']
						. $cssstyles->h2title->css['alignement']
						. $cssstyles->h2title->css['shadow']
						. $cssstyles->h2title->css['fontbold']
						. $cssstyles->h2title->css['fontitalic']
						. $cssstyles->h2title->css['fontunderline']
						. $cssstyles->h2title->css['fontuppercase']
						. $cssstyles->h2title->css['letterspacing']
						. $cssstyles->h2title->css['wordspacing']
						. $cssstyles->h2title->css['textindent']
						. $cssstyles->h2title->css['lineheight']
						. $cssstyles->h2title->css['fontsize']
						. $cssstyles->h2title->css['fontfamily']
						. $cssstyles->h2title->css['custom']
						. "}
";
			}

			if ($cssstyles->h2title->css['normallinkcolor'] OR $cssstyles->h2title->css['normallinkfontbold'] OR $cssstyles->h2title->css['normallinkfontitalic'] OR $cssstyles->h2title->css['normallinkfontunderline'] OR $cssstyles->h2title->css['normallinkfontuppercase']) {
				$styles .= "
" . $id . "h2 a, div.contentheading a {
"
						. $cssstyles->h2title->css['normallinkcolor']
						. $cssstyles->h2title->css['normallinkfontbold']
						. $cssstyles->h2title->css['normallinkfontitalic']
						. $cssstyles->h2title->css['normallinkfontunderline']
						. $cssstyles->h2title->css['normallinkfontuppercase']
						. "}

";
			}

			if ($cssstyles->h2title->css['hoverlinkcolor'] OR $cssstyles->h2title->css['hoverlinkfontbold'] OR $cssstyles->h2title->css['hoverlinkfontitalic'] OR $cssstyles->h2title->css['hoverlinkfontunderline'] OR $cssstyles->h2title->css['hoverlinkfontuppercase']) {
				$styles .= "
" . $id . "h2 a:hover, div.contentheading a:hover {
"
						. $cssstyles->h2title->css['hoverlinkcolor']
						. $cssstyles->h2title->css['hoverlinkfontbold']
						. $cssstyles->h2title->css['hoverlinkfontitalic']
						. $cssstyles->h2title->css['hoverlinkfontunderline']
						. $cssstyles->h2title->css['hoverlinkfontuppercase']
						. "}
";
			}

			/* ---------- styles pour titres de page H3 ------------- */

			if ($cssstyles->h3title->css['background'] OR $cssstyles->h3title->css['gradient'] OR $cssstyles->h3title->css['borders'] OR $cssstyles->h3title->css['borderradius'] OR $cssstyles->h3title->css['height'] OR $cssstyles->h3title->css['width'] OR $cssstyles->h3title->css['color'] OR $cssstyles->h3title->css['margins'] OR $cssstyles->h3title->css['paddings'] OR $cssstyles->h3title->css['alignement'] OR $cssstyles->h3title->css['shadow'] OR $cssstyles->h3title->css['fontbold'] OR $cssstyles->h3title->css['fontitalic'] OR $cssstyles->h3title->css['fontunderline'] OR $cssstyles->h3title->css['fontuppercase'] OR $cssstyles->h3title->css['letterspacing'] OR $cssstyles->h3title->css['wordspacing'] OR $cssstyles->h3title->css['textindent'] OR $cssstyles->h3title->css['lineheight'] OR $cssstyles->h3title->css['fontsize'] OR $cssstyles->h3title->css['fontfamily'] OR $cssstyles->h3title->css['custom']) {
				$styles .= "
" . $id . "h3 {
"
						. $cssstyles->h3title->css['background']
						. $cssstyles->h3title->css['gradient']
						. $cssstyles->h3title->css['borders']
						. $cssstyles->h3title->css['borderradius']
						. $cssstyles->h3title->css['height']
						. $cssstyles->h3title->css['width']
						. $cssstyles->h3title->css['color']
						. $cssstyles->h3title->css['margins']
						. $cssstyles->h3title->css['paddings']
						. $cssstyles->h3title->css['alignement']
						. $cssstyles->h3title->css['shadow']
						. $cssstyles->h3title->css['fontbold']
						. $cssstyles->h3title->css['fontitalic']
						. $cssstyles->h3title->css['fontunderline']
						. $cssstyles->h3title->css['fontuppercase']
						. $cssstyles->h3title->css['letterspacing']
						. $cssstyles->h3title->css['wordspacing']
						. $cssstyles->h3title->css['textindent']
						. $cssstyles->h3title->css['lineheight']
						. $cssstyles->h3title->css['fontsize']
						. $cssstyles->h3title->css['fontfamily']
						. $cssstyles->h3title->css['custom']
						. "}
";
			}

			if ($cssstyles->h3title->css['normallinkcolor'] OR $cssstyles->h3title->css['normallinkfontbold'] OR $cssstyles->h3title->css['normallinkfontitalic'] OR $cssstyles->h3title->css['normallinkfontunderline'] OR $cssstyles->h3title->css['normallinkfontuppercase']) {
				$styles .= "
" . $id . "h3 a {
"
						. $cssstyles->h3title->css['normallinkcolor']
						. $cssstyles->h3title->css['normallinkfontbold']
						. $cssstyles->h3title->css['normallinkfontitalic']
						. $cssstyles->h3title->css['normallinkfontunderline']
						. $cssstyles->h3title->css['normallinkfontuppercase']
						. "}

";
			}

			if ($cssstyles->h3title->css['hoverlinkcolor'] OR $cssstyles->h3title->css['hoverlinkfontbold'] OR $cssstyles->h3title->css['hoverlinkfontitalic'] OR $cssstyles->h3title->css['hoverlinkfontunderline'] OR $cssstyles->h3title->css['hoverlinkfontuppercase']) {
				$styles .= "
" . $id . "h3 a:hover {
"
						. $cssstyles->h3title->css['hoverlinkcolor']
						. $cssstyles->h3title->css['hoverlinkfontbold']
						. $cssstyles->h3title->css['hoverlinkfontitalic']
						. $cssstyles->h3title->css['hoverlinkfontunderline']
						. $cssstyles->h3title->css['hoverlinkfontuppercase']
						. "}
";
			}


			/* ---------- styles pour titres de page H4 ------------- */

			if ($cssstyles->h4title->css['background'] OR $cssstyles->h4title->css['gradient'] OR $cssstyles->h4title->css['borders'] OR $cssstyles->h4title->css['borderradius'] OR $cssstyles->h4title->css['height'] OR $cssstyles->h4title->css['width'] OR $cssstyles->h4title->css['color'] OR $cssstyles->h4title->css['margins'] OR $cssstyles->h4title->css['paddings'] OR $cssstyles->h4title->css['alignement'] OR $cssstyles->h4title->css['shadow'] OR $cssstyles->h4title->css['fontbold'] OR $cssstyles->h4title->css['fontitalic'] OR $cssstyles->h4title->css['fontunderline'] OR $cssstyles->h4title->css['fontuppercase'] OR $cssstyles->h4title->css['letterspacing'] OR $cssstyles->h4title->css['wordspacing'] OR $cssstyles->h4title->css['textindent'] OR $cssstyles->h4title->css['lineheight'] OR $cssstyles->h4title->css['fontsize'] OR $cssstyles->h4title->css['fontfamily'] OR $cssstyles->h4title->css['custom']) {
				$styles .= "
" . $id . "h4 {
"
						. $cssstyles->h4title->css['background']
						. $cssstyles->h4title->css['gradient']
						. $cssstyles->h4title->css['borders']
						. $cssstyles->h4title->css['borderradius']
						. $cssstyles->h4title->css['height']
						. $cssstyles->h4title->css['width']
						. $cssstyles->h4title->css['color']
						. $cssstyles->h4title->css['margins']
						. $cssstyles->h4title->css['paddings']
						. $cssstyles->h4title->css['alignement']
						. $cssstyles->h4title->css['shadow']
						. $cssstyles->h4title->css['fontbold']
						. $cssstyles->h4title->css['fontitalic']
						. $cssstyles->h4title->css['fontunderline']
						. $cssstyles->h4title->css['fontuppercase']
						. $cssstyles->h4title->css['letterspacing']
						. $cssstyles->h4title->css['wordspacing']
						. $cssstyles->h4title->css['textindent']
						. $cssstyles->h4title->css['lineheight']
						. $cssstyles->h4title->css['fontsize']
						. $cssstyles->h4title->css['fontfamily']
						. $cssstyles->h4title->css['custom']
						. "}
";
			}

			if ($cssstyles->h4title->css['normallinkcolor'] OR $cssstyles->h4title->css['normallinkfontbold'] OR $cssstyles->h4title->css['normallinkfontitalic'] OR $cssstyles->h4title->css['normallinkfontunderline'] OR $cssstyles->h4title->css['normallinkfontuppercase']) {
				$styles .= "
" . $id . "h4 a {
"
						. $cssstyles->h4title->css['normallinkcolor']
						. $cssstyles->h4title->css['normallinkfontbold']
						. $cssstyles->h4title->css['normallinkfontitalic']
						. $cssstyles->h4title->css['normallinkfontunderline']
						. $cssstyles->h4title->css['normallinkfontuppercase']
						. "}

";
			}

			if ($cssstyles->h4title->css['hoverlinkcolor'] OR $cssstyles->h4title->css['hoverlinkfontbold'] OR $cssstyles->h4title->css['hoverlinkfontitalic'] OR $cssstyles->h4title->css['hoverlinkfontunderline'] OR $cssstyles->h4title->css['hoverlinkfontuppercase']) {
				$styles .= "
" . $id . "h4 a:hover {
"
						. $cssstyles->h4title->css['hoverlinkcolor']
						. $cssstyles->h4title->css['hoverlinkfontbold']
						. $cssstyles->h4title->css['hoverlinkfontitalic']
						. $cssstyles->h4title->css['hoverlinkfontunderline']
						. $cssstyles->h4title->css['hoverlinkfontuppercase']
						. "}
";
			}

			/* ---------- styles pour titres de page H5 ------------- */

			if ($cssstyles->h5title->css['background'] OR $cssstyles->h5title->css['gradient'] OR $cssstyles->h5title->css['borders'] OR $cssstyles->h5title->css['borderradius'] OR $cssstyles->h5title->css['height'] OR $cssstyles->h5title->css['width'] OR $cssstyles->h5title->css['color'] OR $cssstyles->h5title->css['margins'] OR $cssstyles->h5title->css['paddings'] OR $cssstyles->h5title->css['alignement'] OR $cssstyles->h5title->css['shadow'] OR $cssstyles->h5title->css['fontbold'] OR $cssstyles->h5title->css['fontitalic'] OR $cssstyles->h5title->css['fontunderline'] OR $cssstyles->h5title->css['fontuppercase'] OR $cssstyles->h5title->css['letterspacing'] OR $cssstyles->h5title->css['wordspacing'] OR $cssstyles->h5title->css['textindent'] OR $cssstyles->h5title->css['lineheight'] OR $cssstyles->h5title->css['fontsize'] OR $cssstyles->h5title->css['fontfamily'] OR $cssstyles->h5title->css['custom']) {
				$styles .= "
" . $id . "h5 {
"
						. $cssstyles->h5title->css['background']
						. $cssstyles->h5title->css['gradient']
						. $cssstyles->h5title->css['borders']
						. $cssstyles->h5title->css['borderradius']
						. $cssstyles->h5title->css['height']
						. $cssstyles->h5title->css['width']
						. $cssstyles->h5title->css['color']
						. $cssstyles->h5title->css['margins']
						. $cssstyles->h5title->css['paddings']
						. $cssstyles->h5title->css['alignement']
						. $cssstyles->h5title->css['shadow']
						. $cssstyles->h5title->css['fontbold']
						. $cssstyles->h5title->css['fontitalic']
						. $cssstyles->h5title->css['fontunderline']
						. $cssstyles->h5title->css['fontuppercase']
						. $cssstyles->h5title->css['letterspacing']
						. $cssstyles->h5title->css['wordspacing']
						. $cssstyles->h5title->css['textindent']
						. $cssstyles->h5title->css['lineheight']
						. $cssstyles->h5title->css['fontsize']
						. $cssstyles->h5title->css['fontfamily']
						. $cssstyles->h5title->css['custom']
						. "}
";
			}

			if ($cssstyles->h5title->css['normallinkcolor'] OR $cssstyles->h5title->css['normallinkfontbold'] OR $cssstyles->h5title->css['normallinkfontitalic'] OR $cssstyles->h5title->css['normallinkfontunderline'] OR $cssstyles->h5title->css['normallinkfontuppercase']) {
				$styles .= "
" . $id . "h5 a {
"
						. $cssstyles->h5title->css['normallinkcolor']
						. $cssstyles->h5title->css['normallinkfontbold']
						. $cssstyles->h5title->css['normallinkfontitalic']
						. $cssstyles->h5title->css['normallinkfontunderline']
						. $cssstyles->h5title->css['normallinkfontuppercase']
						. "}

";
			}

			if ($cssstyles->h5title->css['hoverlinkcolor'] OR $cssstyles->h5title->css['hoverlinkfontbold'] OR $cssstyles->h5title->css['hoverlinkfontitalic'] OR $cssstyles->h5title->css['hoverlinkfontunderline'] OR $cssstyles->h5title->css['hoverlinkfontuppercase']) {
				$styles .= "
" . $id . "h5 a:hover {
"
						. $cssstyles->h5title->css['hoverlinkcolor']
						. $cssstyles->h5title->css['hoverlinkfontbold']
						. $cssstyles->h5title->css['hoverlinkfontitalic']
						. $cssstyles->h5title->css['hoverlinkfontunderline']
						. $cssstyles->h5title->css['hoverlinkfontuppercase']
						. "}
";
			}

			/* ---------- styles pour titres de page H6 ------------- */

			if ($cssstyles->h6title->css['background'] OR $cssstyles->h6title->css['gradient'] OR $cssstyles->h6title->css['borders'] OR $cssstyles->h6title->css['borderradius'] OR $cssstyles->h6title->css['height'] OR $cssstyles->h6title->css['width'] OR $cssstyles->h6title->css['color'] OR $cssstyles->h6title->css['margins'] OR $cssstyles->h6title->css['paddings'] OR $cssstyles->h6title->css['alignement'] OR $cssstyles->h6title->css['shadow'] OR $cssstyles->h6title->css['fontbold'] OR $cssstyles->h6title->css['fontitalic'] OR $cssstyles->h6title->css['fontunderline'] OR $cssstyles->h6title->css['fontuppercase'] OR $cssstyles->h6title->css['letterspacing'] OR $cssstyles->h6title->css['wordspacing'] OR $cssstyles->h6title->css['textindent'] OR $cssstyles->h6title->css['lineheight'] OR $cssstyles->h6title->css['fontsize'] OR $cssstyles->h6title->css['fontfamily'] OR $cssstyles->h6title->css['custom']) {
				$styles .= "
" . $id . "h6 {
"
						. $cssstyles->h6title->css['background']
						. $cssstyles->h6title->css['gradient']
						. $cssstyles->h6title->css['borders']
						. $cssstyles->h6title->css['borderradius']
						. $cssstyles->h6title->css['height']
						. $cssstyles->h6title->css['width']
						. $cssstyles->h6title->css['color']
						. $cssstyles->h6title->css['margins']
						. $cssstyles->h6title->css['paddings']
						. $cssstyles->h6title->css['alignement']
						. $cssstyles->h6title->css['shadow']
						. $cssstyles->h6title->css['fontbold']
						. $cssstyles->h6title->css['fontitalic']
						. $cssstyles->h6title->css['fontunderline']
						. $cssstyles->h6title->css['fontuppercase']
						. $cssstyles->h6title->css['letterspacing']
						. $cssstyles->h6title->css['wordspacing']
						. $cssstyles->h6title->css['textindent']
						. $cssstyles->h6title->css['lineheight']
						. $cssstyles->h6title->css['fontsize']
						. $cssstyles->h6title->css['fontfamily']
						. $cssstyles->h6title->css['custom']
						. "}
";
			}

			if ($cssstyles->h6title->css['normallinkcolor'] OR $cssstyles->h6title->css['normallinkfontbold'] OR $cssstyles->h6title->css['normallinkfontitalic'] OR $cssstyles->h6title->css['normallinkfontunderline'] OR $cssstyles->h6title->css['normallinkfontuppercase']) {
				$styles .= "
" . $id . "h6 a {
"
						. $cssstyles->h6title->css['normallinkcolor']
						. $cssstyles->h6title->css['normallinkfontbold']
						. $cssstyles->h6title->css['normallinkfontitalic']
						. $cssstyles->h6title->css['normallinkfontunderline']
						. $cssstyles->h6title->css['normallinkfontuppercase']
						. "}

";
			}

			if ($cssstyles->h6title->css['hoverlinkcolor'] OR $cssstyles->h6title->css['hoverlinkfontbold'] OR $cssstyles->h6title->css['hoverlinkfontitalic'] OR $cssstyles->h6title->css['hoverlinkfontunderline'] OR $cssstyles->h6title->css['hoverlinkfontuppercase']) {
				$styles .= "
" . $id . "h6 a:hover {
"
						. $cssstyles->h6title->css['hoverlinkcolor']
						. $cssstyles->h6title->css['hoverlinkfontbold']
						. $cssstyles->h6title->css['hoverlinkfontitalic']
						. $cssstyles->h6title->css['hoverlinkfontunderline']
						. $cssstyles->h6title->css['hoverlinkfontuppercase']
						. "}
";
			}

			/** styles pour boutons * */
			if ($cssstyles->buttonbutton->css['background'] OR $cssstyles->buttonbutton->css['gradient'] OR $cssstyles->buttonbutton->css['borders'] OR $cssstyles->buttonbutton->css['borderradius'] OR $cssstyles->buttonbutton->css['height'] OR $cssstyles->buttonbutton->css['width'] OR $cssstyles->buttonbutton->css['color'] OR $cssstyles->buttonbutton->css['margins'] OR $cssstyles->buttonbutton->css['paddings'] OR $cssstyles->buttonbutton->css['alignement'] OR $cssstyles->buttonbutton->css['shadow'] OR $cssstyles->buttonbutton->css['fontbold'] OR $cssstyles->buttonbutton->css['fontitalic'] OR $cssstyles->buttonbutton->css['fontunderline'] OR $cssstyles->buttonbutton->css['fontuppercase'] OR $cssstyles->buttonbutton->css['letterspacing'] OR $cssstyles->buttonbutton->css['wordspacing'] OR $cssstyles->buttonbutton->css['textindent'] OR $cssstyles->buttonbutton->css['lineheight'] OR $cssstyles->buttonbutton->css['fontsize'] OR $cssstyles->buttonbutton->css['fontfamily'] OR $cssstyles->buttonbutton->css['custom']) {

				$styles .= "
" . $id . ".button, button, input.btn {
    border: none;
"
						. $cssstyles->buttonbutton->css['background']
						. $cssstyles->buttonbutton->css['gradient']
						. $cssstyles->buttonbutton->css['borders']
						. $cssstyles->buttonbutton->css['borderradius']
						. $cssstyles->buttonbutton->css['height']
						. $cssstyles->buttonbutton->css['width']
						. $cssstyles->buttonbutton->css['color']
						. $cssstyles->buttonbutton->css['margins']
						. $cssstyles->buttonbutton->css['paddings']
						. $cssstyles->buttonbutton->css['alignement']
						. $cssstyles->buttonbutton->css['shadow']
						. $cssstyles->buttonbutton->css['fontbold']
						. $cssstyles->buttonbutton->css['fontitalic']
						. $cssstyles->buttonbutton->css['fontunderline']
						. $cssstyles->buttonbutton->css['fontuppercase']
						. $cssstyles->buttonbutton->css['letterspacing']
						. $cssstyles->buttonbutton->css['wordspacing']
						. $cssstyles->buttonbutton->css['textindent']
						. $cssstyles->buttonbutton->css['lineheight']
						. $cssstyles->buttonbutton->css['fontsize']
						. $cssstyles->buttonbutton->css['fontfamily']
						. $cssstyles->buttonbutton->css['custom']
						. "}
";
			}

			if ($cssstyles->buttonbuttonhover->css['background'] OR $cssstyles->buttonbuttonhover->css['gradient'] OR $cssstyles->buttonbuttonhover->css['borders'] OR $cssstyles->buttonbuttonhover->css['borderradius'] OR $cssstyles->buttonbuttonhover->css['height'] OR $cssstyles->buttonbuttonhover->css['width'] OR $cssstyles->buttonbuttonhover->css['color'] OR $cssstyles->buttonbuttonhover->css['margins'] OR $cssstyles->buttonbuttonhover->css['paddings'] OR $cssstyles->buttonbuttonhover->css['alignement'] OR $cssstyles->buttonbuttonhover->css['shadow'] OR $cssstyles->buttonbuttonhover->css['fontbold'] OR $cssstyles->buttonbuttonhover->css['fontitalic'] OR $cssstyles->buttonbuttonhover->css['fontunderline'] OR $cssstyles->buttonbuttonhover->css['fontuppercase'] OR $cssstyles->buttonbuttonhover->css['letterspacing'] OR $cssstyles->buttonbuttonhover->css['wordspacing'] OR $cssstyles->buttonbuttonhover->css['textindent'] OR $cssstyles->buttonbuttonhover->css['lineheight'] OR $cssstyles->buttonbuttonhover->css['fontsize'] OR $cssstyles->buttonbuttonhover->css['fontfamily'] OR $cssstyles->buttonbuttonhover->css['custom']) {

				$styles .= "
" . $id . ".button:hover, button:hover, input.btn:hover {
"
						. $cssstyles->buttonbuttonhover->css['background']
						. $cssstyles->buttonbuttonhover->css['gradient']
						. $cssstyles->buttonbuttonhover->css['borders']
						. $cssstyles->buttonbuttonhover->css['borderradius']
						. $cssstyles->buttonbuttonhover->css['height']
						. $cssstyles->buttonbuttonhover->css['width']
						. $cssstyles->buttonbuttonhover->css['color']
						. $cssstyles->buttonbuttonhover->css['margins']
						. $cssstyles->buttonbuttonhover->css['paddings']
						. $cssstyles->buttonbuttonhover->css['alignement']
						. $cssstyles->buttonbuttonhover->css['shadow']
						. $cssstyles->buttonbuttonhover->css['fontbold']
						. $cssstyles->buttonbuttonhover->css['fontitalic']
						. $cssstyles->buttonbuttonhover->css['fontunderline']
						. $cssstyles->buttonbuttonhover->css['fontuppercase']
						. $cssstyles->buttonbuttonhover->css['letterspacing']
						. $cssstyles->buttonbuttonhover->css['wordspacing']
						. $cssstyles->buttonbuttonhover->css['textindent']
						. $cssstyles->buttonbuttonhover->css['lineheight']
						. $cssstyles->buttonbuttonhover->css['fontsize']
						. $cssstyles->buttonbuttonhover->css['fontfamily']
						. $cssstyles->buttonbuttonhover->css['custom']
						. "}
";
			}


			/** navigation de page * */
			if ($cssstyles->pagenavbutton->css['background'] OR $cssstyles->pagenavbutton->css['gradient'] OR $cssstyles->pagenavbutton->css['borders'] OR $cssstyles->pagenavbutton->css['borderradius'] OR $cssstyles->pagenavbutton->css['height'] OR $cssstyles->pagenavbutton->css['width'] OR $cssstyles->pagenavbutton->css['color'] OR $cssstyles->pagenavbutton->css['margins'] OR $cssstyles->pagenavbutton->css['paddings'] OR $cssstyles->pagenavbutton->css['alignement'] OR $cssstyles->pagenavbutton->css['shadow'] OR $cssstyles->pagenavbutton->css['fontbold'] OR $cssstyles->pagenavbutton->css['fontitalic'] OR $cssstyles->pagenavbutton->css['fontunderline'] OR $cssstyles->pagenavbutton->css['fontuppercase'] OR $cssstyles->pagenavbutton->css['letterspacing'] OR $cssstyles->pagenavbutton->css['wordspacing'] OR $cssstyles->pagenavbutton->css['textindent'] OR $cssstyles->pagenavbutton->css['lineheight'] OR $cssstyles->pagenavbutton->css['fontsize'] OR $cssstyles->pagenavbutton->css['fontfamily'] OR $cssstyles->pagenavbutton->css['custom']) {

				$styles .= "
" . $id . "ul.pagenav li a {
    display: block;
"
						. $cssstyles->pagenavbutton->css['background']
						. $cssstyles->pagenavbutton->css['gradient']
						. $cssstyles->pagenavbutton->css['borders']
						. $cssstyles->pagenavbutton->css['borderradius']
						. $cssstyles->pagenavbutton->css['height']
						. $cssstyles->pagenavbutton->css['width']
						. $cssstyles->pagenavbutton->css['color']
						. $cssstyles->pagenavbutton->css['margins']
						. $cssstyles->pagenavbutton->css['paddings']
						. $cssstyles->pagenavbutton->css['alignement']
						. $cssstyles->pagenavbutton->css['shadow']
						. $cssstyles->pagenavbutton->css['fontbold']
						. $cssstyles->pagenavbutton->css['fontitalic']
						. $cssstyles->pagenavbutton->css['fontunderline']
						. $cssstyles->pagenavbutton->css['fontuppercase']
						. $cssstyles->pagenavbutton->css['letterspacing']
						. $cssstyles->pagenavbutton->css['wordspacing']
						. $cssstyles->pagenavbutton->css['textindent']
						. $cssstyles->pagenavbutton->css['lineheight']
						. $cssstyles->pagenavbutton->css['fontsize']
						. $cssstyles->pagenavbutton->css['fontfamily']
						. $cssstyles->pagenavbutton->css['custom']
						. "}
";
			}

			if ($cssstyles->pagenavbuttonhover->css['background'] OR $cssstyles->pagenavbuttonhover->css['gradient'] OR $cssstyles->pagenavbuttonhover->css['borders'] OR $cssstyles->pagenavbuttonhover->css['borderradius'] OR $cssstyles->pagenavbuttonhover->css['height'] OR $cssstyles->pagenavbuttonhover->css['width'] OR $cssstyles->pagenavbuttonhover->css['color'] OR $cssstyles->pagenavbuttonhover->css['margins'] OR $cssstyles->pagenavbuttonhover->css['paddings'] OR $cssstyles->pagenavbuttonhover->css['alignement'] OR $cssstyles->pagenavbuttonhover->css['shadow'] OR $cssstyles->pagenavbuttonhover->css['fontbold'] OR $cssstyles->pagenavbuttonhover->css['fontitalic'] OR $cssstyles->pagenavbuttonhover->css['fontunderline'] OR $cssstyles->pagenavbuttonhover->css['fontuppercase'] OR $cssstyles->pagenavbuttonhover->css['letterspacing'] OR $cssstyles->pagenavbuttonhover->css['wordspacing'] OR $cssstyles->pagenavbuttonhover->css['textindent'] OR $cssstyles->pagenavbuttonhover->css['lineheight'] OR $cssstyles->pagenavbuttonhover->css['fontsize'] OR $cssstyles->pagenavbuttonhover->css['fontfamily'] OR $cssstyles->pagenavbuttonhover->css['custom']) {

				$styles .= "
" . $id . "ul.pagenav li a:hover {
"
						. $cssstyles->pagenavbuttonhover->css['background']
						. $cssstyles->pagenavbuttonhover->css['gradient']
						. $cssstyles->pagenavbuttonhover->css['borders']
						. $cssstyles->pagenavbuttonhover->css['borderradius']
						. $cssstyles->pagenavbuttonhover->css['height']
						. $cssstyles->pagenavbuttonhover->css['width']
						. $cssstyles->pagenavbuttonhover->css['color']
						. $cssstyles->pagenavbuttonhover->css['margins']
						. $cssstyles->pagenavbuttonhover->css['paddings']
						. $cssstyles->pagenavbuttonhover->css['alignement']
						. $cssstyles->pagenavbuttonhover->css['shadow']
						. $cssstyles->pagenavbuttonhover->css['fontbold']
						. $cssstyles->pagenavbuttonhover->css['fontitalic']
						. $cssstyles->pagenavbuttonhover->css['fontunderline']
						. $cssstyles->pagenavbuttonhover->css['fontuppercase']
						. $cssstyles->pagenavbuttonhover->css['letterspacing']
						. $cssstyles->pagenavbuttonhover->css['wordspacing']
						. $cssstyles->pagenavbuttonhover->css['textindent']
						. $cssstyles->pagenavbuttonhover->css['lineheight']
						. $cssstyles->pagenavbuttonhover->css['fontsize']
						. $cssstyles->pagenavbuttonhover->css['fontfamily']
						. $cssstyles->pagenavbuttonhover->css['custom']
						. "}
";
			}

			/** boutons lire la suite * */
			if ($cssstyles->readmorebutton->css['background'] OR $cssstyles->readmorebutton->css['gradient'] OR $cssstyles->readmorebutton->css['borders'] OR $cssstyles->readmorebutton->css['borderradius'] OR $cssstyles->readmorebutton->css['height'] OR $cssstyles->readmorebutton->css['width'] OR $cssstyles->readmorebutton->css['color'] OR $cssstyles->readmorebutton->css['margins'] OR $cssstyles->readmorebutton->css['paddings'] OR $cssstyles->readmorebutton->css['alignement'] OR $cssstyles->readmorebutton->css['shadow'] OR $cssstyles->readmorebutton->css['fontbold'] OR $cssstyles->readmorebutton->css['fontitalic'] OR $cssstyles->readmorebutton->css['fontunderline'] OR $cssstyles->readmorebutton->css['fontuppercase'] OR $cssstyles->readmorebutton->css['letterspacing'] OR $cssstyles->readmorebutton->css['wordspacing'] OR $cssstyles->readmorebutton->css['textindent'] OR $cssstyles->readmorebutton->css['lineheight'] OR $cssstyles->readmorebutton->css['fontsize'] OR $cssstyles->readmorebutton->css['fontfamily'] OR $cssstyles->readmorebutton->css['custom']) {

				$styles .= "
" . $id . ".readmore a {
"
						. $cssstyles->readmorebutton->css['background']
						. $cssstyles->readmorebutton->css['gradient']
						. $cssstyles->readmorebutton->css['borders']
						. $cssstyles->readmorebutton->css['borderradius']
						. $cssstyles->readmorebutton->css['height']
						. $cssstyles->readmorebutton->css['width']
						. $cssstyles->readmorebutton->css['color']
						. $cssstyles->readmorebutton->css['margins']
						. $cssstyles->readmorebutton->css['paddings']
						. $cssstyles->readmorebutton->css['alignement']
						. $cssstyles->readmorebutton->css['shadow']
						. $cssstyles->readmorebutton->css['fontbold']
						. $cssstyles->readmorebutton->css['fontitalic']
						. $cssstyles->readmorebutton->css['fontunderline']
						. $cssstyles->readmorebutton->css['fontuppercase']
						. $cssstyles->readmorebutton->css['letterspacing']
						. $cssstyles->readmorebutton->css['wordspacing']
						. $cssstyles->readmorebutton->css['textindent']
						. $cssstyles->readmorebutton->css['lineheight']
						. $cssstyles->readmorebutton->css['fontsize']
						. $cssstyles->readmorebutton->css['fontfamily']
						. $cssstyles->readmorebutton->css['custom']
						. "}
";
			}

			if ($cssstyles->readmorebuttonhover->css['background'] OR $cssstyles->readmorebuttonhover->css['gradient'] OR $cssstyles->readmorebuttonhover->css['borders'] OR $cssstyles->readmorebuttonhover->css['borderradius'] OR $cssstyles->readmorebuttonhover->css['height'] OR $cssstyles->readmorebuttonhover->css['width'] OR $cssstyles->readmorebuttonhover->css['color'] OR $cssstyles->readmorebuttonhover->css['margins'] OR $cssstyles->readmorebuttonhover->css['paddings'] OR $cssstyles->readmorebuttonhover->css['alignement'] OR $cssstyles->readmorebuttonhover->css['shadow'] OR $cssstyles->readmorebuttonhover->css['fontbold'] OR $cssstyles->readmorebuttonhover->css['fontitalic'] OR $cssstyles->readmorebuttonhover->css['fontunderline'] OR $cssstyles->readmorebuttonhover->css['fontuppercase'] OR $cssstyles->readmorebuttonhover->css['letterspacing'] OR $cssstyles->readmorebuttonhover->css['wordspacing'] OR $cssstyles->readmorebuttonhover->css['textindent'] OR $cssstyles->readmorebuttonhover->css['lineheight'] OR $cssstyles->readmorebuttonhover->css['fontsize'] OR $cssstyles->readmorebuttonhover->css['fontfamily'] OR $cssstyles->readmorebuttonhover->css['custom']) {

				$styles .= "
" . $id . ".readmore a:hover {
"
						. $cssstyles->readmorebuttonhover->css['background']
						. $cssstyles->readmorebuttonhover->css['gradient']
						. $cssstyles->readmorebuttonhover->css['borders']
						. $cssstyles->readmorebuttonhover->css['borderradius']
						. $cssstyles->readmorebuttonhover->css['height']
						. $cssstyles->readmorebuttonhover->css['width']
						. $cssstyles->readmorebuttonhover->css['color']
						. $cssstyles->readmorebuttonhover->css['margins']
						. $cssstyles->readmorebuttonhover->css['paddings']
						. $cssstyles->readmorebuttonhover->css['alignement']
						. $cssstyles->readmorebuttonhover->css['shadow']
						. $cssstyles->readmorebuttonhover->css['fontbold']
						. $cssstyles->readmorebuttonhover->css['fontitalic']
						. $cssstyles->readmorebuttonhover->css['fontunderline']
						. $cssstyles->readmorebuttonhover->css['fontuppercase']
						. $cssstyles->readmorebuttonhover->css['letterspacing']
						. $cssstyles->readmorebuttonhover->css['wordspacing']
						. $cssstyles->readmorebuttonhover->css['textindent']
						. $cssstyles->readmorebuttonhover->css['lineheight']
						. $cssstyles->readmorebuttonhover->css['fontsize']
						. $cssstyles->readmorebuttonhover->css['fontfamily']
						. $cssstyles->readmorebuttonhover->css['custom']
						. "}
";
			}

			/** champs de saisie input et autres * */
			if ($cssstyles->inputfieldbutton->css['background'] OR $cssstyles->inputfieldbutton->css['gradient'] OR $cssstyles->inputfieldbutton->css['borders'] OR $cssstyles->inputfieldbutton->css['borderradius'] OR $cssstyles->inputfieldbutton->css['height'] OR $cssstyles->inputfieldbutton->css['width'] OR $cssstyles->inputfieldbutton->css['color'] OR $cssstyles->inputfieldbutton->css['margins'] OR $cssstyles->inputfieldbutton->css['paddings'] OR $cssstyles->inputfieldbutton->css['alignement'] OR $cssstyles->inputfieldbutton->css['shadow'] OR $cssstyles->inputfieldbutton->css['fontbold'] OR $cssstyles->inputfieldbutton->css['fontitalic'] OR $cssstyles->inputfieldbutton->css['fontunderline'] OR $cssstyles->inputfieldbutton->css['fontuppercase'] OR $cssstyles->inputfieldbutton->css['letterspacing'] OR $cssstyles->inputfieldbutton->css['wordspacing'] OR $cssstyles->inputfieldbutton->css['textindent'] OR $cssstyles->inputfieldbutton->css['lineheight'] OR $cssstyles->inputfieldbutton->css['fontsize'] OR $cssstyles->inputfieldbutton->css['fontfamily'] OR $cssstyles->inputfieldbutton->css['custom']) {
				$styles .= "
" . $id . ".invalid {border: red;}
                ";


				$styles .= "
" . $id . "input.inputbox, " . $id . ".registration input, " . $id . ".login input, " . $id . ".contact input, " . $id . ".contact textarea,
textarea, input[type=\"text\"], input[type=\"password\"], input[type=\"datetime\"], input[type=\"datetime-local\"], input[type=\"date\"], input[type=\"month\"], input[type=\"time\"], input[type=\"week\"], input[type=\"number\"], input[type=\"email\"], input[type=\"url\"], input[type=\"search\"], input[type=\"tel\"], input[type=\"color\"], .uneditable-input {
    border: none;
"
						. $cssstyles->inputfieldbutton->css['background']
						. $cssstyles->inputfieldbutton->css['gradient']
						. $cssstyles->inputfieldbutton->css['borders']
						. $cssstyles->inputfieldbutton->css['borderradius']
						. $cssstyles->inputfieldbutton->css['height']
						. $cssstyles->inputfieldbutton->css['width']
						. $cssstyles->inputfieldbutton->css['color']
						. $cssstyles->inputfieldbutton->css['margins']
						. $cssstyles->inputfieldbutton->css['paddings']
						. $cssstyles->inputfieldbutton->css['alignement']
						. $cssstyles->inputfieldbutton->css['shadow']
						. $cssstyles->inputfieldbutton->css['fontbold']
						. $cssstyles->inputfieldbutton->css['fontitalic']
						. $cssstyles->inputfieldbutton->css['fontunderline']
						. $cssstyles->inputfieldbutton->css['fontuppercase']
						. $cssstyles->inputfieldbutton->css['letterspacing']
						. $cssstyles->inputfieldbutton->css['wordspacing']
						. $cssstyles->inputfieldbutton->css['textindent']
						. $cssstyles->inputfieldbutton->css['lineheight']
						. $cssstyles->inputfieldbutton->css['fontsize']
						. $cssstyles->inputfieldbutton->css['fontfamily']
						. $cssstyles->inputfieldbutton->css['custom']
						. "}
";
			}

			if ($cssstyles->inputfieldbuttonactive->css['background'] OR $cssstyles->inputfieldbuttonactive->css['gradient'] OR $cssstyles->inputfieldbuttonactive->css['borders'] OR $cssstyles->inputfieldbuttonactive->css['borderradius'] OR $cssstyles->inputfieldbuttonactive->css['height'] OR $cssstyles->inputfieldbuttonactive->css['width'] OR $cssstyles->inputfieldbuttonactive->css['color'] OR $cssstyles->inputfieldbuttonactive->css['margins'] OR $cssstyles->inputfieldbuttonactive->css['paddings'] OR $cssstyles->inputfieldbuttonactive->css['alignement'] OR $cssstyles->inputfieldbuttonactive->css['shadow'] OR $cssstyles->inputfieldbuttonactive->css['fontbold'] OR $cssstyles->inputfieldbuttonactive->css['fontitalic'] OR $cssstyles->inputfieldbuttonactive->css['fontunderline'] OR $cssstyles->inputfieldbuttonactive->css['fontuppercase'] OR $cssstyles->inputfieldbuttonactive->css['letterspacing'] OR $cssstyles->inputfieldbuttonactive->css['wordspacing'] OR $cssstyles->inputfieldbuttonactive->css['textindent'] OR $cssstyles->inputfieldbuttonactive->css['lineheight'] OR $cssstyles->inputfieldbuttonactive->css['fontsize'] OR $cssstyles->inputfieldbuttonactive->css['fontfamily'] OR $cssstyles->inputfieldbuttonactive->css['custom']) {

				$styles .= "
" . $id . "input:focus, " . $id . "input.inputbox:focus, " . $id . ".registration input:focus, " . $id . ".login input:focus, " . $id . ".contact input:focus, " . $id . ".contact textarea:focus,
textarea, input[type=\"text\"]:focus, input[type=\"password\"]:focus, input[type=\"datetime\"]:focus, input[type=\"datetime-local\"]:focus, input[type=\"date\"]:focus, input[type=\"month\"]:focus, input[type=\"time\"]:focus, input[type=\"week\"]:focus, input[type=\"number\"]:focus, input[type=\"email\"]:focus, input[type=\"url\"]:focus, input[type=\"search\"]:focus, input[type=\"tel\"]:focus, input[type=\"color\"]:focus, .uneditable-input:focus {
"
						. $cssstyles->inputfieldbuttonactive->css['background']
						. $cssstyles->inputfieldbuttonactive->css['gradient']
						. $cssstyles->inputfieldbuttonactive->css['borders']
						. $cssstyles->inputfieldbuttonactive->css['borderradius']
						. $cssstyles->inputfieldbuttonactive->css['height']
						. $cssstyles->inputfieldbuttonactive->css['width']
						. $cssstyles->inputfieldbuttonactive->css['color']
						. $cssstyles->inputfieldbuttonactive->css['margins']
						. $cssstyles->inputfieldbuttonactive->css['paddings']
						. $cssstyles->inputfieldbuttonactive->css['alignement']
						. $cssstyles->inputfieldbuttonactive->css['shadow']
						. $cssstyles->inputfieldbuttonactive->css['fontbold']
						. $cssstyles->inputfieldbuttonactive->css['fontitalic']
						. $cssstyles->inputfieldbuttonactive->css['fontunderline']
						. $cssstyles->inputfieldbuttonactive->css['fontuppercase']
						. $cssstyles->inputfieldbuttonactive->css['letterspacing']
						. $cssstyles->inputfieldbuttonactive->css['wordspacing']
						. $cssstyles->inputfieldbuttonactive->css['textindent']
						. $cssstyles->inputfieldbuttonactive->css['lineheight']
						. $cssstyles->inputfieldbuttonactive->css['fontsize']
						. $cssstyles->inputfieldbuttonactive->css['fontfamily']
						. $cssstyles->inputfieldbuttonactive->css['custom']
						. "}
";
			}
		} /** fin du code pour body * */
		/* ---------- styles pour menu ------------- */
		if (stristr($cssparams->class, 'horiznav')) {

			$styles .= $id . " ul.menu {
            margin: 0;
            padding: 0;
"
					. $cssstyles->level0bg->css['background']
					. $cssstyles->level0bg->css['gradient']
					. $cssstyles->level0bg->css['borders']
					. $cssstyles->level0bg->css['borderradius']
					. $cssstyles->level0bg->css['height']
					. $cssstyles->level0bg->css['width']
					. $cssstyles->level0bg->css['margins']
					. $cssstyles->level0bg->css['paddings']
					. $cssstyles->level0bg->css['shadow']
					. $cssstyles->level0bg->css['custom']
					. "}

" . $id . " ul.menu li {
	margin: 0;
	padding: 0;
	float: left;
	list-style:none;
        white-space: nowrap;
}

" . $id . " ul.menu > li > a, " . $id . " ul.menu > li > span.separator {
    display:block;
"
					. $cssstyles->level0item->css['background']
					. $cssstyles->level0item->css['gradient']
					. $cssstyles->level0item->css['borders']
					. $cssstyles->level0item->css['borderradius']
					. $cssstyles->level0item->css['height']
					. $cssstyles->level0item->css['width']
					. $cssstyles->level0item->css['color']
					. $cssstyles->level0item->css['margins']
					. $cssstyles->level0item->css['paddings']
					. $cssstyles->level0item->css['alignement']
					. $cssstyles->level0item->css['shadow']
					. $cssstyles->level0item->css['fontbold']
					. $cssstyles->level0item->css['fontitalic']
					. $cssstyles->level0item->css['fontunderline']
					. $cssstyles->level0item->css['fontuppercase']
					. $cssstyles->level0item->css['letterspacing']
					. $cssstyles->level0item->css['wordspacing']
					. $cssstyles->level0item->css['textindent']
					. $cssstyles->level0item->css['lineheight']
					. $cssstyles->level0item->css['fontsize']
					. $cssstyles->level0item->css['fontfamily']
					. $cssstyles->level0item->css['custom']
					. "}

" . $id . " ul.menu > li:hover > a {
"
					. $cssstyles->level0itemhover->css['background']
					. $cssstyles->level0itemhover->css['gradient']
					. $cssstyles->level0itemhover->css['borders']
					. $cssstyles->level0itemhover->css['borderradius']
					. $cssstyles->level0itemhover->css['height']
					. $cssstyles->level0itemhover->css['width']
					. $cssstyles->level0itemhover->css['color']
					. $cssstyles->level0itemhover->css['margins']
					. $cssstyles->level0itemhover->css['paddings']
					. $cssstyles->level0itemhover->css['alignement']
					. $cssstyles->level0itemhover->css['shadow']
					. $cssstyles->level0itemhover->css['fontbold']
					. $cssstyles->level0itemhover->css['fontitalic']
					. $cssstyles->level0itemhover->css['fontunderline']
					. $cssstyles->level0itemhover->css['fontuppercase']
					. $cssstyles->level0itemhover->css['letterspacing']
					. $cssstyles->level0itemhover->css['wordspacing']
					. $cssstyles->level0itemhover->css['textindent']
					. $cssstyles->level0itemhover->css['lineheight']
					. $cssstyles->level0itemhover->css['fontsize']
					. $cssstyles->level0itemhover->css['fontfamily']
					. $cssstyles->level0itemhover->css['custom']
					. "}

" . $id . " ul.menu > li.active > a {
"
					. $cssstyles->level0itemactive->css['background']
					. $cssstyles->level0itemactive->css['gradient']
					. $cssstyles->level0itemactive->css['borders']
					. $cssstyles->level0itemactive->css['borderradius']
					. $cssstyles->level0itemactive->css['height']
					. $cssstyles->level0itemactive->css['width']
					. $cssstyles->level0itemactive->css['color']
					. $cssstyles->level0itemactive->css['margins']
					. $cssstyles->level0itemactive->css['paddings']
					. $cssstyles->level0itemactive->css['alignement']
					. $cssstyles->level0itemactive->css['shadow']
					. $cssstyles->level0itemactive->css['fontbold']
					. $cssstyles->level0itemactive->css['fontitalic']
					. $cssstyles->level0itemactive->css['fontunderline']
					. $cssstyles->level0itemactive->css['fontuppercase']
					. $cssstyles->level0itemactive->css['letterspacing']
					. $cssstyles->level0itemactive->css['wordspacing']
					. $cssstyles->level0itemactive->css['textindent']
					. $cssstyles->level0itemactive->css['lineheight']
					. $cssstyles->level0itemactive->css['fontsize']
					. $cssstyles->level0itemactive->css['fontfamily']
					. $cssstyles->level0itemactive->css['custom']
					. "}

" . $id . " ul.menu li li a, " . $id . " ul.menu li li span.separator {
    display:block;
"
					. $cssstyles->level1item->css['background']
					. $cssstyles->level1item->css['gradient']
					. $cssstyles->level1item->css['borders']
					. $cssstyles->level1item->css['borderradius']
					. $cssstyles->level1item->css['height']
					. $cssstyles->level1item->css['width']
					. $cssstyles->level1item->css['color']
					. $cssstyles->level1item->css['margins']
					. $cssstyles->level1item->css['paddings']
					. $cssstyles->level1item->css['alignement']
					. $cssstyles->level1item->css['shadow']
					. $cssstyles->level1item->css['fontbold']
					. $cssstyles->level1item->css['fontitalic']
					. $cssstyles->level1item->css['fontunderline']
					. $cssstyles->level1item->css['fontuppercase']
					. $cssstyles->level1item->css['letterspacing']
					. $cssstyles->level1item->css['wordspacing']
					. $cssstyles->level1item->css['textindent']
					. $cssstyles->level1item->css['lineheight']
					. $cssstyles->level1item->css['fontsize']
					. $cssstyles->level1item->css['fontfamily']
					. $cssstyles->level1item->css['custom']
					. "}

" . $id . " ul.menu li li:hover > a {
"
					. $cssstyles->level1itemhover->css['background']
					. $cssstyles->level1itemhover->css['gradient']
					. $cssstyles->level1itemhover->css['borders']
					. $cssstyles->level1itemhover->css['borderradius']
					. $cssstyles->level1itemhover->css['height']
					. $cssstyles->level1itemhover->css['width']
					. $cssstyles->level1itemhover->css['color']
					. $cssstyles->level1itemhover->css['margins']
					. $cssstyles->level1itemhover->css['paddings']
					. $cssstyles->level1itemhover->css['alignement']
					. $cssstyles->level1itemhover->css['shadow']
					. $cssstyles->level1itemhover->css['fontbold']
					. $cssstyles->level1itemhover->css['fontitalic']
					. $cssstyles->level1itemhover->css['fontunderline']
					. $cssstyles->level1itemhover->css['fontuppercase']
					. $cssstyles->level1itemhover->css['letterspacing']
					. $cssstyles->level1itemhover->css['wordspacing']
					. $cssstyles->level1itemhover->css['textindent']
					. $cssstyles->level1itemhover->css['lineheight']
					. $cssstyles->level1itemhover->css['fontsize']
					. $cssstyles->level1itemhover->css['fontfamily']
					. $cssstyles->level1itemhover->css['custom']
					. "}

" . $id . " ul.menu li li.active > a {
"
					. $cssstyles->level1itemactive->css['background']
					. $cssstyles->level1itemactive->css['gradient']
					. $cssstyles->level1itemactive->css['borders']
					. $cssstyles->level1itemactive->css['borderradius']
					. $cssstyles->level1itemactive->css['height']
					. $cssstyles->level1itemactive->css['width']
					. $cssstyles->level1itemactive->css['color']
					. $cssstyles->level1itemactive->css['margins']
					. $cssstyles->level1itemactive->css['paddings']
					. $cssstyles->level1itemactive->css['alignement']
					. $cssstyles->level1itemactive->css['shadow']
					. $cssstyles->level1itemactive->css['fontbold']
					. $cssstyles->level1itemactive->css['fontitalic']
					. $cssstyles->level1itemactive->css['fontunderline']
					. $cssstyles->level1itemactive->css['fontuppercase']
					. $cssstyles->level1itemactive->css['letterspacing']
					. $cssstyles->level1itemactive->css['wordspacing']
					. $cssstyles->level1itemactive->css['textindent']
					. $cssstyles->level1itemactive->css['lineheight']
					. $cssstyles->level1itemactive->css['fontsize']
					. $cssstyles->level1itemactive->css['fontfamily']
					. $cssstyles->level1itemactive->css['custom']
					. "}

/* code pour menu normal */
" . $id . " ul.menu li ul, " . $id . " ul.menu li:hover ul ul, " . $id . " ul.menu li:hover ul ul ul {
	position: absolute;
	left: -999em;
	z-index: 999;
        margin: 0;
        padding: 0;
"
					. $cssstyles->level1bg->css['background']
					. $cssstyles->level1bg->css['gradient']
					. $cssstyles->level1bg->css['borders']
					. $cssstyles->level1bg->css['borderradius']
					. $cssstyles->level1bg->css['height']
					. $cssstyles->level1bg->css['width']
					. $cssstyles->level1bg->css['margins']
					. $cssstyles->level1bg->css['paddings']
					. $cssstyles->level1bg->css['shadow']
					. $cssstyles->level1bg->css['custom']
					. "}


" . $id . " ul.menu li:hover ul ul, " . $id . " ul.menu li:hover li:hover ul ul, " . $id . " ul.menu li:hover li:hover li:hover ul ul,
" . $id . " ul.menu li.sfhover ul ul, " . $id . " ul.menu li.sfhover ul.sfhover ul ul, " . $id . " ul.menu li.sfhover ul.sfhover ul.sfhover ul ul {
	left: -999em;
}

" . $id . " ul.menu li:hover > ul, " . $id . " ul.menu li:hover ul li:hover > ul, " . $id . " ul.menu li:hover ul li:hover ul li:hover > ul, " . $id . " ul.menu li:hover ul li:hover ul li:hover ul li:hover > ul,
" . $id . " ul.menu li.sfhover ul, " . $id . " ul.menu li.sfhover ul li.sfhover ul, " . $id . " ul.menu li.sfhover ul li.sfhover ul li.sfhover ul, " . $id . " ul.menu li.sfhover ul li.sfhover ul li.sfhover ul li.sfhover ul {
	left: auto;
}

" . $id . " ul.menu li:hover ul li:hover ul {
"
					. $cssstyles->level2bg->css['background']
					. $cssstyles->level2bg->css['gradient']
					. $cssstyles->level2bg->css['borders']
					. $cssstyles->level2bg->css['borderradius']
					. $cssstyles->level2bg->css['height']
					. $cssstyles->level2bg->css['width']
					. $cssstyles->level2bg->css['margins']
					. $cssstyles->level2bg->css['paddings']
					. $cssstyles->level2bg->css['shadow']
					. $cssstyles->level2bg->css['custom']
					. "}

/* fin code normal */

" . $id . " ul.menu.maximenuCK li ul, " . $id . " ul.menu.maximenuCK li:hover ul ul, " . $id . " ul.menu.maximenuCK li:hover ul ul ul,
" . $id . " ul.menu.maximenuck li ul, " . $id . " ul.menu.maximenuck li:hover ul ul, " . $id . " ul.menu.maximenuck li:hover ul ul ul {
	position: static !important;
	left: auto !important;
	background: transparent !important;
	border-radius: 0 !important;
    border: none !important;
	-moz-border-radius: 0 !important;
	-o-border-radius:  0 !important;
	-webkit-border-radius: 0 !important;
	width: 100% !important;
	box-shadow: none !important;
	-moz-box-shadow: none !important;
	-webkit-box-shadow: none !important;
}

" . $id . " ul.menu.maximenuCK li ul ul,
" . $id . " ul.menu.maximenuck li ul ul {
	margin: 0 !important;
}

" . $id . " li div.floatCK,
" . $id . " li div.floatck {
"
					. $cssstyles->level1bg->css['background']
					. $cssstyles->level1bg->css['gradient']
					. $cssstyles->level1bg->css['borders']
					. $cssstyles->level1bg->css['borderradius']
					. $cssstyles->level1bg->css['height']
					. $cssstyles->level1bg->css['width']
					. $cssstyles->level1bg->css['margins']
					. $cssstyles->level1bg->css['paddings']
					. $cssstyles->level1bg->css['shadow']
					. $cssstyles->level1bg->css['custom']
					. "}

" . $id . " ul.menu li ul.maximenuCK2,
" . $id . " ul.menu li ul.maximenuck2 {
    margin: 0;
    padding: 0;
}

" . $id . " ul.menu li div.maximenuCK2,
" . $id . " ul.menu li div.maximenuck2 {
    float: left;
    width: 100%;
}

" . $id . " ul li.maximenuCK div.floatCK div.floatCK,
" . $id . " ul li.maximenuck div.floatck div.floatck {
"
					. $cssstyles->level2bg->css['background']
					. $cssstyles->level2bg->css['gradient']
					. $cssstyles->level2bg->css['borders']
					. $cssstyles->level2bg->css['borderradius']
					. $cssstyles->level2bg->css['height']
					. $cssstyles->level2bg->css['width']
					. $cssstyles->level2bg->css['margins']
					. $cssstyles->level2bg->css['paddings']
					. $cssstyles->level2bg->css['shadow']
					. $cssstyles->level2bg->css['custom']
					. "}

" . $id . " span.descCK,
" . $id . " span.descck {
    display: block;
    line-height: 10px;
}

" . $id . " ul.menu li li {
    float: none;
    display: block;
}

";
		} else {

			/* ---------------- for menu normal ------------------ */

			if ($cssstyles->level0bg->css['background'] OR $cssstyles->level0bg->css['gradient'] OR $cssstyles->level0bg->css['borders'] OR $cssstyles->level0bg->css['borderradius'] OR $cssstyles->level0bg->css['height'] OR $cssstyles->level0bg->css['width'] OR $cssstyles->level0bg->css['color'] OR $cssstyles->level0bg->css['margins'] OR $cssstyles->level0bg->css['paddings']
//                    OR $cssstyles->level0bg->css['alignement']
					OR $cssstyles->level0bg->css['shadow'] OR $cssstyles->level0bg->css['fontbold'] OR $cssstyles->level0bg->css['fontitalic'] OR $cssstyles->level0bg->css['fontunderline'] OR $cssstyles->level0bg->css['fontuppercase'] OR $cssstyles->level0bg->css['letterspacing'] OR $cssstyles->level0bg->css['wordspacing'] OR $cssstyles->level0bg->css['textindent'] OR $cssstyles->level0bg->css['lineheight'] OR $cssstyles->level0bg->css['fontsize'] OR $cssstyles->level0bg->css['fontfamily'] OR $cssstyles->level0bg->css['custom']) {

				$styles .= "
" . $id . " ul.menu {
"
						. $cssstyles->level0bg->css['background']
						. $cssstyles->level0bg->css['gradient']
						. $cssstyles->level0bg->css['borders']
						. $cssstyles->level0bg->css['borderradius']
						. $cssstyles->level0bg->css['height']
						. $cssstyles->level0bg->css['width']
						. $cssstyles->level0bg->css['color']
						. $cssstyles->level0bg->css['margins']
						. $cssstyles->level0bg->css['paddings']
//                        . $cssstyles->level0bg->css['alignement']
						. $cssstyles->level0bg->css['shadow']
						. $cssstyles->level0bg->css['fontbold']
						. $cssstyles->level0bg->css['fontitalic']
						. $cssstyles->level0bg->css['fontunderline']
						. $cssstyles->level0bg->css['fontuppercase']
						. $cssstyles->level0bg->css['letterspacing']
						. $cssstyles->level0bg->css['wordspacing']
						. $cssstyles->level0bg->css['textindent']
						. $cssstyles->level0bg->css['lineheight']
						. $cssstyles->level0bg->css['fontsize']
						. $cssstyles->level0bg->css['fontfamily']
						. $cssstyles->level0bg->css['custom']
						. "}
";
			}

			/* --------- pour item level 0 ------------ */
			if ($cssstyles->level0item->css['background'] OR $cssstyles->level0item->css['gradient'] OR $cssstyles->level0item->css['borders'] OR $cssstyles->level0item->css['borderradius'] OR $cssstyles->level0item->css['height'] OR $cssstyles->level0item->css['width'] OR $cssstyles->level0item->css['color'] OR $cssstyles->level0item->css['margins'] OR $cssstyles->level0item->css['paddings']
//                    OR $cssstyles->level0item->css['alignement']
					OR $cssstyles->level0item->css['shadow'] OR $cssstyles->level0item->css['fontbold'] OR $cssstyles->level0item->css['fontitalic'] OR $cssstyles->level0item->css['fontunderline'] OR $cssstyles->level0item->css['fontuppercase'] OR $cssstyles->level0item->css['letterspacing'] OR $cssstyles->level0item->css['wordspacing'] OR $cssstyles->level0item->css['textindent'] OR $cssstyles->level0item->css['lineheight'] OR $cssstyles->level0item->css['fontsize'] OR $cssstyles->level0item->css['fontfamily'] OR $cssstyles->level0item->css['custom']) {

				$styles .= "
" . $id . " ul.menu li a, " . $id . " ul.menu li span.separator {
    white-space: nowrap;
}

" . $id . " ul.menu li a, " . $id . " ul.menu li span.separator {
    display: block;
"
						. $cssstyles->level0item->css['background']
						. $cssstyles->level0item->css['gradient']
						. $cssstyles->level0item->css['borders']
						. $cssstyles->level0item->css['borderradius']
						. $cssstyles->level0item->css['height']
						. $cssstyles->level0item->css['width']
						. $cssstyles->level0item->css['color']
						. $cssstyles->level0item->css['margins']
						. $cssstyles->level0item->css['paddings']
//                        . $cssstyles->level0item->css['alignement']
						. $cssstyles->level0item->css['shadow']
						. $cssstyles->level0item->css['fontbold']
						. $cssstyles->level0item->css['fontitalic']
						. $cssstyles->level0item->css['fontunderline']
						. $cssstyles->level0item->css['fontuppercase']
						. $cssstyles->level0item->css['letterspacing']
						. $cssstyles->level0item->css['wordspacing']
						. $cssstyles->level0item->css['textindent']
						. $cssstyles->level0item->css['lineheight']
						. $cssstyles->level0item->css['fontsize']
						. $cssstyles->level0item->css['fontfamily']
						. $cssstyles->level0item->css['custom']
						. "}
";
			}

			if ($cssstyles->level0itemhover->css['background'] OR $cssstyles->level0itemhover->css['gradient'] OR $cssstyles->level0itemhover->css['borders'] OR $cssstyles->level0itemhover->css['borderradius'] OR $cssstyles->level0itemhover->css['height'] OR $cssstyles->level0itemhover->css['width'] OR $cssstyles->level0itemhover->css['color'] OR $cssstyles->level0itemhover->css['margins'] OR $cssstyles->level0itemhover->css['paddings']
//                    OR $cssstyles->level0itemhover->css['alignement']
					OR $cssstyles->level0itemhover->css['shadow'] OR $cssstyles->level0itemhover->css['fontbold'] OR $cssstyles->level0itemhover->css['fontitalic'] OR $cssstyles->level0itemhover->css['fontunderline'] OR $cssstyles->level0itemhover->css['fontuppercase'] OR $cssstyles->level0itemhover->css['letterspacing'] OR $cssstyles->level0itemhover->css['wordspacing'] OR $cssstyles->level0itemhover->css['textindent'] OR $cssstyles->level0itemhover->css['lineheight'] OR $cssstyles->level0itemhover->css['fontsize'] OR $cssstyles->level0itemhover->css['fontfamily'] OR $cssstyles->level0itemhover->css['custom']) {

				$styles .= "
" . $id . " ul.menu li:hover > a, " . $id . " ul.menu li:hover > span.separator {
"
						. $cssstyles->level0itemhover->css['background']
						. $cssstyles->level0itemhover->css['gradient']
						. $cssstyles->level0itemhover->css['borders']
						. $cssstyles->level0itemhover->css['borderradius']
						. $cssstyles->level0itemhover->css['height']
						. $cssstyles->level0itemhover->css['width']
						. $cssstyles->level0itemhover->css['color']
						. $cssstyles->level0itemhover->css['margins']
						. $cssstyles->level0itemhover->css['paddings']
//                        . $cssstyles->level0itemhover->css['alignement']
						. $cssstyles->level0itemhover->css['shadow']
						. $cssstyles->level0itemhover->css['fontbold']
						. $cssstyles->level0itemhover->css['fontitalic']
						. $cssstyles->level0itemhover->css['fontunderline']
						. $cssstyles->level0itemhover->css['fontuppercase']
						. $cssstyles->level0itemhover->css['letterspacing']
						. $cssstyles->level0itemhover->css['wordspacing']
						. $cssstyles->level0itemhover->css['textindent']
						. $cssstyles->level0itemhover->css['lineheight']
						. $cssstyles->level0itemhover->css['fontsize']
						. $cssstyles->level0itemhover->css['fontfamily']
						. $cssstyles->level0itemhover->css['custom']
						. "}
";
			}

			if ($cssstyles->level0itemactive->css['background'] OR $cssstyles->level0itemactive->css['gradient'] OR $cssstyles->level0itemactive->css['borders'] OR $cssstyles->level0itemactive->css['borderradius'] OR $cssstyles->level0itemactive->css['height'] OR $cssstyles->level0itemactive->css['width'] OR $cssstyles->level0itemactive->css['color'] OR $cssstyles->level0itemactive->css['margins'] OR $cssstyles->level0itemactive->css['paddings']
//                    OR $cssstyles->level0itemactive->css['alignement']
					OR $cssstyles->level0itemactive->css['shadow'] OR $cssstyles->level0itemactive->css['fontbold'] OR $cssstyles->level0itemactive->css['fontitalic'] OR $cssstyles->level0itemactive->css['fontunderline'] OR $cssstyles->level0itemactive->css['fontuppercase'] OR $cssstyles->level0itemactive->css['letterspacing'] OR $cssstyles->level0itemactive->css['wordspacing'] OR $cssstyles->level0itemactive->css['textindent'] OR $cssstyles->level0itemactive->css['lineheight'] OR $cssstyles->level0itemactive->css['fontsize'] OR $cssstyles->level0itemactive->css['fontfamily'] OR $cssstyles->level0itemactive->css['custom']) {

				$styles .= "
" . $id . " ul.menu li.active > a, " . $id . " ul.menu li.active > span.separator {
"
						. $cssstyles->level0itemactive->css['background']
						. $cssstyles->level0itemactive->css['gradient']
						. $cssstyles->level0itemactive->css['borders']
						. $cssstyles->level0itemactive->css['borderradius']
						. $cssstyles->level0itemactive->css['height']
						. $cssstyles->level0itemactive->css['width']
						. $cssstyles->level0itemactive->css['color']
						. $cssstyles->level0itemactive->css['margins']
						. $cssstyles->level0itemactive->css['paddings']
//                        . $cssstyles->level0itemactive->css['alignement']
						. $cssstyles->level0itemactive->css['shadow']
						. $cssstyles->level0itemactive->css['fontbold']
						. $cssstyles->level0itemactive->css['fontitalic']
						. $cssstyles->level0itemactive->css['fontunderline']
						. $cssstyles->level0itemactive->css['fontuppercase']
						. $cssstyles->level0itemactive->css['letterspacing']
						. $cssstyles->level0itemactive->css['wordspacing']
						. $cssstyles->level0itemactive->css['textindent']
						. $cssstyles->level0itemactive->css['lineheight']
						. $cssstyles->level0itemactive->css['fontsize']
						. $cssstyles->level0itemactive->css['fontfamily']
						. $cssstyles->level0itemactive->css['custom']
						. "}
";
			}

			if ($cssstyles->level1bg->css['background'] OR $cssstyles->level1bg->css['gradient'] OR $cssstyles->level1bg->css['borders'] OR $cssstyles->level1bg->css['borderradius'] OR $cssstyles->level1bg->css['height'] OR $cssstyles->level1bg->css['width'] OR $cssstyles->level1bg->css['color'] OR $cssstyles->level1bg->css['margins'] OR $cssstyles->level1bg->css['paddings']
//                    OR $cssstyles->level1bg->css['alignement']
					OR $cssstyles->level1bg->css['shadow'] OR $cssstyles->level1bg->css['fontbold'] OR $cssstyles->level1bg->css['fontitalic'] OR $cssstyles->level1bg->css['fontunderline'] OR $cssstyles->level1bg->css['fontuppercase'] OR $cssstyles->level1bg->css['letterspacing'] OR $cssstyles->level1bg->css['wordspacing'] OR $cssstyles->level1bg->css['textindent'] OR $cssstyles->level1bg->css['lineheight'] OR $cssstyles->level1bg->css['fontsize'] OR $cssstyles->level1bg->css['fontfamily'] OR $cssstyles->level1bg->css['custom']) {

				$styles .= "
" . $id . " ul.menu li ul {
"
						. $cssstyles->level1bg->css['background']
						. $cssstyles->level1bg->css['gradient']
						. $cssstyles->level1bg->css['borders']
						. $cssstyles->level1bg->css['borderradius']
						. $cssstyles->level1bg->css['height']
						. $cssstyles->level1bg->css['width']
						. $cssstyles->level1bg->css['color']
						. $cssstyles->level1bg->css['margins']
						. $cssstyles->level1bg->css['paddings']
//                        . $cssstyles->level1bg->css['alignement']
						. $cssstyles->level1bg->css['shadow']
						. $cssstyles->level1bg->css['fontbold']
						. $cssstyles->level1bg->css['fontitalic']
						. $cssstyles->level1bg->css['fontunderline']
						. $cssstyles->level1bg->css['fontuppercase']
						. $cssstyles->level1bg->css['letterspacing']
						. $cssstyles->level1bg->css['wordspacing']
						. $cssstyles->level1bg->css['textindent']
						. $cssstyles->level1bg->css['lineheight']
						. $cssstyles->level1bg->css['fontsize']
						. $cssstyles->level1bg->css['fontfamily']
						. $cssstyles->level1bg->css['custom']
						. "}
";
			}

			/* --------- pour item level 1 ------------ */
			if ($cssstyles->level1item->css['background'] OR $cssstyles->level1item->css['gradient'] OR $cssstyles->level1item->css['borders'] OR $cssstyles->level1item->css['borderradius'] OR $cssstyles->level1item->css['height'] OR $cssstyles->level1item->css['width'] OR $cssstyles->level1item->css['color'] OR $cssstyles->level1item->css['margins'] OR $cssstyles->level1item->css['paddings']
//                    OR $cssstyles->level1item->css['alignement']
					OR $cssstyles->level1item->css['shadow'] OR $cssstyles->level1item->css['fontbold'] OR $cssstyles->level1item->css['fontitalic'] OR $cssstyles->level1item->css['fontunderline'] OR $cssstyles->level1item->css['fontuppercase'] OR $cssstyles->level1item->css['letterspacing'] OR $cssstyles->level1item->css['wordspacing'] OR $cssstyles->level1item->css['textindent'] OR $cssstyles->level1item->css['fontsize'] OR $cssstyles->level1item->css['fontfamily'] OR $cssstyles->level1item->css['custom']) {

				$styles .= "
" . $id . " ul.menu li li a, " . $id . " ul.menu li li span.separator {
"
						. $cssstyles->level1item->css['background']
						. $cssstyles->level1item->css['gradient']
						. $cssstyles->level1item->css['borders']
						. $cssstyles->level1item->css['borderradius']
						. $cssstyles->level1item->css['height']
						. $cssstyles->level1item->css['width']
						. $cssstyles->level1item->css['color']
						. $cssstyles->level1item->css['margins']
						. $cssstyles->level1item->css['paddings']
//                        . $cssstyles->level1item->css['alignement']
						. $cssstyles->level1item->css['shadow']
						. $cssstyles->level1item->css['fontbold']
						. $cssstyles->level1item->css['fontitalic']
						. $cssstyles->level1item->css['fontunderline']
						. $cssstyles->level1item->css['fontuppercase']
						. $cssstyles->level1item->css['letterspacing']
						. $cssstyles->level1item->css['wordspacing']
						. $cssstyles->level1item->css['textindent']
						. $cssstyles->level1item->css['fontsize']
						. $cssstyles->level1item->css['fontfamily']
						. $cssstyles->level1item->css['custom']
						. "}
";
			}

			if ($cssstyles->level1itemhover->css['background'] OR $cssstyles->level1itemhover->css['gradient'] OR $cssstyles->level1itemhover->css['borders'] OR $cssstyles->level1itemhover->css['borderradius'] OR $cssstyles->level1itemhover->css['height'] OR $cssstyles->level1itemhover->css['width'] OR $cssstyles->level1itemhover->css['color'] OR $cssstyles->level1itemhover->css['margins'] OR $cssstyles->level1itemhover->css['paddings']
//                    OR $cssstyles->level1itemhover->css['alignement']
					OR $cssstyles->level1itemhover->css['shadow'] OR $cssstyles->level1itemhover->css['fontbold'] OR $cssstyles->level1itemhover->css['fontitalic'] OR $cssstyles->level1itemhover->css['fontunderline'] OR $cssstyles->level1itemhover->css['fontuppercase'] OR $cssstyles->level1itemhover->css['letterspacing'] OR $cssstyles->level1itemhover->css['wordspacing'] OR $cssstyles->level1itemhover->css['textindent'] OR $cssstyles->level1itemhover->css['fontsize'] OR $cssstyles->level1itemhover->css['fontfamily'] OR $cssstyles->level1itemhover->css['custom']) {

				$styles .= "
" . $id . " ul.menu li li:hover > a, " . $id . " ul.menu li li:hover > span.separator {
"
						. $cssstyles->level1itemhover->css['background']
						. $cssstyles->level1itemhover->css['gradient']
						. $cssstyles->level1itemhover->css['borders']
						. $cssstyles->level1itemhover->css['borderradius']
						. $cssstyles->level1itemhover->css['height']
						. $cssstyles->level1itemhover->css['width']
						. $cssstyles->level1itemhover->css['color']
						. $cssstyles->level1itemhover->css['margins']
						. $cssstyles->level1itemhover->css['paddings']
//                        . $cssstyles->level1itemhover->css['alignement']
						. $cssstyles->level1itemhover->css['shadow']
						. $cssstyles->level1itemhover->css['fontbold']
						. $cssstyles->level1itemhover->css['fontitalic']
						. $cssstyles->level1itemhover->css['fontunderline']
						. $cssstyles->level1itemhover->css['fontuppercase']
						. $cssstyles->level1itemhover->css['letterspacing']
						. $cssstyles->level1itemhover->css['wordspacing']
						. $cssstyles->level1itemhover->css['textindent']
						. $cssstyles->level1itemhover->css['fontsize']
						. $cssstyles->level1itemhover->css['fontfamily']
						. $cssstyles->level1itemhover->css['custom']
						. "}
";
			}

			if ($cssstyles->level1itemactive->css['background'] OR $cssstyles->level1itemactive->css['gradient'] OR $cssstyles->level1itemactive->css['borders'] OR $cssstyles->level1itemactive->css['borderradius'] OR $cssstyles->level1itemactive->css['height'] OR $cssstyles->level1itemactive->css['width'] OR $cssstyles->level1itemactive->css['color'] OR $cssstyles->level1itemactive->css['margins'] OR $cssstyles->level1itemactive->css['paddings']
//                    OR $cssstyles->level1itemactive->css['alignement']
					OR $cssstyles->level1itemactive->css['shadow'] OR $cssstyles->level1itemactive->css['fontbold'] OR $cssstyles->level1itemactive->css['fontitalic'] OR $cssstyles->level1itemactive->css['fontunderline'] OR $cssstyles->level1itemactive->css['fontuppercase'] OR $cssstyles->level1itemactive->css['letterspacing'] OR $cssstyles->level1itemactive->css['wordspacing'] OR $cssstyles->level1itemactive->css['textindent'] OR $cssstyles->level1itemactive->css['fontsize'] OR $cssstyles->level1itemactive->css['fontfamily'] OR $cssstyles->level1itemactive->css['custom']) {

				$styles .= "
" . $id . " ul.menu li li.active > a, " . $id . " ul.menu li li.active > span.separator {
"
						. $cssstyles->level1itemactive->css['background']
						. $cssstyles->level1itemactive->css['gradient']
						. $cssstyles->level1itemactive->css['borders']
						. $cssstyles->level1itemactive->css['borderradius']
						. $cssstyles->level1itemactive->css['height']
						. $cssstyles->level1itemactive->css['width']
						. $cssstyles->level1itemactive->css['color']
						. $cssstyles->level1itemactive->css['margins']
						. $cssstyles->level1itemactive->css['paddings']
//                        . $cssstyles->level1itemactive->css['alignement']
						. $cssstyles->level1itemactive->css['shadow']
						. $cssstyles->level1itemactive->css['fontbold']
						. $cssstyles->level1itemactive->css['fontitalic']
						. $cssstyles->level1itemactive->css['fontunderline']
						. $cssstyles->level1itemactive->css['fontuppercase']
						. $cssstyles->level1itemactive->css['letterspacing']
						. $cssstyles->level1itemactive->css['wordspacing']
						. $cssstyles->level1itemactive->css['textindent']
						. $cssstyles->level1itemactive->css['fontsize']
						. $cssstyles->level1itemactive->css['fontfamily']
						. $cssstyles->level1itemactive->css['custom']
						. "}
";
			}


			if ($cssstyles->level2bg->css['background'] OR $cssstyles->level2bg->css['gradient'] OR $cssstyles->level2bg->css['borders'] OR $cssstyles->level2bg->css['borderradius'] OR $cssstyles->level2bg->css['height'] OR $cssstyles->level2bg->css['width'] OR $cssstyles->level2bg->css['color'] OR $cssstyles->level2bg->css['margins'] OR $cssstyles->level2bg->css['paddings']
//                    OR $cssstyles->level2bg->css['alignement']
					OR $cssstyles->level2bg->css['shadow'] OR $cssstyles->level2bg->css['fontbold'] OR $cssstyles->level2bg->css['fontitalic'] OR $cssstyles->level2bg->css['fontunderline'] OR $cssstyles->level2bg->css['fontuppercase'] OR $cssstyles->level2bg->css['letterspacing'] OR $cssstyles->level2bg->css['wordspacing'] OR $cssstyles->level2bg->css['textindent'] OR $cssstyles->level2bg->css['fontsize'] OR $cssstyles->level2bg->css['fontfamily'] OR $cssstyles->level2bg->css['custom']) {

				$styles .= "
" . $id . " ul.menu li li ul, " . $id . " ul.menu li li ul {
"
						. $cssstyles->level2bg->css['background']
						. $cssstyles->level2bg->css['gradient']
						. $cssstyles->level2bg->css['borders']
						. $cssstyles->level2bg->css['borderradius']
						. $cssstyles->level2bg->css['height']
						. $cssstyles->level2bg->css['width']
						. $cssstyles->level2bg->css['color']
						. $cssstyles->level2bg->css['margins']
						. $cssstyles->level2bg->css['paddings']
//                        . $cssstyles->level2bg->css['alignement']
						. $cssstyles->level2bg->css['shadow']
						. $cssstyles->level2bg->css['fontbold']
						. $cssstyles->level2bg->css['fontitalic']
						. $cssstyles->level2bg->css['fontunderline']
						. $cssstyles->level2bg->css['fontuppercase']
						. $cssstyles->level2bg->css['letterspacing']
						. $cssstyles->level2bg->css['wordspacing']
						. $cssstyles->level2bg->css['textindent']
						. $cssstyles->level2bg->css['fontsize']
						. $cssstyles->level2bg->css['fontfamily']
						. $cssstyles->level2bg->css['custom']
						. "}
";
			}
		}
		/** fin condition menu normal * */
		/* ---- fin des css ------ */
		return $styles;
	}

	function genCss($cssparams, $prefix, $action, $id, $direction) {
		// construct variable names
		$backgroundimageurl = $prefix . 'backgroundimageurl';
		$backgroundimageleft = $prefix . 'backgroundimageleft';
		$backgroundimagetop = $prefix . 'backgroundimagetop';
		$backgroundimagerepeat = $prefix . 'backgroundimagerepeat';
		$backgroundcolor = $prefix . 'backgroundcolorstart';
		$backgroundopacity = $prefix . 'backgroundopacity';
		$gradientcolor = $prefix . 'backgroundcolorend';
		$gradient1position = $prefix . 'backgroundpositionend';
		$gradient1opacity = $prefix . 'backgroundopacityend';
		$gradient2color = $prefix . 'backgroundcolorstop1';
		$gradient2position = $prefix . 'backgroundpositionstop1';
		$gradient2opacity = $prefix . 'backgroundopacitystop1';
		$gradient3color = $prefix . 'backgroundcolorstop2';
		$gradient3position = $prefix . 'backgroundpositionstop2';
		$gradient3opacity = $prefix . 'backgroundopacitystop2';
		$gradientdirection = $prefix . 'backgrounddirection';


		// set the background color
		$css['background'] = (isset($cssparams->$backgroundcolor) AND $cssparams->$backgroundcolor) ? "\tbackground: " . $cssparams->$backgroundcolor . ";\r\n" : "";
		$backgroundcolorvalue = (isset($cssparams->$backgroundcolor) AND $cssparams->$backgroundcolor) ? $cssparams->$backgroundcolor : "";

		// manage rgba color for opacity
		if (isset($cssparams->$backgroundopacity) AND $cssparams->$backgroundopacity) {
			$rgbacolor = hex2RGB($cssparams->$backgroundcolor, $cssparams->$backgroundopacity);
			$css['background'] .= (isset($cssparams->$backgroundcolor) AND $cssparams->$backgroundcolor) ? "\tbackground: " . $rgbacolor . ";\r\n\t-pie-background: " . $rgbacolor . ";\r\n" : "";
		}

		$imageurl = "";
		if (isset($cssparams->$backgroundimageurl) AND $cssparams->$backgroundimageurl) {
			if ($action == 'preview') {
				$imageurl = JUri::base(true) . '/' . $cssparams->$backgroundimageurl;
			} else {
				$imageurl = explode("/", $cssparams->$backgroundimageurl);
				$imageurl = end($imageurl);
				$imageurl = "../images/" . $imageurl;
			}
		}

		// set the background image
		$backgroundimageleftvalue = (isset($cssparams->$backgroundimageleft) AND $cssparams->$backgroundimageleft != null) ? $cssparams->$backgroundimageleft : "center";
		$backgroundimagetopvalue = (isset($cssparams->$backgroundimagetop) AND $cssparams->$backgroundimagetop != null) ? $cssparams->$backgroundimagetop : "center";
		$backgroundimagerepeatvalue = (isset($cssparams->$backgroundimagerepeat) AND $cssparams->$backgroundimagerepeat) ? $cssparams->$backgroundimagerepeat : "no-repeat";
		$backgroundimageurlvalue = (isset($cssparams->$backgroundimageurl) AND $cssparams->$backgroundimageurl) ? $cssparams->$backgroundimageurl : "";

		if ($backgroundimageleftvalue != 'top' AND $backgroundimageleftvalue != 'right' AND $backgroundimageleftvalue != 'bottom' AND $backgroundimageleftvalue != 'left' AND $backgroundimageleftvalue != 'center' AND !stristr($backgroundimageleftvalue, "px")
		)
			$backgroundimageleftvalue = $this->testUnit($backgroundimageleftvalue);

		if ($backgroundimagetopvalue != 'top' AND $backgroundimagetopvalue != 'right' AND $backgroundimagetopvalue != 'bottom' AND $backgroundimagetopvalue != 'left' AND $backgroundimagetopvalue != 'center' AND !stristr($backgroundimagetopvalue, "px")
		)
			$backgroundimagetopvalue = $this->testUnit($backgroundimagetopvalue);

		// set the background color
		if ((isset($cssparams->class) AND !stristr($cssparams->class, 'bannerlogo')) OR !isset($cssparams->class)) {
			$css['background'] = (isset($cssparams->$backgroundimageurl) AND $cssparams->$backgroundimageurl) ? "\tbackground: " . $backgroundcolorvalue . " url(" . $imageurl . ") " . $backgroundimageleftvalue . " " . $backgroundimagetopvalue . " " . $backgroundimagerepeatvalue . ";\r\n" : $css['background'];
		}


		// copy the background image in the template folder
		$path = JPATH_ROOT . '/components/com_templateck/projects/' . JRequest::getVar('templatename');
		if (isset($cssparams->$backgroundimageurl) AND $cssparams->$backgroundimageurl AND $action == 'archive') {
			$bgimgurl = $cssparams->$backgroundimageurl;

			$bgimgname = explode("/", $cssparams->$backgroundimageurl);
			$bgimgname = end($bgimgname);

			$imagesdest = $path . '/images/' . $bgimgname;
			$imagessrc = JPATH_ROOT . '/' . $bgimgurl;

			if (!JFile::copy($imagessrc, $imagesdest)) {
				$msg = '<p class="errorck">' . JText::_('CK_ERROR_CREATING_IMAGEFILES') . $bgimgname . '</p>';
			} else {
				$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_IMAGEFILES') . $bgimgname . '</p>';
			}
			echo $msg;
		}

		$gradient0colorvalue = (isset($cssparams->$backgroundcolor) AND $cssparams->$backgroundcolor) ? $cssparams->$backgroundcolor : "";
		$gradient1colorvalue = (isset($cssparams->$gradientcolor) AND $cssparams->$gradientcolor) ? $cssparams->$gradientcolor : "";
		$gradient1positionvalue = (isset($cssparams->$gradient1position) AND $cssparams->$gradient1position) ? $cssparams->$gradient1position . "%" : "100%";
		$gradient2colorvalue = (isset($cssparams->$gradient2color) AND $cssparams->$gradient2color) ? $cssparams->$gradient2color : "";
		$gradient2positionvalue = (isset($cssparams->$gradient2position) AND $cssparams->$gradient2position) ? $cssparams->$gradient2position . "%" : "";
		$gradient3colorvalue = (isset($cssparams->$gradient3color) AND $cssparams->$gradient3color) ? $cssparams->$gradient3color : "";
		$gradient3positionvalue = (isset($cssparams->$gradient3position) AND $cssparams->$gradient3position) ? $cssparams->$gradient3position . "%" : "";

		if (isset($cssparams->$gradientdirection)) {
			switch ($cssparams->$gradientdirection) {
				case 'bottomtop':
					$gradientdirectionvalue = 'center bottom';
					$gradientdirectionvaluebis = 'left bottom, left top';
					$gradientdirectionvaluebis2 = 'x1="0%" y1="100%"
				x2="0%" y2="0%"';
					break;
				case 'leftright':
					$gradientdirectionvalue = 'center left';
					$gradientdirectionvaluebis = 'left top, right top';
					$gradientdirectionvaluebis2 = 'x1="0%" y1="0%"
				x2="100%" y2="0%"';
					break;
				case 'rightleft':
					$gradientdirectionvalue = 'center right';
					$gradientdirectionvaluebis = 'right top, left top';
					$gradientdirectionvaluebis2 = 'x1="100%" y1="0%"
				x2="0%" y2="0%"';
					break;
				case 'topbottom':
				default :
					$gradientdirectionvalue = 'center top';
					$gradientdirectionvaluebis = 'left top, left bottom';
					$gradientdirectionvaluebis2 = 'x1="0%" y1="0%"
				x2="0%" y2="100%"';
					break;
			}
		} else {
			$gradientdirectionvalue = 'center top';
			$gradientdirectionvaluebis = 'left top, left bottom';
			$gradientdirectionvaluebis2 = 'x1="0%" y1="0%"
				x2="0%" y2="100%"';
		}


		$gradientstop2 = '';
		$gradientstop2webkit = '';
		$gradientstop2bis = '';
		$gradientstop3 = '';
		$gradientstop3webkit = '';
		$gradientstop3bis = '';
		if ($gradient2colorvalue AND $gradient2positionvalue) {
			$gradientstop2 = ',' . $gradient2colorvalue . ' ' . $gradient2positionvalue;
			$gradientstop2webkit = ',color-stop(' . $gradient2positionvalue . ',' . $gradient2colorvalue . ')';
			$gradientstop2bis = '<stop offset="' . $gradient2positionvalue . '"   stop-color="' . $gradient2colorvalue . '" stop-opacity="1"/>';
		}
		if ($gradient3colorvalue AND $gradient3positionvalue) {
			$gradientstop3 = ',' . $gradient3colorvalue . ' ' . $gradient3positionvalue;
			$gradientstop3webkit = ',color-stop(' . $gradient3positionvalue . ',' . $gradient3colorvalue . ')';
			$gradientstop3bis = '<stop offset="' . $gradient3positionvalue . '"   stop-color="' . $gradient3colorvalue . '" stop-opacity="1"/>';
		}



		if ($gradient0colorvalue && $gradient1colorvalue) {
			$css['gradient'] = "\tbackground-image: url(\"" . $prefix . $id . "-gradient.svg\");\r\n"
					. "\tbackground-image: -o-linear-gradient(" . $gradientdirectionvalue . "," . $gradient0colorvalue . $gradientstop2 . $gradientstop3 . ", " . $gradient1colorvalue . ' ' . $gradient1positionvalue . ");\r\n"
					. "\tbackground-image: -webkit-gradient(linear, " . $gradientdirectionvaluebis . ",from(" . $gradient0colorvalue . ")" . $gradientstop2webkit . $gradientstop3webkit . ", color-stop(" . $gradient1positionvalue . ', ' . $gradient1colorvalue . "));\r\n"
					. "\tbackground-image: -moz-linear-gradient(" . $gradientdirectionvalue . "," . $gradient0colorvalue . $gradientstop2 . $gradientstop3 . ", " . $gradient1colorvalue . ' ' . $gradient1positionvalue . ");\r\n"
					. "\tbackground-image: linear-gradient(" . $gradientdirectionvalue . "," . $gradient0colorvalue . $gradientstop2 . $gradientstop3 . ", " . $gradient1colorvalue . ' ' . $gradient1positionvalue . ");\r\n"
					. "\t-pie-background: linear-gradient(" . $gradientdirectionvalue . "," . $gradient0colorvalue . $gradientstop2 . $gradientstop3 . ", " . $gradient1colorvalue . ' ' . $gradient1positionvalue . ");\r\n";


			// create the file svg for IE9 and Opera gradient compatibility
			$svgie9cssdest = $path . '/css/' . $prefix . $id . '-gradient.svg';
			$svgie9csstext = '<?xml version="1.0" ?>
              <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.0" width="100%"
              height="100%"
              xmlns:xlink="http://www.w3.org/1999/xlink">

              <defs>
              <linearGradient id="' . $prefix . $id . '"
              ' . $gradientdirectionvaluebis2 . '
              spreadMethod="pad">
              <stop offset="0%"   stop-color="' . $gradient0colorvalue . '" stop-opacity="1"/>
              ' . $gradientstop2bis . '
              ' . $gradientstop3bis . '
              <stop offset="' . $gradient1positionvalue . '" stop-color="' . $gradient1colorvalue . '" stop-opacity="1"/>
              </linearGradient>
              </defs>

              <rect width="100%" height="100%"
              style="fill:url(#' . $prefix . $id . ');" />
              </svg>
              ';
			if (!JFile::write($svgie9cssdest, $svgie9csstext)) {
				echo '<p class="error">' . JText::_('CK_ERROR_CREATING_SVGIE9CSS') . '</p>';
			}
		} else {
			$css['gradient'] = "";
		}


		// construct variable names
		$borderscolor = $prefix . 'borderscolor';
		$borderssize = $prefix . 'borderssize';
		$bordersstyle = $prefix . 'bordersstyle';
		$bordertopcolor = $prefix . 'bordertopcolor';
		$bordertopsize = $prefix . 'bordertopsize';
		$bordertopstyle = $prefix . 'bordertopstyle';
		$borderbottomcolor = $prefix . 'borderbottomcolor';
		$borderbottomsize = $prefix . 'borderbottomsize';
		$borderbottomstyle = $prefix . 'borderbottomstyle';
		$borderleftcolor = $prefix . 'borderleftcolor';
		$borderleftsize = $prefix . 'borderleftsize';
		$borderleftstyle = $prefix . 'borderleftstyle';
		$borderrightcolor = $prefix . 'borderrightcolor';
		$borderrightsize = $prefix . 'borderrightsize';
		$borderrightstyle = $prefix . 'borderrightstyle';
		// for border radius
		$borderradius = $prefix . 'borderradius';
		$borderradiustopleft = $prefix . 'borderradiustopleft';
		$borderradiustopright = $prefix . 'borderradiustopright';
		$borderradiusbottomleft = $prefix . 'borderradiusbottomleft';
		$borderradiusbottomright = $prefix . 'borderradiusbottomright';

		$cssparams->$bordersstyle = isset($cssparams->$bordersstyle) ? $cssparams->$bordersstyle : 'solid';
		$cssparams->$bordertopstyle = isset($cssparams->$bordertopstyle) ? $cssparams->$bordertopstyle : 'solid';
		$cssparams->$borderbottomstyle = isset($cssparams->$borderbottomstyle) ? $cssparams->$borderbottomstyle : 'solid';
		$cssparams->$borderleftstyle = isset($cssparams->$borderleftstyle) ? $cssparams->$borderleftstyle : 'solid';
		$cssparams->$borderrightstyle = isset($cssparams->$borderrightstyle) ? $cssparams->$borderrightstyle : 'solid';

		$css['borders'] = (isset($cssparams->$borderscolor) AND $cssparams->$borderscolor AND isset($cssparams->$borderssize) AND $cssparams->$borderssize) ? "\tborder: " . $cssparams->$borderscolor . " " . $this->testUnit($cssparams->$borderssize) . " " . $cssparams->$bordersstyle . ";\r\n" : "";
		$css['bordertop'] = (isset($cssparams->$bordertopcolor) AND $cssparams->$bordertopcolor AND isset($cssparams->$bordertopsize) AND $cssparams->$bordertopsize) ? "\tborder-top: " . $cssparams->$bordertopcolor . " " . $this->testUnit($cssparams->$bordertopsize) . " " . $cssparams->$bordertopstyle . ";\r\n" : "";
		$css['borderbottom'] = (isset($cssparams->$borderbottomcolor) AND $cssparams->$borderbottomcolor AND isset($cssparams->$borderbottomsize) AND $cssparams->$borderbottomsize) ? "\tborder-bottom: " . $cssparams->$borderbottomcolor . " " . $this->testUnit($cssparams->$borderbottomsize) . " " . $cssparams->$borderbottomstyle . ";\r\n" : "";
		$css['borderleft'] = (isset($cssparams->$borderleftcolor) AND $cssparams->$borderleftcolor AND isset($cssparams->$borderleftsize) AND $cssparams->$borderleftsize) ? "\tborder-left: " . $cssparams->$borderleftcolor . " " . $this->testUnit($cssparams->$borderleftsize) . " " . $cssparams->$borderleftstyle . ";\r\n" : "";
		$css['borderright'] = (isset($cssparams->$borderrightcolor) AND $cssparams->$borderrightcolor AND isset($cssparams->$borderrightsize) AND $cssparams->$borderrightsize) ? "\tborder-right: " . $cssparams->$borderrightcolor . " " . $this->testUnit($cssparams->$borderrightsize) . " " . $cssparams->$borderrightstyle . ";\r\n" : "";

		// compile all borders
		$css['borders'] .= $css['bordertop'] . $css['borderbottom'] . $css['borderleft'] . $css['borderright'];

		$borderradiusvalue = (isset($cssparams->$borderradius) AND $cssparams->$borderradius) ? $cssparams->$borderradius : "0";
		$borderradiustopleftvalue = (isset($cssparams->$borderradiustopleft) AND $cssparams->$borderradiustopleft) ? $cssparams->$borderradiustopleft : $borderradiusvalue;
		$borderradiustoprightvalue = (isset($cssparams->$borderradiustopright) AND $cssparams->$borderradiustopright) ? $cssparams->$borderradiustopright : $borderradiusvalue;
		$borderradiusbottomleftvalue = (isset($cssparams->$borderradiusbottomleft) AND $cssparams->$borderradiusbottomleft) ? $cssparams->$borderradiusbottomleft : $borderradiusvalue;
		$borderradiusbottomrightvalue = (isset($cssparams->$borderradiusbottomright) AND $cssparams->$borderradiusbottomright) ? $cssparams->$borderradiusbottomright : $borderradiusvalue;

		if ($borderradiustopleftvalue || $borderradiustoprightvalue || $borderradiusbottomleftvalue || $borderradiusbottomrightvalue) {
			$css['borderradius'] = "\t-moz-border-radius: " . $this->testUnit($borderradiusvalue) . ";\r\n"
					. "\t-o-border-radius: " . $this->testUnit($borderradiusvalue) . ";\r\n"
					. "\t-webkit-border-radius: " . $this->testUnit($borderradiusvalue) . ";\r\n"
					. "\tborder-radius: " . $this->testUnit($borderradiusvalue) . ";\r\n"
					. "\t-moz-border-radius: " . $this->testUnit($borderradiustopleftvalue) . " " . $this->testUnit($borderradiustoprightvalue) . " " . $this->testUnit($borderradiusbottomrightvalue) . " " . $this->testUnit($borderradiusbottomleftvalue) . ";\r\n"
					. "\t-o-border-radius: " . $this->testUnit($borderradiustopleftvalue) . " " . $this->testUnit($borderradiustoprightvalue) . " " . $this->testUnit($borderradiusbottomrightvalue) . " " . $this->testUnit($borderradiusbottomleftvalue) . ";\r\n"
					. "\t-webkit-border-radius: " . $this->testUnit($borderradiustopleftvalue) . " " . $this->testUnit($borderradiustoprightvalue) . " " . $this->testUnit($borderradiusbottomrightvalue) . " " . $this->testUnit($borderradiusbottomleftvalue) . ";\r\n"
					. "\tborder-radius: " . $this->testUnit($borderradiustopleftvalue) . " " . $this->testUnit($borderradiustoprightvalue) . " " . $this->testUnit($borderradiusbottomrightvalue) . " " . $this->testUnit($borderradiusbottomleftvalue) . ";\r\n";
		} else {
			$css['borderradius'] = "";
		}

		// construct variable names
		$height = $prefix . 'height';
		$width = $prefix . 'width';
		$color = $prefix . 'color';
		$lineheight = $prefix . 'lineheight';
		$margintop = $prefix . 'margintop';
		$marginbottom = $prefix . 'marginbottom';
		$marginleft = $prefix . 'marginleft';
		$marginright = $prefix . 'marginright';
		$margins = $prefix . 'margins';
		$paddingtop = $prefix . 'paddingtop';
		$paddingbottom = $prefix . 'paddingbottom';
		$paddingleft = $prefix . 'paddingleft';
		$paddingright = $prefix . 'paddingright';
		$paddings = $prefix . 'paddings';

		$css['height'] = (isset($cssparams->$height) AND $cssparams->$height) ? "\theight: " . $this->testUnit($cssparams->$height) . ";\r\n" : "";
		$css['width'] = (isset($cssparams->$width) AND $cssparams->$width) ? "\twidth: " . $this->testUnit($cssparams->$width) . ";\r\n" : "";
		$css['color'] = (isset($cssparams->$color) AND $cssparams->$color) ? "\tcolor: " . $cssparams->$color . ";\r\n" : "";
		$css['lineheight'] = (isset($cssparams->$lineheight) AND $cssparams->$lineheight) ? "\tline-height: " . $this->testUnit($cssparams->$lineheight) . ";\r\n" : "";
		$css['margintop'] = (isset($cssparams->$margintop) AND ($cssparams->$margintop OR $cssparams->$margintop == '0')) ? "\tmargin-top: " . $this->testUnit($cssparams->$margintop) . ";\r\n" : "";
		$css['marginbottom'] = (isset($cssparams->$marginbottom) AND ($cssparams->$marginbottom OR $cssparams->$marginbottom == '0')) ? "\tmargin-bottom: " . $this->testUnit($cssparams->$marginbottom) . ";\r\n" : "";
		$css['marginleft'] = (isset($cssparams->$marginleft) AND ($cssparams->$marginleft OR $cssparams->$marginleft == '0')) ? "\tmargin-left: " . $this->testUnit($cssparams->$marginleft) . ";\r\n" : "";
		$css['margins'] = (isset($cssparams->$margins) AND ($cssparams->$margins OR $cssparams->$margins == '0')) ? "\tmargin: " . $this->testUnit($cssparams->$margins) . ";\r\n" : "";
		$css['marginright'] = (isset($cssparams->$marginright) AND ($cssparams->$marginright OR $cssparams->$marginright == '0')) ? "\tmargin-right: " . $this->testUnit($cssparams->$marginright) . ";\r\n" : "";
		$css['paddingtop'] = (isset($cssparams->$paddingtop) AND ($cssparams->$paddingtop OR $cssparams->$paddingtop == '0')) ? "\tpadding-top: " . $this->testUnit($cssparams->$paddingtop) . ";\r\n" : "";
		$css['paddingbottom'] = (isset($cssparams->$paddingbottom) AND ($cssparams->$paddingbottom OR $cssparams->$paddingbottom == '0')) ? "\tpadding-bottom: " . $this->testUnit($cssparams->$paddingbottom) . ";\r\n" : "";
		$css['paddingleft'] = (isset($cssparams->$paddingleft) AND ($cssparams->$paddingleft OR $cssparams->$paddingleft == '0')) ? "\tpadding-left: " . $this->testUnit($cssparams->$paddingleft) . ";\r\n" : "";
		$css['paddingright'] = (isset($cssparams->$paddingright) AND ($cssparams->$paddingright OR $cssparams->$paddingright == '0')) ? "\tpadding-right: " . $this->testUnit($cssparams->$paddingright) . ";\r\n" : "";
		$css['paddings'] = (isset($cssparams->$paddings) AND ($cssparams->$paddings OR $cssparams->$paddings == '0')) ? "\tpadding: " . $this->testUnit($cssparams->$paddings) . ";\r\n" : "";

		$css['margins'] .= $css['margintop'] . $css['marginright'] . $css['marginbottom'] . $css['marginleft'];
		$css['paddings'] .= $css['paddingtop'] . $css['paddingright'] . $css['paddingbottom'] . $css['paddingleft'];

		// construct variable names
		$shadowcolor = $prefix . 'shadowcolor';
		$shadowhoffset = $prefix . 'shadowoffseth';
		$shadowvoffset = $prefix . 'shadowoffsetv';
		$shadowblur = $prefix . 'shadowblur';
		$shadowspread = $prefix . 'shadowspread';

		// manage shadow box
		$shadowcolorvalue = (isset($cssparams->$shadowcolor) AND $cssparams->$shadowcolor) ? $cssparams->$shadowcolor : "";
		$shadowhoffsetvalue = (isset($cssparams->$shadowhoffset) AND $cssparams->$shadowhoffset) ? $cssparams->$shadowhoffset : "0";
		$shadowvoffsetvalue = (isset($cssparams->$shadowvoffset) AND $cssparams->$shadowvoffset) ? $cssparams->$shadowvoffset : "0";
		$shadowblurvalue = (isset($cssparams->$shadowblur) AND $cssparams->$shadowblur) ? $cssparams->$shadowblur : "";
		$shadowspreadvalue = (isset($cssparams->$shadowspread) AND $cssparams->$shadowspread) ? $cssparams->$shadowspread : "0";

		if ($shadowcolorvalue && $shadowblurvalue) {
			$css['shadow'] = "\tbox-shadow: " . $shadowcolorvalue . " " . $this->testUnit($shadowhoffsetvalue) . " " . $this->testUnit($shadowvoffsetvalue) . " " . $this->testUnit($shadowblurvalue) . " " . $this->testUnit($shadowspreadvalue) . ";\r\n"
					. "\t-moz-box-shadow: " . $shadowcolorvalue . " " . $this->testUnit($shadowhoffsetvalue) . " " . $this->testUnit($shadowvoffsetvalue) . " " . $this->testUnit($shadowblurvalue) . " " . $this->testUnit($shadowspreadvalue) . ";\r\n"
					. "\t-webkit-box-shadow: " . $shadowcolorvalue . " " . $this->testUnit($shadowhoffsetvalue) . " " . $this->testUnit($shadowvoffsetvalue) . " " . $this->testUnit($shadowblurvalue) . " " . $this->testUnit($shadowspreadvalue) . ";\r\n";
		} else {
			$css['shadow'] = "";
		}

		// construct variable names
		$fontactivation = $prefix . 'fontactivation';
		$fontbold = $prefix . 'fontbold';
		$fontitalic = $prefix . 'fontitalic';
		$fontunderline = $prefix . 'fontunderline';
		$fontuppercase = $prefix . 'fontuppercase';
		$fontfamily = $prefix . 'fontfamily';
		$fontsize = $prefix . 'fontsize';
		$alignementactivation = $prefix . 'alignementactivation';
		$alignement = $prefix . 'alignement';
		$alignementleft = $prefix . 'alignementleft';
		$alignementcenter = $prefix . 'alignementcenter';
		$alignementjustify = $prefix . 'alignementjustify';
		$alignementright = $prefix . 'alignementright';
		$wordspacing = $prefix . 'wordspacing';
		$letterspacing = $prefix . 'letterspacing';
		$textindent = $prefix . 'textindent';

		$css['alignement'] = "";
		if (isset($cssparams->$alignementright) AND $cssparams->$alignementright == 'checked') {
			$css['alignement'] = $direction == "rtl" ? "\ttext-align: left;\r\n" : "\ttext-align: right;\r\n";
		} else if (isset($cssparams->$alignementcenter) AND $cssparams->$alignementcenter == 'checked') {
			$css['alignement'] = "\ttext-align: center;\r\n";
		} else if (isset($cssparams->$alignementjustify) AND $cssparams->$alignementjustify == 'checked') {
			$css['alignement'] = "\ttext-align: justify;\r\n";
		} else if (isset($cssparams->$alignementleft) AND $cssparams->$alignementleft == 'checked') {
			$css['alignement'] = $direction == "rtl" ? "\ttext-align: right;\r\n" : "\ttext-align: left;\r\n";
			;
		}

		$css['fontbold'] = "";
		$css['fontitalic'] = "";
		$css['fontunderline'] = "";
		$css['fontuppercase'] = "";

		if (isset($cssparams->$fontbold) AND $cssparams->$fontbold) {
			if ($cssparams->$fontbold != 'default')
				$css['fontbold'] = $cssparams->$fontbold == 'bold' ? "\tfont-weight: bold;\r\n" : "\tfont-weight: normal;\r\n";
		}

		if (isset($cssparams->$fontitalic) AND $cssparams->$fontitalic) {
			if ($cssparams->$fontitalic != 'default')
				$css['fontitalic'] = $cssparams->$fontitalic == 'italic' ? "\tfont-style: italic;\r\n" : "\tfont-style: normal;\r\n";
		}

		if (isset($cssparams->$fontunderline) AND $cssparams->$fontunderline) {
			if ($cssparams->$fontunderline != 'default')
				$css['fontunderline'] = $cssparams->$fontunderline == 'underline' ? "\ttext-decoration: underline;\r\n" : "\ttext-decoration: none;\r\n";
		}

		if (isset($cssparams->$fontuppercase) AND $cssparams->$fontuppercase) {
			if ($cssparams->$fontuppercase != 'default')
				$css['fontuppercase'] = $cssparams->$fontuppercase == 'uppercase' ? "\ttext-transform: uppercase;\r\n" : "\ttext-transform: none;\r\n";
		}

		$css['textindent'] = (isset($cssparams->$textindent) AND $cssparams->$textindent) ? "\ttext-indent: " . $this->testUnit($cssparams->$textindent) . ";\r\n" : "";
		$css['letterspacing'] = (isset($cssparams->$letterspacing) AND $cssparams->$letterspacing) ? "\tletter-spacing: " . $this->testUnit($cssparams->$letterspacing) . ";\r\n" : "";
		$css['wordspacing'] = (isset($cssparams->$wordspacing) AND $cssparams->$wordspacing) ? "\tword-spacing: " . $this->testUnit($cssparams->$wordspacing) . ";\r\n" : "";
		$css['fontsize'] = (isset($cssparams->$fontsize) AND $cssparams->$fontsize) ? "\tfont-size: " . $this->testUnit($cssparams->$fontsize) . ";\r\n" : "";
		$css['fontstylessquirrel'] = '';
		if ($action != 'preview' AND isset($cssparams->$fontfamily) AND $cssparams->$fontfamily != 'default' AND $cssparams->$fontfamily != 'Times New Roman, Serif' AND $cssparams->$fontfamily != 'Helvetica, sans-serif' AND $cssparams->$fontfamily != 'Georgia, serif' AND $cssparams->$fontfamily != 'Courier New, serif' AND $cssparams->$fontfamily != 'Arial, sans-serif' AND $cssparams->$fontfamily != 'Verdana, sans-serif' AND $cssparams->$fontfamily != 'Comic Sans MS, cursive' AND $cssparams->$fontfamily != 'Tahoma, sans-serif' AND $cssparams->$fontfamily != 'Segoe UI, sans-serif') {

			$this->_injectFontsquirrel($cssparams, $fontfamily);
		}
		$css['fontfamily'] = (isset($cssparams->$fontfamily) AND $cssparams->$fontfamily != "default") ? "\tfont-family: " . $cssparams->$fontfamily . ";\r\n" : "";


		// construct variable names
		$normallinkfontbold = $prefix . 'normallinkfontbold';
		$normallinkfontitalic = $prefix . 'normallinkfontitalic';
		$normallinkfontunderline = $prefix . 'normallinkfontunderline';
		$normallinkfontuppercase = $prefix . 'normallinkfontuppercase';
		$normallinkcolor = $prefix . 'normallinkcolor';

		$css['normallinkfontbold'] = "";
		$css['normallinkfontitalic'] = "";
		$css['normallinkfontunderline'] = "";
		$css['normallinkfontuppercase'] = "";

		if (isset($cssparams->$normallinkfontbold) AND $cssparams->$normallinkfontbold) {
			if ($cssparams->$normallinkfontbold != 'default')
				$css['normallinkfontbold'] = $cssparams->$normallinkfontbold == 'bold' ? "\tfont-weight: bold;\r\n" : "\tfont-weight: normal;\r\n";
		}

		if (isset($cssparams->$normallinkfontitalic) AND $cssparams->$normallinkfontitalic) {
			if ($cssparams->$normallinkfontitalic != 'default')
				$css['normallinkfontitalic'] = $cssparams->$normallinkfontitalic == 'italic' ? "\tfont-style: italic;\r\n" : "\tfont-style: normal;\r\n";
		}

		if (isset($cssparams->$normallinkfontunderline) AND $cssparams->$normallinkfontunderline) {
			if ($cssparams->$normallinkfontunderline != 'default')
				$css['normallinkfontunderline'] = $cssparams->$normallinkfontunderline == 'underline' ? "\ttext-decoration: underline;\r\n" : "\ttext-decoration: none;\r\n";
		}

		if (isset($cssparams->$normallinkfontuppercase) AND $cssparams->$normallinkfontuppercase) {
			if ($cssparams->$normallinkfontuppercase != 'default')
				$css['normallinkfontuppercase'] = $cssparams->$normallinkfontuppercase == 'uppercase' ? "\ttext-transform: uppercase;\r\n" : "\ttext-transform: none;\r\n";
		}

		$css['normallinkcolor'] = (isset($cssparams->$normallinkcolor) AND $cssparams->$normallinkcolor) ? "\tcolor: " . $cssparams->$normallinkcolor . ";\r\n" : "";


		// construct variable names
		$hoverlinkactivation = $prefix . 'hoverlinkactivation';
		$hoverlinkfontbold = $prefix . 'hoverlinkfontbold';
		$hoverlinkfontitalic = $prefix . 'hoverlinkfontitalic';
		$hoverlinkfontunderline = $prefix . 'hoverlinkfontunderline';
		$hoverlinkfontuppercase = $prefix . 'hoverlinkfontuppercase';
		$hoverlinkcolor = $prefix . 'hoverlinkcolor';

		$css['hoverlinkfontbold'] = "";
		$css['hoverlinkfontitalic'] = "";
		$css['hoverlinkfontunderline'] = "";
		$css['hoverlinkfontuppercase'] = "";

		if (isset($cssparams->$hoverlinkfontbold) AND $cssparams->$hoverlinkfontbold) {
			if ($cssparams->$hoverlinkfontbold != 'default')
				$css['hoverlinkfontbold'] = $cssparams->$hoverlinkfontbold == 'bold' ? "\tfont-weight: bold;\r\n" : "\tfont-weight: normal;\r\n";
		}

		if (isset($cssparams->$hoverlinkfontitalic) AND $cssparams->$hoverlinkfontitalic) {
			if ($cssparams->$hoverlinkfontitalic != 'default')
				$css['hoverlinkfontitalic'] = $cssparams->$hoverlinkfontitalic == 'italic' ? "\tfont-style: italic;\r\n" : "\tfont-style: normal;\r\n";
		}

		if (isset($cssparams->$hoverlinkfontunderline) AND $cssparams->$hoverlinkfontunderline) {
			if ($cssparams->$hoverlinkfontunderline != 'default')
				$css['hoverlinkfontunderline'] = $cssparams->$hoverlinkfontunderline == 'underline' ? "\ttext-decoration: underline;\r\n" : "\ttext-decoration: none;\r\n";
		}

		if (isset($cssparams->$hoverlinkfontuppercase) AND $cssparams->$hoverlinkfontuppercase) {
			if ($cssparams->$hoverlinkfontuppercase != 'default')
				$css['hoverlinkfontuppercase'] = $cssparams->$hoverlinkfontuppercase == 'uppercase' ? "\ttext-transform: uppercase;\r\n" : "\ttext-transform: none;\r\n";
		}

		$css['hoverlinkcolor'] = (isset($cssparams->$hoverlinkcolor) AND $cssparams->$hoverlinkcolor) ? "\tcolor: " . $cssparams->$hoverlinkcolor . ";\r\n" : "";


		$custom = $prefix . 'custom';
		$css['custom'] = (isset($cssparams->$custom) AND $cssparams->$custom) ? "\t" . $cssparams->$custom . "\r\n" : "";

		return $css;
	}

	/**
	 * Copy the css and files for the font kits
	 * @param <object> $cssparams
	 * @param <string> $fontfamily
	 * @param <string> $path
	 */
	function _injectFontsquirrel($cssparams, $fontfamily) {
		$db = & JFactory::getDBO();
		$query = "SELECT * FROM #__templateck_fonts";
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$fontdirectory = '';
		foreach ($rows as $row) {
			if (stristr($row->fontfamilies, $cssparams->$fontfamily)) {
				$fontdirectory = $row->name;
				$fontstyles = $row->styles;
				$fontfamilies = explode(",", $row->fontfamilies);
				break;
			}
		}

		$dest = JPATH_ROOT . '/components/com_templateck/projects/' . JRequest::getVar('templatename') . '/css/fonts';
		$src = JPATH_ROOT . '/components/com_templateck/fonts/' . $fontdirectory;
		$fontfiles = JFolder::files($src);
		foreach ($fontfiles as $fontfile) {
			$fileext = strtolower(JFile::getExt($fontfile));
			if ($fileext != 'css' AND $fileext != 'html' AND $fileext != 'txt')
				if (!JFile::copy($src . '/' . $fontfile, $dest . '/' . $fontfile)) {
					echo 'ERREUR COPIE FONT';
				}
		}

		$fontsfile = JPATH_ROOT . '/components/com_templateck/projects/' . JRequest::getVar('templatename') . '/css/fonts/fonts.css';
		// get the content of the fonts file
		if (!$fontscontent = JFile::read($fontsfile)) {
			$msg = '<p class="error">' . JText::_('CK_ERROR_READING_FONTSCSS') . '</p>';
		}

		if (!stristr($fontscontent, $cssparams->$fontfamily)) {
			// create the file font.css
			$fontscontent .= $fontstyles;
			if (!JFile::write($fontsfile, $fontscontent)) {
				$msg = '<p class="errorck">' . JText::_('CK_ERROR_WRITING_FONTSCSS') . '</p>';
			} else {
				$msg = '<p class="successck">' . JText::_('CK_SUCCESS_WRITING_FONTSCSS') . '</p>';
			}

			echo $msg;
		}
	}

	function createFlexiblemodulesCss($fields, $id, $action = 'preview') {
		$moduleswidth = Array();
		$moduleswidth['2'] = isset($fields->moduleswidth2) ? $fields->moduleswidth2 : '50,50';
		$moduleswidth['3'] = isset($fields->moduleswidth3) ? $fields->moduleswidth3 : '33.333333333333336,33.333333333333336,33.333333333333336';
		$moduleswidth['4'] = isset($fields->moduleswidth4) ? $fields->moduleswidth4 : '25,25,25,25';
		$moduleswidth['5'] = isset($fields->moduleswidth5) ? $fields->moduleswidth5 : '20,20,20,20,20';
		$numberofmodules = isset($fields->numberofmodules) ? $fields->numberofmodules : '5';
		$css = "";
		$css .= "#" . $fields->ckid . " .n1 > .flexiblemodule { width: 100%; }\n";

		for ($i = 2; $i <= $numberofmodules; $i++) {
			for ($j = 0; $j < $i; $j++) {
				$widthmodule = explode(",", $moduleswidth[$i]);
				$css .= "#" . $fields->ckid . " .n" . $i . " > .flexiblemodule" . str_repeat(' + div', $j) . " { width: " . ((int) $widthmodule[$j]) . "%; }\n";
			}
		}
		return $css;
	}

}

/**
 * CssMobileStyles is a class to manage the styles for mobiles
 *
 * @author Cedric KEIFLIN http://www.joomlack.fr
 */
class CssMobileStyles extends JObject {

	/**
	 * Template object
	 *
	 * @var object
	 */
	var $_data;

	public function create($blocs, $column1width, $column2width) {
		$css = new stdClass();
		$css->resolution1 = '';
		$css->resolution2 = '';
		$css->resolution3 = '';
		$css->resolution4 = '';
		foreach ($blocs as $bloc) {
			$bloc->ckresponsive1 = (isset($bloc->ckresponsive1)) ? $bloc->ckresponsive1 : 'mobile_notaligned';
			$bloc->ckresponsive2 = (isset($bloc->ckresponsive2)) ? $bloc->ckresponsive2 : 'mobile_notaligned';
			$bloc->ckresponsive3 = (isset($bloc->ckresponsive3)) ? $bloc->ckresponsive3 : 'mobile_default';
			$bloc->ckresponsive4 = (isset($bloc->ckresponsive4)) ? $bloc->ckresponsive4 : 'mobile_default';
			$css->resolution1 .= (isset($bloc->ckresponsive1)) ? $this->_genMobileCSS($bloc, 'ckresponsive1') : '';
			$css->resolution2 .= (isset($bloc->ckresponsive2)) ? $this->_genMobileCSS($bloc, 'ckresponsive2') : '';
			$css->resolution3 .= (isset($bloc->ckresponsive3)) ? $this->_genMobileCSS($bloc, 'ckresponsive3') : '';
			$css->resolution4 .= (isset($bloc->ckresponsive4)) ? $this->_genMobileCSS($bloc, 'ckresponsive4') : '';
		}
		return $css;
	}

	private function _genMobileCSS($bloc, $resolution) {
		$css = '';
		if (!$bloc)
			return;

		switch ($bloc->class) {
			case (stristr($bloc->class, 'maincontent')) :
				$css .= $this->genMaincontentMobileCss($bloc, $resolution);
				break;
			case (stristr($bloc->class, 'mainbanner')) :
				$css .= $this->genSinglemoduleMobileCss($bloc, $resolution);
				break;
			case (stristr($bloc->class, 'horiznav')) :
				$css .= $this->genHoriznavMobileCss($bloc, $resolution);
				break;
			case (stristr($bloc->class, 'singlemodule')) :
				$css .= $this->genSinglemoduleMobileCss($bloc, $resolution);
				break;
			case (stristr($bloc->class, 'flexiblemodules')) :
				$css .= $this->genFlexiblemodulesMobileCss($bloc, $resolution);
				break;
		}
		// }
		return $css;
	}

	/*
	 * Generate the css for one module
	 */

	private function genSinglemoduleMobileCss($bloc, $resolution) {
		$css = '';
		switch ($bloc->$resolution) {
			case 'mobile_default':
			default:
				$css = '';
				break;
			case 'mobile_hide':
				$css = "#" . $bloc->ckid . " {\n\tdisplay :none;\n}\n";
				break;
			case 'mobile_notaligned':
				$css = "#" . $bloc->ckid . " {\n\theight: auto !important;\n}\n";
				$css .= "#" . $bloc->ckid . " .logobloc {\n\tfloat :none !important;\n\twidth: auto !important;\n}\n";
				break;
		}

		return $css;
	}

	/*
	 * Generate the css for the horizontal menu
	 */

	private function genHoriznavMobileCss($bloc, $resolution) {
		$css = '';
		switch ($bloc->$resolution) {
			case 'mobile_default':
			default:
				$css = '';
				break;
			case 'mobile_hide':
				$css = "#" . $bloc->ckid . " {\n\tdisplay :none;\n}\n";
				break;
			case 'mobile_alignhalf':
				$css = "#" . $bloc->ckid . " {\n\theight: auto !important;\n}\n";
				$css .= "#" . $bloc->ckid . " ul {\n\theight: auto !important;\n}\n";
				break;
			case 'mobile_notaligned':
				$css = "#" . $bloc->ckid . " {\n\theight: auto !important;\n}\n";
				$css .= "#" . $bloc->ckid . " ul {\n\theight: auto !important;\n}\n";
				$css .= "#" . $bloc->ckid . " li {\n\tfloat :none !important;\n\twidth: 100% !important;\n}\n";
				$css .= "#" . $bloc->ckid . " div.floatck {\n\twidth: 100% !important;\n}\n";
				break;
		}

		return $css;
	}

	/*
	 * Generate the css for flexibles modules
	 */

	private function genFlexiblemodulesMobileCss($bloc, $resolution) {
		$css = '';
		switch ($bloc->$resolution) {
			case 'mobile_default':
			default:
				$css = '';
				break;
			case 'mobile_hide':
				$css = "#" . $bloc->ckid . " {\n\tdisplay :none;\n}\n";
				break;
			case 'mobile_alignhalf':
				$css = "#" . $bloc->ckid . " .flexiblemodule {\n\twidth: 50% !important;\nfloat: left;\n}\n";
				break;
			case 'mobile_notaligned':
				$css = "#" . $bloc->ckid . " .flexiblemodule {\n\twidth: 100% !important;\nfloat: none;\n}\n";
				$css .= "#" . $bloc->ckid . " .flexiblemodule > div.inner {\n\tmargin-left: 0 !important;\n\tmargin-right: 0 !important;\n}\n";
				break;
		}

		return $css;
	}

	/*
	 * Generate the css for main content
	 */

	private function genMaincontentMobileCss($bloc, $resolution) {
		$css = '';
		switch ($bloc->$resolution) {
			case 'mobile_default':
			default:
				break;
			case 'mobile_notaligned':
				$css .= "#" . $bloc->ckid . " .column {\n\twidth: 100% !important;\n\tclear:both;\n\tfloat:left\n}\n";
				$css .= "#" . $bloc->ckid . " .column1 div.inner, #" . $bloc->ckid . " .column2 div.inner {\n\t/*overflow:hidden;*/\n}\n";
				$css .= "#" . $bloc->ckid . " .column div.inner {\n\tmargin-left: 0 !important;\n\tmargin-right: 0 !important;\n}\n";
				$css .= ".items-row .item, .column {
	width: auto !important;
	float: none;
	margin: 0 !important;
}

.column div.moduletable, .column div.moduletable_menu {
	float: none;
	width: auto !important;
	/*margin: 0 !important;
	padding: 0 !important;*/
}

/** specifique au formulaire de contact **/
.contact form fieldset dt {
	max-width: 80px;
}

.contact input, .contact textarea {
	max-width: 160px;
}";
				break;
			case 'mobile_lefttop':
				$css = "#" . $bloc->ckid . " .column1, #" . $bloc->ckid . " .main {\n\twidth: 100% !important;\n\tclear:both;\n\tfloat:left;\n}\n";
				$css .= "#" . $bloc->ckid . " .column1 div.inner, #" . $bloc->ckid . " .column1 div.inner > div {\nmargin-left: 0 !important;\nmargin-right: 0 !important;\n}\n";
				break;
			case 'mobile_lefthidden':
				$css = "#" . $bloc->ckid . " .column1 {\n\tdisplay: none;\n}\n";
				$css .= "#" . $bloc->ckid . " .main {\n\twidth: 100% !important;\n\tclear:both;\n\tfloat:left;\n}\n";
				break;
			case 'mobile_rightbottom':
				$css = "#" . $bloc->ckid . " .column2, #" . $bloc->ckid . " .center {\n\twidth: 100% !important;\n\tclear: both;\n\tfloat:left;\n}\n";
				$css .= "#" . $bloc->ckid . " .column2 div.inner, #" . $bloc->ckid . " .column2 div.inner > div {\nmargin-left: 0 !important;\nmargin-right: 0 !important;\n}\n";
				break;
			case 'mobile_righthidden':
				$css = "#" . $bloc->ckid . " .column2 {\n\tdisplay: none;\n}\n";
				$css = "#" . $bloc->ckid . " .center {\n\twidth: 100% !important;\n\tclear: both;\n\tfloat:left;\n}\n";
				break;
		}

		return $css;
	}

	/**
	 * Method to transform the html code to responsive interface
	 *
	 * @access	public
	 * @return	string	html code
	 */
	private function uncompressData($data) {
		$resolutions = array('1', '2', '3', '4');
		$fdata = new stdClass();
		foreach ($resolutions as $resolution) {
			$val = 'resolution' . $resolution;
			$data->$val = Json_decode($data->$val);
			$fdata->$val = $data->$val;
		}

		return $fdata;
	}

}

/**
 * Convert a hexa decimal color code to its RGB equivalent
 *
 * @param string $hexStr (hexadecimal color value)
 * @param boolean $returnAsString (if set true, returns the value separated by the separator character. Otherwise returns associative array)
 * @param string $seperator (to separate RGB values. Applicable only if second parameter is true.)
 * @return array or string (depending on second parameter. Returns False if invalid hex color value)
 */
function hex2RGB($hexStr, $opacity) {
	$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
	$rgbArray = array();
	if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
		$colorVal = hexdec($hexStr);
		$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
		$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
		$rgbArray['blue'] = 0xFF & $colorVal;
	} elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
		$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
		$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
		$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
	} else {
		return false; //Invalid hex color code
	}
	$rgbacolor = "rgba(" . $rgbArray['red'] . "," . $rgbArray['green'] . "," . $rgbArray['blue'] . "," . ($opacity / 100) . ")";

	return $rgbacolor;
}
