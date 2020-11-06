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
?>
<div class="ckpopupoverlay"></div>
<div class="ckpopupheader">
    <div class="ckpopuplogo"></div>
    <div class="ckpopuptitle"><?php echo JText::_('CK_MAINCONTENT_EDIT'); ?></div>
    <div style="float:right;">
        <div class="ckclose ckcancel" onclick="$ck('#popup_editionck').empty().hide();"><?php echo JText::_('CK_CANCEL'); ?></div>
        <div class="ckclose cksave" onclick="saveMaincontentPopup();"><?php echo JText::_('CK_VALIDATE'); ?></div>
    </div>
    <div class="clr"></div>
</div>
<table>
	<tr>
		<td style="vertical-align:top;">
			<div class="layoutinfos">
				<div class="layoutinfostitle"><?php echo JText::_('CK_MAINCONTENT_INFOS'); ?></div>
				<div class="layoutinfosdesc"><?php echo JText::_('CK_MAINCONTENT_DESC'); ?></div>
			</div>
		</td>
		<td style="vertical-align:top;">
			<div id="elementscontainer" style="margin-top: 8px;">
				<div id="maincontentmanagertitle"><?php echo JText::_('CK_MAINCONTENT'); ?></div>
				<div id="maincontentmanager">
					<div id="maincontentmanager_left" class="column maincontentmanager candisable" target="column1">
						<div class="inner">
							<div class="maincontentmanagerbloctitle">left</div>
						</div>
					</div>
					<div id="maincontentmanager_main" class="column">
						<div class="inner">
							<div id="maincontentmanager_maintop" class="clearfix maincontentmanager candisable" target="maintop">
								<div class="inner">
									<div class="maincontentmanagerbloctitle">maintop</div>
								</div>
							</div>
							<div id="maincontentmanager_maincenter" class="clearfix">
								<div class="inner">
									<div id="maincontentmanager_center" class="column">
										<div class="inner">
											<div id="maincontentmanager_centertop" class="clearfix maincontentmanager candisable" target="centertop">
												<div class="inner">
													<div class="maincontentmanagerbloctitle">centertop</div>

												</div>
											</div>
											<div style="border: 1px solid transparent;"></div>
											<div id="maincontentmanager_content" class="clearfix maincontentmanager">
												<div class="inner">
													<div class="maincontentmanagerbloctitle">content</div>
												</div>
											</div>
											<div style="border: 1px solid transparent;"></div>
											<div id="maincontentmanager_centerbottom" class="clearfix maincontentmanager candisable" target="centerbottom">
												<div class="inner">
													<div class="maincontentmanagerbloctitle">centerbottom</div>

												</div>
											</div>
										</div>
									</div>
									<div id="maincontentmanager_right" class="column maincontentmanager candisable" target="column2">
										<div class="inner">
											<div class="maincontentmanagerbloctitle">right</div>
										</div>
									</div>
									<div class="clr"></div>
								</div>
							</div>
							<div id="maincontentmanager_mainbottom" class="clearfix maincontentmanager candisable" target="mainbottom">
								<div class="inner">
									<div class="maincontentmanagerbloctitle">mainbottom</div>

								</div>
							</div>
							<div class="clr"></div>
						</div>
					</div>
					<div class="clr"></div>
				</div>
				<div class="clr"></div>
				<div style="float:left;margin: 5px 0 0 7px;width: 145px;">
					<div class="columnwidth_barleft"></div>
					<input type="text" class="blocwidthselect" id="blocwidthselectleft" value="" onchange="calculatecolumnswidth();"/>
					<div class="columnwidth_barright"></div>
					<div class="clr"></div>
					<div class="columnwidthtitle"><?php echo JText::_('CK_LEFTCOLUMN_WIDTH'); ?></div>
				</div>
				<div style="float:left;margin: 5px 7px 0 7px;width: 300px;">
					<div class="contentwidth_barleft"></div>
					<input type="text" class="blocwidthselect" id="blocwidthselectcontent" value="" onchange="calculatecolumnswidth();"/>
					<div class="contentwidth_barright"></div>
					<div class="clr"></div>
					<div class="columnwidthtitle"><?php echo JText::_('CK_MAINCOLUMN_WIDTH'); ?></div>
				</div>
				<div style="float:left;margin: 5px 0 0 7px;width: 145px;">
					<div class="columnwidth_barleft"></div>
					<input type="text" class="blocwidthselect" id="blocwidthselectright" value="" onchange="calculatecolumnswidth();"/>
					<div class="columnwidth_barright"></div>
					<div class="clr"></div>
					<div class="columnwidthtitle"><?php echo JText::_('CK_RIGHTCOLUMN_WIDTH'); ?></div>
				</div>
				<div class="clr"></div>
			</div>
		</td>
	</tr>
</table>
<script language="javascript" type="text/javascript">
			$ck('.candisable').click(function() {
				bloc = $ck(this);
				if (!$ck(this).hasClass('disabled')) {
					$ck(this).addClass('disabled');
				} else {
					$ck(this).removeClass('disabled');
				}
				if (bloc.attr('id') == 'maincontentmanager_left' || bloc.attr('id') == 'maincontentmanager_right')
					toggleWidthState();
			});

			function toggleWidthState() {
				if ($ck('#maincontentmanager_left').hasClass('disabled')) {
					$ck('#blocwidthselectleft').attr('value', '0');
					$ck('#blocwidthselectleft').attr('disabled', true);
				} else {
					$ck('#blocwidthselectleft').attr('disabled', false);
					$ck('#blocwidthselectleft').attr('value', '25');
				}
				if ($ck('#maincontentmanager_right').hasClass('disabled')) {
					$ck('#blocwidthselectright').attr('value', '0');
					$ck('#blocwidthselectright').attr('disabled', true);
				} else {
					$ck('#blocwidthselectright').attr('disabled', false);
					$ck('#blocwidthselectright').attr('value', '25');
				}

				calculatecolumnswidth();
			}

			function initmainmodele() {
				var focus = $ck('.cssfocus');
				$ck('.maincontentmanager').each(function(i, module) {
					module = $ck(module);
					var target = module.attr('target');
					if (focus.attr('isdisabledmodule' + target) == 'true') {
						module.addClass('disabled');
					}
				});
				var leftwidth = $ck('#maincontentmanager_left').hasClass('disabled') ? '0' : $ck('.column1', focus).attr('blocwidth');
				var rightwidth = $ck('#maincontentmanager_right').hasClass('disabled') ? '0' : $ck('.column2', focus).attr('blocwidth');
				$ck('#blocwidthselectleft').attr('value', leftwidth);
				$ck('#blocwidthselectright').attr('value', rightwidth);
				toggleWidthState();

			}

			function calculatecolumnswidth() {
				var leftwidth = $ck('#blocwidthselectleft').attr('value');
				var rightwidth = $ck('#blocwidthselectright').attr('value');
				var contentwidth = 100 - parseFloat(leftwidth) - parseFloat(rightwidth);
				$ck('#blocwidthselectleft').attr('value', parseFloat(leftwidth) + '%');
				$ck('#blocwidthselectright').attr('value', parseFloat(rightwidth) + '%');
				$ck('#blocwidthselectcontent').attr('value', contentwidth + '%');
			}

			initmainmodele();
</script>