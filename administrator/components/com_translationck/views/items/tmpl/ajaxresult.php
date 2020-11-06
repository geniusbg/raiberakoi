<?php
/**
 * @version     1.0.0
 * @package     com_translationck
 * @copyright   Copyright (C) 2011. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */


// no direct access
defined('_JEXEC') or die;
$componentname = JRequest::getVar('componentname');
$languageprefix = JRequest::getVar('languageprefix');
?>

<form action="<?php echo JRoute::_('index.php?option=com_translationck&view=items'); ?>" method="post" name="adminForm" id="adminForm">
	<table class="adminlist">
		<thead>
			<tr>
				<th>
					<?php echo JText::_("Num"); ?>
				</th>
				<th>
					<?php echo JText::_("File"); ?>
				</th>
				<th>
					<?php echo JText::_("Translation string"); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($this->translations as $i => $translation) :
			?>
			<tr class="row<?php echo $i % 2; ?>">
				<td>
					<?php echo $i+1; ?>
				</td>
				<td>
					<?php echo $translation->file; ?>
				</td>
				<td>
					<?php echo $translation->jtext; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<p style="padding:5px;background: #333;color:#fff;"><?php echo '<a  style="padding:5px;background: #333;color:#fff;font-size:14px;" href="'.JURI::ROOT().'/administrator/components/com_translationck/'.$languageprefix.'.'.$componentname.'.ini">Download the INI file</a>'; ?></div>

	<div>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>