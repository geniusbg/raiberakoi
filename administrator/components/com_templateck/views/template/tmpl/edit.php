<?php
/**
 * @name		Template Creator CK 3
 * @package		com_templateck
 * @copyright	Copyright (C) 2013. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */
// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_templateck/assets/css/templateck.css');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'template.cancel' || document.formvalidator.isValid(document.id('template-form'))) {
			document.id('jform_name').value = document.id('jform_name').value.toLowerCase().replace(/\s/g, "");
			// document.id('jform_name').value = document.id('jform_name').value.toLowerCase();
			Joomla.submitform(task, document.getElementById('template-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_templateck&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="template-form" class="form-validate">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_TEMPLATECK_LEGEND_TEMPLATE'); ?></legend>
            <ul class="adminformlist">
				<?php echo $this->form->getInput('id'); ?>
                <li><?php echo $this->form->getLabel('joomlaversion'); ?>
                    <div class="clr"></div><?php echo $this->form->getInput('joomlaversion'); ?></li>

                <li><?php echo $this->form->getLabel('name'); ?>
                    <div class="clr"></div><?php echo $this->form->getInput('name'); ?></li>

                <li><?php echo $this->form->getLabel('creationdate'); ?>
					<?php echo $this->form->getInput('creationdate'); ?></li>

                <li><?php echo $this->form->getLabel('author'); ?>
					<?php echo $this->form->getInput('author'); ?></li>

                <li><?php echo $this->form->getLabel('authoremail'); ?>
					<?php echo $this->form->getInput('authoremail'); ?></li>

                <li><?php echo $this->form->getLabel('authorurl'); ?>
					<?php echo $this->form->getInput('authorurl'); ?></li>

                <li><?php echo $this->form->getLabel('copyright'); ?>
					<?php echo $this->form->getInput('copyright'); ?></li>

                <li><?php echo $this->form->getLabel('license'); ?>
					<?php echo $this->form->getInput('license'); ?></li>

                <li><?php echo $this->form->getLabel('version'); ?>
					<?php echo $this->form->getInput('version'); ?></li>

                <li><?php echo $this->form->getLabel('description'); ?>
					<?php echo $this->form->getInput('description'); ?></li>
            </ul>
        </fieldset>
    </div>

    <input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>

    <style type="text/css">
        /* Temporary fix for drifting editor fields */
        .adminformlist li {
            clear: both;
        }
    </style>
</form>