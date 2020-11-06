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
$currentblocid = $app->input->get('currentblocid');
?>
<div class="ckpopupoverlay"></div>
<div class="ckpopupheader">
    <div class="ckpopuplogo"></div>
    <div class="ckpopuptitle"><?php echo JText::_('CK_CSS_EDIT'); ?></div>
    <div style="float:right;">
        <div class="ckclose ckcancel" onclick="$ck('#popup_editionck').empty().hide();"><?php echo JText::_('CK_CANCEL'); ?></div>
        <div class="ckclose cksave" onclick="checkBlockSelection('<?php echo $currentblocid ?>');"><?php echo JText::_('CK_VALIDATE'); ?></div>
    </div>
    <div class="clr"></div>
</div>
<table>
	<tr>
		<td style="vertical-align:top;">
			<div class="layoutinfos">
				<div class="layoutinfostitle"><?php echo JText::_('CK_BLOCSELECTION_INFOS'); ?></div>
				<div class="layoutinfosdesc"><?php echo JText::_('CK_BLOCSELECTION_DESC'); ?></div>
			</div>
		</td>
		<td style="vertical-align:top;">
			<div id="elementscontainer" style="margin-top:20px;">
				<div class="blocselect singleModule" onclick="chooseBlockSelection('singleModule')"><div class="blocselecttitle"><?php echo JText::_('CK_SINGLE_MODULE') ?></div></div>
				<div class="blocselect flexiblemodules" onclick="chooseBlockSelection('flexiblemodules')"><div class="blocselecttitle"><?php echo JText::_('CK_FLEXIBLES_MODULES') ?></div></div>
				<div class="blocselect horizMenu" onclick="chooseBlockSelection('horizMenu')"><div class="blocselecttitle"><?php echo JText::_('CK_HORIZ_MENU') ?></div></div>
				<div class="blocselect banner" onclick="chooseBlockSelection('banner')"><div class="blocselecttitle"><?php echo JText::_('CK_BANNER_LOGO') ?></div></div>
				<div class="blocselect custombloc" onclick="chooseBlockSelection('custombloc')"><div class="blocselecttitle"><?php echo JText::_('CK_CUSTOM_BLOCK') ?></div></div>
				<div class="clr" style="border-bottom:1px solid #000;"></div>
				<div id="blocselectidcont">
					<input id="blocselecttype" name="blocselecttype" type="hidden" />
					<input id="blocselectid" name="blocselectid" class="inputbox" />&nbsp;<?php echo JText::_('CK_UNIQUE_ID') ?>
					<div class="clr"></div>
					<input id="blocselectposition" name="blocselectposition" class="inputbox" />
					<input id="blocselectposition2" name="blocselectposition2" class="inputbox blocselectposition" style="display:none;" />
					<input id="blocselectposition3" name="blocselectposition3" class="inputbox blocselectposition" style="display:none;" />
					<input id="blocselectposition4" name="blocselectposition4" class="inputbox blocselectposition" style="display:none;" />
					<input id="blocselectposition5" name="blocselectposition5" class="inputbox blocselectposition" style="display:none;" /><?php echo JText::_('CK_UNIQUE_POSITION') ?>
				</div>
			</div>
		</td>
	</tr>
