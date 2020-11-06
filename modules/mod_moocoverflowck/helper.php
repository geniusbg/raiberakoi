<?php

/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.ck-web-creation-alsace.com
 * http://www.joomlack.fr
 * Module moocoverflowck pour Joomla! 1.6
 * @license		GNU/GPL
 * */
// no direct access
defined('_JEXEC') or die('Restricted access');

class modMoocoverflowckHelper {

    function getMenu(&$params, $module) {
        jimport('joomla.application.module.helper');
        JHTML::_("behavior.framework", true);

        // retrieve parameters from the module
        $reflection = $params->get('reflection', '0.4');
        $heightratio = $params->get('heightratio', '0.6');
        $offsety = $params->get('offsety', '0');
        $startindex = $params->get('startindex', '0');
        $interval = $params->get('interval', '3000');
        $factor = $params->get('factor', '115');
        $bgcolor = $params->get('bgcolor', '#000');
        $usecaption = $params->get('usecaption', false);
        $useresize = $params->get('useresize', false);
        $useslider = $params->get('useslider', false);
        $usewindowresize = $params->get('usewindowresize', false);
        $usemousewheel = $params->get('usemousewheel', false);
        $usekeyinput = $params->get('usekeyinput', false);
        $useautoplay = $params->get('useautoplay', false);
        $useviewer = $params->get('useviewer', false);
        $usemediabox = $params->get('usemediabox', 0);



        // add external stylesheets
        $document = &JFactory::getDocument();
        $document->addStyleSheet(JURI::base() . 'modules/mod_moocoverflowck/assets/MooFlow.css');
        $document->addScript(JURI::base() . 'modules/mod_moocoverflowck/assets/MooFlow.js');


        if ($usemediabox) {
            $clickfunction = 'function(obj){
				Mediabox.open(obj.href, obj.title+"::"+obj.alt, \'600 400\');
			}';
        } else {
            $clickfunction = 'function(obj){
				document.location.href=obj.href;
			}';
        }

        $script = "<!--
                    window.addEvent('domready', function() {"
                . "var mf = new MooFlow($(\"MooFlow" . $module->id . "\"),{"
                . "onStart: '',"
                . "onClickView: $clickfunction,"
                . "onAutoPlay: '',"
                . "onAutoStop: '',"
                . "onRequest: '',"
                . "onResized: '',"
                . "onEmptyinit: '',"
                . "reflection: " . $reflection . ","
                . "heightRatio: " . $heightratio . ","
                . "offsetY: " . $offsety . ","
                . "startIndex: " . $startindex . ","
                . "interval: " . $interval . ","
                . "factor: " . $factor . ","
                . "bgColor: '" . $bgcolor . "',"
                . "useCaption: " . $usecaption . ","
                . "useResize: " . $useresize . ","
                . "useSlider: " . $useslider . ","
                . "useWindowResize: " . $usewindowresize . ","
                . "useMouseWheel: " . $usemousewheel . ","
                . "useKeyInput: " . $usekeyinput . ","
                . "useAutoPlay: " . $useautoplay . " });"
                . " }); //-->";
        $document->addScriptDeclaration($script);


        //get the menu items
        $app = JFactory::getApplication();
        $menu = $app->getMenu();
        $items = $menu->getItems('menutype', $params->get('menutype'));



        foreach ($items as $i => &$item) {

            switch ($item->type) {
                case 'separator':
                    // No further action needed.
                    continue;

                case 'url':
                    if ((strpos($item->link, 'index.php?') === 0) && (strpos($item->link, 'Itemid=') === false)) {
                        // If this is an internal Joomla link, ensure the Itemid is set.
                        $item->link = $item->link . '&Itemid=' . $item->id;
                    }
                    break;

                case 'alias':
                    // If this is an alias use the item id stored in the parameters to make the link.
                    $item->link = 'index.php?Itemid=' . $item->params->get('aliasoptions');
                    break;

                default:
                    $router = JSite::getRouter();
                    if ($router->getMode() == JROUTER_MODE_SEF) {
                        $item->link = 'index.php?Itemid=' . $item->id;
                    } else {
                        $item->link .= '&Itemid=' . $item->id;
                    }
                    break;
            }

            if (strcasecmp(substr($item->link, 0, 4), 'http') && (strpos($item->link, 'index.php?') !== false)) {
                $item->link = JRoute::_($item->link, true, $item->params->get('secure'));
            } else {
                $item->link = JRoute::_($item->link);
            }


            // manage images
            $item->image = '';
            $menu_image = $item->params->get('menu_image', -1);
            if (($menu_image <> '-1') && $menu_image) {
                $item->image = '<img src="' . JURI::base(true) . '/' . $menu_image . '" alt="' . $item->params->get('menu-anchor_title', '') . '" title="' . $item->title . '" />';
            }
        }
        return $items;
    }

}

?>