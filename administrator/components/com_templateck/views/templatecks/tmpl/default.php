<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.template-creator.com
 * Component Template Creator CK
 * @license		GNU/GPL
 * */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$this->_checkIfTemplateInstalled();
?>
<form action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="adminForm">
<div id="editcell">
    <table class="adminlist">
	<thead>
            <tr>
                <th width="5">
                    <?php echo JText::_( 'CK_NUM' ); ?>
                </th>
                <th width="20">
                    <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->templates ); ?>);" />
		</th>
		<th  class="title">
                    <?php echo JText::_( 'CK_TEMPLATES' ); ?>
		</th>
                <th  class="mobile">
                    <?php echo JText::_( 'CK_MOBILES' ); ?>
		</th>
		<th width="1%" nowrap="nowrap">
                    <?php echo JText::_( 'ID' ); ?>
		</th>
            </tr>

	</thead>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->templates ); $i < $n; $i++)
	{
		$template = &$this->templates[$i];

		$checked 	= JHTML::_('grid.id',   $i, $template->id );
		$link 		= JRoute::_( 'index.php?option=com_templateck&controller=templateck&task=edit&cid[]='. $template->id );
                $mobilelink	= JRoute::_( 'index.php?option=com_templateck&controller=mobile&view=mobile&templateid='. $template->id );

		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $i+1; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $template->name; ?></a>
			</td>
                        <td>
                            <?php if (isset($template->htmlcode_responsive) && $template->htmlcode_responsive) { ?>
				<a href="<?php echo $mobilelink; ?>"><?php echo JText::_( 'CK_EDIT_MOBILE_DESIGN' ); ?></a>
                            <?php } else {
                                echo JText::_( 'CK_SAVETEMPLATETOEDITMOBILE_DESIGN' );
                            } ?>
			</td>
			<td align="center">
				<?php echo $template->id; ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</table>
</div>

<input type="hidden" name="option" value="com_templateck" />
<input type="hidden" name="view" value="templatecks" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="templateck" />

</form>

