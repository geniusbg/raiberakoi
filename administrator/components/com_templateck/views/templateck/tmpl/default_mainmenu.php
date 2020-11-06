<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<style type="text/css">
    #ck_mainmenu {
        /*position: fixed;
        width: 200px;*/
        z-index: 100;
        left: 0;
        border: 1px solid #fff;
        margin: 0;
        padding:0;
        -moz-box-shadow: 0 0 5px #888;
        -webkit-box-shadow: 0 0 5px#888;
        box-shadow: 0 0 5px #888;
        background: #f5f5f5; /* Old browsers */
        background: -moz-linear-gradient(top, #f5f5f5 50%, #e5e5e5 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#f5f5f5), color-stop(100%,#e5e5e5)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #f5f5f5 50%,#e5e5e5 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #f5f5f5 50%,#e5e5e5 100%); /* Opera11.10+ */
        background: -ms-linear-gradient(top, #f5f5f5 50%,#e5e5e5 100%); /* IE10+ */
    }

    #ck_mainmenu ul {
        padding: 0;
        margin: 0;
    }

    #ck_mainmenu li {
        list-style: none;
        padding: 5px;
        display: inline-block;
        height: 25px;
        border-right: 1px solid #ddd;
    }

    #ck_mainmenu li a {
        text-transform: uppercase;
        /*display: block;*/
        padding: 7px;
        color: #333;
        line-height: 25px;
    }

    #ck_mainmenu li:hover {
        background: #f5f5f5; /* Old browsers */
        background: -moz-linear-gradient(bottom, #f5f5f5 50%, #e5e5e5 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left bottom, left top, color-stop(50%,#f5f5f5), color-stop(100%,#e5e5e5)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(bottom, #f5f5f5 50%,#e5e5e5 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(bottom, #f5f5f5 50%,#e5e5e5 100%); /* Opera11.10+ */
        background: -ms-linear-gradient(bottom, #f5f5f5 50%,#e5e5e5 100%); /* IE10+ */
    }

    #ck_mainmenu li div.inner {
        position: absolute;
        left: -999em;
        width: 200px;
    }

    #ck_mainmenu li:hover div.inner {
        left: auto;
        z-index: 90;
        padding: 5px;
        border-bottom: 1px solid #fff;
        border-right: 1px solid #fff;
        border-left: 1px solid #fff;
        -moz-box-shadow: 0px 0 5px 0px #888;
        -webkit-box-shadow: 0px 0 5px 0px #888;
        box-shadow: 0px 0 5px 0px #888;
        -moz-border-radius: 0em 0em 1em 1em;
        border-radius: 0em 0em 1em 1em;
        background-color: #e4e4e4;
    }

    #ck_mainmenu li li {
        display :block;
    }
</style>

<div id="ck_mainmenu">
    <ul>
        <li>
            <img src="components/com_templateck/images/infos24.png" align="left" style="margin-right:5px;"/>
            <a href="javascript:void(0);" rel="editGlobalinfos" class="ck_action"><?php echo JText::_('CK_INFOS_BUTTON'); ?></a>
        </li>
        <li>
            <img src="components/com_templateck/images/options24.png" align="left" style="margin-right:5px;"/>
            <a href="javascript:void(0);"><?php echo JText::_('CK_ADDBLOCK_BUTTON'); ?></a>
            <div class="inner">
                <ul id="addblockmenuslide">
                    <li>
                        <a href="javascript:void(0);" rel="createModule" class="ck_action"><?php echo JText::_('CK_SINGLE_MODULE'); ?></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" rel="createFlexiblemodules" class="ck_action"><?php echo JText::_('CK_FLEXIBLES_MODULES'); ?></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" rel="createBannerlogo" class="ck_action"><?php echo JText::_('CK_BANNER_LOGO'); ?></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" rel="createHorizontalmenu" class="ck_action"><?php echo JText::_('CK_HORIZ_MENU'); ?></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" rel="createMaincontent" class="ck_action"><?php echo JText::_('CK_MAIN_CONTENT'); ?></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" rel="createMaincontent2" class="ck_action"><?php echo JText::_('CK_MAIN_CONTENT_COMPLEX'); ?></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" rel="createCustomblock" class="ck_action"><?php echo JText::_('CK_CUSTOM_BLOCK'); ?></a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <img src="components/com_templateck/images/preview24.png" align="left" style="margin-right:5px;"/>
            <a href="javascript:void(0);" rel="templatePreview" class="ck_action"><?php echo JText::_('CK_PREVIEW_BUTTON'); ?></a>
        </li>
        <li>
            <img src="components/com_templateck/images/joomla24.png" align="left" style="margin-right:5px;"/>
            <a href="javascript:void(0);" rel="templatePackage" class="ck_action"><?php echo JText::_('CK_JOOMLA_BUTTON'); ?></a>
        </li>
        <li>
            <a id="checkmodules" rel="showcheckModules" class="ck_action"></a>
        </li>
        <li>
            <input type="checkbox" name="saveintemplate" id="saveintemplate" value="1" /><?php echo JText::_('CK_DIRECTSAVE'); ?><br />
        </li>
    </ul>
</div>