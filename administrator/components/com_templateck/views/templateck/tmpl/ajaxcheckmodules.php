<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.module.helper' );
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
$action = JRequest::getVar('action','test');
$positions = explode(",",$positions);
$positionstopublish = Array();
foreach ($positions as $position) {
	if (!$position) continue;
	
	$modules = checkModulePosition($position);
	if ($modules) {
		echo '<p class="successck"><b>'.$position.' :</b>';
		echo JText::_('CK_MODULES_IN_POSITION_OK');
	} else {
		echo '<p class="errorck"><b>'.$position.' :</b>';
		echo JText::_('CK_NO_MODULES_IN_POSITION');
		$positionstopublish[] = $position;
	}
	echo '</p>';
	
}
// var_dump($positionstopublish);

if ($positionstopublish) {
	echo '<script language="javascript" type="text/javascript">setErrorStateButton();</script>';
	echo '<input type="button" value="'.JText::_('CK_AUTO_PUBLISH_MODULES').'" onclick="publishmodules();"/>';
} else {
	echo '<script language="javascript" type="text/javascript">setValidStateButton();</script>';
}

if ($action == 'publish') installModules($positionstopublish);
// var_dump($positionstopublish);


/**
 * Look in the DB to find the modules loaded in the position
 */
function checkModulePosition($position) {
	$db	= JFactory::getDbo();
	$query = ' SELECT id, title, module, position, content, showtitle, params, mm.menuid, published'
		.' FROM #__modules AS m'
		.' LEFT JOIN #__modules_menu AS mm ON mm.moduleid = m.id'
		.' WHERE m.published = 1'
		.' AND mm.menuid = 0'
		.' AND m.client_id = 0'
		.' AND m.position = \''.$position.'\';';
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
	$module['title'] = "'Sample data'";
	$module['note'] = "''";
	$module['content'] = "'<p><img align=\"left\" src=\"administrator/templates/bluestork/images/header/icon-48-themes.png\" border=\"0\" />Joomla! is a flexible and powerful platform, whether you are building a small site for yourself or a huge site with hundreds of thousands of visitors. <a href=\"#\">Joomla</a> is open source, which means you can make it work just the way you want it to.</p><div style=\"clear:both;\"></div>'";
	$module['ordering'] = 1;
	$module['position'] = "'".$position."'";
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
	
	$db	= JFactory::getDbo();
	foreach ($positionstopublish as $position) {
		if (checkModulePosition($position)) continue;
		$module = getModuleData($position);
		$q = 'SELECT MAX(id) FROM '.$db->getPrefix().'modules;';
		$db->setQuery($q);
		if (!$moduleid = $db->loadResult()) {
			echo $db->getErrorMsg();
		}
		$moduleid = $moduleid+1;
		$module['id'] = $moduleid;

		$query = 'INSERT INTO '.$db->getPrefix().'modules'
			.' (`id`, `title`, `note`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `published`, `module`, `access`, `showtitle`, `params`, `client_id`, `language`) VALUES'
			.' ('.implode(",",$module).');';

			
		$db->setQuery($query);
		if (!$db->query()) {
			echo $db->getErrorMsg();
			echo JText::_('CK_SAMPLE_MODULES_PUBLISHED_ERROR');
			return false;
		}
		
		$query = 'INSERT INTO '.$db->getPrefix().'modules_menu'
			.' (`moduleid`, `menuid`) VALUES'
			.' ('.$moduleid.',0);';

			
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

?>

