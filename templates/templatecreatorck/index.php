<?php
/**
 * @version		$Id: index.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$indexphpsrc = JPATH_ROOT . DS . 'components' . DS . 'com_templateck' . DS . 'projects' . DS . JRequest::getVar('templatename') . DS . 'index.php';

include $indexphpsrc;
?>
