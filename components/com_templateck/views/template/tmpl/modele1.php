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
?>
<div id="body" class="body ckbloc editor">
    <div class="ckstyle"></div>
	<?php
	echo TemplateCreatorck::openWrapper('wrapper');
	echo TemplateCreatorck::banner('banner', 'position-0');
	echo TemplateCreatorck::maincontent($blockid = '', $left = false, $right = false, $maintop = false, $mainbottom = false, $centertop = false, $centerbottom = false);
	echo TemplateCreatorck::closeWrapper();
	?>
</div>