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
JHtml::_('stylesheet', 'administrator/components/com_templateck/assets/templateck_template.css');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'template.cancel' || document.formvalidator.isValid(document.id('exportGabarit'))) {
			Joomla.submitform(task, document.getElementById('exportGabarit'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
		}
	}
</script>

<?php
$path = JPATH_ROOT . '/components/com_templateck/projects';
$exportfiledest = $path . '/' . $this->item->name . '.tck3';
$this->item->htmlcode = str_replace(JUri::root(true), "|URIBASE|", $this->item->htmlcode);
$exportfiletext = json_encode($this->item);
?>
<form action="<?php echo JRoute::_('index.php'); ?>" enctype="multipart/form-data" method="post" name="adminForm" id="exportGabarit" class="form-validate">
	<?php
	// create the file index.php
	if (!JFile::write($exportfiledest, $exportfiletext)) {
		$msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_EXPORTFILE') . '</p>';
	} else {
		$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_EXPORTFILE') . '</p>';
	}
	echo '<p>' . $msg . '</p>';

// create button to download the package
	echo '<p style="padding: 15px;"><a class="ckdownload" target="_blank" href="' . JURI::root() . 'components/com_templateck/projects/' . $this->item->name . '.tck3">' . JText::_('CK_DOWNLOAD_GABARIT') . '</a></p>';
	?>
    <input type="hidden" name="option" value="com_templateck" />
    <input type="hidden" name="id" value="" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="template" />
	<?php echo JHtml::_('form.token'); ?>
</form>