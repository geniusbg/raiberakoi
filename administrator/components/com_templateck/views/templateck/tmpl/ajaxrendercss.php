<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
$cssstyles = new CssStyles();
//$menustyles = new MenuStyles();

//var_dump($fields);
$id = JRequest::getVar('objid');
$class = JRequest::getVar('objclass');
$fields = JRequest::getVar('fields');
$fields = json_decode($fields); //test
$action = JRequest::getVar('action');
$direction = 'ltr';
$styles = $cssstyles->create($fields, $id, $action, $direction, $class);
//var_dump($styles);
if ($action == 'preview') {
    echo '<style>'.$styles.'</style>';
} else {
    return $styles;
}


?>