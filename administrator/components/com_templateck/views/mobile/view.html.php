<?php

/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.template-creator.com
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

/**
 * About View
 */
class TemplatecksViewMobile extends JView {

    /**
     * About view display method
     * @return void
     * */
    function display($tpl = null) {
        JRequest::setVar('hidemainmenu', 1);
        JToolBarHelper::title(JText::_('CK_RESPONSIVE_DESIGN').': <small>[ Edition ]</small>', 'home_templateck');
        JToolBarHelper::save();
        JToolBarHelper::apply();
        JToolBarHelper::cancel('cancel', 'Close');

		// load the css
		 JHTML::_('stylesheet', 'templateck_mobile.css', 'administrator/components/com_templateck/assets/');
		 
		// load the template HTML
		$template = $this->get('Template');
		$mobilecode = $this->get('Mobilecode');
                $code = Json_decode($template->htmlcode_responsive);

		// assign the variables
		$this->assignRef('code',$code);
		$this->assignRef('mobilecode',$mobilecode);
		$this->assignRef('template', $template);

        parent::display($tpl);
    }

}
