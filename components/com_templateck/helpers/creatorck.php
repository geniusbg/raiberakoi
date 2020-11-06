<?php

/**
 * @name		Template Creator CK 3
 * @package		com_templateck
 * @copyright	Copyright (C) 2013. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */
defined('_JEXEC') or die;

abstract class TemplateCreatorck {

	public static function openWrapper($blockid, $fluid = 'fluid') {
		$fluidClass = ($fluid == 'fluid') ? '-fluid' : '';
		$html = "<div id=\"" . $blockid . "\" class=\"wrapper ckbloc\">
            <script type=\"text/javascript\">jQuery(\"#" . $blockid . "\").mouseenter(function() {addEdition(this);});
        jQuery(\"#" . $blockid . "\").mouseleave(function() {removeEdition(this);});</script>
            <div class=\"ckstyle\"></div>
            <div class=\"container" . $fluidClass . " inner\">";
		return $html;
	}

	public static function closeWrapper() {
		$html = "</div>
        </div>";
		return $html;
	}

	public static function addMaincontrol($type) {
		if ($type == 'container') {
			$html = "<div class=\"maincontrol " . $type . "\" onclick=\"createWrapperBloc(this)\">";
			$html .= JText::_('CK_ADD_WRAPPER');
		} else {
			$html = "<div class=\"maincontrol " . $type . "\" onclick=\"showBlocSelection(this)\">";
			$html .= JText::_('CK_ADD_BLOCK');
		}
		$html .= "</div>";
		return $html;
	}

	public static function singleModule($blockid, $position) {
		$html = "<div id=\"" . $blockid . "\" class=\"singlemodule ckbloc\" ckmoduleposition=\"" . $position . "\" onmouseover=\"addControlsOnHover(this);\" \">
            <div class=\"ckstyle\"></div>
            <div class=\"inner clearfix\">
            <div class=\"moduletable\">
                " . self::fillNews() . "
            </div>
            </div>
        </div>";
		return $html;
	}

	public static function horizMenu($blockid, $position) {
		$html = "<div id=\"" . $blockid . "\" class=\"horiznav ckbloc\" ckmoduleposition=\"" . $position . "\">
            " . self::addJs($blockid) . "
            " . self::addMenuCssProps($blockid) . "
            <div class=\"ckstyle\">
                <style type=\"text/css\" >" . self::addMenuCssStyles($blockid) . "</style>
            </div>
            <div class=\"inner clearfix\">
            <div class=\"moduletable\">
                " . self::fillHorizmenu() . "
            </div>
            </div>
        </div>";
		return $html;
	}

	public static function custombloc($blockid, $position) {
		$html = "<div id=\"" . $blockid . "\" class=\"custombloc ckbloc\">
           " . self::addJs($blockid) . "
            <div class=\"ckstyle\"></div>
            <div class=\"inner clearfix\">
            <div class=\"customcont\" contenteditable=\"true\" style=\"height:75px;background-color:#efefef;border:1px solid #666;\">
            </div>
            </div>
        </div>";
		return $html;
	}

	public static function banner($blockid, $position) {
		$html = "<div id=\"" . $blockid . "\" class=\"mainbanner ckbloc\">
            " . self::addJs($blockid) . "
            <div class=\"ckstyle\"></div>
            <div class=\"inner clearfix\">
                <div id=\"" . $blockid . "logo\" class=\"bannerlogo ckbloc\">
                    <div class=\"tab_logodescstyles ckprops\" logodesccolor=\"#a3a3a3\" logodescfontsize=\"13\" logodescfontfamily=\"Arial, sans-serif\" logodescalignementcenter=\"checked\" fieldslist=\"logodesccolor,logodescfontsize,logodescfontfamily,logodescalignementcenter\"></div>
                    <div class=\"tab_blocstyles ckprops\" blocbackgroundimageurl=\"components/com_templateck/images/logo_fake.png\" blocwidth=\"216\" blocheight=\"53\" blocmarginright=\"150\" fieldslist=\"blocbackgroundimageurl,blocwidth,blocheight,blocmarginright\"></div>
                    " . self::addJs($blockid . "logo") . "
                    <div class=\"ckstyle\">
                    <style type=\"text/css\" >#" . $blockid . "logo > div.inner > .bannerlogodesc {
                    color: #a3a3a3;
                    text-align: center;
                    font-size: 13px;
                    font-family: Arial, sans-serif;
                    }

                    #" . $blockid . "logo > div.inner {
                    margin-right: 150px;
                    }
                    </style>
                    </div>
                    <div class=\"inner\">
                        <img src=\"components/com_templateck/images/logo_fake.png\" width=\"216\" height=\"53\" />
                        <div class=\"bannerlogodesc\">
                            <div class=\"inner\">
                                <div>This is the slogan for my company</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id=\"" . $blockid . "module\" class=\"banner ckbloc\" ckmoduleposition=\"" . $position . "\" >
                    " . self::addJs($blockid . "module") . "
                    <div class=\"tab_blocstyles ckprops\" blocwidth=\"290px\" fieldslist=\"blocwidth\"></div>
                    <div class=\"ckstyle\"><style type=\"text/css\" >#" . $blockid . "module {width: 290px;}</style></div>
                    <div class=\"inner clearfix\">
                        <div class=\"moduletable\">
                            " . self::fillNews() . "
                        </div>
                    </div>
                </div>
                <div class=\"clr\"></div>
            </div>
        </div>";
		return $html;
	}

	public static function flexiblemodules($blockid, $positions) {
		$positions = explode(',', $positions);
		$html = "<div id=\"" . $blockid . "\" class=\"flexiblemodules ckbloc\">
            " . self::addJs($blockid) . "
            <div class=\"ckstyle\"></div>
            <div class=\"inner clearfix\">
                <div id=\"" . $blockid . "mod1\" class=\"flexiblemodule ckbloc\" ckmoduleposition=\"" . $positions[0] . "\">
                    " . self::addJs($blockid . "mod1") . "
                    <div class=\"ckstyle\"></div>
                    <div class=\"inner clearfix\">
                        <div class=\"moduletable\">
                            " . self::fillNews() . "
                        </div>
                    </div>
                </div>
                <div id=\"" . $blockid . "mod2\" class=\"flexiblemodule ckbloc\" ckmoduleposition=\"" . $positions[1] . "\">
                    " . self::addJs($blockid . "mod2") . "
                    <div class=\"ckstyle\"></div>
                    <div class=\"inner clearfix\">
                        <div class=\"moduletable\">
                            " . self::fillNews() . "
                        </div>
                    </div>
                </div>
                <div id=\"" . $blockid . "mod3\" class=\"flexiblemodule ckbloc\" ckmoduleposition=\"" . $positions[2] . "\">
                    " . self::addJs($blockid . "mod3") . "
                    <div class=\"ckstyle\"></div>
                    <div class=\"inner clearfix\">
                        <div class=\"moduletable\">
                            " . self::fillNews() . "
                        </div>
                    </div>
                </div>
                <div id=\"" . $blockid . "mod4\" class=\"flexiblemodule ckbloc\" ckmoduleposition=\"" . $positions[3] . "\">
                    " . self::addJs($blockid . "mod4") . "
                    <div class=\"ckstyle\"></div>
                    <div class=\"inner clearfix\">
                        <div class=\"moduletable\">
                            " . self::fillNews() . "
                        </div>
                    </div>
                </div>
                <div id=\"" . $blockid . "mod5\" class=\"flexiblemodule ckbloc\" ckmoduleposition=\"" . $positions[4] . "\">
                    " . self::addJs($blockid . "mod5") . "
                    <div class=\"ckstyle\"></div>
                    <div class=\"inner clearfix\">
                        <div class=\"moduletable\">
                            " . self::fillNews() . "
                        </div>
                    </div>
                </div>
                <div class=\"clr\"></div>
            </div>
        </div>";
		return $html;
	}

	public static function maincontent($blockid = '', $left = true, $right = true, $maintop = true, $mainbottom = true, $centertop = true, $centerbottom = true) {
		$isdisabledattributes = "";
		$isrighthidden = "";
		$isallhidden = "";
		$isallparenthidden = "";
		$maincontentclass = "";
		$leftdisabled = ($left) ? " isdisabled=\"false\"" : " isdisabled=\"true\"";
		$rightdisabled = ($right) ? " isdisabled=\"false\"" : " isdisabled=\"true\"";
		$maintopdisabled = ($maintop) ? " isdisabled=\"false\"" : " isdisabled=\"true\"";
		$mainbottomdisabled = ($mainbottom) ? " isdisabled=\"false\"" : " isdisabled=\"true\"";
		$centertopdisabled = ($centertop) ? " isdisabled=\"false\"" : " isdisabled=\"true\"";
		$centerbottomdisabled = ($centerbottom) ? " isdisabled=\"false\"" : " isdisabled=\"true\"";
		// main, maincenter, center, content
		$contenthidden = ($centertop && $centerbottom) ? " ishidden=\"false\"" : " ishidden=\"true\"";
		$centerhidden = ($right) ? " ishidden=\"false\"" : " ishidden=\"true\"";
		$maincenterhidden = ($maintop && $mainbottom) ? " ishidden=\"false\"" : " ishidden=\"true\"";
		$mainhidden = ($left) ? " ishidden=\"false\"" : " ishidden=\"true\"";
		$isdisabledattributes .= ($left) ? "" : " isdisabledmodulecolumn1=\"true\"";
		$isdisabledattributes .= ($right) ? "" : " isdisabledmodulecolumn2=\"true\"";
		$isdisabledattributes .= ($maintop) ? "" : " isdisabledmodulemaintop=\"true\"";
		$isdisabledattributes .= ($mainbottom) ? "" : " isdisabledmodulemainbottom=\"true\"";
		$isdisabledattributes .= ($centertop) ? "" : " isdisabledmodulecentertop=\"true\"";
		$isdisabledattributes .= ($centerbottom) ? "" : " isdisabledmodulecenterbottom=\"true\"";
		$maincontentclass .= ($left) ? "" : " noleftcol";
		$maincontentclass .= ($right) ? "" : " norightcol";
		$html = "<div id=\"" . $blockid . "maincontent\" class=\"maincontent ckbloc" . $maincontentclass . "\"" . $isdisabledattributes . ">
            " . self::addJs($blockid . "maincontent") . "
            <div class=\"ckstyle\"></div>
            <div class=\"inner clearfix\">
            <div id=\"" . $blockid . "left\" class=\"column column1 ckbloc\" ckmoduleposition=\"position-7\"" . $leftdisabled . " blocwidth=\"25%\">
                " . self::addJs($blockid . "left") . "
                <div class=\"ckstyle\"></div>
                <div class=\"inner clearfix\">
                    <div class=\"moduletable\">
                        " . self::fillMenu() . "
                    </div>
                    <div class=\"moduletable\">
                        " . self::fillNews() . "
                    </div>
                    <div class=\"moduletable\">
                        " . self::fillLoginform() . "
                    </div>
                </div>
            </div>
            <div id=\"" . $blockid . "main\" class=\"column main ckbloc\"" . $mainhidden . ">
                " . self::addJs($blockid . "main") . "
                <div class=\"ckstyle\"></div>
                <div class=\"inner clearfix\">
                    <div id=\"" . $blockid . "maintop\" class=\"maintop ckbloc clearfix\" ckmoduleposition=\"maintop\"" . $maintopdisabled . ">
                        " . self::addJs($blockid . "maintop") . "
                        <div class=\"ckstyle\"></div>
                        <div class=\"inner clearfix\">
                            <div class=\"moduletable\">
                                " . self::fillNews() . "
                            </div>
                        </div>
                    </div>
                    <div id=\"" . $blockid . "maincenter\" class=\"maincenter ckbloc\"" . $maincenterhidden . ">
                        " . self::addJs($blockid . "maincenter") . "
                        <div class=\"ckstyle\"></div>
                        <div class=\"inner clearfix\">
                            <div id=\"" . $blockid . "center\" class=\"column center ckbloc\"" . $centerhidden . ">
                                " . self::addJs($blockid . "center") . "
                                <div class=\"ckstyle\"></div>
                                <div class=\"inner clearfix\">
                                    <div id=\"" . $blockid . "centertop\" class=\"centertop ckbloc\" ckmoduleposition=\"centertop\"" . $centertopdisabled . ">
                                        " . self::addJs($blockid . "centertop") . "
                                        <div class=\"ckstyle\"></div>
                                        <div class=\"inner clearfix\">
                                            <div class=\"moduletable\">
                                                " . self::fillNews() . "
                                            </div>
                                        </div>
                                    </div>
                                    <div id=\"" . $blockid . "content\" class=\"content ckbloc\"" . $contenthidden . ">
                                        " . self::addJs($blockid . "content") . "
                                        <div class=\"ckstyle\"></div>
                                        <div class=\"inner clearfix\">
                                            " . self::fillContent() . "
                                        </div>
                                    </div>
                                    <div id=\"" . $blockid . "centerbottom\" class=\"centerbottom ckbloc\" ckmoduleposition=\"centerbottom\"" . $centerbottomdisabled . ">
                                        " . self::addJs($blockid . "centerbottom") . "
                                        <div class=\"ckstyle\"></div>
                                        <div class=\"inner clearfix\">
                                            <div class=\"moduletable\">
                                                " . self::fillNews() . "
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id=\"" . $blockid . "right\" class=\"column column2 ckbloc\" ckmoduleposition=\"position-6\"" . $rightdisabled . " blocwidth=\"25%\" >
                                " . self::addJs($blockid . "right") . "
                                <div class=\"ckstyle\"></div>
                                <div class=\"inner clearfix\">
                                    <div class=\"moduletable\">
                                        " . self::fillNews() . "
                                    </div>
                                </div>
                            </div>
                            <div class=\"clr\"></div>
                        </div>
                    </div>
                    <div id=\"" . $blockid . "mainbottom\" class=\"mainbottom ckbloc\" ckmoduleposition=\"mainbottom\"" . $mainbottomdisabled . ">
                        " . self::addJs($blockid . "mainbottom") . "
                        <div class=\"ckstyle\"></div>
                        <div class=\"inner clearfix\">
                            <div class=\"moduletable\">
                                " . self::fillNews() . "
                            </div>
                        </div>
                    </div>
                    <div class=\"clr\"></div>
                </div>
            </div>
            <div class=\"clr\"></div>
            </div>
        </div>";
		return $html;
	}

	public static function addJs($blockid) {
		$html = "<script type=\"text/javascript\">jQuery(\"#" . $blockid . "\").mouseenter(function() {addEdition(this);});
        jQuery(\"#" . $blockid . "\").mouseleave(function() {removeEdition(this);});</script>";

		return $html;
	}

	public static function addMenuCssProps($blockid) {
		$html = '<div class="tab_thirdlevelcontainer ckprops" level2bgmargintop="-30" level2bgmarginleft="190"
        fieldslist="level2bgmargintop,level2bgmarginleft"
        ></div>
        <div class="tab_firstlevellink ckprops" level0itemcolor="#000000" level0itemmargins="2" level0itemmarginright="10" level0itempaddings="5"
        fieldslist="level0itemcolor,level0itemmargins,level0itempaddings,level0itemmarginright"
        ></div>
        <div class="tab_firstlevellinkhover ckprops" level0itemhovercolor=""
        fieldslist="level0itemhovercolor"
        ></div>
        <div class="tab_secondlevelcontainer ckprops" level1bgbackgroundcolorstart="#e8e8e8" level1bgwidth="200"
        fieldslist="level1bgbackgroundcolorstart,level1bgwidth"
        ></div>
        <div class="tab_secondlevellink ckprops" level1itemcolor="#4a4a4a" level1itemmargins="2" level1itempaddings="5"
        fieldslist="level1itemcolor,level1itemmargins,level1itempaddings"
        ></div>
        <div class="tab_secondlevellinkhover ckprops" level1itemhoverbackgroundcolorstart="#d1d1d1"
        fieldslist="level1itemhoverbackgroundcolorstart"
        ></div>';

		return $html;
	}

	public static function addMenuCssStyles($blockid) {
		$html = '#' . $blockid . ' > div.inner {
text-align: left;
}
#' . $blockid . ' ul.menu {
margin: 0;
padding: 0;
}
#' . $blockid . ' ul.menu li {
margin: 0;
padding: 0;
float: left;
list-style:none;
white-space: nowrap;
}
#' . $blockid . ' ul.menu li a, #' . $blockid . ' ul.menu li span.separator {
display:block;
color: #000;
margin: 2px;
margin-right: 10px;
padding: 5px;
text-align: left;
}
#' . $blockid . ' ul.menu li:hover > a {
color: #000000;
text-align: left;
}
#' . $blockid . ' ul.menu li li a, #' . $blockid . ' ul.menu li li span.separator {
display:block;
color: #4a4a4a;
margin: 2px;
padding: 5px;
text-align: left;
}
#' . $blockid . ' ul.menu li li:hover > a {
background: #d1d1d1;
text-align: left;
}
#' . $blockid . ' ul.menu li ul, #' . $blockid . ' ul.menu li:hover ul ul, #' . $blockid . ' ul.menu li:hover ul ul ul {
position: absolute;
left: -999em;
z-index: 999;
margin: 0;
padding: 0;
background: #e8e8e8;
width: 200px;
}
#' . $blockid . ' ul.menu li:hover ul ul, #' . $blockid . ' ul.menu li:hover li:hover ul ul, #' . $blockid . ' ul.menu li:hover li:hover li:hover ul ul,
#' . $blockid . ' ul.menu li.sfhover ul ul, #' . $blockid . ' ul.menu li.sfhover ul.sfhover ul ul, #' . $blockid . ' ul.menu li.sfhover ul.sfhover ul.sfhover ul ul {
left: -999em;
}
#' . $blockid . ' ul.menu li:hover > ul, #' . $blockid . ' ul.menu li:hover ul li:hover > ul, #' . $blockid . ' ul.menu li:hover ul li:hover ul li:hover > ul, #' . $blockid . ' ul.menu li:hover ul li:hover ul li:hover ul li:hover > ul,
#' . $blockid . ' ul.menu li.sfhover ul, #' . $blockid . ' ul.menu li.sfhover ul li.sfhover ul, #' . $blockid . ' ul.menu li.sfhover ul li.sfhover ul li.sfhover ul, #' . $blockid . ' ul.menu li.sfhover ul li.sfhover ul li.sfhover ul li.sfhover ul {
left: auto;
}
#' . $blockid . ' ul.menu li:hover ul li:hover ul {
margin-top: -30px;
margin-left: 190px;
}

