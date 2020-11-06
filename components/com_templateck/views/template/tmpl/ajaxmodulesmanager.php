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
<style>

</style>
<div class="ckpopupoverlay"></div>
<div class="ckpopupheader">
    <div class="ckpopuplogo"></div>
    <div class="ckpopuptitle"><?php echo JText::_('CK_MODULES_MANAGER'); ?></div>
    <div style="float:right;">
        <div class="ckclose ckcancel" onclick="$ck('#popup_editionck').empty().hide();"><?php echo JText::_('CK_CANCEL'); ?></div>
        <div class="ckclose cksave" onclick="saveModulesPopup();"><?php echo JText::_('CK_VALIDATE'); ?></div>
    </div>
    <div class="clr"></div>
</div>
<table>
	<tr>
		<td style="vertical-align:top;">
			<div class="layoutinfos">
				<div class="layoutinfostitle"><?php echo JText::_('CK_MODULESMANAGER_INFOS'); ?></div>
				<div class="layoutinfosdesc"><?php echo JText::_('CK_MODULESMANAGER_DESC'); ?></div>
			</div>
		</td>
		<td style="vertical-align:top;">
			<div id="elementscontainer" style="margin-top: 8px;">

				<div id="modulesnumberselect">
					<div class="modulemanagerheader"><?php echo JText::_('CK_NUMBEROFMODULES'); ?></div>
					<div class="modulenumberselect" onclick="selectnumberofmodules(2);">
						<?php echo JText::_('2'); ?>
					</div>
					<div class="modulenumberselect" onclick="selectnumberofmodules(3);">
						<?php echo JText::_('3'); ?>
					</div>
					<div class="modulenumberselect" onclick="selectnumberofmodules(4);">
						<?php echo JText::_('4'); ?>
					</div>
					<div class="modulenumberselect" onclick="selectnumberofmodules(5);">
						<?php echo JText::_('5'); ?>
					</div>
					<input type="hidden" name="modulenumberselect" id="modulenumberselect" value="" />
					<div class="clr"></div>
				</div>
				<div id="modulesmanagertitle"><?php echo JText::_('CK_MODULESMANAGER'); ?></div>
				<div id="modulesmanager">

					<div class="modulemanagercontainer clearfix n2" nbmodules="2">
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="2module1" value="" onchange="calculatemoduleswidth(this);"/>
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="2module2" value="" onchange="calculatemoduleswidth(this);" />
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
					</div>
					<div class="modulemanagercontainer clearfix n3" nbmodules="3">
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="3module1" value="" onchange="calculatemoduleswidth(this);"/>
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="3module2" value="" onchange="calculatemoduleswidth(this);" />
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="3module3" value="" onchange="calculatemoduleswidth(this);" />
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
					</div>
					<div class="modulemanagercontainer clearfix n4" nbmodules="4">
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="4module1" value="" onchange="calculatemoduleswidth(this);"/>
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="4module2" value="" onchange="calculatemoduleswidth(this);" />
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="4module3" value="" onchange="calculatemoduleswidth(this);" />
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="4module4" value="" onchange="calculatemoduleswidth(this);" />
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
					</div>
					<div class="modulemanagercontainer clearfix n5" nbmodules="5">
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="5module1" value="" onchange="calculatemoduleswidth(this);"/>
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="5module2" value="" onchange="calculatemoduleswidth(this);" />
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="5module3" value="" onchange="calculatemoduleswidth(this);" />
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="5module4" value="" onchange="calculatemoduleswidth(this);" />
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
						<div class="modulemanager">
							<div class="inner" onclick="togglemodulewidthstate(this);">
							</div>
							<div class="modulewidthselectcont">
								<input type="text" class="inputbox modulewidthselect" id="5module5" value="" onchange="calculatemoduleswidth(this);" />
								<?php echo JText::_('%'); ?>
							</div>
							<div class="modulewidth">
								<div class="modulewidth_barleft"></div>
								<div class="modulewidth_barright"></div>
								<div class="clr"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>
