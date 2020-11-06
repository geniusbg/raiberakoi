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
$objclass = $app->input->get('objclass', '');
$objid = $app->input->get('objid', '');
$menustyles = new MenuStyles();
$expertmode = $app->input->get('expertmode', false);
?>
<div class="menustyleslink current" tab="tab_firstlevellink"><?php echo JText::_('CK_FIRST_LEVEL_MENULINK'); ?><div class="menustyleslinkdesc"><?php echo JText::_('CK_FIRST_LEVEL'); ?></div></div>
<div class="menustyleslink" tab="tab_firstlevellinkhover"><?php echo JText::_('CK_FIRST_LEVEL_MENULINK_HOVER'); ?><div class="menustyleslinkdesc"><?php echo JText::_('CK_FIRST_LEVEL'); ?></div></div>
<div class="menustyleslink" tab="tab_firstlevellinkactive"><?php echo JText::_('CK_FIRST_LEVEL_MENULINK_ACTIVE'); ?><div class="menustyleslinkdesc"><?php echo JText::_('CK_FIRST_LEVEL'); ?></div></div>
<div class="menustyleslink" tab="tab_secondlevelcontainer"><?php echo JText::_('CK_FIRST_SUBLEVEL_CONTAINER'); ?><div class="menustyleslinkdesc"><?php echo JText::_('CK_FIRST_SUBLEVEL'); ?></div></div>
<div class="menustyleslink" tab="tab_secondlevellink"><?php echo JText::_('CK_FIRST_SUBLEVEL_MENULINK'); ?><div class="menustyleslinkdesc"><?php echo JText::_('CK_FIRST_SUBLEVEL'); ?></div></div>
<div class="menustyleslink" tab="tab_secondlevellinkhover"><?php echo JText::_('CK_FIRST_SUBLEVEL_MENULINK_HOVER'); ?><div class="menustyleslinkdesc"><?php echo JText::_('CK_FIRST_SUBLEVEL'); ?></div></div>
<div class="menustyleslink" tab="tab_secondlevellinkactive"><?php echo JText::_('CK_FIRST_SBULEVEL_MENULINK_ACTIVE'); ?><div class="menustyleslinkdesc"><?php echo JText::_('CK_FIRST_SUBLEVEL'); ?></div></div>
<div class="menustyleslink" tab="tab_thirdlevelcontainer"><?php echo JText::_('CK_SECOND_SUBLEVEL_CONTAINER'); ?><div class="menustyleslinkdesc"><?php echo JText::_('CK_SECOND_SUBLEVEL'); ?></div></div>
<div class="clr"></div>
<div id="menustylescontent">
    <table>
		<tr>
			<td style="vertical-align:top;">
				<div class="layoutinfos">
					<div class="layoutinfostitle"><?php echo JText::_('CK_MENU_INFOS'); ?></div>
					<div class="layoutinfosdesc"><?php echo JText::_('CK_MENU_DESC'); ?></div>
					<div class="menustylesmenudescription"></div>
				</div>
			</td>
			<td style="vertical-align:top;">
				<div class="tabmenu menustyles ckproperty current" id="tab_firstlevellink">
					<?php echo $menustyles->createBlocStyles('level0item', $objclass, false, false); ?>
					<div class="clr"></div>
				</div>
				<div class="tabmenu menustyles ckproperty" id="tab_firstlevellinkhover">
					<?php echo $menustyles->createBlocStyles('level0itemhover', $objclass, false, false); ?>
					<div class="clr"></div>
				</div>
				<div class="tabmenu menustyles ckproperty" id="tab_firstlevellinkactive">
					<?php echo $menustyles->createBlocStyles('level0itemactive', $objclass, false, false); ?>
					<div class="clr"></div>
				</div>
				<div class="tabmenu menustyles ckproperty" id="tab_secondlevelcontainer">
					<?php echo $menustyles->createBlocStyles('level1bg', $objclass); ?>
					<div class="clr"></div>
				</div>
				<div class="tabmenu menustyles ckproperty" id="tab_secondlevellink">
					<?php echo $menustyles->createBlocStyles('level1item', $objclass, false, false); ?>
					<div class="clr"></div>
				</div>
				<div class="tabmenu menustyles ckproperty" id="tab_secondlevellinkhover">
					<?php echo $menustyles->createBlocStyles('level1itemhover', $objclass, false, false); ?>
					<div class="clr"></div>
				</div>
				<div class="tabmenu menustyles ckproperty" id="tab_secondlevellinkactive">
					<?php echo $menustyles->createBlocStyles('level1itemactive', $objclass, false, false); ?>
					<div class="clr"></div>
				</div>
				<div class="tabmenu menustyles ckproperty" id="tab_thirdlevelcontainer">
					<?php echo $menustyles->createBlocStyles('level2bg', $objclass); ?>
					<div class="clr"></div>
				</div>
			</td>
		</tr>
    </table>
</div>

<script language="javascript" type="text/javascript">
	$ck('#menustylescontent div.tabmenu:not(.current)').hide();
	$ck('.menustyleslink', $ck('#elementscontainer')).each(function(i, tab) {
		$ck(tab).click(function() {
			$ck('#menustylescontent div.tabmenu').hide();
			$ck('.menustyleslink', $ck('#elementscontainer')).removeClass('current');
			if ($ck('#' + $ck(tab).attr('tab')).length)
				$ck('#' + $ck(tab).attr('tab')).show();
			this.addClass('current');
		});
	});
	initColorPickers();
	initModalPopup();
	initAccordionStyles();
</script>