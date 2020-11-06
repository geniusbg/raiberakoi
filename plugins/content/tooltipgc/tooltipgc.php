<?php

/**
 * @copyright	Copyright (C) 2010 Cédric KEIFLIN alias ced1870 & Ghazal
 * http://www.joomlack.fr
 * @license		GNU/GPL
 * */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.event.plugin');
jimport('joomla.html.parameter');
jimport('joomla.html.html');
jimport( 'joomla.html.html.behavior' );

// exemple de syntaxe :{tooltip}Déclencheur{end-texte}un petit garçon bien sympathique{end-tooltip}

class plgContentTooltipgc extends JPlugin {

    function plgContentTooltipgc(&$subject, $params) {
        parent::__construct($subject, $params);
    }

    public function onContentPrepare($context, &$article, &$params, $limitstart) {
        // si aucun tooltip on sort
        if (strpos($article->text, '{tooltip}') == false)
            return;

        JHTML::_('behavior.framework'); 
		
        // charge les paramètres par défaut
        $plugin = JPluginHelper::getPlugin('content', 'tooltipgc');
        $pluginParams = new JRegistry($plugin->params);
        $largeur = $pluginParams->get('stylewidth', '150');
        $activationjs = $pluginParams->get('activationjs', '1');
        $dureemootools = $pluginParams->get('dureemootools', '300');
        $dureebulle = $pluginParams->get('dureebulle', '500');
        $opacity = $pluginParams->get('opacity', '80')/100;
        $mootransition = $pluginParams->get('mootransition', 'linear');

  
        // inclut les fichiers nécessaires
        $doc = JFactory::getDocument();
        $doc->addScript("plugins/content/tooltipgc/assets/tooltipgc.js");
        $doc->addStyleSheet(JURI::root() . "plugins/content/tooltipgc/assets/tooltipgc.css");
		
        // inclut les styles des bulles à partir des paramètres
        $doc->addStyleDeclaration($this->createTooltipCss());

        // lance le script
        if ($activationjs && !stristr($doc->_script['text/javascript'],"tooltipClass")) {
                $js = 'window.addEvent(\'domready\', function() {new tooltipClass($$(\'.infotip\'),{' .
                                'largeur : \'' . $largeur . '\',' .
                                'opacite : \'' . $opacity . '\',' .
                                'dureemootools : ' . $dureemootools . ',' .
                                'mootransition : \'' . $mootransition . '\',' .
                                'dureebulle : ' . $dureebulle . '})});';
                $doc->addScriptDeclaration($js);
        }
//var_dump($doc->_script);die();
        $regex = "#{tooltip}(.*?){end-tooltip}#s"; // masque de recherche
        // $article->text = preg_replace_callback($regex, 'createTooltipgc', $article->text); // on cherche l'inclusion et on appelle la fonction

		preg_match_all($regex, $article->text, $tooltips);
		
		// test for results
		if (!$tooltips[0]) 
			return;
		
		foreach ($tooltips[0] as $tooltip) {
			$tooltipreplacement = createTooltipgc($tooltip, $params);
			$article->text = str_replace($tooltip, $tooltipreplacement, $article->text);
		}

        return;
    }
	
