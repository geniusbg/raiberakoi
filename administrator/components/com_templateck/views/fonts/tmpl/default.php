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

$document = JFactory::getDocument();
$document->addStyleSheet('components/com_templateck/assets/css/templateck.css');

// load the fontface css
$this->_callfontsSquirrel();
?>

<div class="alert alert-message"><?php echo JText::_('CK_HOW_TO_DL_FONTKIT'); ?></div>
<form action="<?php echo JRoute::_('index.php'); ?>" method="post" name="adminForm" id="adminForm">
	<div id="editcell">
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="5">
						<?php echo JText::_('CK_NUM'); ?>
					</th>
					<th width="20">

					</th>
					<th>
						<?php echo JText::_('CK_FONTKIT'); ?>
					</th>
					<th>
						<?php echo JText::_('CK_FONTFAMILIES'); ?>
					</th>
					<th width="1%" nowrap="nowrap">
						<?php echo JText::_('ID'); ?>
					</th>
				</tr>

			</thead>
			<?php
			$k = 0;
			for ($i = 0, $n = count($this->fonts); $i < $n; $i++) {
				$font = &$this->fonts[$i];
				$checked = JHTML::_('grid.id', $i, $font->id);
				?>
				<tr class="<?php echo "row$k"; ?>">
					<td>
	<?php echo $i + 1; ?>
					</td>
					<td>
	<?php echo $checked; ?>
					</td>
					<td>
	<?php echo $font->name; ?>
					</td>
					<td>
	<?php
	$fonts = explode(",", $font->fontfamilies);
	foreach ($fonts as $fontfamily) {
		echo " <span style=\"font-size:16px;font-family:'" . $fontfamily . "';\"> " . $fontfamily . " </span> ";
	}
	?>
					</td>
					<td align="center">
						<?php echo $font->id; ?>
					</td>
				</tr>
				<?php
				$k = 1 - $k;
			}
			?>
		</table>
	</div>

	<input type="hidden" name="option" value="com_templateck" />
	<input type="hidden" name="view" value="fonts" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<?php echo JHtml::_('form.token'); ?>
</form>