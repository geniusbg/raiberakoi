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
<div id="joomla_code" class="ckpopup">
    <div class="ckpopupoverlay"></div>
    <div class="ckpopupheader">
        <div class="ckpopuplogo"></div>
        <div class="ckpopuptitle"><?php echo JText::_('CK_TEMPLATE_PACKAGE'); ?></div>
        <div style="float:right;">
            <div class="ckclose" onclick="document.getElements('.ckpopup').setStyle('display', 'none');"></div>
        </div>
        <div class="clr"></div>
    </div>
    <table>
        <tr>
            <td style="vertical-align:top;">
                <div class="layoutinfos">
                    <div class="layoutinfostitle"><?php echo JText::_('CK_PACKAGE_INFOS'); ?></div>
                    <div class="layoutinfosdesc"><?php echo JText::_('CK_PACKAGE_DESC'); ?></div>
                </div>
            </td>
            <td style="vertical-align:top;">
				<div class="packagesteparchive"></div>
				<div id="joomla_code_inner">
					<div id="packagestep1"></div>
					<div id="packagestepcss"></div>
					<div id="packagestepxml"></div>
					<div class="packagesteparchive"></div>
				</div>
			</td>
        </tr>
    </table>
</div>