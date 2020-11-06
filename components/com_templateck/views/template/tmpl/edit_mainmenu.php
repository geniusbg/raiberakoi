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
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
$input = new JInput();
?>
<div id="mainmenuck" class="clearfix">
    <div class="ckpopupheader clearfix">
        <table>
			<tr>
				<td style="vertical-align:top;">
					<div class="ckpopuplogo"></div>
				</td>
				<td style="width:100%;">

					<div style="float:left;">
						<div class="ck_button infotip" rel="<?php echo JText::_('CK_INFOS_BUTTON_DESC'); ?>">
							<a href="javascript:void(0);" onclick="if (!$ck('#ck_modelewrapper').length)
									editGlobalinfos();"><?php echo JText::_('CK_INFOS_BUTTON'); ?></a>
						</div>
						<div class="ck_button infotip" rel="<?php echo JText::_('CK_INFOS_PARAMS_DESC'); ?>">
							<a href="javascript:void(0);" onclick="if (!$ck('#ck_modelewrapper').length)
									showParamsPopup();"><?php echo JText::_('CK_INFOS_PARAMS'); ?></a>
						</div>
						<div class="ck_button infotip" rel="<?php echo JText::_('CK_RESPONSIVE_PARAMS_DESC'); ?>">
							<a href="javascript:void(0);" onclick="if (!$ck('#ck_modelewrapper').length)
									showResponsivePopup();"><?php echo JText::_('CK_RESPONSIVE_PARAMS'); ?></a>
						</div>
						<div class="ck_button infotip" rel="<?php echo JText::_('CK_PREVIEW_BUTTON_DESC'); ?>">
							<a href="javascript:void(0);" onclick="if (!$ck('#ck_modelewrapper').length)
									templatePackage('preview');"><?php echo JText::_('CK_PREVIEW_BUTTON'); ?></a>
						</div>
						<div class="ck_button infotip" rel="<?php echo JText::_('CK_JOOMLA_BUTTON_DESC'); ?>">
							<a href="javascript:void(0);" onclick="if (!$ck('#ck_modelewrapper').length)
									templatePackage('package');"><?php echo JText::_('CK_JOOMLA_BUTTON'); ?></a>
						</div>
						<div class="ck_button infotip" rel="<?php echo JText::_('CK_DIRECTCOPY_BUTTON_DESC'); ?>">
							<a href="javascript:void(0);" onclick="if (!$ck('#ck_modelewrapper').length)
									templatePackage('copy');"><?php echo JText::_('CK_DIRECTCOPY_BUTTON'); ?></a>
						</div>
						<div class="ck_button" id="infotipdesc" style="clear:both;">
							<a href="javascript:void(0);" onclick="if (!$ck('#ck_modelewrapper').length)
									showcheckModules();" id="checkmodules"></a>
						</div>
					</div>
					<div class="ck_buttons_right">
						<div class="ck_button big">
							<a href="javascript:void(0);" class="ckexpert" onclick="if (!$ck('#ck_modelewrapper').length)
									toggleExpertMode($ck(this).parent());"><?php echo JText::_('CK_TOGGLE_EXPERT'); ?></a>
						</div>
						<div class="ck_button big">
							<a href="javascript:void(0);" class="ckthemes" onclick="if (!$ck('#ck_modelewrapper').length)
									toggleThemes($ck(this).parent())"><?php echo JText::_('CK_LOAD_THEME'); ?></a>
						</div>
						<div class="ck_button big">
							<a href="javascript:void(0);" class="cksavetemplate" onclick="if (!$ck('#ck_modelewrapper').length)
									Joomla.submitbutton('template.save')">
								   <?php echo JText::_('CK_SAVE') ?>
							</a>
						</div>
						<div class="ck_button big">
							<a href="javascript:void(0);"class="ckcanceltemplate" onclick="Joomla.submitbutton('template.cancel')">
								<?php echo JText::_('JCANCEL') ?>
							</a>
						</div>
					</div>


					<?php if ($input->get('themes', '', 'int') == 1) { ?>
						<div class="ck_button big">
							<a href="javascript:void(0);" onclick="if (!$ck('#ck_modelewrapper').length)
										saveTheme();"><?php echo JText::_('CK_SAVE_THEME'); ?></a>
							<div id="themefile"></div>
						</div>
					<?php } ?>
				</td>
			</tr>
        </table>
        <div id="showthemes" class="clearfix">
			<?php
			$path = JPATH_ROOT . '/components/com_templateck/themes';
			$files = JFolder::files($path, '.hck', false, false);
			natsort($files);
			$i = 1;
			$nbthemes = count($files);
			echo '<div class="clearfix" style="width:' . (count($files) * 95) . 'px;height:100px;">';
			foreach ($files as $file) {
				$theme = JFile::stripExt($file);
				echo '<div class="themethumb" target="' . $theme . '"><img src="components/com_templateck/themes/' . $theme . '.jpg" style="height:80px;width:80px;margin:0;padding:0;" onclick="if(!$ck(\'#ck_modelewrapper\').length) loadTheme(\'' . $theme . '\');"/><div class="themeindice">' . $i . '</div></div>';
				$i++;
			}
			echo '</div>';
			?>
        </div>
    </div>
</div>
<script type="text/javascript">
							$ck('#mainmenuck').find('.infotip').hover(
									function() {
										if ($ck(this).attr('rel')) {
											$ck('#checkmodules').hide();
											$ck('#infotipdesc').append($ck("<span class=\"infotipdesc\">" + $ck(this).attr('rel') + "</span>")).hide().show();
										}
									},
									function() {
										$ck('#infotipdesc').find("span.infotipdesc").remove();
										$ck('#checkmodules').show();
									}
							);
</script>