#' . $blockid . ' ul.menu.maximenuCK li ul, #' . $blockid . ' ul.menu.maximenuCK li:hover ul ul, #' . $blockid . ' ul.menu.maximenuCK li:hover ul ul ul,
#' . $blockid . ' ul.menu.maximenuck li ul, #' . $blockid . ' ul.menu.maximenuck li:hover ul ul, #' . $blockid . ' ul.menu.maximenuck li:hover ul ul ul {
position: static !important;
left: auto !important;
background: transparent !important;
border-radius: 0 !important;
border: none !important;
-moz-border-radius: 0 !important;
-o-border-radius: 0 !important;
-webkit-border-radius: 0 !important;
width: 100% !important;
box-shadow: none !important;
-moz-box-shadow: none !important;
-webkit-box-shadow: none !important;
}
#' . $blockid . ' ul.menu.maximenuCK li ul ul,
#' . $blockid . ' ul.menu.maximenuck li ul ul {
margin: 0 !important;
}
#' . $blockid . ' li div.floatCK,
#' . $blockid . ' li div.floatck {
background: #e8e8e8;
width: 200px;
}
#' . $blockid . ' ul.menu li ul.maximenuCK2,
#' . $blockid . ' ul.menu li ul.maximenuck2 {
margin: 0;
padding: 0;
}
#' . $blockid . ' ul.menu li div.maximenuCK2,
#' . $blockid . ' ul.menu li div.maximenuck2 {
float: left;
width: 100%;
}
#' . $blockid . ' ul li.maximenuCK div.floatCK div.floatCK,
#' . $blockid . ' ul li.maximenuck div.floatck div.floatck {
margin-top: -30px;
margin-left: 190px;
}
#' . $blockid . ' span.descCK,
#' . $blockid . ' span.descck {
display: block;
line-height: 10px;
}
#' . $blockid . ' ul.menu li li {
float: none;
display: block;
} ';

		return $html;
	}

	public static function fillLoginform() {
		$html = "<h3>Login Form</h3>
            <form id=\"login-form\" class=\"form-inline\">
                <div class=\"userdata\">
                    <div id=\"form-login-username\" class=\"control-group\">
                        <div class=\"controls\">
                            <div class=\"input-prepend input-append\">
                                <span class=\"add-on\"><span class=\"icon-user tip\" title=\"User Name\"></span><label for=\"modlgn-username\" class=\"element-invisible\">User Name</label></span>
                                <input id=\"modlgn-username\" type=\"text\" name=\"username\" class=\"input-small\" tabindex=\"1\" size=\"18\" placeholder=\"User Name\" />
                            </div>
                        </div>
                    </div>
                    <div id=\"form-login-password\" class=\"control-group\">
                        <div class=\"controls\">
                            <div class=\"input-prepend input-append\">
                                <span class=\"add-on\"><span class=\"icon-lock tip\" title=\"Password\"></span><label for=\"modlgn-passwd\" class=\"element-invisible\">Password</label></span>
                                <input id=\"modlgn-passwd\" type=\"password\" name=\"password\" class=\"input-small\" tabindex=\"2\" size=\"18\" placeholder=\"Password\" />

                            </div>
                        </div>
                    </div>
                    <div id=\"form-login-remember\" class=\"control-group checkbox\">
                        <label for=\"modlgn-remember\" class=\"control-label\">Remember Me</label> <input id=\"modlgn-remember\" type=\"checkbox\" name=\"remember\" class=\"inputbox\" value=\"yes\"/>
                    </div>
                    <div id=\"form-login-submit\" class=\"control-group\">
                        <div class=\"controls\">
                            <input type=\"button\" tabindex=\"3\" name=\"\" class=\"btn btn-primary btn\" value=\"Log in\" />
                        </div>
                    </div>
                    <ul class=\"unstyled\">
                        <li>
                            <a href=\"javascript:void(0);\">
                            Create an account <span class=\"icon-arrow-right\"></span></a>
                        </li>
                    </ul>
                </div>
            </form>";

		return $html;
	}

	static function fillContent() {

		$html = "<div class=\"item-page\">

            <div class=\"page-header\">
                <h2>
                    <a href=\"javascript:void(0)\">Article title - H2</a>
                </h2>
                <div class=\"btn-group pull-right\">
                    <a class=\"btn dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:void(0);\"> <span class=\"icon-cog\"></span> <span class=\"caret\"></span> </a>
                    <ul class=\"dropdown-menu actions\">
                        <li class=\"print-icon\"> <a href=\"javascript:void(0);\" title=\"Imprimer\" ><span class=\"icon-print\"></span>&#160;Imprimer&#160;</a> </li>
                        <li class=\"email-icon\"> <a href=\"javascript:void(0);\" title=\"E-mail\" ></span> E-mail</a> </li>
                    </ul>
                </div>
                <div class=\"article-info muted\">
                    <dl class=\"article-info\">
                        <dt class=\"article-info-term\">Détails</dt>
                        <dd class=\"createdby\">Written by Joomla</dd>
                        <dd class=\"category-name\">Category : <a href=\"javascript:void(0)\">Joomla!</a></dd>
                        <dd class=\"published\"><span class=\"icon-calendar\"></span>Published: 01 January 2011</dd>
                        <dd class=\"hits\"><span class=\"icon-eye-open\"></span>Hits: 2</dd>
                    </dl>
                </div>
                <p>Congratulations! You have a Joomla site! Joomla makes it easy to build a website just the way you want it and keep it simple to update and maintain.</p>
<p>Joomla is a flexible and powerful platform, whether you are building a small site for yourself or a huge site with hundreds of thousands of visitors. Joomla is open source, which means you can make it work just the way you want it to.</p>
<p>The content in this installation of Joomla has been designed to give you an in depth tour of Joomla's features.</p>
                <p class=\"readmore\">
                    <a class=\"btn\" href=\"javascript:void(0)\"> <span class=\"icon-chevron-right\"></span>Readmore&nbsp;: Joomla</a>
                </p>
                <h1>H1 title</h1>
                <h2>H2 title</h2>
                <h3>H3 title</h3>
                <h4>H4 title</h4>
                <h5>H5 title</h5>
                <h6>H6 title</h6>
				<ul class=\"pager pagenav\">
					<li class=\"previous\">
						<a href=\"javascript:void(0)\" rel=\"prev\">&lt; Prev</a>
					</li>
					<li class=\"next\">
						<a href=\"javascript:void(0)\" rel=\"next\">Next &gt;</a>
					</li>
				</ul>
            </div>
        </div>";

		return $html;
	}

	static function fillMenu() {
		$html = "<h3>Menu</h3>
                    <ul class=\"nav menu\">
                        <li class=\"item-437\"><a href=\"javascript:void(0);\" >Getting Started</a></li>
                        <li class=\"item-280 parent\"><a href=\"javascript:void(0);\" >Using Joomla!</a></li>
                        <li class=\"item-278\"><a href=\"javascript:void(0);\" >The Joomla! Project</a></li>
                        <li class=\"item-279\"><a href=\"javascript:void(0);\" >The Joomla! Community</a></li>
                    </ul>";
		return $html;
	}

	static function fillHorizmenu() {
		$html = "<ul class=\"nav menu\">
                <li id=\"item-435\" class=\"current active\"><a href=\"javascript:void(0);\">Nullam luctus</a></li>
                <li><a href=\"javascript:void(0);\">Vestibulum et neque</a></li>
                <li class=\"deeper parent\"><a href=\"javascript:void(0);\">Etiam feugiat</a>
                    <ul>
                        <li><a href=\"javascript:void(0);\">Aenean luctus</a></li>
                        <li class=\"deeper parent\"><a href=\"javascript:void(0);\">Nullam eu elit</a>
                            <ul>
                                <li id=\"item-475\"><a href=\"javascript:void(0);\">Phasellus tincidunt</a></li>
                            </ul>
                        </li>
                        <li id=\"item-439\"><a href=\"javascript:void(0);\">Morbi eget justo</a></li>
                    </ul>
                </li>
                <li id=\"item-448\"><a href=\"javascript:void(0);\">Donec</a></li>
            </ul>";
		return $html;
	}

	static function fillNews() {
		$html = "<h3>Module</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed molestie scelerisque ultrices. Nullam venenatis, felis ut accumsan vestibulum, diam leo congue nisl, eget luctus sapien libero eget urna. Duis ac pellentesque nisi.</p>";
		return $html;
	}

}