<script language="javascript" type="text/javascript">
			function calculatemoduleswidth(field) {
				var container = $ck(field).parents('.modulemanagercontainer');//console.log(container);
				var enabledfields = $ck('.modulemanager:not(.disabled) .modulewidthselect:not(.disabled,.locked,#' + $ck(field).attr('id') + ')', container);
				var amount = enabledfields.length;
				//console.log(amount);
				var lockedvalue = 0;
				$ck('.modulewidthselect.locked', container).each(function(i, modulefield) { //console.log(modulefield);
					modulefield = $ck(modulefield);
					if (modulefield.attr('value') == '') {
						modulefield.removeClass('locked').next('input').attr('checked', false);
						calculatemoduleswidth(field);
					}
					if (modulefield.attr('id') != $ck(field).attr('id')) {
						lockedvalue = parseFloat(modulefield.attr('value')) + parseFloat(lockedvalue);
					}
				});
				var mw = parseFloat($ck(field).attr('value'));
				// $ck(field).attr('value',mw+'%');
				var percent = (100 - mw - lockedvalue) / amount;
				enabledfields.each(function(i, modulefield) {
					if ($ck(modulefield).attr('id') != $ck(field).attr('id')
							&& !$ck(modulefield).hasClass('locked')) {
						$ck(modulefield).attr('value', parseFloat(percent));
					}
				});
				changemoduledisplay();
			}

			function togglemodulewidthstate(locker) {
				var input = $ck(locker).parent().find('input.modulewidthselect');
				var enableamount = $ck('.modulemanager:not(.disabled)', $ck(locker).parents('.modulemanagercontainer')).length;
				var loackedamount = $ck('.modulewidthselect.locked', $ck(locker).parents('.modulemanagercontainer')).length;
				if (loackedamount >= (enableamount - 1) && !input.hasClass('locked')) {
					alert('Not possible ! You can not lock all the width');
					return;
				}

				if (!input.hasClass('locked')) {
					input.addClass('locked');
					$ck(locker).addClass('locked');
				} else {
					input.removeClass('locked');
					$ck(locker).removeClass('locked');
				}
			}

			function selectnumberofmodules(number) {

				$ck('.modulemanagercontainer:gt(' + (number - 2) + ')').css('display', 'none').addClass('disabled');
				$ck('.modulemanagercontainer:lt(' + (number - 1) + ')').css('display', 'block').removeClass('disabled');
				$ck('.modulenumberselect').removeClass('selected');
				$ck('.modulenumberselect:eq(' + (number - 2) + ')').addClass('selected');
				$ck('#modulenumberselect').attr('value', number);
			}

			function changemoduledisplay() {
				$ck('.modulemanager').each(function(i, module) {
					$ck(module).css('width', parseFloat($ck(module).find('.modulewidthselect').attr('value')) + '%');
				});
			}

			function initmodules() {
				var focus = $ck('.cssfocus');
				if (!focus.attr('numberofmodules')) {
					selectnumberofmodules(5);
				} else {
					selectnumberofmodules(focus.attr('numberofmodules'));

				}

				setmoduleswidth();
				changemoduledisplay();
			}

			function setmoduleswidth() {
				$ck('.modulemanagercontainer').each(function(i, modulesrow) {
					modulesrow = $ck(modulesrow);
					nbmodules = modulesrow.attr('nbmodules');
					moduleswidth = $ck('.cssfocus').attr('moduleswidth' + (i + 2)) ? $ck('.cssfocus').attr('moduleswidth' + (i + 2)).split(',') : getdefaultwidth(nbmodules);
					$ck('.modulewidthselect', modulesrow).each(function(j, module) {
						module = $ck(module);
						module.attr('value', moduleswidth[j]);
					});
				});
			}
			initmodules();
</script>