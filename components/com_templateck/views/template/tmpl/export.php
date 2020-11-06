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
JHTML::_('stylesheet', 'templateck_template.css', 'administrator/components/com_templateck/assets/');
?>
<script language="javascript" type="text/javascript">
	Joomla.submitbutton = function(task)
	{

		if (task == 'cancel') {
			Joomla.submitform(task);
			return;
		}

	}

</script>

<?php
$path = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'projects';
$exportfiledest = $path . DS . $this->template->name . '.tck';
$exportfiletext = json_encode($this->template);
$exportfiletext .= '||TCK||' . json_encode($this->mobiledata);
?>
<form action="<?php echo JRoute::_('index.php'); ?>" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm" class="form-validate">
	<?php
// create the file index.php
	if (!JFile::write($exportfiledest, $exportfiletext)) {
		$msg = '<p class="error">' . JText::_('CK_ERROR_CREATING_EXPORTFILE') . '</p>';
	} else {
		$msg = '<p class="successck">' . JText::_('CK_SUCCESS_CREATING_EXPORTFILE') . '</p>';
	}
	echo '<p>' . $msg . '</p>';

// create button to download the package
	echo '<p style="padding: 15px;"><a class="ckdownload" target="_blank" href="' . JURI::root() . 'components/com_templateck/projects/' . $this->template->name . '.tck">' . JText::_('CK_DOWNLOAD_GABARIT') . '</a></p>';
	?>
    <input type="hidden" name="option" value="com_templateck" />
    <input type="hidden" name="id" value="<?php echo $this->template->id; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="templateck" />
</form>