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
jimport('joomla.application.module.helper');
$app = JFactory::getApplication();
$type = $app->input->get('type');
$blockid = $app->input->get('blockid');
$blockposition = $app->input->get('blockposition', '', 'string');
$fluid = $app->input->get('fluid');
?>
<script language="javascript" type="text/javascript">

</script>
<?php

if ($type != 'wrapper') {
	echo TemplateCreatorck::$type($blockid, $blockposition);
} else {
	echo TemplateCreatorck::openWrapper($blockid, $fluid);
	echo TemplateCreatorck::closeWrapper();
}