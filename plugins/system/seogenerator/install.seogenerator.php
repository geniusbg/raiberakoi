<?php
######################################################################
# SEO-Generator    	          	                                     #
# Copyright (C) 2013 by MCTrading - All rights reserved. 	   	   	   #
# Homepage   : http://www.suchmaschinen-optimierung-seo.org  		   	 #
# Author     : MCTrading          		   	   	   	   	   	   	   	   #
# Version    : 4.6                        	   	    	   	    	   	 #
# License    : GNU/GPL                                               #
# Line 18 to 267 are partially under the following copyright:        #
# 	@author Ryan McLaughlin - Copyright (C) 2008-2009 Dao By Design  #
# 	(www.daobydesign.com)- GNU/GPL                                   #
# 	see details in code                                              #
######################################################################




// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
//the name of the class must be the name of your component + InstallerScript
//for example: com_contentInstallerScript for com_content.
class plgSystemSEOGeneratorInstallerScript
{
	/*
	 * $parent is the class calling this method.
	 * $type is the type of change (install, update or discover_install, not uninstall).
	 * preflight runs before anything else and while the extracted files are in the uploaded temp folder.
	 * If preflight returns false, Joomla will abort the update and undo everything already done.
	 */
	function preflight( $type, $parent ) {
		$jversion = new JVersion();

			// this component does not work with Joomla releases as of version 3.0, The possible operators are: <, lt, <=, le, >, gt, >=, ge, ==, =, eq, !=, <>, ne
			if( version_compare( $jversion->getShortVersion(), '3.0', 'ge' ) ) {
 			Jerror::raiseWarning(null, 'Cannot install this version of SEOGenerator in a Joomla release as of version 3.0. You can find an new Version on the <a href="http://www.suchmaschinen-optimierung-seo.org/index.php/SEO-Nachrichten/seo-generator.html" target="blank">official SEO-Generator website</a>');
 			
 			return false;
 			
 			}

		  // this component does not work with PHP releases prior to 5.0, The possible operators are: <, lt, <=, le, >, gt, >=, ge, ==, =, eq, !=, <>, ne
			if (version_compare(PHP_VERSION, '5', 'lt' )) {
 			Jerror::raiseWarning(null, 'Cannot install this version of SEOGenerator in a PHP release prior to 5.0. Your server currently uses ' . PHP_VERSION . '. Please update PHP on your server or contact the developer of SEOGenerator with the <a href="http://www.suchmaschinen-optimierung-seo.org/index.php/component/option,com_dfcontact/Itemid,2/" target="blank">official SEO-Generator contact form</a>');
 			
 			return false;
 			
 			}
 
		
	}
}
