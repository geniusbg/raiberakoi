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
JHtml::_('behavior.multiselect');
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_templateck/assets/css/templateck.css');

$user = JFactory::getUser();
$userId = $user->get('id');

$this->_checkIfTemplateInstalled();
?>

<form action="<?php echo JRoute::_('index.php?option=com_templateck&view=templates'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="clearfix"> </div>
    <table class="table table-striped" id="templateckList">
        <thead>
            <tr>
                <th width="1%">
                    <input type="checkbox" name="checkall-toggle" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" value="" onclick="Joomla.checkAll(this)" />
                </th>

                <th class='left'>
					<?php echo JText::_('COM_TEMPLATECK_TEMPLATES_NAME'); ?>
                </th>
				<?php if (isset($this->items[0]->state)) { ?>
				<?php } ?>
				<?php if (isset($this->items[0]->id)) {
					?>
					<th width="1%" class="nowrap">
						<?php echo JText::_('JGRID_HEADING_ID'); ?>
					</th>
				<?php } ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="10">
					<?php echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
			<?php
			foreach ($this->items as $i => $item) :
				$canCreate = $user->authorise('core.create', 'com_templateck');
				$canEdit = $user->authorise('core.edit', 'com_templateck');
				$canCheckin = $user->authorise('core.manage', 'com_templateck');
				$canChange = $user->authorise('core.edit.state', 'com_templateck');
				$link = JURI::root() . 'index.php?option=com_templateck&view=template&task=template.edit&template=templatecreatorck&id=' . $item->id;
				?>
				<tr class="row<?php echo $i % 2; ?>">
					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
	                </td>

	                <td>
	                    <a href="<?php echo $link; ?>"><?php echo $item->name; ?></a>
	                </td>

					<?php if (isset($this->items[0]->id)) {
						?>
						<td class="center">
							<?php echo (int) $item->id; ?>
						</td>
					<?php } ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
    </div>
</form>