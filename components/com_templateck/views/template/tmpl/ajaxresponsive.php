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
$input = new JInput();
$resolutions = array('1', '2', '3', '4');
$blocs = $input->get('blocs', '', 'html');
$blocs = str_replace("|di|", "#", $blocs);
$blocs = json_decode($blocs);
?>
<div class="ckpopupoverlay"></div>
<div class="ckpopupheader">
    <div class="ckpopuplogo"></div>
    <div class="ckpopuptitle"><?php echo JText::_('CK_EDIT_RESPONSIVE'); ?></div>
    <div style="float:right;">
        <div class="ckclose ckcancel" onclick="$ck('#popup_editionck').empty().hide();"><?php echo JText::_('CK_CANCEL'); ?></div>
        <div class="ckclose cksave" onclick="saveResponsivePopup();"><?php echo JText::_('CK_VALIDATE'); ?></div>
    </div>
    <div class="clr"></div>
</div>
<div id="elementscontainer">
	<table>
        <tr>
            <td style="vertical-align:top;">
				<div class="layoutinfos">
					<div class="layoutinfostitle"><?php echo JText::_('CK_RESPONSIVE_INFOS'); ?></div>
					<div class="layoutinfosdesc"><?php echo JText::_('CK_RESPONSIVE_DESC'); ?></div>
				</div>
            </td>
            <td style="vertical-align:top;">
				<?php
				foreach ($resolutions as $resolution) {
					?>
					<div id="ckresponsive<?php echo $resolution; ?>" class="blocresolution">
						<p class="resolution-title"><?php echo JText::_('CK_RESPONSIVE' . $resolution); ?></p>
						<?php
						foreach ($blocs as $block) {
							switch ($block->class) {
								case (stristr($block->class, 'mainbanner')):
									$cktype = 'mainbanner';
									break;
								case (stristr($block->class, 'flexiblemodules')):
									$cktype = 'flexiblemodules';
									break;
								case (stristr($block->class, 'maincontent')):
									$cktype = 'maincontent';
									break;
								case (stristr($block->class, 'singlemodule')):
									$cktype = 'singlemodule';
									break;
								case (stristr($block->class, 'custombloc')):
									$cktype = 'custombloc';
									break;
								case (stristr($block->class, 'horiznav')):
									$cktype = 'horiznav';
									break;
								default :
									$cktype = '';
									break;
							}

							$val = 'ckresponsive' . $resolution;
							$ckid = $block->ckid;
							if ($block->ckid AND (
									stristr($block->class, 'mainbanner') OR stristr($block->class, 'flexiblemodules') OR stristr($block->class, 'maincontent') OR stristr($block->class, 'singlemodule') OR stristr($block->class, 'custombloc') OR stristr($block->class, 'horiznav')
									)) {
								$ckmobile = isset($block->$val) ? $block->$val : (($val == 'ckresponsive1' || $val == 'ckresponsive2') ? 'mobile_notaligned' : 'mobile_default');
								echo '<div class="responsive ' . $block->class . '"'
								. ' ckid="' . $block->ckid . '"'
								. ' ckmobile="' . $ckmobile . '" onclick="changeResponsive(this, \'' . $cktype . '\')">'
								. $block->ckid . '</div>';
							}
						}
						?>
					</div>

					<?php
				}
				?>
			</td>
        </tr>
    </table>
</div>
<script>
			function changeResponsive(el, type) {
				el = $ck(el);
				var ckmobile = el.attr('ckmobile');
				switch (type)
				{
					case 'mainbanner':
						responsivechoice = new Array("mobile_default", "mobile_notaligned", "mobile_hide");
						break;
					case 'flexiblemodules':
						responsivechoice = new Array("mobile_default", "mobile_hide", "mobile_alignhalf", "mobile_notaligned");
						break;
					case 'maincontent':
						responsivechoice = new Array("mobile_default", "mobile_lefttop", "mobile_lefthidden", "mobile_rightbottom", "mobile_righthidden", "mobile_notaligned");
						break;
					case 'singlemodule':
						responsivechoice = new Array("mobile_default", "mobile_hide");
						break;
					case 'horiznav':
						responsivechoice = new Array("mobile_default", "mobile_hide", "mobile_alignhalf", "mobile_notaligned");
						break;
					default:
						break;
				}
				var index = ($ck.inArray(ckmobile, responsivechoice) + 1 < responsivechoice.length) ? $ck.inArray(ckmobile, responsivechoice) + 1 : 0;
				el.attr('ckmobile', responsivechoice[index]);
			}
</script>