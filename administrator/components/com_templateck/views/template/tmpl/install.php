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
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'template.cancel' || document.formvalidator.isValid(document.id('installGabarit'))) {
			Joomla.submitform(task, document.getElementById('installGabarit'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php'); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="installGabarit" class="form-validate">
	<div>
		<fieldset>
			<legend><?php echo JText::_('CK_INSTALL_GABARIT'); ?></legend>
			<table class="admintable">
				<tr>
					<td width="110" class="key">
						<label for="title">
<?php echo JText::_('CK_CHOOSE_FILE_TCK'); ?>:
						</label>
					</td>
					<td>
						<input class="inputbox" type="file" name="file" id="importzip" size="60" />
						<input type="submit" name="submitfile" class="inputbox" value="<?php echo JText::_('CK_INSTALL'); ?>" />
					</td>
				</tr>
			</table>
		</fieldset>
	</div>

	<input type="hidden" name="option" value="com_templateck" />
	<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="view" value="template" />
	<input type="hidden" name="task" value="template.importtck" />
	<input type="hidden" name="controller" value="template" />
<?php echo JHtml::_('form.token'); ?>
</form>