	function createTooltipCss() {
		$plugin = JPluginHelper::getPlugin('content', 'tooltipgc');
		$pluginParams = new JRegistry($plugin->params);
		$padding = $pluginParams->get('padding', '5').'px';
		$tipoffsetx = $pluginParams->get('tipoffsetx', '0').'px';
		$tipoffsety = $pluginParams->get('tipoffsety', '0').'px';
		$bgcolor1 = $pluginParams->get('bgcolor1', '#f0f0f0');
		$bgcolor2 = $pluginParams->get('bgcolor2', '#e3e3e3');
		$roundedcornerstl = $pluginParams->get('roundedcornerstl', '').'px';
		$roundedcornerstr = $pluginParams->get('roundedcornerstr', '').'px';
		$roundedcornersbr = $pluginParams->get('roundedcornersbr', '').'px';
		$roundedcornersbl = $pluginParams->get('roundedcornersbl', '').'px';
		$shadowcolor = $pluginParams->get('shadowcolor', '#444444');
		$shadowblur = $pluginParams->get('shadowblur', '3').'px';
		$shadowspread = $pluginParams->get('shadowspread', '0').'px';
		$shadowoffsetx = $pluginParams->get('shadowoffsetx', '0').'px';
		$shadowoffsety = $pluginParams->get('shadowoffsety', '0').'px';
		$bordercolor = $pluginParams->get('bordercolor', '#efefef');
		$borderwidth = $pluginParams->get('borderwidth', '1').'px';
		$shadowinset = $pluginParams->get('shadowinset', 0);
		
		$shadowinset = $shadowinset ? 'inset ' : '';
		
		$css = '.tooltipgc_tooltip {'
			.'padding: '.$padding.';'
			.'border: '.$bordercolor.' '.$borderwidth.' solid;'
			.'-moz-border-radius: '.$roundedcornerstl.' '.$roundedcornerstr.' '.$roundedcornersbr.' '.$roundedcornersbl.';'
			.'-webkit-border-radius: '.$roundedcornerstl.' '.$roundedcornerstr.' '.$roundedcornersbr.' '.$roundedcornersbl.';'
			.'border-radius: '.$roundedcornerstl.' '.$roundedcornerstr.' '.$roundedcornersbr.' '.$roundedcornersbl.';'
			.'background: '.$bgcolor1.';'
			.'background: -moz-linear-gradient(top, '.$bgcolor1.', '.$bgcolor2.');'
			.'background: -webkit-gradient(linear, 0% 0%, 0% 100%, from('.$bgcolor1.'), to('.$bgcolor2.'));'
			.'margin: '.$tipoffsety.' 0 0 '.$tipoffsetx.';'
			.'-moz-box-shadow: '.$shadowinset.$shadowoffsetx.' '.$shadowoffsety.' '.$shadowblur.' '.$shadowspread.' '.$shadowcolor.';'
			.'-webkit-box-shadow: '.$shadowinset.$shadowoffsetx.' '.$shadowoffsety.' '.$shadowblur.' '.$shadowspread.' '.$shadowcolor.';'
			.'box-shadow: '.$shadowinset.$shadowoffsetx.' '.$shadowoffsety.' '.$shadowblur.' '.$shadowspread.' '.$shadowcolor.';'
			// .'opacity: '.$opacity.';'
			.'}';
			
		return $css;
	}

    // fin de la classe JPlugin::plgContentTooltipgc
}

function createTooltipgc(&$tooltip, $params) {

	$ID = (int) (microtime() * 100000); // pour ID
	// charge les paramètres par défaut
    $plugin = JPluginHelper::getPlugin('content', 'tooltipgc');
    $pluginParams = new JRegistry($plugin->params);
    $largeur = $pluginParams->def('stylewidth', '150');
    $activationjs = $pluginParams->def('activationjs', '1');
    $dureemootools = $pluginParams->def('dureemootools', '300');
    $dureebulle = $pluginParams->def('dureebulle', '500');
	$tipoffsetx = $pluginParams->get('tipoffsetx', '0');
	$tipoffsety = $pluginParams->get('tipoffsety', '0');
		
		
	// découpe l'expression pour récupérer les textes
    $patterns = "#{tooltip}(.*){(.*)}(.*){end-tooltip}#Uis";
    $result = preg_match($patterns, $tooltip, $results);
	
    // vérifie si des paramètres personnalisés existent
	$relparams = Array();
    $params = explode('|', $results[2]);
    $parmsnumb = count($params);
    for ($i = 1; $i < $parmsnumb; $i++) {
        $dureemootools = stristr($params[$i], "mood=") ? str_replace('mood=', '', $params[$i]) : $dureemootools;
        $dureebulle = stristr($params[$i], "tipd=") ? str_replace('tipd=', '', $params[$i]) : $dureebulle;
		$tipoffsetx = stristr($params[$i], "offsetx=") ? str_replace('offsetx=', '', $params[$i]) : $tipoffsetx;
		$tipoffsety = stristr($params[$i], "offsety=") ? str_replace('offsety=', '', $params[$i]) : $tipoffsety;
		$largeur = stristr($params[$i], "w=") ? str_replace('px', '',str_replace('w=', '', $params[$i])) : $largeur;
    }

	// compile the rel attribute to inject the specific params
	$relparams['mood'] = 'mood='.$dureemootools;
	$relparams['tipd'] = 'tipd='.$dureebulle ;
	$relparams['offsetx'] = 'offsetx='.$tipoffsetx ;
	$relparams['offsety'] = 'offsety='.$tipoffsety ;
	
	$tooltiprel = '';
	if (count($relparams)) {
		$tooltiprel = ' rel="'.implode("|",$relparams).'"';
	}
	
	// compile le code HTML de sortie
    $result = '<cite class="infotip" id="tooltipgc' . $ID . '"' . $tooltiprel . '>'
            . $results[1]
            . '<span class="tooltipgc_tooltip" style="width:' . $largeur . 'px;"><span class="tooltipgc_inner">'
            . $results[3]
            . '</span></span></cite>';


    return $result;
}

?>

