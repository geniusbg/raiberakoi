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
$expertmode = $app->input->get('expertmode', false);
$joomlaversion = $app->input->get('joomlaversion', false);
$menustyles = new MenuStyles();
?>
<div class="ckpopupoverlay"></div>
<div class="ckpopupheader">
    <div class="ckpopuplogo"></div>
    <div class="ckpopuptitle"><?php echo JText::_('CK_PARAMS_EDIT'); ?></div>
    <div style="float:right;">
        <div class="ckclose ckcancel" onclick="$ck('#popup_editionck').empty().hide();"><?php echo JText::_('CK_CANCEL'); ?></div>
        <div class="ckclose cksave" onclick="saveEditionPopup('body');"><?php echo JText::_('CK_VALIDATE'); ?></div>
    </div>
    <div class="clr"></div>
</div>
<div id="elementscontainer">
    <div class="menulink current" tab="tab_blocstyles"><?php echo JText::_('CK_PAGE'); ?></div>
    <div class="menulink" tab="tab_titlestyles"><?php echo JText::_('CK_TITLES'); ?></div>
    <div class="menulink" tab="tab_buttonstyles"><?php echo JText::_('CK_BUTTONS'); ?></div>
    <div class="menulink" tab="tab_systemimagesstyles"><?php echo JText::_('CK_SYSTEMIMAGES'); ?></div>
    <div class="clr"></div>
    <div id="elementscontent">
        <div class="tab menustyles current ckproperty" id="tab_blocstyles">
            <table>
                <tr>
					<td style="vertical-align:top;">
						<div class="layoutinfos">
							<div class="layoutinfostitle"><?php echo JText::_('CK_PAGEPARAMS_INFOS'); ?></div>
							<div class="layoutinfosdesc"><?php echo JText::_('CK_PAGEPARAMS_DESC'); ?></div>
						</div>
					</td>
					<td style="vertical-align:top;">
						<div class=""><?php echo $menustyles->createBlocStyles('bloc', 'body', $expert = false, $showlinks = true, $joomlaversion); ?></div>
					</td>
				</tr>
            </table>
            <div class="clr"></div>
        </div>
        <div class="tab menustyles ckproperty" id="tab_titlestyles">

            <div class="menulink2 current" tab="tab_titleh1styles"><?php echo JText::_('CK_H1'); ?></div>
            <div class="menulink2" tab="tab_titleh2styles"><?php echo JText::_('CK_H2'); ?></div>
            <div class="menulink2" tab="tab_titleh3styles"><?php echo JText::_('CK_H3'); ?></div>
            <div class="menulink2" tab="tab_titleh4styles"><?php echo JText::_('CK_H4'); ?></div>
            <div class="menulink2" tab="tab_titleh5styles"><?php echo JText::_('CK_H5'); ?></div>
            <div class="menulink2" tab="tab_titleh6styles"><?php echo JText::_('CK_H6'); ?></div>
            <div class="clr"></div>
            <table>
                <tr>
					<td style="vertical-align:top;">
						<div class="layoutinfos">
							<div class="layoutinfostitle"><?php echo JText::_('CK_PAGETITLES_INFOS'); ?></div>
							<div class="layoutinfosdesc"><?php echo JText::_('CK_PAGETITLES_DESC'); ?></div>
						</div>
					</td>
					<td style="vertical-align:top;">
						<div class="tab2 menustyles current" id="tab_titleh1styles">
							<?php echo $menustyles->createNormalStyles('h1title'); ?>
						</div>
						<div class="tab2 menustyles" id="tab_titleh2styles">
							<?php echo $menustyles->createNormalStyles('h2title'); ?>
						</div>
						<div class="tab2 menustyles" id="tab_titleh3styles">
							<?php echo $menustyles->createNormalStyles('h3title'); ?>
						</div>
						<div class="tab2 menustyles" id="tab_titleh4styles">
							<?php echo $menustyles->createNormalStyles('h4title'); ?>
						</div>
						<div class="tab2 menustyles" id="tab_titleh5styles">
							<?php echo $menustyles->createNormalStyles('h5title'); ?>
						</div>
						<div class="tab2 menustyles" id="tab_titleh6styles">
							<?php echo $menustyles->createNormalStyles('h6title'); ?>
						</div>
					</td>
				</tr>
            </table>
            <div class="clr"></div>
        </div>
        <div class="tab menustyles ckproperty" id="tab_buttonstyles">
            <div class="menulink2 current" tab="tab_pagenavbuttonstyles"><?php echo JText::_('CK_PAGENAV'); ?></div>
            <div class="menulink2" tab="tab_pagenavbuttonhoverstyles"><?php echo JText::_('CK_PAGENAV_HOVER'); ?></div>
            <div class="menulink2" tab="tab_readmorebuttonstyles"><?php echo JText::_('CK_READMORE'); ?></div>
            <div class="menulink2" tab="tab_readmorebuttonhoverstyles"><?php echo JText::_('CK_READMORE_HOVER'); ?></div>
            <div class="menulink2" tab="tab_buttonbuttonstyles"><?php echo JText::_('CK_BUTTON'); ?></div>
            <div class="menulink2" tab="tab_buttonbuttonhoverstyles"><?php echo JText::_('CK_BUTTON_HOVER'); ?></div>
            <div class="menulink2" tab="tab_inputfieldbuttonstyles"><?php echo JText::_('CK_INPUTFIELD'); ?></div>
            <div class="menulink2" tab="tab_inputfieldbuttonactivestyles"><?php echo JText::_('CK_INPUTFIELD_ACTIVE'); ?></div>
            <div class="clr"></div>
            <table>
                <tr>
					<td style="vertical-align:top;">
						<div class="layoutinfos">
							<div class="layoutinfostitle"><?php echo JText::_('CK_PAGEBUTTONS_INFOS'); ?></div>
							<div class="layoutinfosdesc"><?php echo JText::_('CK_PAGEBUTTONS_DESC'); ?></div>
						</div>
					</td>
					<td style="vertical-align:top;">

						<div class="tab2 menustyles current" id="tab_pagenavbuttonstyles">
							<div class=""><?php echo $menustyles->createNormalStyles('pagenavbutton', false); ?></div>
						</div>
						<div class="tab2 menustyles" id="tab_pagenavbuttonhoverstyles">
							<div class=""><?php echo $menustyles->createNormalStyles('pagenavbuttonhover', false); ?></div>
						</div>
						<div class="tab2 menustyles" id="tab_readmorebuttonstyles">
							<div class=""><?php echo $menustyles->createNormalStyles('readmorebutton', false); ?></div>
						</div>
						<div class="tab2 menustyles" id="tab_readmorebuttonhoverstyles">
							<div class=""><?php echo $menustyles->createNormalStyles('readmorebuttonhover', false); ?></div>
						</div>
						<div class="tab2 menustyles" id="tab_buttonbuttonstyles">
							<div class=""><?php echo $menustyles->createNormalStyles('buttonbutton', false); ?></div>
						</div>
						<div class="tab2 menustyles" id="tab_buttonbuttonhoverstyles">
							<div class=""><?php echo $menustyles->createNormalStyles('buttonbuttonhover', false); ?></div>
						</div>
						<div class="tab2 menustyles" id="tab_inputfieldbuttonstyles">
							<div class=""><?php echo $menustyles->createNormalStyles('inputfieldbutton', false); ?></div>
						</div>
						<div class="tab2 menustyles" id="tab_inputfieldbuttonactivestyles">
							<div class=""><?php echo $menustyles->createNormalStyles('inputfieldbuttonactive', false); ?></div>
						</div>
					</td>
				</tr>
            </table>
            <div class="clr"></div>
        </div>
        <div class="tab menustyles ckproperty" id="tab_systemimagesstyles">
            <table>
                <tr>
					<td style="vertical-align:top;">
						<div class="layoutinfos">
							<div class="layoutinfostitle"><?php echo JText::_('CK_SYSTEMIMAGES_INFOS'); ?></div>
							<div class="layoutinfosdesc"><?php echo JText::_('CK_SYSTEMIMAGES_DESC'); ?></div>
						</div>
					</td>
					<td style="vertical-align:top;">
						<div style="text-align:left;height: 25px;clear:both;">
							<input style="width:200px;" class="inputbox" type="text" value="" name="emailsystemimageurl" id="emailsystemimageurl" size="10" /><a class="modal ckbuttonstyle" href="administrator/index.php?option=com_media&view=images&tmpl=component&e_name=emailsystemimageurl" rel="{handler: 'iframe', size: {x: 700, y: 600}}" ><?php echo JText::_('CK_SELECT'); ?></a><?php echo JText::_('CK_EMAIL_IMAGE'); ?>
						</div>
						<div style="text-align:left;height: 25px;clear:both;">
							<input style="width:200px;" class="inputbox" type="text" value="" name="printsystemimageurl" id="printsystemimageurl" size="10" /><a class="modal ckbuttonstyle" href="administrator/index.php?option=com_media&view=images&tmpl=component&e_name=printsystemimageurl" rel="{handler: 'iframe', size: {x: 700, y: 600}}" ><?php echo JText::_('CK_SELECT'); ?></a><?php echo JText::_('CK_PRINT_IMAGE'); ?>
						</div>
						<div style="text-align:left;height: 25px;clear:both;">
							<input style="width:200px;" class="inputbox" type="text" value="" name="ratingblanksystemimageurl" id="ratingblanksystemimageurl" size="10" /><a class="modal ckbuttonstyle" href="administrator/index.php?option=com_media&view=images&tmpl=component&e_name=ratingblanksystemimageurl" rel="{handler: 'iframe', size: {x: 700, y: 600}}" ><?php echo JText::_('CK_SELECT'); ?></a><?php echo JText::_('CK_RATINGBLANK_IMAGE'); ?>
						</div>
						<div style="text-align:left;height: 25px;clear:both;">
							<input style="width:200px;" class="inputbox" type="text" value="" name="ratingfilledsystemimageurl" id="ratingfilledsystemimageurl" size="10" /><a class="modal ckbuttonstyle" href="administrator/index.php?option=com_media&view=images&tmpl=component&e_name=ratingfilledsystemimageurl" rel="{handler: 'iframe', size: {x: 700, y: 600}}" ><?php echo JText::_('CK_SELECT'); ?></a><?php echo JText::_('CK_RATINGFILLED_IMAGE'); ?>
						</div>
						<div style="text-align:left;height: 25px;clear:both;">
							<input style="width:200px;" class="inputbox" type="text" value="" name="editsystemimageurl" id="editsystemimageurl" size="10" /><a class="modal ckbuttonstyle" href="administrator/index.php?option=com_media&view=images&tmpl=component&e_name=editsystemimageurl" rel="{handler: 'iframe', size: {x: 700, y: 600}}" ><?php echo JText::_('CK_SELECT'); ?></a><?php echo JText::_('CK_EDIT_IMAGE'); ?>
						</div>
						<div style="text-align:left;height: 25px;clear:both;">
							<input style="width:200px;" class="inputbox" type="text" value="" name="arrowsystemimageurl" id="arrowsystemimageurl" size="10" /><a class="modal ckbuttonstyle" href="administrator/index.php?option=com_media&view=images&tmpl=component&e_name=arrowsystemimageurl" rel="{handler: 'iframe', size: {x: 700, y: 600}}" ><?php echo JText::_('CK_SELECT'); ?></a><?php echo JText::_('CK_ARROW_IMAGE'); ?>
						</div>
						<div style="text-align:left;height: 25px;clear:both;">
							<input style="width:200px;" class="inputbox" type="text" value="" name="faviconsystemimageurl" id="faviconsystemimageurl" size="10" /><a class="modal ckbuttonstyle" href="administrator/index.php?option=com_media&view=images&tmpl=component&e_name=faviconsystemimageurl" rel="{handler: 'iframe', size: {x: 700, y: 600}}" ><?php echo JText::_('CK_SELECT'); ?></a><?php echo JText::_('CK_FAVICON_IMAGE'); ?>
						</div>
						<div style="text-align:left;height: 25px;clear:both;">
							<input style="width:200px;" class="inputbox" type="text" value="" name="template_thumbnailsystemimageurl" id="template_thumbnailsystemimageurl" size="10" /><a class="modal ckbuttonstyle" href="administrator/index.php?option=com_media&view=images&tmpl=component&e_name=template_thumbnailsystemimageurl" rel="{handler: 'iframe', size: {x: 700, y: 600}}" ><?php echo JText::_('CK_SELECT'); ?></a><?php echo JText::_('CK_THUMB_IMAGE'); ?>
						</div>
						<div style="text-align:left;height: 25px;clear:both;">
							<input style="width:200px;" class="inputbox" type="text" value="" name="template_previewsystemimageurl" id="template_previewsystemimageurl" size="10" /><a class="modal ckbuttonstyle" href="administrator/index.php?option=com_media&view=images&tmpl=component&e_name=template_previewsystemimageurl" rel="{handler: 'iframe', size: {x: 700, y: 600}}" ><?php echo JText::_('CK_SELECT'); ?></a><?php echo JText::_('CK_PREVIEW_IMAGE'); ?>
						</div>
					</td>
				</tr>
            </table>
        </div>
    </div>
</div>
<script language="javascript" type="text/javascript">
			$ck('#elementscontent div.tab:not(.current)').hide();
			$ck('.menulink', $ck('#elementscontainer')).each(function(i, tab) {
				$ck(tab).click(function() {
					$ck('#elementscontent div.tab').hide();
					$ck('.menulink', $ck('#elementscontainer')).removeClass('current');
					if ($ck('#' + $ck(tab).attr('tab')).length)
						$ck('#' + $ck(tab).attr('tab')).show();
					this.addClass('current');
				});
			});

			$ck('#elementscontent div.tab2:not(.current)').hide();
			$ck('.menulink2', $ck('#elementscontainer')).each(function(i, tab) {
				$ck(tab).click(function() {
					$ck('#elementscontent div.tab2').hide();
					$ck('.menulink2', $ck('#elementscontainer')).removeClass('current');
					if ($ck('#' + $ck(tab).attr('tab')).length)
						$ck('#' + $ck(tab).attr('tab')).show();
					this.addClass('current');
				});
			});

			initColorPickers();
			initModalPopup();
			initTooltips();
			initModalPopup();
			initAccordionStyles();
</script>