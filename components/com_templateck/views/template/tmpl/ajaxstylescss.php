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
$expertmode = $app->input->get('expertmode', false);

$showheight = (stristr($objclass, 'mainbanner') OR stristr($objclass, 'bannerlogo') OR stristr($objclass, 'horizmenu')) ? true : false;
$showwidth = ((stristr($objclass, 'wrapper') OR stristr($objclass, 'bannerlogo') OR stristr($objclass, 'banner') OR stristr($objclass, 'column')) AND !stristr($objclass, 'content')) ? true : false;
$isContent = (stristr($objclass, 'content') OR stristr($objclass, 'bannerlogodesc')) ? true : false;
$isBody = stristr($objclass, 'body') ? true : false;
$isWrapper = stristr($objclass, 'wrapper') ? true : false;
$isContainer = (stristr($objclass, 'body') OR stristr($objclass, 'wrapper') OR stristr($objclass, 'mainbanner') OR stristr($objclass, 'bannerlogo') OR stristr($objclass, 'flexiblemodules') OR stristr($objclass, 'maincontent') OR stristr($objclass, 'content') OR stristr($objclass, 'center')) ? true : false;
$isColumn = (stristr($objclass, 'column1') OR stristr($objclass, 'column2')) ? true : false;
$isLogo = (stristr($objclass, 'bannerlogo')) ? true : false;
$isModulesContainer = stristr($objclass, 'flexiblemodules') ? true : false;
$isMaincontentContainer = stristr($objclass, 'maincontent') ? true : false;
$isHoriznav = stristr($objclass, 'horiznav') ? true : false;
$menustyles = new MenuStyles();
?>

<div class="ckpopupoverlay"></div>
<div class="ckpopupheader">
    <div class="ckpopuplogo"></div>
    <div class="ckpopuptitle"><?php echo JText::_('CK_CSS_EDIT'); ?></div>
    <div style="float:right;">
        <div class="ckclose ckcancel" onclick="$ck('#popup_editionck').empty().hide();"><?php echo JText::_('CK_CANCEL'); ?></div>
        <div class="ckclose cksave" onclick="saveEditionPopup();"><?php echo JText::_('CK_VALIDATE'); ?></div>
        <div class="ckclose ckpaste" id="pastefromclipboard" onclick="pastefromclipboard(this)"><?php echo JText::_('CK_PASTE'); ?></div>
        <div class="ckclose ckcopy" id="copytoclipboard" onclick="copytoclipboard(this)"><?php echo JText::_('CK_COPYALLCSS'); ?></div>
    </div>
    <div class="clr"></div>
