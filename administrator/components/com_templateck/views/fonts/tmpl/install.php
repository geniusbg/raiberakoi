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
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_templateck/assets/css/templateck.css');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'font.cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
			Joomla.submitform(task, document.getElementById('adminForm'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php'); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="adminForm" class="form-validate">
    <div>
        <fieldset class="adminform">
            <legend><?php echo JText::_('CK_INSTALL_FONT'); ?></legend>
            <table class="admintable">
                <tr>
                    <td width="110" class="key">
                        <label for="title">
							<?php echo JText::_('File (.zip) to import'); ?>:
                        </label>
                    </td>
                    <td>
                        <input class="inputbox" type="file" name="file" id="font.importzip" size="60" />
                        <input type="submit" name="submitbutton" value="<?php echo JText::_('CK_INSTALL_FONT'); ?>" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>

    <input type="hidden" name="option" value="com_templateck" />
    <input type="hidden" name="view" value="fonts" />
    <input type="hidden" name="task" value="font.importzip" />
	<?php echo JHtml::_('form.token'); ?>
</form>