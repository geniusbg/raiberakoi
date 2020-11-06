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
	.aboutversion {
		margin: 10px;
		padding: 10px;
		font-size: 20px;
		font-color: #000;

	}
</style>
<div class="aboutversion"><?php echo JText::_('CK_TEMPLATECK_VERSION') . ' ' . $this->tckversion; ?></div>

<?php echo JText::_('CK_TEMPLATECK_DESC'); ?>
