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
<div id="infos_code" class="ckpopup">
    <div class="ckpopupoverlay"></div>
    <div class="ckpopupheader">
        <div class="ckpopuplogo"></div>
        <div class="ckpopuptitle"><?php echo JText::_('CK_TEMPLATE_INFOS'); ?></div>
        <div style="float:right;">
            <div class="ckclose cksave" onclick="$ck('#infos_code').hide();"><?php echo JText::_('CK_VALIDATE'); ?></div>
        </div>
    </div>
    <table>
        <tr>
            <td style="vertical-align:top;">
                <div class="layoutinfos">
                    <div class="layoutinfostitle"><?php echo JText::_('CK_GLOBALINFOS_INFOS'); ?></div>
                    <div class="layoutinfosdesc"><?php echo JText::_('CK_GLOBALINFOS_DESC'); ?></div>
                </div>
            </td>
            <td style="vertical-align:top;">
				<div class="infos_code_field clr">
					<div>
						<label for="joomlaversion"><?php echo JText::_('CK_JOOMLAVERSION'); ?> :</label>
						<?php
						$joomlaversionKeysValues = array(
							JHTML::_('select.option', 'j15', JText::_('CK_JOOMLA15')),
							JHTML::_('select.option', 'j17', JText::_('CK_JOOMLA17')),
							JHTML::_('select.option', 'j25', JText::_('CK_JOOMLA25')),
							JHTML::_('select.option', 'j3', JText::_('CK_JOOMLA3'))
						);
						echo JHTML::_('select.genericlist', $joomlaversionKeysValues, 'joomlaversion', 'class="inputbox" style="width:200px;" onchange="toggleBootstrap();"', 'value', 'text', $this->item->joomlaversion, 'joomlaversion');
						?>
					</div>
					<div>
						<label for="name">
							<?php echo JText::_('CK_NAME'); ?> :
						</label>
						<input class="inputbox" type="text" name="name" id="name" style="width:200px;" value="<?php echo $this->item->name; ?>" onchange="validateTemplateName(this);"/>
					</div>
					<div>
						<label for="creationDate">
							<?php echo JText::_('CK_CREATIONDATE'); ?> :
						</label>

						<input class="inputbox" type="text" name="creationDate" id="creationDate" style="width:200px;" value="<?php echo $this->item->creationdate; ?>" />
					</div>
					<div>
						<label for="author">
							<?php echo JText::_('CK_AUTHOR'); ?> :
						</label>

						<input class="inputbox" type="text" name="author" id="author" style="width:200px;" value="<?php echo $this->item->author; ?>" />
					</div>
					<div>
						<label for="authorEmail">
							<?php echo JText::_('CK_AUTHOREMAIL'); ?> :
						</label>

						<input class="inputbox" type="text" name="authorEmail" id="authorEmail" style="width:200px;" value="<?php echo $this->item->authoremail; ?>" />
					</div>
					<div>
						<label for="authorUrl">
							<?php echo JText::_('CK_AUTHORURL'); ?> :
						</label>

						<input class="inputbox" type="text" name="authorUrl" id="authorUrl" style="width:200px;" value="<?php echo $this->item->authorurl; ?>" />
					</div>
					<div>
						<label for="copyright">
							<?php echo JText::_('CK_COPYRIGHT'); ?> :
						</label>

						<input class="inputbox" type="text" name="copyright" id="copyright" style="width:200px;" value="<?php echo $this->item->copyright; ?>" />
					</div>
					<div>
						<label for="license">
							<?php echo JText::_('CK_LICENSE'); ?> :
						</label>

						<input class="inputbox" type="text" name="license" id="license" style="width:200px;" value="<?php echo $this->item->license; ?>" />
					</div>
					<div>
						<label for="version">
							<?php echo JText::_('CK_VERSION'); ?> :
						</label>

						<input class="inputbox" type="text" name="version" id="version" style="width:200px;" value="<?php echo $this->item->version; ?>" />
					</div>
					<div>
						<label for="description" style="vertical-align:top;">
							<?php echo JText::_('CK_DESCRIPTION'); ?> :
						</label>

						<textarea class="inputbox" name="description" id="description" style="width:200px;height: 150px;" ><?php echo $this->item->description; ?></textarea>
					</div>
				</div>
			</td>
        </tr>
    </table>
</div>