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
	echo TemplateCreatorck::maincontent($blockid = '', $left = true, $right = true, $maintop = true, $mainbottom = false, $centertop = false, $centerbottom = false);
	echo TemplateCreatorck::closeWrapper();
	?>
</div>