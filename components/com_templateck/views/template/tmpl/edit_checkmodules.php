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
?>
<div id="modules_code" class="ckpopup">
    <div class="ckpopupoverlay"></div>
    <div class="ckpopupheader">
        <div class="ckpopuplogo"></div>
        <div class="ckpopuptitle"><?php echo JText::_('CK_CHECK_MODULES'); ?></div>
        <div style="float:right;">
            <div class="ckclose ckcancel" onclick="$ck('#modules_code').hide();"><?php echo JText::_('CK_CANCEL'); ?></div>
        </div>
        <div class="clr"></div>
    </div>
    <table>
        <tr>
            <td style="vertical-align:top;">
                <div class="layoutinfos">
                    <div class="layoutinfostitle"><?php echo JText::_('CK_CHECKMODULES_INFOS'); ?></div>
                    <div class="layoutinfosdesc"><?php echo JText::_('CK_CHECKMODULES_DESC'); ?></div>
                </div>
            </td>
            <td style="vertical-align:top;">
                <div id="modules_code_inner" style="margin-top:20px;">

                </div>
            </td>
        </tr>
    </table>
</div>