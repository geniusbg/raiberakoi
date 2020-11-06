<?php
/**
 * @version     $Id$ 1.0.0 0
 * @package     aiMootoolsControl
 * @copyright   Copyright (C)2011 Alex Dobrin. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

if (version_compare(JVERSION, '1.6.0', 'ge')) {
	jimport('joomla.form.formfield');
	JFormHelper::loadFieldClass('spacer');
	
	class JFormFieldAiDonate extends JFormFieldSpacer {
	
		protected $type = 'aiDonate';
	
		protected function getInput() {
			return '<div style="margin-left:auto; margin-right:auto; width:120px; height:90px;"><iframe frameborder="0" src="http://www.algisinfo.com/donate/" style="width:120px; height:90px; border:0px solid #FFFFFF;"><a href="http://www.algisinfo.com/donate/" target="_blank">You can help us</a></iframe></div>';
		}
	
	}
} else {
	class JElementAiDonate extends JElement {
	
		var	$_name = 'aiDonate';
	
		function fetchElement($name, $value, &$node, $control_name) {
			$htmlTag = '<div style="margin-left:auto; margin-right:auto; width:120px; height:90px;"><iframe frameborder="0" src="http://www.algisinfo.com/donate/" style="width:120px; height:90px; border:0px solid #FFFFFF;"><a href="http://www.algisinfo.com/donate/" target="_blank">You can help us</a></iframe></div>';
			return $htmlTag;
		}
	
	}
}
