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
 
jimport( 'joomla.plugin.plugin' );

class plgSystemAiMootoolsControl extends JPlugin {
	// page content
	var $htmlBody = null;
	
	function plgSystemAiMootoolsControl( &$subject, $params ) {
		parent::__construct( $subject, $params );
	}

	function onAfterRender() {

		// load the response class
		jimport( 'joomla.environment.response' );
		$response = new JResponse();
		$this->htmlBody = $response->getBody();

		// get the header information
		$doc =& JFactory::getDocument();
		$headerstuff = $doc->getHeadData();
		// determine if the plugin is executed in the front-end or back-end
		$app =& JFactory::getApplication();
		$backend = $app->getClientId();
		// check if the plugin should be executed
		$load_plugin = $this->params->get('load_plugin');

		if( ( $load_plugin == 1 && !$backend ) || ( $load_plugin == 2 && $backend ) || $load_plugin == 3 ) {
			// read the parameters
			$mootoolsids 			= explode(',',$this->params->get('mootoolsids'));
			$path_mootools_1_4		= $this->params->get('path_mootools_1_4');
			$path_mootools_1_3		= $this->params->get('path_mootools_1_3');
			$path_mootools_1_2		= $this->params->get('path_mootools_1_2');
			$path_mootools_1_12		= $this->params->get('path_mootools_1_12');
			if ( $backend ) {
				$com_mootools_1_4	= explode(',',$this->params->get('b_com_mootools_1_4'));
				$com_mootools_1_3	= explode(',',$this->params->get('b_com_mootools_1_3'));
				$com_mootools_1_2	= explode(',',$this->params->get('b_com_mootools_1_2'));
				$com_mootools_1_12	= explode(',',$this->params->get('b_com_mootools_1_12'));
				$com_no_mootools	= explode(',',$this->params->get('b_com_no_mootools'));
				$check_buffer 		= (int)$this->params->get('b_check_buffer');
				$otherwise 			= (int)$this->params->get('b_otherwise');
			} else {
				$com_mootools_1_4	= explode(',',$this->params->get('f_com_mootools_1_4'));
				$com_mootools_1_3	= explode(',',$this->params->get('f_com_mootools_1_3'));
				$com_mootools_1_2	= explode(',',$this->params->get('f_com_mootools_1_2'));
				$com_mootools_1_12	= explode(',',$this->params->get('f_com_mootools_1_12'));
				$com_no_mootools	= explode(',',$this->params->get('f_com_no_mootools'));
				$check_buffer 		= (int)$this->params->get('f_check_buffer');
				$otherwise 			= (int)$this->params->get('f_otherwise');
			}
			// initialize the variable to stop the search
			$moottols_replaced = false;
			// initialize the array to record the scripts to remove
			$mootools_scripts = array();
			// identify scripts that are loading mootools
			if(is_array($headerstuff) && array_key_exists('scripts',$headerstuff) && is_array($headerstuff['scripts'])) {
				foreach($headerstuff['scripts'] as $key=>$script) {
					foreach($mootoolsids as $mt_id) {
						if( strlen(trim($mt_id)) > 0 && strtolower(substr($key,-1*strlen(trim($mt_id)))) == strtolower(trim($mt_id)) ) {
							$mootools_scripts[$key] = $script;
						}
					}
				}
			}
			// load the buffer if it has to be checked
			if( $check_buffer ) {
				$buffer = $this->htmlBody;
			}
			// if mootools is loaded
			if( count($mootools_scripts) > 0 ) {
				// read the current component
				$option = JRequest::getCmd('option');
				// check for mootools 1.4
				if( count($com_mootools_1_4) > 0 ) {
					foreach($com_mootools_1_4 as $com) {
						if(strtolower(trim($com)) == strtolower(trim($option))) {
							$this->replaceMootools($headerstuff, $mootools_scripts, $path_mootools_1_4);
							$moottols_replaced = true;
							break;
						}
					}
				}
				// if mootools was not replaced and it is actiavted check the buffer
				if( !$moottols_replaced && $check_buffer ) {
					if( strpos($buffer,'{aimootoolscontrol_1_4}') !== false ) {
						$this->replaceMootools($headerstuff, $mootools_scripts, $path_mootools_1_4);
						$moottols_replaced = true;
					}
				}
				// check for mootools 1.3
				if( count($com_mootools_1_3) > 0 ) {
					foreach($com_mootools_1_3 as $com) {
						if(strtolower(trim($com)) == strtolower(trim($option))) {
							$this->replaceMootools($headerstuff, $mootools_scripts, $path_mootools_1_3);
							$moottols_replaced = true;
							break;
						}
					}
				}
				// if mootools was not replaced and it is actiavted check the buffer
				if( !$moottols_replaced && $check_buffer ) {
					if( strpos($buffer,'{aimootoolscontrol_1_3}') !== false ) {
						$this->replaceMootools($headerstuff, $mootools_scripts, $path_mootools_1_3);
						$moottols_replaced = true;
					}
				}

				// if mootools was not replaced check for mootools 1.2
				if( !$moottols_replaced && count($com_mootools_1_2) > 0 ) {
					foreach($com_mootools_1_2 as $com) {
						if(strtolower(trim($com)) == strtolower(trim($option))) {
							$this->replaceMootools($headerstuff, $mootools_scripts, $path_mootools_1_2);
							$moottols_replaced = true;
							break;
						}
					}
				}
				// if mootools was not replaced and it is actiavted check the buffer
				if( !$moottols_replaced && $check_buffer ) {
					if( strpos($buffer,'{aimootoolscontrol_1_2}') !== false ) {
						$this->replaceMootools($headerstuff, $mootools_scripts, $path_mootools_1_2);
						$moottols_replaced = true;
					}
				}
				// if mootools was not replaced and check for mootools 1.12
				if( !$moottols_replaced && count($com_mootools_1_12) > 0 ) {
					foreach($com_mootools_1_12 as $com) {
						if(strtolower(trim($com)) == strtolower(trim($option))) {
							$this->replaceMootools($headerstuff, $mootools_scripts, $path_mootools_1_12);
							$moottols_replaced = true;
							break;
						}
					}
				}
				// if mootools was not replaced and it is actiavted check the buffer
				if( !$moottols_replaced && $check_buffer ) {
					if( strpos($buffer,'{aimootoolscontrol_1_12}') !== false ) {
						$this->replaceMootools($headerstuff, $mootools_scripts, $path_mootools_1_12);
						$moottols_replaced = true;
					}
				}
				// if mootools was not replaced check for removing mootools
				if( !$moottols_replaced && count($com_no_mootools) > 0 ) {
					foreach($com_no_mootools as $com) {
						if(strtolower(trim($com)) == strtolower(trim($option))) {
							$this->replaceMootools($headerstuff, $mootools_scripts, '');
							$moottols_replaced = true;
							break;
						}
					}
				}
				// if mootools was not replaced and it is actiavted check the buffer
				if( !$moottols_replaced && $check_buffer ) {
					if( strpos($buffer,'{aimootoolscontrol_no_mootools}') !== false ) {
						$this->replaceMootools($headerstuff, $mootools_scripts, '');
						$moottols_replaced = true;
					}
				}
				// if no acction was taken take the default one
				if( !$moottols_replaced ) {
					switch($otherwise) {
						case 1 :
							// Don't load mootools
							$this->replaceMootools($headerstuff, $mootools_scripts, '');
							$moottols_replaced = true;
							break;
						case 2 :
							// Load mootools 1.12
							$this->replaceMootools($headerstuff, $mootools_scripts, $path_mootools_1_12);
							$moottols_replaced = true;
							break;
						case 3 :
							// Load mootools 1.2
							$this->replaceMootools($headerstuff, $mootools_scripts, $path_mootools_1_2);
							$moottols_replaced = true;
							break;
						case 4 :
							// Load mootools 1.3
							$this->replaceMootools($headerstuff, $mootools_scripts, $path_mootools_1_3);
							$moottols_replaced = true;
							break;
						case 5 :
							// Load mootools 1.4
							$this->replaceMootools($headerstuff, $mootools_scripts, $path_mootools_1_4);
							$moottols_replaced = true;
							break;
						case 0 :
						default :
							// No changes are made
					}
				}
			}
			// if the check into the buffer is activated, remove the codes triggering the plugin
			if( $check_buffer ) {
				$this->htmlBody = str_replace('{aimootoolscontrol_1_2}','',$this->htmlBody);
				$this->htmlBody = str_replace('{aimootoolscontrol_1_12}','',$this->htmlBody);
				$this->htmlBody = str_replace('{aimootoolscontrol_no_mootools}','',$this->htmlBody);
			}
			// replace the header only if mootools has to be replaced
			if( $moottols_replaced ) {
				$response->setBody($this->htmlBody);
			}
		}
	}

	function replaceMootools($headerstuff, $mootools_scripts, $mootools_path = '') {
		$replaced = false;
		// remove the old version of mootools
		foreach($mootools_scripts as $script=>$type) {
			if( !$replaced && strlen(trim($mootools_path)) > 0 ) {
				if (version_compare(JVERSION, '1.6.0', 'ge')) {
					$replace_script = '<script src="'.JURI::root(true).(substr($mootools_path,0,1) == '/'?'':'/').$mootools_path.'" type="text/javascript"></script>';
				} else {
					$replace_script = '<script type="text/javascript" src="'.JURI::root(true).(substr($mootools_path,0,1) == '/'?'':'/').$mootools_path.'"></script>';
				}
				$replaced = true;
			} else {
				$replace_script = '';
			}
			if (version_compare(JVERSION, '1.6.0', 'ge')) {
				$this->htmlBody = str_replace('<script src="'.$script.'" type="'.$type['mime'].'"></script>',$replace_script,$this->htmlBody);
			} else {
				$this->htmlBody = str_replace('<script type="'.$type.'" src="'.$script.'"></script>',$replace_script,$this->htmlBody);
			}
		}
	}
}
