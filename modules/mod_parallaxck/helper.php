<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.ck-web-creation-alsace.com
 * http://www.joomlack.fr
 * Module Parallaxck for Joomla! 1.6
 * @license		GNU/GPL
 * @ version : 1.0
**/


// no direct access
defined('_JEXEC') or die('Restricted access');

class modParallaxckHelper {
	static function GenParallax(&$params){
		// inclut mootools si nécessaire
		JHTML::_("behavior.framework");
		jimport( 'joomla.application.module.helper' );
		
		// ajoute les documents externes
		$document = JFactory::getDocument();
		$document->addScript( 'modules/mod_parallaxck/assets/mod_parallaxck.js' );

		//crée les éléments
		$items = array();	
		$j = 0;		
		$functionsToLoad = array();
		for ($i=1 ; $i<6 ; $i++)
		{
                        $items[$i] = new stdClass();
			// récupère les paramètres
			$items[$i]->hasimage = $params->get('image'.$i);
			$items[$i]->automove = $params->get('image'.$i.'automove');
			$items[$i]->speed = $params->get('image'.$i.'speed');
			$items[$i]->mousespeed = $params->get('image'.$i.'mousespeed');
			$items[$i]->direction = $params->get('image'.$i.'direction');
			$items[$i]->offsetx = $params->get('image'.$i.'offsetx');
			
			
			// définit l'image de background
			if ((isset($items[$i]->hasimage)) && ($items[$i]->hasimage != "-1") && ($items[$i]->hasimage != "")) {
				$items[$i]->image = JURI::base().'modules/mod_parallaxck/images/'.$params->get('image'.$i);
			}
			
			// définit l'effet à appliquer si besoin
			if ($params->get('image'.$i.'use') == 1) {
			
				if ($items[$i]->automove == 1) {			
					modParallaxckHelper::genFxAutoscroll($i, $items[$i]->speed, $items[$i]->direction, $params);
				} else {
					modParallaxckHelper::genFxMousescroll($i, $items[$i]->mousespeed, $items[$i]->direction, $items[$i]->offsetx, $params);
					array_push($functionsToLoad,$i);
				}
			}
		} 
		
		// lance les fontions javascript pour les effets à la souris
		modParallaxckHelper::genMousescrollFunctions($functionsToLoad, $params);
		
		return $items;
	}
	
	static function genFxAutoscroll($i, $speed, $direction, &$params){

		$js = "window.addEvent('domready',function() {

			var duration = ".$speed.";
			var count = 0;
			var length = 2000;
			var direction = ".$direction.";

			//moo 1.11
			/*var fx = new Fx.Style($('parallaxCK".$i."') ,'background-position', {
			duration: duration,
			unit: 'px',
			transition: Fx.Transitions.linear
			});*/
			
			var fx = new Fx.Tween($('parallaxCK".$i."'), {
                    property:'background-position',
                    duration:duration,
					unit: 'px',
                    transition: Fx.Transitions.linear});

			//moo 1.2
			//var tweener = $('animate-area').set('tween',{ duration: duration, transition: 'linear' });

			fx.set(\"0 0\");
			var run = function() {
			count++;
			
			//moo 1.11
			fx.cancel();
			fx.start((direction*length*count)+\" 0\" ); 
			
			//moo 1.2
			//tweener.tween('background-position',length*count + 'px 0px'); 

			};
			run();
			run.periodical(duration);
	
			});";
		$document = JFactory::getDocument();
		$document->addScriptDeclaration( $js );
	}
	
	static function genFxMousescroll($i, $mousespeed, $direction, $offsetx, &$params){
	
		$js = "function chg_info_plc_parallax_CK".$i."(mouseEventArgs) { 
			/*var fx".$i." = new Fx.Style($('parallaxCK".$i."') ,'background-position', {
			duration: 0,
			unit: 'px',
			transition: Fx.Transitions.linear
			});*/
			
			var fx".$i." = new Fx.Tween($('parallaxCK".$i."'), {
                    property:'background-position',
                    duration:0,
					unit: 'px',
                    transition: Fx.Transitions.linear});


			ie?x = event.clientX / ".$mousespeed." + ".$offsetx.":x= mouseEventArgs.pageX / ".$mousespeed." + ".$offsetx."; 
			//ie?y = event.clientY + 32:y= mouseEventArgs.pageY + 32; 

 
			fx".$i.".start(\"0 0\", ".$direction."*x + \" 0\" );
			//x = x * 2;

			} ";
		$document = JFactory::getDocument();
		$document->addScriptDeclaration( $js );
	}
	
	static function genMousescrollFunctions($functionsToLoad, &$params){
		$script = "";
		foreach ($functionsToLoad as $functionToLoad) {
			$script .= "chg_info_plc_parallax_CK".$functionToLoad."(mouseEventArgs);";
		}

		$js = "document.onmousemove = charge_fonctions_parallax_CK; 
			var ie = document.all;

			function charge_fonctions_parallax_CK(mouseEventArgs) {
				".$script."
			}";
		$document = JFactory::getDocument();
		$document->addScriptDeclaration( $js );
	}
}
?>