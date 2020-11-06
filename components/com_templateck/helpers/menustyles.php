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

class MenuStyles extends JObject {

	var $imagespath = 'components/com_templateck/images/menustyles/';

	public function createBlocStyles($prefix = 'bloc', $objclass = '', $expert = false, $showlinks = true, $joomlaversion = 'j25') {
		if (stristr($objclass, 'wrapper')) {
			$this->createBackground($prefix, true);
			if ($prefix == 'bloc')
				$this->createText($prefix);
			if ($prefix == 'bloc')
				$this->createDimensions($prefix);
			$this->createDecoration($prefix);
			$this->createShadow($prefix);
			$this->createCustom($prefix);
		} elseif (stristr($objclass, 'body')) {
			$this->createWrapperStyles($prefix, $joomlaversion);
			$this->createBackground($prefix, false, JText::_('CK_PAGEBACKGROUND'));
			$this->createText($prefix);
			$this->createCustom($prefix);
		} else {
			$this->createBackground($prefix);
			if ($prefix != 'level1bg' && $prefix != 'level2bg')
				$this->createText($prefix, $showlinks);
			if ($prefix == 'level1bg' || $prefix == 'level2bg' || $expert == 'true' || (stristr($objclass, 'banner') && !stristr($objclass, 'mainbanner')) && (!stristr($objclass, 'column') && !stristr($objclass, 'flexiblemodule'))) {
				$useheight = true;
				$usewidth = true;
			} else {
				$useheight = false;
				$usewidth = false;
			}
			$this->createDimensions($prefix, $useheight, $usewidth, $expert);
			$this->createDecoration($prefix);
			$this->createShadow($prefix);
			$this->createCustom($prefix);
		}
	}

	public function createNormalStyles($prefix, $showlinks = true) {
		$this->createBackground($prefix);
		$this->createText($prefix, $showlinks);
		$this->createDimensions($prefix);
		$this->createDecoration($prefix);
		$this->createShadow($prefix);
		$this->createCustom($prefix);
	}

	public function createLogoStyles($prefix) {
		$this->createLogo($prefix);
		$this->createCustom($prefix);
	}

	public function createModuleStyles($prefix = 'module') {
		$this->createBackground($prefix);
		$this->createDimensions($prefix);
		$this->createDecoration($prefix);
		$this->createShadow($prefix);
		$this->createCustom($prefix);
	}

	public function createModuletitleStyles($prefix = 'moduletitle') {
		$this->createBackground($prefix);
		$this->createText($prefix, false);
		$this->createDimensions($prefix);
		$this->createDecoration($prefix);
		$this->createShadow($prefix);
		$this->createCustom($prefix);
	}

	public function createCustom($prefix) {
		?>
		<div class="menustylesblock" style="width:850px;">
			<div class="menustylesblocktitle"><?php echo JText::_('CK_CUSTOMCSS') ?></div>
			<div class="menustylesblockaccordion">
		        <div style="text-align:left;clear:both;">
		            <textarea class="inputbox" name="<?php echo $prefix; ?>custom" id="<?php echo $prefix; ?>custom" rows="7" cols="20" style="width:780px;height:110px;"></textarea>
		        </div>
			</div>
		</div>
		<?php
	}

	public function createWrapperStyles($prefix, $joomlaversion) {
		?>
		<div class="menustylesblock" style="width:850px;">
			<div class="menustylesblocktitle"><?php echo JText::_('CK_WRAPPER_PARAMS') ?></div>
			<div class="menustylesblockaccordion">
				<div style="text-align:left;clear:both;">
					<div style="float:left;text-align:left;width:170px;margin:5px 5px 0 0px;"><?php echo JText::_('CK_WRAPPER_WIDTH'); ?></div>
					<div style="float:left;text-align:right;margin:5px 5px 0 0;"><img src="<?php echo $this->imagespath; ?>width.png" width="15" height="15" align="top" /></div><div style="float:left;"><input class="inputbox hasTip" title="<?php echo JText::_('CK_WRAPPER_WIDTH_TIPS'); ?>" type="text" name="<?php echo $prefix; ?>width" id="<?php echo $prefix; ?>width" size="2" value="" style="" /></div>
					<div class="clr"></div>
				</div>
				<div style="text-align:left;clear:both;">
					<div style="float:left;text-align:left;width:170px;margin:5px 5px 0 0px;"><?php echo JText::_('CK_WRAPPER_FLUID'); ?></div>
					<div style="float:left;text-align:right;margin:5px 5px 0 0;">
						<select class="inputbox" type="list" name="<?php echo $prefix; ?>wrapperfluid" id="<?php echo $prefix; ?>wrapperfluid" value="" style="width:105px;" onchange="" >
							<option value="fixed"><?php echo JText::_('CK_FIXED'); ?></option>
							<option value="fluid"><?php echo JText::_('CK_FLUID'); ?></option>
						</select>
					</div>
					<div class="clr"></div>
				</div>
				<?php if ($joomlaversion == 'j3') { ?>
					<div style="text-align:left;clear:both;">
						<div style="float:left;text-align:left;width:170px;margin:5px 5px 0 0px;"><?php echo JText::_('CK_LOAD_BOOTSTRAP'); ?></div>
						<div style="float:left;text-align:right;margin:5px 5px 0 0;">
							<select class="inputbox" type="list" name="<?php echo $prefix; ?>loadboostrap" id="<?php echo $prefix; ?>loadboostrap" value="" style="width:105px;" onchange="" >
								<option value="0"><?php echo JText::_('JNO'); ?></option>
								<option value="1"><?php echo JText::_('JYES'); ?></option>
							</select>
						</div>
						<div class="clr"></div>
					</div>
				<?php } else { ?>
					<input class="inputbox" type="hidden" name="<?php echo $prefix; ?>loadboostrap" id="<?php echo $prefix; ?>loadboostrap" value="0" />
				<?php } ?>
			</div>
		</div>
		<?php
	}

