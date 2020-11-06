<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.ck-web-creation-alsace.com
 * http://www.joomlack.fr
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>

<div id="infos_code" class="ckpopup">
	<div class="ckpopuptitle"><?php echo JText::_('CK_TEMPLATE_INFOS'); ?></div>

	<div class="ckclose cksave" onclick="document.getElements('.ckpopup').setStyle('display','none');"></div>
	<div class="ckpopuplogo"></div>
	<div class="infos_code_field">
		<div>
			<label for="joomlaversion"><?php echo JText::_('CK_JOOMLAVERSION'); ?> :</label>
			<?php
				$joomlaversionKeysValues = array(
					JHTML::_('select.option', 'j15', JText::_('CK_JOOMLA15')),
					JHTML::_('select.option', 'j17', JText::_('CK_JOOMLA17')),
                                        JHTML::_('select.option', 'j25', JText::_('CK_JOOMLA25')),
					JHTML::_('select.option', 'j3', JText::_('CK_JOOMLA3'))
				);
				echo JHTML::_('select.genericlist', $joomlaversionKeysValues, 'joomlaversion', 'class="ckinput"', 'value', 'text', $this->template->joomlaversion, 'joomlaversion');
			?>
		</div>
		<div>
			<label for="name">
				<?php echo JText::_('CK_NAME'); ?> :
			</label>
			<input class="ckinput" type="text" name="name" id="name" size="60" value="<?php echo $this->template->name; ?>" />
		</div>
		<div>
			<label for="creationDate">
				<?php echo JText::_('CK_CREATIONDATE'); ?> :
			</label>

			<input class="ckinput" type="text" name="creationDate" id="creationDate" size="60" value="<?php echo $this->template->creationDate; ?>" />
		</div>
		<div>
			<label for="author">
				<?php echo JText::_('CK_AUTHOR'); ?> :
			</label>

			<input class="ckinput" type="text" name="author" id="author" size="60" value="<?php echo $this->template->author; ?>" />
		</div>
		<div>
			<label for="authorEmail">
				<?php echo JText::_('CK_AUTHOREMAIL'); ?> :
			</label>

			<input class="ckinput" type="text" name="authorEmail" id="authorEmail" size="60" value="<?php echo $this->template->authorEmail; ?>" />
		</div>
		<div>
			<label for="authorUrl">
				<?php echo JText::_('CK_AUTHORURL'); ?> :
			</label>

			<input class="ckinput" type="text" name="authorUrl" id="authorUrl" size="60" value="<?php echo $this->template->authorUrl; ?>" />
		</div>
		<div>
			<label for="copyright">
				<?php echo JText::_('CK_COPYRIGHT'); ?> :
			</label>

			<input class="ckinput" type="text" name="copyright" id="copyright" size="60" value="<?php echo $this->template->copyright; ?>" />
		</div>
		<div>
			<label for="license">
				<?php echo JText::_('CK_LICENSE'); ?> :
			</label>

			<input class="ckinput" type="text" name="license" id="license" size="60" value="<?php echo $this->template->license; ?>" />
		</div>
		<div>
			<label for="version">
				<?php echo JText::_('CK_VERSION'); ?> :
			</label>

			<input class="ckinput" type="text" name="version" id="version" size="60" value="<?php echo $this->template->version; ?>" />
		</div>
		<div>
			<label for="description">
				<?php echo JText::_('CK_DESCRIPTION'); ?> :
			</label>

			<textarea class="ckinput" name="description" id="description" rows="5" cols="20"><?php echo $this->template->description; ?></textarea>
		</div>
	</div>
</div>
                   