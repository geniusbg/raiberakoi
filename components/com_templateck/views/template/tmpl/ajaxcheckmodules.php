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
?>
<script language="javascript" type="text/javascript">
	function publishmodules() {
		checkModules('publish');
	}

	function setValidStateButton() {
		$('checkmodules').set('html', '<?php echo JText::_("CK_MODULEPOSITIONS_VALID"); ?>');
	}

	function setErrorStateButton() {
		$('checkmodules').set('html', '<?php echo JText::_("CK_MODULEPOSITIONS_ERROR"); ?>');
	}
</script>
<?php
$positions = JRequest::getVar('positions');
$action = JRequest::getVar('action', 'test');
$positions = explode(",", $positions);
$positionstopublish = Array();
foreach ($positions as $position) {
	if (!$position)
		continue;

	$modules = checkModulePosition($position);
	if ($modules) {
		echo '<p class="successck"><b>' . $position . ' :</b>';
		echo JText::_('CK_MODULES_IN_POSITION_OK');
	} else {
		echo '<p class="errorck"><b>' . $position . ' :</b>';
		echo JText::_('CK_NO_MODULES_IN_POSITION');
		$positionstopublish[] = $position;
	}
	echo '</p>';
}

if ($positionstopublish) {
	echo '<script language="javascript" type="text/javascript">setErrorStateButton();</script>';
	echo '<input type="button" value="' . JText::_('CK_AUTO_PUBLISH_MODULES') . '" class="ckbuttonstyle" onclick="publishmodules();"/>';
} else {
	echo '<script language="javascript" type="text/javascript">setValidStateButton();</script>';
}

if ($action == 'publish')
	installModules($positionstopublish);

/**
 * Look in the DB to find the modules loaded in the position
 */
function checkModulePosition($position) {
	$db = JFactory::getDbo();
	$query = ' SELECT id, title, module, position, content, showtitle, params, mm.menuid, published'
			. ' FROM #__modules AS m'
			. ' LEFT JOIN #__modules_menu AS mm ON mm.moduleid = m.id'
			. ' WHERE m.published = 1'
			. ' AND mm.menuid = 0'
			. ' AND m.client_id = 0'
			. ' AND m.position = \'' . $position . '\';';
	$db->setQuery($query);
	$modules = $db->loadObjectList();
	return $modules;
}

/**
 * Set default values for the module to publish
 */
function getModuleData($position) {
	$module = Array();
	$module['id'] = 0;
	$module['title'] = "'Module'";
	$module['note'] = "''";
	$module['content'] = "'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed molestie scelerisque ultrices. Nullam venenatis, felis ut accumsan vestibulum, diam leo congue nisl, eget luctus sapien libero eget urna. Duis ac pellentesque nisi.</p>'";
	$module['ordering'] = 1;
	$module['position'] = "'" . $position . "'";
	$module['checked_out '] = 0;
	$module['checked_out_time'] = "'0000-00-00 00:00:00'";
	$module['publish_up '] = "'0000-00-00 00:00:00'";
	$module['publish_down '] = "'0000-00-00 00:00:00'";
	$module['published'] = 1;
	$module['module'] = "'mod_custom'";
	$module['access'] = 1;
	$module['showtitle'] = 1;
	$module['params'] = "''";
	$module['client_id '] = 0;
	$module['language'] = "'*'";

	return $module;
}

/**
 * Inject the data in the DB
 */
function installModules($positionstopublish) {

	$db = JFactory::getDbo();
	foreach ($positionstopublish as $position) {
		if (checkModulePosition($position))
			continue;
		$module = getModuleData($position);
		$q = 'SELECT MAX(id) FROM ' . $db->getPrefix() . 'modules;';
		$db->setQuery($q);
		if (!$moduleid = $db->loadResult()) {
			echo $db->getErrorMsg();
		}
		$moduleid = $moduleid + 1;
		$module['id'] = $moduleid;

		$query = 'INSERT INTO ' . $db->getPrefix() . 'modules'
				. ' (`id`, `title`, `note`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `published`, `module`, `access`, `showtitle`, `params`, `client_id`, `language`) VALUES'
				. ' (' . implode(",", $module) . ');';

		$db->setQuery($query);
		if (!$db->query()) {
			echo $db->getErrorMsg();
			echo JText::_('CK_SAMPLE_MODULES_PUBLISHED_ERROR');
			return false;
		}

		$query = 'INSERT INTO ' . $db->getPrefix() . 'modules_menu'
				. ' (`moduleid`, `menuid`) VALUES'
				. ' (' . $moduleid . ',0);';

		$db->setQuery($query);
		if (!$db->query()) {
			echo $db->getErrorMsg();
			echo JText::_('CK_SAMPLE_MODULES_PUBLISHED_ERROR');
			return false;
		}

		echo JText::_('CK_SAMPLE_MODULES_PUBLISHED_SUCCESS');
		echo '<script language="javascript" type="text/javascript">checkModules(\'test\');</script>';
	}
}