	public function createLogo($prefix, $usegradient = true, $title = '') {
		?>
		<div class="menustylesblock" style="width:850px;">
			<div class="menustylesblocktitle"><?php echo ($title ? $title : JText::_('CK_LOGO')) ?></div>
			<div class="menustylesblockaccordion">
		        <div class="menupaneblock" style="margin-left:10px;">
		            <div class="menupanetitle"><?php echo JText::_('CK_LOGO'); ?></div>
		            <div style="">
		                <div style="margin-left:10px;">
		                    <img src="<?php echo $this->imagespath; ?>logo_illustration.png" width="65" height="40"/>
		                </div>
		                <div style="text-align:left;">
		                    <a style="display:block;float:left;padding:0 5px;width:85px;" class="modal ckbuttonstyle" href="administrator/index.php?option=com_media&view=images&tmpl=component&e_name=<?php echo $prefix; ?>backgroundimageurl" rel="{handler: 'iframe', size: {x: 700, y: 600}}" ><?php echo JText::_('CK_SELECT'); ?></a>
		                    <a style="display:block;float:left;padding:0 5px;width:45px;" class="ckbuttonstyle" href="javascript:void(0)" onclick="$ck('#<?php echo $prefix; ?>backgroundimageurl').attr('value', '');"><?php echo JText::_('CK_CLEAN'); ?></a>
		                    <div class="clr"></div>
		                    <input class="inputbox" type="text" value="" name="<?php echo $prefix; ?>backgroundimageurl" id="<?php echo $prefix; ?>backgroundimageurl" size="7" style="width:150px; clear:both;" />
		                </div>

		            </div>
		        </div>
		        <div class="menupaneblock" style="margin-left:10px;">
		            <div class="menupanetitle" style="text-align:left;padding-left:0px;margin-top:0px;"><?php echo JText::_('CK_DIMENSIONS'); ?></div>
		            <div style="text-align:left;">
		                <div><?php echo JText::_('CK_HEIGHT'); ?></div>
		                <div style="float:left;text-align:right;margin:5px 5px 0 0;"><img src="<?php echo $this->imagespath; ?>height.png" width="15" height="15" align="top" /></div><div style="float:left;"><input class="inputbox" type="text" name="<?php echo $prefix; ?>height" id="<?php echo $prefix; ?>height" size="2" value="" style="" /></div><div style="float:left;text-align:left;margin-left:3px;"></div>
		            </div>
		            <div style="text-align:left;clear:both;">
		                <div><?php echo JText::_('CK_WIDTH'); ?></div>
		                <div style="float:left;text-align:right;margin:5px 5px 0 0;"><img src="<?php echo $this->imagespath; ?>width.png" width="15" height="15" align="top" /></div><div style="float:left;"><input class="inputbox" type="text" name="<?php echo $prefix; ?>width" id="<?php echo $prefix; ?>width" size="2" value="" style="" /></div><div style="float:left;text-align:left;margin-left:3px;"></div>
		            </div>
		        </div>
		        <div class="menupaneblock">
		            <div class="menupanetitle" style="text-align:left;width:150px;padding-left:60px;"><?php echo JText::_('CK_MARGINS'); ?></div>
		            <div class="menupaneblock">
		                <div><div style="width:45px;float:left;text-align:right;margin-right:10px;"><?php echo JText::_('CK_TOP'); ?></div><div style="float:left;text-align:right;margin-right:5px;"><img src="<?php echo $this->imagespath; ?>margintop.png" width="23" height="23" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>margintop" id="<?php echo $prefix; ?>margintop" size="1" value="" /></div>
		                <div><div style="width:45px;float:left;text-align:right;margin-right:10px;"><?php echo JText::_('CK_RIGHT'); ?></div><div style="float:left;text-align:right;margin-right:5px;"><img src="<?php echo $this->imagespath; ?>marginright.png" width="23" height="23" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>marginright" id="<?php echo $prefix; ?>marginright" size="1" value="" /></div>
		                <div><div style="width:45px;float:left;text-align:right;margin-right:10px;"><?php echo JText::_('CK_BOTTOM'); ?></div><div style="float:left;text-align:right;margin-right:5px;"><img src="<?php echo $this->imagespath; ?>marginbottom.png" width="23" height="23" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>marginbottom" id="<?php echo $prefix; ?>marginbottom" size="1" value=""  /></div>
		                <div><div style="width:45px;float:left;text-align:right;margin-right:10px;"><?php echo JText::_('CK_LEFT'); ?></div><div style="float:left;text-align:right;margin-right:5px;"><img src="<?php echo $this->imagespath; ?>marginleft.png" width="23" height="23" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>marginleft" id="<?php echo $prefix; ?>marginleft" size="1" value="" /></div>
		            </div>
		            <div class="menupaneblock">
		                <div style="width:21px;float:left;text-align:right;margin:1px 0 0 0;"><img src="<?php echo $this->imagespath; ?>all_margins.png" width="21" height="98" /></div>
		                <div style="float:left;text-align:left;margin:38px 0 0 5px;"><input class="inputbox" type="text" name="<?php echo $prefix; ?>margins" id="<?php echo $prefix; ?>margins" size="1" value="" /><div style="width:25px;float:right;text-align:left;margin-left:3px;"></div></div>
		            </div>
		        </div>
		        <div class="menupaneblock">
		            <div class="menupanetitle" style="text-align:left;width:150px;padding-left:0px;"><?php echo JText::_('CK_PADDINGS'); ?></div>
		            <div class="menupaneblock">
		                <div><div style="float:left;text-align:right;margin:5px 10px 0 0;"><img src="<?php echo $this->imagespath; ?>paddingtop.png" width="15" height="15" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>paddingtop" id="<?php echo $prefix; ?>paddingtop" size="1" value="" /></div>
		                <div><div style="float:left;text-align:right;margin:5px 10px 0 0;"><img src="<?php echo $this->imagespath; ?>paddingright.png" width="15" height="15" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>paddingright" id="<?php echo $prefix; ?>paddingright" size="1" value="" /></div>
		                <div><div style="float:left;text-align:right;margin:5px 10px 0 0;"><img src="<?php echo $this->imagespath; ?>paddingbottom.png" width="15" height="15" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>paddingbottom" id="<?php echo $prefix; ?>paddingbottom" size="1" value=""  /></div>
		                <div><div style="float:left;text-align:right;margin:5px 10px 0 0;"><img src="<?php echo $this->imagespath; ?>paddingleft.png" width="15" height="15" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>paddingleft" id="<?php echo $prefix; ?>paddingleft" size="1" value="" /></div>
		            </div>
		            <div class="menupaneblock">
		                <div style="width:21px;float:left;text-align:right;margin:1px 0 0 0;"><img src="<?php echo $this->imagespath; ?>all_paddings.png" width="15" height="98" /></div>
		                <div style="float:left;text-align:left;margin:38px 0 0 5px;"><input class="inputbox" type="text" name="<?php echo $prefix; ?>paddings" id="<?php echo $prefix; ?>paddings" size="1" value="" /><div style="width:20px;float:right;text-align:left;margin-left:3px;"></div></div>
		            </div>
		        </div>

		    </div>
		</div>
		<?php
	}