</div>
<div id="elementscontainer">
	<?php if ($isLogo) { ?>
		<div class="menulink current" tab="tab_blocstyles"><?php echo JText::_('CK_LOGO_STYLES'); ?></div>
		<div class="menulink" tab="tab_logodescstyles"><?php echo JText::_('CK_LOGODESC_STYLES'); ?></div>
		<div class="clr"></div>
		<div id="elementscontent">
			<div class="tab menustyles current ckproperty" id="tab_blocstyles">
				<table>
	                <tr>
						<td style="vertical-align:top;">
							<div class="layoutinfos">
								<div class="layoutinfostitle"><?php echo JText::_('CK_LOGO_INFOS'); ?></div>
								<div class="layoutinfosdesc"><?php echo JText::_('CK_LOGO_DESC'); ?></div>
							</div>
						</td>
						<td style="vertical-align:top;">
							<?php echo $menustyles->createLogoStyles('bloc', $objclass) ?>
						</td>
	                </tr>
				</table>
				<div class="clr"></div>
			</div>
			<div class="tab menustyles ckproperty" id="tab_logodescstyles">
				<table>
	                <tr>
						<td style="vertical-align:top;">
							<div class="layoutinfos">
								<div class="layoutinfostitle"><?php echo JText::_('CK_LOGODESC_INFOS'); ?></div>
								<div class="layoutinfosdesc"><?php echo JText::_('CK_LOGODESC_DESC'); ?></div>
							</div>
						</td>
						<td style="vertical-align:top;">
							<?php echo $menustyles->createBlocStyles('logodesc', $objclass, $expertmode, false) ?>
						</td>
	                </tr>
				</table>
				<div class="clr"></div>
			</div>
		</div>
	<?php
	} else {
		$menulinktext = $isWrapper ? JText::_('CK_WRAPPER_STYLES') : JText::_('CK_BLOCK_STYLES');
		$blocinfos = $isWrapper ? JText::_('CK_WRAPPER_INFOS') : JText::_('CK_BLOC_INFOS');
		$blocdesc = $isWrapper ? JText::_('CK_WRAPPER_DESC') : JText::_('CK_BLOC_DESC');
		?>
	    <div class="menulink current" tab="tab_blocstyles"><?php echo $menulinktext; ?></div>
		<?php if ($expertmode == 'true' && $isWrapper) { ?>
		    <div class="menulink<?php if ($expertmode == 'true') echo ' expert'; ?>" tab="tab_bodystyles"><?php echo JText::_('CK_BODY_STYLES'); ?></div>
		<?php } ?>
		<?php if (($expertmode == 'true' && !$isContainer) || $isColumn) { ?>
		    <div class="menulink<?php if ($expertmode == 'true') echo ' expert'; ?>" tab="tab_modulestyles"><?php echo JText::_('CK_MODULES_STYLES'); ?></div>
		<?php } ?>
		<?php if (!$isContainer) { ?>
		    <div class="menulink" tab="tab_moduletitlestyles"><?php echo JText::_('CK_MODULES_TITLES_STYLES'); ?></div>
			<?php if ($expertmode == 'true' || $isHoriznav) { ?>
				<div class="menulink<?php if ($expertmode == 'true') echo ' expert'; ?>" tab="tab_menustyles" onmousedown="loadTab_menustyles();"><?php echo JText::_('CK_MENUS_STYLES'); ?></div>
			<?php } ?>
	<?php } ?>
	    <div class="clr"></div>
	    <div id="elementscontent">
	        <div class="tab menustyles current ckproperty" id="tab_blocstyles">
	            <table>
					<tr>
						<td style="vertical-align:top;">
							<div class="layoutinfos">
								<div class="layoutinfostitle"><?php echo $blocinfos; ?></div>
								<div class="layoutinfosdesc"><?php echo $blocdesc; ?></div>
							</div>
						</td>
						<td style="vertical-align:top;">
	<?php echo $menustyles->createBlocStyles('bloc', $objclass, $expertmode) ?>
						</td>
					</tr>
	            </table>
	            <div class="clr"></div>
	        </div>
	<?php if ($expertmode == 'true' && $isWrapper) { ?>
		        <div class="tab menustyles ckproperty" id="tab_bodystyles">
		            <table>
						<tr>
							<td style="vertical-align:top;">
								<div class="layoutinfos">
									<div class="layoutinfostitle"><?php echo JText::_('CK_MODULES_BODY_INFOS'); ?></div>
									<div class="layoutinfosdesc"><?php echo JText::_('CK_MODULES_BODY_DESC'); ?></div>
								</div>
							</td>
							<td style="vertical-align:top;">
		<?php echo $menustyles->createBlocStyles('body', $objclass, $expertmode) ?>
							</td>
						</tr>
		            </table>
		            <div class="clr"></div>
		        </div>
			<?php } ?>
	<?php if (($expertmode == 'true' && !$isContainer) || $isColumn) { ?>
		        <div class="tab menustyles ckproperty" id="tab_modulestyles">
		            <table>
						<tr>
							<td style="vertical-align:top;">
								<div class="layoutinfos">
									<div class="layoutinfostitle"><?php echo JText::_('CK_MODULE_INFOS'); ?></div>
									<div class="layoutinfosdesc"><?php echo JText::_('CK_MODULE_DESC'); ?></div>
								</div>
							</td>
							<td style="vertical-align:top;">
		<?php echo $menustyles->createModuleStyles('module', $objclass) ?>
							</td>
						</tr>
		            </table>
		            <div class="clr"></div>
		        </div>
			<?php } ?>
	<?php if (!$isContainer) { ?>
		        <div class="tab menustyles ckproperty" id="tab_moduletitlestyles">

		            <table>
						<tr>
							<td style="vertical-align:top;">
								<div class="layoutinfos">
									<div class="layoutinfostitle"><?php echo JText::_('CK_MODULETITLE_INFOS'); ?></div>
									<div class="layoutinfosdesc"><?php echo JText::_('CK_MODULETITLE_DESC'); ?></div>
								</div>
							</td>
							<td style="vertical-align:top;">
		<?php echo $menustyles->createModuletitleStyles('moduletitle', $objclass) ?>
							</td>
						</tr>
		            </table>
		            <div class="clr"></div>
		        </div>
				<?php if ($expertmode == 'true' || $isHoriznav) { ?>
			        <div class="tab menustyles" id="tab_menustyles"></div>
				<?php } ?>
		<?php } ?>
	    </div>
<?php } ?>
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

			initColorPickers();
			initModalPopup();
			initAccordionStyles();
</script>