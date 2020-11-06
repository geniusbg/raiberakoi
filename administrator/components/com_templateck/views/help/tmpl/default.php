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
?>
<style>
	.ckgrid {
		margin: 10px;
		padding: 5px;
		width: 350px;
		float: left;
		border: #e7e7e7 1px solid;
		border-radius: 5px;
		text-align: center;
	}

	.ckgridtitle {
		font-size: 14px;
		font-color: #000;
	}
</style>
<div class="ckgrid">
    <h4 class="ckgridtitle"><?php echo JText::_('CK_HELP_VIDEO_OVERVIEW') ?></h4>
    <iframe width="340" height="180" src="http://www.youtube.com/embed/5N4lrTV1h4g" frameborder="0" allowfullscreen></iframe>
</div>
<div class="ckgrid">
    <h4 class="ckgridtitle"><?php echo JText::_('CK_HELP_VIDEO_ADDINGCSS') ?></h4>
    <iframe width="340" height="180" src="http://www.youtube.com/embed/f1h6kAqTSBU" frameborder="0" allowfullscreen></iframe>
</div>
<div class="ckgrid">
    <h4 class="ckgridtitle"><?php echo JText::_('CK_HELP_VIDEO_ADDINGFONT') ?></h4>
    <iframe width="340" height="180" src="http://www.youtube.com/embed/RXNlVevvKHY" frameborder="0" allowfullscreen></iframe>
</div>
<div class="ckgrid">
    <h4 class="ckgridtitle"><?php echo JText::_('CK_HELP_VIDEO_LOGOOPTIONS') ?></h4>
    <iframe width="340" height="180" src="http://www.youtube.com/embed/JSliHMaKAHs" frameborder="0" allowfullscreen></iframe>
</div>
<div class="ckgrid">
    <h4 class="ckgridtitle"><?php echo JText::_('CK_HELP_VIDEO_COLLAPSINGMARGINS') ?></h4>
    <iframe width="340" height="180" src="http://www.youtube.com/embed/gw8Ye6ewwag" frameborder="0" allowfullscreen></iframe>
</div>
<div class="ckgrid">
    <h4 class="ckgridtitle"><?php echo JText::_('CK_HELP_VIDEO_ADDINGDROPDOWNMENU') ?></h4>
    <iframe width="340" height="180" src="http://www.youtube.com/embed/wsB_EPMgAI4" frameborder="0" allowfullscreen></iframe>
</div>