	public function createBackground($prefix, $usegradient = true, $title = '', $expert = false) {
		?>
		<input class="inputbox" type="hidden" value="" name="widthmodule0" id="widthmodule0" />
		<input class="inputbox" type="hidden" value="" name="widthmodule1" id="widthmodule1" />
		<input class="inputbox" type="hidden" value="" name="widthmodule2" id="widthmodule2" />
		<input class="inputbox" type="hidden" value="" name="widthmodule3" id="widthmodule3" />
		<input class="inputbox" type="hidden" value="" name="widthmodule4" id="widthmodule4" />
		<input class="inputbox" type="hidden" value="" name="isdisabledmodule0" id="isdisabledmodule0" />
		<input class="inputbox" type="hidden" value="" name="isdisabledmodule1" id="isdisabledmodule1" />
		<input class="inputbox" type="hidden" value="" name="isdisabledmodule2" id="isdisabledmodule2" />
		<input class="inputbox" type="hidden" value="" name="isdisabledmodule3" id="isdisabledmodule3" />
		<input class="inputbox" type="hidden" value="" name="isdisabledmodule4" id="isdisabledmodule4" />
		<input class="inputbox" type="hidden" value="" name="numberofmodules" id="numberofmodules" />
		<div class="menustylesblock" style="width:850px;">
			<div class="menustylesblocktitle<?php if ($expert == 'true') echo ' expert'; ?>"><?php echo ($title ? $title : JText::_('CK_BACKGROUND')) ?></div>
			<div class="menustylesblockaccordion">
				<?php
				if ($usegradient) {
					//$this->createGradientPreview($prefix);
					?>                 <div class="menupaneblock" style="margin:0;">
						<div class="menupanetitle"><?php echo JText::_('CK_BACKGROUNDGRADIENT'); ?></div>
						<div id="<?php echo $prefix; ?>gradientpreview" style="width:85px;height:94px;margin-top:3px;border:1px solid #808080;"><div class="injectstyles"></div></div>
					</div>
					<div class="menupaneblock" style="margin-right:30px;padding-left:25px;background:url(<?php echo $this->imagespath; ?>background_gradient_lines.png) left 27px no-repeat;">
						<div class="menupanetitle"><?php echo ($usegradient ? JText::_('CK_BACKGROUNDCOLORS') : JText::_('CK_BACKGROUNDCOLOR')) ?></div>

						<div style="text-align:left;margin-left:20px;">
							<div style="float:left;color:#bcbcbc;line-height:23px;"><?php echo JText::_('0 %'); ?></div>
							<div style="float:left;"><input class="inputbox colorPicker isGradientfield" type="text" value="" name="<?php echo $prefix; ?>backgroundcolorstart" id="<?php echo $prefix; ?>backgroundcolorstart" size="6" style="width:52px;" onblur="createGradientPreview('<?php echo $prefix ?>');"/></div><div style="float:left;margin:4px 2px 0 2px;"><img src="<?php echo $this->imagespath; ?>color.png" width="15" height="15"/></div><?php echo JText::_('CK_MAINCOLOR'); ?>
							<input class="inputbox isGradientfield" type="text" value="" name="<?php echo $prefix; ?>backgroundopacity" id="<?php echo $prefix; ?>backgroundopacity" size="1" style="width:22px;"/><?php echo JText::_('CK_OPACITY'); ?>
						</div>
						<div style="text-align:left;clear:both;">
							<div style="float:left;"><input disabled="disabled" class="inputbox isGradientfield" type="text" value="" name="<?php echo $prefix; ?>backgroundpositionstop1" id="<?php echo $prefix; ?>backgroundpositionstop1" size="1" style="width:22px;" onblur="createGradientPreview('<?php echo $prefix ?>');"/><?php echo JText::_('%'); ?></div>
							<div style="float:left;"><input disabled="disabled" class="inputbox colorPicker isGradientfield" type="text" value="" name="<?php echo $prefix; ?>backgroundcolorstop1" id="<?php echo $prefix; ?>backgroundcolorstop1" size="6" style="width:52px;" onblur="createGradientPreview('<?php echo $prefix ?>')"/></div><div style="float:left;margin:4px 2px 0 2px;"><img src="<?php echo $this->imagespath; ?>color.png" width="15" height="15"/></div><?php echo JText::_('CK_STOP1COLOR'); ?>
						</div>
						<div style="text-align:left;clear:both;">
							<div style="float:left;"><input disabled="disabled" class="inputbox isGradientfield" type="text" value="" name="<?php echo $prefix; ?>backgroundpositionstop2" id="<?php echo $prefix; ?>backgroundpositionstop2" size="1" style="width:22px;" onblur="createGradientPreview('<?php echo $prefix ?>');"/><?php echo JText::_('%'); ?></div>
							<div style="float:left;"><input disabled="disabled" class="inputbox colorPicker isGradientfield" type="text" value="" name="<?php echo $prefix; ?>backgroundcolorstop2" id="<?php echo $prefix; ?>backgroundcolorstop2" size="6" style="width:52px;" onblur="createGradientPreview('<?php echo $prefix ?>')" /></div><div style="float:left;margin:4px 2px 0 2px;"><img src="<?php echo $this->imagespath; ?>color.png" width="15" height="15"/></div><?php echo JText::_('CK_STOP2COLOR'); ?>
						</div>
						<div style="text-align:left;clear:both;">
							<div style="float:left;"><input disabled="disabled" class="inputbox isGradientfield" type="text" value="100" name="<?php echo $prefix; ?>backgroundpositionend" id="<?php echo $prefix; ?>backgroundpositionend" size="1" style="width:22px;" onblur="createGradientPreview('<?php echo $prefix ?>');"/><?php echo JText::_('%'); ?></div>
							<div style="float:left;"><input disabled="disabled" class="inputbox colorPicker isGradientfield" type="text" value="" name="<?php echo $prefix; ?>backgroundcolorend" id="<?php echo $prefix; ?>backgroundcolorend" size="6" style="width:52px;" onblur="createGradientPreview('<?php echo $prefix ?>')"/></div><div style="float:left;margin:4px 2px 0 2px;"><img src="<?php echo $this->imagespath; ?>color.png" width="15" height="15"/></div><?php echo JText::_('CK_ENDCOLOR'); ?>
						</div>
						<div style="text-align:left;clear:both;">
							<select class="inputbox" type="list" value="" name="<?php echo $prefix; ?>backgrounddirection" id="<?php echo $prefix; ?>backgrounddirection" style="width: 120px;">
								<option value="topbottom"><?php echo JText::_('CK_TOPTOBOTTOM'); ?></option>
								<option value="bottomtop"><?php echo JText::_('CK_BOTTOMTOTOP'); ?></option>
								<option value="leftright"><?php echo JText::_('CK_LEFTTORIGHT'); ?></option>
								<option value="rightleft"><?php echo JText::_('CK_RIGHTTOLEFT'); ?></option>
							</select><?php echo JText::_('CK_DIRECTION'); ?>
						</div>
					</div>
		<?php } else { ?>
					<div class="menupaneblock" style="margin:0 15px 0 0;">
						<div class="menupanetitle"><?php echo JText::_('CK_BACKGROUNDCOLOR'); ?></div>
						<div style="float:left;"><input class="inputbox colorPicker" type="text" value="" name="<?php echo $prefix; ?>backgroundcolorstart" id="<?php echo $prefix; ?>backgroundcolorstart" size="6" style="width:52px;" /></div><div style="float:left;margin:4px 2px 0 2px;"><img src="<?php echo $this->imagespath; ?>color.png" width="15" height="15"/></div><?php echo JText::_('CK_MAINCOLOR'); ?>
						<input class="inputbox" type="text" value="" name="<?php echo $prefix; ?>backgroundopacity" id="<?php echo $prefix; ?>backgroundopacity" size="1" style="width:22px;"/><?php echo JText::_('CK_OPACITY'); ?>
					</div>
					<?php }
				?>
				<div class="menupaneblock" style="width:350px;margin-left:0px;">
					<div class="menupanetitle"><?php echo JText::_('CK_BACKGROUNDIMAGE'); ?></div>
					<div style="text-align:left;float: left;">
		                <div style="text-align:left;float: left;">
		                    <div style="float: left">
								<select class="inputbox" type="list" value="" name="<?php echo $prefix; ?>backgroundimageattachment" id="<?php echo $prefix; ?>backgroundimageattachment" style="width: 70px;">
									<option value="scroll"><?php echo JText::_('scroll'); ?></option>
									<option value="fixed"><?php echo JText::_('fixed'); ?></option>
								</select>
		                    </div>
		                    <div style="text-align:left;float: left;width:8px;"><?php echo JText::_('x'); ?></div><div style="text-align:left;float: left;"><input class="inputbox" type="text" value="" name="<?php echo $prefix; ?>backgroundimageleft" id="<?php echo $prefix; ?>backgroundimageleft" size="7" style="width:25px;" /></div>
		                    <div style="text-align:left;float: left;width:8px;"><?php echo JText::_('y'); ?></div><div style="text-align:left;float: left;"><input class="inputbox" type="text" value="" name="<?php echo $prefix; ?>backgroundimagetop" id="<?php echo $prefix; ?>backgroundimagetop" size="7" style="width:25px;" /></div>
		                    <div>
		                    </div>
		                </div>
		                <div style="clear:both;float:left;">
		                    <div style="text-align:left;">
		                        <a style="display:block;float:left;padding:0 5px;width:85px;" class="modal ckbuttonstyle" href="administrator/index.php?option=com_media&view=images&tmpl=component&e_name=<?php echo $prefix; ?>backgroundimageurl" rel="{handler: 'iframe', size: {x: 700, y: 600}}" ><?php echo JText::_('CK_SELECT'); ?></a>
		                        <a style="display:block;float:left;padding:0 5px;width:45px;" class="ckbuttonstyle" href="javascript:void(0)" onclick="$ck('#<?php echo $prefix; ?>backgroundimageurl').attr('value', '');"><?php echo JText::_('CK_CLEAN'); ?></a>
		                        <div class="clr"></div>
		                        <input class="inputbox" type="text" value="" name="<?php echo $prefix; ?>backgroundimageurl" id="<?php echo $prefix; ?>backgroundimageurl" size="7" style="width:150px; clear:both;" />
		                    </div>

		                    <div style="text-align:left;">
		<?php echo JText::_('CK_REPEAT'); ?>
		                        <select class="inputbox" type="list" value="" name="<?php echo $prefix; ?>backgroundimagerepeat" id="<?php echo $prefix; ?>backgroundimagerepeat" style="width: 70px;float:right; margin-right:4px;">
		                            <option value="no-repeat"><?php echo JText::_('CK_NONE'); ?></option>
		                            <option value="repeat-x"><?php echo JText::_('CK_HORIZONTAL'); ?></option>
		                            <option value="repeat-y"><?php echo JText::_('CK_VERTICAL'); ?></option>
		                            <option value="repeat"><?php echo JText::_('CK_HORIZONTAL_VERTICAL'); ?></option>
		                        </select>
		                    </div>
		                </div>
					</div>
					<div style="margin-left:2px;float: left;">
						<img src="<?php echo $this->imagespath; ?>background_illustration.png" width="175" height="115"/>
					</div>
				</div>
				<div class="menupaneblock" style="margin-left:10px;">

				</div>


			</div>
		</div>
		<?php
	}

