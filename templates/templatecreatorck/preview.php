<?php

/**
 * @name		Template Creator CK 3
 * @package		com_templateck
 * @copyright	Copyright (C) 2013. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */
defined('_JEXEC') or die;

$indexphpsrc = JPATH_ROOT . '/components/com_templateck/projects/' . JFactory::getApplication()->input->get('templatename') . '/' . 'index.php';

include $indexphpsrc;
