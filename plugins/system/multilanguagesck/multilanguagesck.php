<?php
/**
 * @copyright	Copyright (C) 2012 Cédric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * @license		GNU/GPL
 * Version 1.0
 * */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class plgSystemMultilanguagesck extends JPlugin
{

	function plgSystemMultilanguagesck(&$subject, $config) {
        parent :: __construct($subject, $config);
    }

	public function onAfterRender()
	{
		$app = JFactory::getApplication();
        $document = JFactory::getDocument();
        $doctype = $document->getType();

        // si pas en frontend, on sort
        if ($app->isAdmin()) {
            return false;
        }

        // si pas HTML, on sort
        if ($doctype !== 'html') {
            return;
        }

        // renvoie les données dans la page
        $body = JResponse::getBody();
		
		// debug mode
		// get attribute from system plugin params
		$plugin = JPluginHelper::getPlugin('system', 'multilanguagesck');
		$pluginParams = new JRegistry($plugin->params);
		if ($pluginParams->get('debugmode') == '1') {
			// get the language
			$lang = JFactory::getLanguage();
			$langtag = $lang->getTag(); // returns fr-FR or en-GB
			$debugmessage = '<p style="font-size:14px;color:red;">The actual language tag is : '.$langtag.'</p>';
			$body = str_replace("<body",$debugmessage."<body", $body);
		}
					
		$regex = "#{langck(.*?){/langck}#s"; // masque de recherche
		$body = preg_replace_callback($regex, 'self::checklanguageck', $body);
        
        JResponse::setBody($body);
    }
	
	
	function checklanguageck(&$matches) {

		// découpe l'expression pour récupérer les textes
		$patterns = "#{langck(.*)}(.*){/langck}#Uis";
		$result = preg_match($patterns, $matches[0], $results);

		// vérifie si des paramètres personnalisés existent
		$params = explode('=', $results[1]);

		// si pas de langue définie on sort
		if (!isset($params[1])) return $matches[0];
		
		$lang = JFactory::getLanguage();
		$langtag = $lang->getTag(); // returns fr-FR or en-GB
			
		// vérifie si ça colle avec la langue active
		if (($params[1] == $langtag) AND isset($results[2])) {
			$return = $results[2];
		} else {
			$return = '';
		}
			
		return $return;
	}
		
}