	public function createText($prefix, $showlinks = true) {
		?>
		<div class="menustylesblock" style="width:850px;">
			<div class="menustylesblocktitle"><?php echo JText::_('CK_TEXT'); ?></div>
			<div class="menustylesblockaccordion">
				<div class="menupaneblock">
					<div style="float:left;">
						<div class="menupanetitle" style="width:200px;text-align:center;"><?php echo JText::_('CK_POLICE'); ?></div>
						<div style="float:left;margin:0px 0 0 0px;clear:both;">
							<div>
								<div style="float:left;"><input class="inputbox colorPicker" type="text" value="" name="<?php echo $prefix; ?>color" id="<?php echo $prefix; ?>color" size="6" style="width:52px;"/></div><div style="float:left;margin:5px 5px 0 2px;"><img src="<?php echo $this->imagespath; ?>color.png" width="15" height="15"/></div>
							</div>
							<div style="clear:both;">
								<input class="inputbox" style="width: 20px;" name="<?php echo $prefix; ?>fontsize" id="<?php echo $prefix; ?>fontsize" />
								<div style="text-align:left;display:inline;"><?php echo JText::_('CK_SIZE'); ?></div>
							</div>
							<div style="clear:both;">
								<select class="inputbox" style="width: 78px;" name="<?php echo $prefix; ?>fontfamily" id="<?php echo $prefix; ?>fontfamily">
									<option value="default"><?php echo JText::_('CK_DEFAULT'); ?></option>
									<option style="font-family:Times New Roman;" value="Times New Roman, Serif">Times New Roman</option>
									<option style="font-family:Helvetica;" value="Helvetica, sans-serif">Helvetica</option>
									<option style="font-family:Georgia;" value="Georgia, serif">Georgia</option>
									<option style="font-family:Courier New;" value="Courier New, serif">Courier New</option>
									<option style="font-family:Arial;" value="Arial, sans-serif">Arial</option>
									<option style="font-family:Verdana;" value="Verdana, sans-serif">Verdana</option>
									<option style="font-family:Comic Sans MS;" value="Comic Sans MS, cursive">Comic Sans MS</option>
									<option style="font-family:Tahoma;" value="Tahoma, sans-serif">Tahoma</option>
									<option style="font-family:Segoe UI;" value="Segoe UI, sans-serif">Segoe UI</option>
									<?php
									$fonts = $this->_getFonts();
									foreach ($fonts as $font) {
										echo '<option style="font-family:\'' . $font . '\';" value="' . $font . '">' . $font . '</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div style="float:left;margin:0px 0 0 15px;">
							<select class="inputbox" value="default" name="<?php echo $prefix; ?>fontbold" id="<?php echo $prefix; ?>fontbold" style="width:70px;">
								<option value="default"><?php echo JText::_('CK_DEFAULT'); ?></option>
								<option value="bold"><?php echo JText::_('CK_BOLD'); ?></option>
								<option value="normal"><?php echo JText::_('CK_NORMAL'); ?></option>
							</select>
							<img src="<?php echo $this->imagespath; ?>text_bold.png" width="16" height="16" title="bold"/><br />
							<select class="inputbox" default="default" name="<?php echo $prefix; ?>fontitalic" id="<?php echo $prefix; ?>fontitalic" style="width:70px;">
								<option value="default"><?php echo JText::_('CK_DEFAULT'); ?></option>
								<option value="italic"><?php echo JText::_('CK_ITALIC'); ?></option>
								<option value="normal"><?php echo JText::_('CK_NORMAL'); ?></option>
							</select>
							<img src="<?php echo $this->imagespath; ?>text_italic.png" width="16" height="16" title="italic"/><br />
							<select class="inputbox" value="default" name="<?php echo $prefix; ?>fontunderline" id="<?php echo $prefix; ?>fontunderline" style="width:70px;">
								<option value="default"><?php echo JText::_('CK_DEFAULT'); ?></option>
								<option value="underline"><?php echo JText::_('CK_UNDERLINE'); ?></option>
								<option value="nodecoration"><?php echo JText::_('CK_NORMAL'); ?></option>
							</select>
							<img src="<?php echo $this->imagespath; ?>text_underline.png" width="16" height="16" title="underline"/><br />
							<select class="inputbox" value="default" name="<?php echo $prefix; ?>fontuppercase" id="<?php echo $prefix; ?>fontuppercase" style="width:70px;">
								<option value="default"><?php echo JText::_('CK_DEFAULT'); ?></option>
								<option value="uppercase"><?php echo JText::_('CK_UPPERCASE'); ?></option>
								<option value="lowercase"><?php echo JText::_('CK_LOWERCASE'); ?></option>
							</select>
							<img src="<?php echo $this->imagespath; ?>text_smallcaps.png" width="16" height="16" title="uppercase"/><br />
						</div>

						<div style="clear:both;"></div>
						<div style="margin:5px 0 0 0px;">
							<div style="float:left;margin:0px 0px 0 2px;"><input type="radio" class="inputbox" name="<?php echo $prefix; ?>alignement" id="<?php echo $prefix; ?>alignementleft" value="left" style="width:16px;border:none;margin:0 2px;"></div> <div style="float:left;margin:0px 5px 0 2px;"><img src="<?php echo $this->imagespath; ?>text_align_left.png" width="16" height="16" /></div>
							<div style="float:left;margin:0px 0px 0 2px;"><input type="radio" class="inputbox" name="<?php echo $prefix; ?>alignement" id="<?php echo $prefix; ?>alignementcenter" value="center" style="width:16px;border:none;margin:0 2px;"></div> <div style="float:left;margin:0px 5px 0 2px;"><img src="<?php echo $this->imagespath; ?>text_align_center.png" width="16" height="16" /></div>
							<div style="float:left;margin:0px 0px 0 2px;"><input type="radio" class="inputbox" name="<?php echo $prefix; ?>alignement" id="<?php echo $prefix; ?>alignementright" value="right" style="width:16px;border:none;margin:0 2px;"></div> <div style="float:left;margin:0px 5px 0 2px;"><img src="<?php echo $this->imagespath; ?>text_align_right.png" width="16" height="16" /></div>
							<div style="float:left;margin:0px 0px 0 2px;"><input type="radio" class="inputbox" name="<?php echo $prefix; ?>alignement" id="<?php echo $prefix; ?>alignementjustify" value="justify" style="width:16px;border:none;margin:0 2px;"></div> <div style="float:left;margin:0px 5px 0 2px;"><img src="<?php echo $this->imagespath; ?>text_align_justify.png" width="16" height="16" /></div>
						</div>
					</div>
				</div>
				<div class="menupaneblock">
					<div class="menupanetitle"><?php echo JText::_('CK_SPACING'); ?></div>
					<div style="text-align:left;clear:both;">
						<div style="float:left;margin:0px 5px 0 2px;"><input class="inputbox" type="text" name="<?php echo $prefix; ?>wordspacing" id="<?php echo $prefix; ?>wordspacing" size="1" value="" style="width:20px;" /></div>
						<div style="float:left;margin:5px 5px 0 2px;"><img src="<?php echo $this->imagespath; ?>spacing.png" width="16" height="16" /></div> <?php echo JText::_('CK_WORD'); ?>
					</div>
					<div style="text-align:left;clear:both;">
						<div style="float:left;margin:0px 5px 0 2px;"><input class="inputbox" type="text" name="<?php echo $prefix; ?>letterspacing" id="<?php echo $prefix; ?>letterspacing" size="1" value="" style="width:20px;" /></div>
						<div style="float:left;margin:5px 5px 0 2px;"><img src="<?php echo $this->imagespath; ?>spacing.png" width="16" height="16" /></div> <?php echo JText::_('CK_LETTER'); ?>
					</div>
					<div style="text-align:left;clear:both;">
						<div style="float:left;margin:0px 5px 0 2px;"><input class="inputbox" type="text" name="<?php echo $prefix; ?>lineheight" id="<?php echo $prefix; ?>lineheight" size="1" value="" style="width:20px;" /></div>
						<div style="float:left;margin:5px 5px 0 2px;"><img src="<?php echo $this->imagespath; ?>text_linespacing.png" width="16" height="16" /></div> <?php echo JText::_('CK_LINEHEIGHT'); ?>
					</div>
					<div style="text-align:left;clear:both;">
						<div style="float:left;margin:0px 5px 0 2px;"><input class="inputbox" type="text" name="<?php echo $prefix; ?>textindent" id="<?php echo $prefix; ?>textindent" size="1" value="" style="width:20px;" /></div>
						<div style="float:left;margin:5px 5px 0 2px;"><img src="<?php echo $this->imagespath; ?>text_indent.png" width="16" height="16" align="top"/></div> <?php echo JText::_('CK_TEXTINDENT'); ?>
					</div>
				</div>
		<?php if ($showlinks) { ?>
					<div class="menupaneblock" style="margin-left:10px;">
						<div class="menupanetitle"><?php echo JText::_('CK_NORMALLINK'); ?></div>
						<select class="inputbox" value="default" name="<?php echo $prefix; ?>normallinkfontbold" id="<?php echo $prefix; ?>normallinkfontbold" style="width:70px;">
							<option value="default"><?php echo JText::_('CK_DEFAULT'); ?></option>
							<option value="bold"><?php echo JText::_('CK_BOLD'); ?></option>
							<option value="normal"><?php echo JText::_('CK_NORMAL'); ?></option>
						</select>
						<img src="<?php echo $this->imagespath; ?>text_bold.png" width="16" height="16" title="bold"/><br />
						<select class="inputbox" default="default" name="<?php echo $prefix; ?>normallinkfontitalic" id="<?php echo $prefix; ?>normallinkfontitalic" style="width:70px;">
							<option value="default"><?php echo JText::_('CK_DEFAULT'); ?></option>
							<option value="italic"><?php echo JText::_('CK_ITALIC'); ?></option>
							<option value="normal"><?php echo JText::_('CK_NORMAL'); ?></option>
						</select>
						<img src="<?php echo $this->imagespath; ?>text_italic.png" width="16" height="16" title="italic"/><br />
						<select class="inputbox" value="default" name="<?php echo $prefix; ?>normallinkfontunderline" id="<?php echo $prefix; ?>normallinkfontunderline" style="width:70px;">
							<option value="default"><?php echo JText::_('CK_DEFAULT'); ?></option>
							<option value="underline"><?php echo JText::_('CK_UNDERLINE'); ?></option>
							<option value="nodecoration"><?php echo JText::_('CK_NORMAL'); ?></option>
						</select>
						<img src="<?php echo $this->imagespath; ?>text_underline.png" width="16" height="16" title="underline"/><br />
						<select class="inputbox" value="default" name="<?php echo $prefix; ?>normallinkfontuppercase" id="<?php echo $prefix; ?>normallinkfontuppercase" style="width:70px;">
							<option value="default"><?php echo JText::_('CK_DEFAULT'); ?></option>
							<option value="uppercase"><?php echo JText::_('CK_UPPERCASE'); ?></option>
							<option value="lowercase"><?php echo JText::_('CK_LOWERCASE'); ?></option>
						</select>
						<img src="<?php echo $this->imagespath; ?>text_smallcaps.png" width="16" height="16" title="uppercase"/><br />
						<div style="text-align:left;">
							<div style="float:left;"><input class="inputbox colorPicker" type="text" value="" name="<?php echo $prefix; ?>normallinkcolor" id="<?php echo $prefix; ?>normallinkcolor" size="6" style="width:45px;"/></div><div style="float:left;margin:5px 5px 0 2px;"><img src="<?php echo $this->imagespath; ?>color.png" width="15" height="15"/></div>
						</div>
					</div>
					<div class="menupaneblock" style="margin-left:10px;">
						<div class="menupanetitle"><?php echo JText::_('CK_HOVERLINK'); ?></div>
						<select class="inputbox" value="default" name="<?php echo $prefix; ?>hoverlinkfontbold" id="<?php echo $prefix; ?>hoverlinkfontbold" style="width:70px;">
							<option value="default"><?php echo JText::_('CK_DEFAULT'); ?></option>
							<option value="bold"><?php echo JText::_('CK_BOLD'); ?></option>
							<option value="normal"><?php echo JText::_('CK_NORMAL'); ?></option>
						</select>
						<img src="<?php echo $this->imagespath; ?>text_bold.png" width="16" height="16" title="bold"/><br />
						<select class="inputbox" default="default" name="<?php echo $prefix; ?>hoverlinkfontitalic" id="<?php echo $prefix; ?>hoverlinkfontitalic" style="width:70px;">
							<option value="default"><?php echo JText::_('CK_DEFAULT'); ?></option>
							<option value="italic"><?php echo JText::_('CK_ITALIC'); ?></option>
							<option value="normal"><?php echo JText::_('CK_NORMAL'); ?></option>
						</select>
						<img src="<?php echo $this->imagespath; ?>text_italic.png" width="16" height="16" title="italic"/><br />
						<select class="inputbox" value="default" name="<?php echo $prefix; ?>hoverlinkfontunderline" id="<?php echo $prefix; ?>hoverlinkfontunderline" style="width:70px;">
							<option value="default"><?php echo JText::_('CK_DEFAULT'); ?></option>
							<option value="underline"><?php echo JText::_('CK_UNDERLINE'); ?></option>
							<option value="nodecoration"><?php echo JText::_('CK_NORMAL'); ?></option>
						</select>
						<img src="<?php echo $this->imagespath; ?>text_underline.png" width="16" height="16" title="underline"/><br />
						<select class="inputbox" value="default" name="<?php echo $prefix; ?>hoverlinkfontuppercase" id="<?php echo $prefix; ?>hoverlinkfontuppercase" style="width:70px;">
							<option value="default"><?php echo JText::_('CK_DEFAULT'); ?></option>
							<option value="uppercase"><?php echo JText::_('CK_UPPERCASE'); ?></option>
							<option value="lowercase"><?php echo JText::_('CK_LOWERCASE'); ?></option>
						</select>
						<img src="<?php echo $this->imagespath; ?>text_smallcaps.png" width="16" height="16" title="uppercase"/><br />
						<div style="text-align:left;">
							<div style="float:left;"><input class="inputbox colorPicker" type="text" value="" name="<?php echo $prefix; ?>hoverlinkcolor" id="<?php echo $prefix; ?>hoverlinkcolor" size="6" style="width:45px;"/></div><div style="float:left;margin:5px 5px 0 2px;"><img src="<?php echo $this->imagespath; ?>color.png" width="15" height="15"/></div>
						</div>
					</div>
					<div class="menuseparator"></div>
		<?php } ?>
				<div class="clr"></div>
			</div>
		</div>
		<?php
	}

	public function createDimensions($prefix, $useheight = false, $usewidth = false, $expert = false) {
		?>
		<div class="menustylesblock" style="width:850px;">
			<div class="menustylesblocktitle"><?php echo JText::_('CK_MISE_FORME'); ?></div>
			<div class="menustylesblockaccordion">
				<div class="menupaneblock">
					<div class="menupanetitle" style="text-align:left;width:150px;padding-left:60px;"><?php echo JText::_('CK_MARGINS'); ?></div>
					<div class="menupaneblock">
						<div><div style="width:45px;float:left;text-align:right;margin-right:10px;"><?php echo JText::_('CK_TOP'); ?></div><div style="float:left;text-align:right;margin-right:5px;"><img src="<?php echo $this->imagespath; ?>margintop.png" width="23" height="23" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>margintop" id="<?php echo $prefix; ?>margintop" size="1" value="" /></div>
						<div><div style="width:45px;float:left;text-align:right;margin-right:10px;"><?php echo JText::_('CK_RIGHT'); ?></div><div style="float:left;text-align:right;margin-right:5px;"><img src="<?php echo $this->imagespath; ?>marginright.png" width="23" height="23" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>marginright" id="<?php echo $prefix; ?>marginright" size="1" value="" /></div>
						<div><div style="width:45px;float:left;text-align:right;margin-right:10px;"><?php echo JText::_('CK_BOTTOM'); ?></div><div style="float:left;text-align:right;margin-right:5px;"><img src="<?php echo $this->imagespath; ?>marginbottom.png" width="23" height="23" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>marginbottom" id="<?php echo $prefix; ?>marginbottom" size="1" value=""  /></div>
						<div><div style="width:45px;float:left;text-align:right;margin-right:10px;"><?php echo JText::_('CK_LEFT'); ?></div><div style="float:left;text-align:right;margin-right:5px;"><img src="<?php echo $this->imagespath; ?>marginleft.png" width="23" height="23" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>marginleft" id="<?php echo $prefix; ?>marginleft" size="1" value="" /></div>
					</div>
					<div class="menupaneblock">
						<div style="width:21px;float:left;text-align:right;margin:1px 0 0 0;"><img src="<?php echo $this->imagespath; ?>all_margins.png" width="21" height="98" /></div>
						<div style="float:left;text-align:left;margin:38px 0 0 5px;"><input class="inputbox" type="text" name="<?php echo $prefix; ?>margins" id="<?php echo $prefix; ?>margins" size="1" value="" /><div style="width:25px;float:right;text-align:left;margin-left:3px;"></div></div>
					</div>
				</div>
				<div class="menupaneblock">
					<div class="menupanetitle" style="text-align:left;width:150px;padding-left:0px;"><?php echo JText::_('CK_PADDINGS'); ?></div>
					<div class="menupaneblock">
						<div><div style="float:left;text-align:right;margin:5px 10px 0 0;"><img src="<?php echo $this->imagespath; ?>paddingtop.png" width="15" height="15" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>paddingtop" id="<?php echo $prefix; ?>paddingtop" size="1" value="" /></div>
						<div><div style="float:left;text-align:right;margin:5px 10px 0 0;"><img src="<?php echo $this->imagespath; ?>paddingright.png" width="15" height="15" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>paddingright" id="<?php echo $prefix; ?>paddingright" size="1" value="" /></div>
						<div><div style="float:left;text-align:right;margin:5px 10px 0 0;"><img src="<?php echo $this->imagespath; ?>paddingbottom.png" width="15" height="15" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>paddingbottom" id="<?php echo $prefix; ?>paddingbottom" size="1" value=""  /></div>
						<div><div style="float:left;text-align:right;margin:5px 10px 0 0;"><img src="<?php echo $this->imagespath; ?>paddingleft.png" width="15" height="15" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>paddingleft" id="<?php echo $prefix; ?>paddingleft" size="1" value="" /></div>
					</div>
					<div class="menupaneblock">
						<div style="width:21px;float:left;text-align:right;margin:1px 0 0 0;"><img src="<?php echo $this->imagespath; ?>all_paddings.png" width="15" height="98" /></div>
						<div style="float:left;text-align:left;margin:38px 0 0 5px;"><input class="inputbox" type="text" name="<?php echo $prefix; ?>paddings" id="<?php echo $prefix; ?>paddings" size="1" value="" /><div style="width:20px;float:right;text-align:left;margin-left:3px;"></div></div>
					</div>
				</div>
		<?php if ($useheight OR $usewidth) { ?>
					<div class="menuseparator"></div>
					<div class="menupaneblock" style="margin-left:10px;">
						<div class="menupanetitle<?php if ($expert == 'true') echo ' expert'; ?>" style="text-align:left;padding-left:0px;margin-top:0px;"><?php echo JText::_('CK_DIMENSIONS'); ?></div>
			<?php if ($useheight) { ?>
							<div style="text-align:left;">
								<div><?php echo JText::_('CK_HEIGHT'); ?></div>
								<div style="float:left;text-align:right;margin:5px 5px 0 0;"><img src="<?php echo $this->imagespath; ?>height.png" width="15" height="15" align="top" /></div><div style="float:left;"><input class="inputbox" type="text" name="<?php echo $prefix; ?>height" id="<?php echo $prefix; ?>height" size="2" value="" style="" /></div><div style="float:left;text-align:left;margin-left:3px;"></div>
							</div>
						<?php } ?>
			<?php if ($usewidth) { ?>
							<div style="text-align:left;clear:both;">
								<div><?php echo JText::_('CK_WIDTH'); ?></div>
								<div style="float:left;text-align:right;margin:5px 5px 0 0;"><img src="<?php echo $this->imagespath; ?>width.png" width="15" height="15" align="top" /></div><div style="float:left;"><input class="inputbox" type="text" name="<?php echo $prefix; ?>width" id="<?php echo $prefix; ?>width" size="2" value="" style="" /></div><div style="float:left;text-align:left;margin-left:3px;"></div>
							</div>
					<?php } ?>
					</div>
		<?php } ?>
				<div class="menupaneblock" style="float:right;">
					<div style="margin:10px 0 0 15px;"><img src="<?php echo $this->imagespath; ?>formatting.png" width="200" height="150" /></div>
				</div>

				<div class="clr"></div>
			</div>
		</div>
		<?php
	}

	public function createDecoration($prefix) {
		?>
		<div class="menustylesblock" style="width:850px;">
			<div class="menustylesblocktitle"><?php echo JText::_('CK_DECORATION'); ?></div>
			<div class="menustylesblockaccordion">
				<div class="menupaneblock" style="margin-left:0px;">
					<div class="menupanetitle" style="text-align:left;width:150px;padding-left:0px;"><?php echo JText::_('CK_ROUNDED_CORNERS'); ?>
					</div>
					<div class="menupaneblock">
						<div><div style="float:left;text-align:right;margin:5px 3px 0 0;"><img src="<?php echo $this->imagespath; ?>topright_corner.png" width="18" height="18" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>borderradiustopright" id="<?php echo $prefix; ?>borderradiustopright" size="1" value="" style="" /><div style="width:85px;float:right;text-align:left;margin-left:3px;"><?php echo JText::_('CK_TOPRIGHT'); ?></div></div>
						<div><div style="float:left;text-align:right;margin:5px 3px 0 0;"><img src="<?php echo $this->imagespath; ?>bottomright_corner.png" width="18" height="18" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>borderradiusbottomright" id="<?php echo $prefix; ?>borderradiusbottomright" size="1" value="" style="" /><div style="width:85px;float:right;text-align:left;margin-left:3px;"><?php echo JText::_('CK_BOTTOMRIGHT'); ?></div></div>
						<div><div style="float:left;text-align:right;margin:5px 3px 0 0;"><img src="<?php echo $this->imagespath; ?>bottomleft_corner.png" width="18" height="18" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>borderradiusbottomleft" id="<?php echo $prefix; ?>borderradiusbottomleft" size="1" value="" style=""  /><div style="width:85px;float:right;text-align:left;margin-left:3px;"><?php echo JText::_('CK_BOTTOMLEFT'); ?></div></div>
						<div><div style="float:left;text-align:right;margin:5px 3px 0 0;"><img src="<?php echo $this->imagespath; ?>topleft_corner.png" width="18" height="18" align="top" /></div><input class="inputbox" type="text" name="<?php echo $prefix; ?>borderradiustopleft" id="<?php echo $prefix; ?>borderradiustopleft" size="1" value="" style="" /><div style="width:85px;float:right;text-align:left;margin-left:3px;"><?php echo JText::_('CK_TOPLEFT'); ?></div></div>
					</div>
					<div class="menupaneblock" style="width:100px;">
						<div style="width:38px;float:left;text-align:right;margin:1px 0 0 0;"><img src="<?php echo $this->imagespath; ?>all_corners.png" width="38" height="98" /></div>
						<div style="float:left;text-align:right;margin:35px 0 0 5px;">
							<input class="inputbox" type="text" name="<?php echo $prefix; ?>borderradius" id="<?php echo $prefix; ?>borderradius" size="1" value="" style="" />
						</div>
					</div>
				</div>
				<div class="menupaneblock">
					<div class="menupanetitle" style="width:210px;"><?php echo JText::_('CK_BORDERS'); ?></div>
					<div style="text-align: left;">
						<div style="float:left;text-align:right;margin:5px 2px 0 50px;"><img src="<?php echo $this->imagespath; ?>color.png" width="15" height="15" align="top" /></div><span style="padding-left:0px;"><?php echo JText::_('CK_COLOR'); ?></span><span style="padding-left:7px;"><?php echo JText::_('CK_SIZE'); ?></span><span style="padding-left:20px;"><?php echo JText::_('CK_STYLE'); ?></span>
					</div>
					<div style="text-align: left;clear:both;">
						<div style="width:45px;float:left;text-align:right;margin-right:3px;">
		<?php echo JText::_('CK_TOP'); ?>
						</div>
						<input class="inputbox colorPicker" type="text" value="" name="<?php echo $prefix; ?>bordertopcolor" id="<?php echo $prefix; ?>bordertopcolor" size="7" style="width:55px;" />
						<input class="inputbox" style="" name="<?php echo $prefix; ?>bordertopsize" id="<?php echo $prefix; ?>bordertopsize" >

						<select class="inputbox" style="width:55px;height:22px;" name="<?php echo $prefix; ?>bordertopstyle" id="<?php echo $prefix; ?>bordertopstyle" >
							<option value="solid">solid</option>
							<option value="dotted">dotted</option>
							<option value="dashed">dashed</option>
						</select>
					</div>
					<div style="text-align: left;">
						<div style="width:45px;float:left;text-align:right;margin-right:3px;">
		<?php echo JText::_('CK_RIGHT'); ?>
						</div>
						<input class="inputbox colorPicker" type="text" value="" name="<?php echo $prefix; ?>borderrightcolor" id="<?php echo $prefix; ?>borderrightcolor" size="7" style="width:55px;" />
						<input class="inputbox" style="" name="<?php echo $prefix; ?>borderrightsize" id="<?php echo $prefix; ?>borderrightsize">

						<select class="inputbox" style="width:55px;height:22px;" name="<?php echo $prefix; ?>borderrightstyle" id="<?php echo $prefix; ?>borderrightstyle" >
							<option value="solid">solid</option>
							<option value="dotted">dotted</option>
							<option value="dashed">dashed</option>
						</select>
					</div>
					<div style="text-align: left;">
						<div style="width:45px;float:left;text-align:right;margin-right:3px;">
		<?php echo JText::_('CK_BOTTOM'); ?>
						</div>
						<input class="inputbox colorPicker" type="text" value="" name="<?php echo $prefix; ?>borderbottomcolor" id="<?php echo $prefix; ?>borderbottomcolor" size="7" style="width:55px;" />
						<input class="inputbox" style="" name="<?php echo $prefix; ?>borderbottomsize" id="<?php echo $prefix; ?>borderbottomsize">

						<select class="inputbox" style="width:55px;height:22px;" name="<?php echo $prefix; ?>borderbottomstyle" id="<?php echo $prefix; ?>borderbottomstyle" >
							<option value="solid">solid</option>
							<option value="dotted">dotted</option>
							<option value="dashed">dashed</option>
						</select>
					</div>
					<div style="text-align: left;">
						<div style="width:45px;float:left;text-align:right;margin-right:3px;">
		<?php echo JText::_('CK_LEFT'); ?>
						</div>
						<input class="inputbox colorPicker" type="text" value="" name="<?php echo $prefix; ?>borderleftcolor" id="<?php echo $prefix; ?>borderleftcolor" size="7" style="width:55px;" />
						<input class="inputbox" style="" name="<?php echo $prefix; ?>borderleftsize" id="<?php echo $prefix; ?>borderleftsize">

						<select class="inputbox" style="width:55px;height:22px;" name="<?php echo $prefix; ?>borderleftstyle" id="<?php echo $prefix; ?>borderleftstyle" >
							<option value="solid">solid</option>
							<option value="dotted">dotted</option>
							<option value="dashed">dashed</option>
						</select>
					</div>
				</div>
				<div class="menupaneblock">
					<div style="text-align: left;margin:45px 0 0 5px;">
						<div><img src="<?php echo $this->imagespath; ?>all_borders_top.png" width="7" height="11" /></div>
						<div><input class="inputbox colorPicker" type="text" value="" name="<?php echo $prefix; ?>borderscolor" id="<?php echo $prefix; ?>borderscolor" size="7" style="width:52px;float:left;" /><div style="float:right;margin:4px 2px 0 2px;"><img src="<?php echo $this->imagespath; ?>color.png" width="15" height="15"/></div></div>
						<div>
							<input class="inputbox" style="width:20px;" name="<?php echo $prefix; ?>borderssize" id="<?php echo $prefix; ?>borderssize" >
							<div style="text-align:left;display:inline;"><?php echo JText::_('CK_SIZE'); ?></div>
						</div>

						<select class="inputbox" style="width:78px;height:22px;" name="<?php echo $prefix; ?>bordersstyle" id="<?php echo $prefix; ?>bordersstyle" >
							<option value="solid">solid</option>
							<option value="dotted">dotted</option>
							<option value="dashed">dashed</option>
						</select>
						<div><img src="<?php echo $this->imagespath; ?>all_borders_bottom.png" width="7" height="8" /></div>
					</div>
				</div>
				<div class="menupaneblock" style="float:right;">
					<div style="margin:3px 0 0 0px;"><img src="<?php echo $this->imagespath; ?>borders.png" width="200" height="170" /></div>
				</div>

			</div>
		</div>
		<?php
	}

	public function createShadow($prefix) {
		?>
		<div class="menustylesblock" style="width:850px;">
			<div class="menustylesblocktitle"><?php echo JText::_('CK_SHADOW'); ?></div>
			<div class="menustylesblockaccordion">
				<div class="menupaneblock" style="text-align: left;">
					<div class="menupanetitle"><?php echo JText::_('CK_SHADOW'); ?></div>
					<div>
						<div style="float:left;">
							<div style="float:left;"><input class="inputbox colorPicker" type="text" value="" name="<?php echo $prefix; ?>shadowcolor" id="<?php echo $prefix; ?>shadowcolor" size="6" style="width:52px;" /></div>
							<div style="float:left;margin:4px 2px 0 2px;"><img src="<?php echo $this->imagespath; ?>color.png" width="15" height="15"/></div><?php echo JText::_('CK_COLOR'); ?>
						</div>
						<div style="float:left;margin-left:10px;">
							<input class="inputbox" type="text" name="<?php echo $prefix; ?>shadowblur" id="<?php echo $prefix; ?>shadowblur" size="1" value="" /><?php echo JText::_('CK_BLUR'); ?>
							<input class="inputbox" type="text" name="<?php echo $prefix; ?>shadowspread" id="<?php echo $prefix; ?>shadowspread" size="1" value="" /><?php echo JText::_('CK_SPREAD'); ?>
						</div>
					</div>
				</div>
				<div class="menupaneblock" style="margin-left:30px;">
					<div class="menupanetitle"><?php echo JText::_('CK_OFFSET'); ?></div>
					<div>
						<input class="inputbox" type="text" name="<?php echo $prefix; ?>shadowoffseth" id="<?php echo $prefix; ?>shadowoffseth" size="1" value="" /><?php echo JText::_('x'); ?>
						<input class="inputbox" type="text" name="<?php echo $prefix; ?>shadowoffsetv" id="<?php echo $prefix; ?>shadowoffsetv" size="1" value="" /><?php echo JText::_('y'); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/*
	 * Get the list of fonts squirrel
	 * @return Array
	 */
	function _getFonts() {
		$fonts = Array();
		$db = JFactory::getDBO();
		$query = "SELECT * FROM #__templateck_fonts";
		$db->setQuery($query);
		$rows = $db->loadObjectList();

		foreach ($rows as $row) {
			$fontfamilies = explode(",", $row->fontfamilies);
			foreach ($fontfamilies as $fontfamily) {
				$fonts[] = $fontfamily;
			}
		}

		return $fonts;
	}
}