</table>
<script language="javascript" type="text/javascript">
			function chooseBlockSelection(type) {
				idproposal = getIdProposal(type);
				$ck('#blocselectid').attr('value', idproposal);
				positionsproposal = getPositionsProposal(type);
				$ck('#blocselectposition').attr('value', positionsproposal[0]);
				$ck('#blocselectposition2').attr('value', positionsproposal[1]);
				$ck('#blocselectposition3').attr('value', positionsproposal[2]);
				$ck('#blocselectposition4').attr('value', positionsproposal[3]);
				$ck('#blocselectposition5').attr('value', positionsproposal[4]);
				$ck('#blocselecttype').attr('value', type);
				$ck('.blocselect').removeClass('selected');
				$ck('.blocselect.' + type).addClass('selected');
				if (type == 'flexiblemodules') {
					$ck('.blocselectposition').show();
				} else {
					$ck('.blocselectposition').hide();
				}
			}

			function checkBlockSelection(currentblocid) {
				var type = $ck('#blocselecttype').attr('value');
				if (!type) {
					alert(Joomla.JText._('CK_CHOOSE_BLOC_TYPE', 'Please select a type of block'));
					return;
				}
				var blockid = $ck('#blocselectid').attr('value');
				var blockposition = $ck('#blocselectposition').attr('value');
				(isvalidBlocId = validateBlocId(blockid)) ? $ck('#blocselectid').removeClass('invalid') : $ck('#blocselectid').addClass('invalid');
				if (type == 'flexiblemodules') {
					(isvalidBlocPosition1 = validateBlocPosition($ck('#blocselectposition').attr('value'))) ? $ck('#blocselectposition').removeClass('invalid') : $ck('#blocselectposition').addClass('invalid');
					(isvalidBlocPosition2 = validateBlocPosition($ck('#blocselectposition2').attr('value'))) ? $ck('#blocselectposition2').removeClass('invalid') : $ck('#blocselectposition2').addClass('invalid');
					(isvalidBlocPosition3 = validateBlocPosition($ck('#blocselectposition3').attr('value'))) ? $ck('#blocselectposition3').removeClass('invalid') : $ck('#blocselectposition3').addClass('invalid');
					(isvalidBlocPosition4 = validateBlocPosition($ck('#blocselectposition4').attr('value'))) ? $ck('#blocselectposition4').removeClass('invalid') : $ck('#blocselectposition4').addClass('invalid');
					(isvalidBlocPosition5 = validateBlocPosition($ck('#blocselectposition5').attr('value'))) ? $ck('#blocselectposition5').removeClass('invalid') : $ck('#blocselectposition5').addClass('invalid');
					isvalidBlocPosition = isvalidBlocPosition1 && isvalidBlocPosition2 && isvalidBlocPosition3 && isvalidBlocPosition4 && isvalidBlocPosition5;
					blockposition = $ck('#blocselectposition').attr('value') + ',' + $ck('#blocselectposition2').attr('value') + ',' + $ck('#blocselectposition3').attr('value') + ',' + $ck('#blocselectposition4').attr('value') + ',' + $ck('#blocselectposition5').attr('value');
				} else {
					(isvalidBlocPosition = validateBlocPosition(blockposition)) ? $ck('#blocselectposition').removeClass('invalid') : $ck('#blocselectposition').addClass('invalid');
				}
				if (isvalidBlocId && isvalidBlocPosition) {
					addBloc(type, blockid, blockposition, currentblocid);
				}
			}

			function getIdProposal(type) {
				var suggestion;
				switch (type) {
					case 'singleModule':
					default:
						suggestion = 'module';
						break;
					case 'flexiblemodules':
						suggestion = 'modules';
						break;
					case 'horizMenu':
						suggestion = 'nav';
						break;
					case 'banner':
						suggestion = 'banner';
						break;
					case 'custombloc':
						suggestion = 'custom';
						break;
				}
				var i = 1;
				while ($ck('#' + suggestion + i).length && i < 1000) {
					i++;
				}
				return suggestion + i;
			}

			function getPositionsProposal(type) {
				var positions = new Array();
				var suggestion = new Array();
				$ck('.ckbloc').each(function(i, bloc) {
					bloc = $ck(bloc);
					if (bloc.attr('ckmoduleposition'))
						positions.push(bloc.attr('ckmoduleposition'));
				});
				i = 0;
				found = 0;
				while (found < 5) {
					if ($ck.inArray("position-" + i, positions) == -1) {
						suggestion.push("position-" + i);
						found++;
					}
					console.log(i);
					i++;
				}
				return suggestion;
			}
</script>