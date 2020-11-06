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
 * Templatecks View
 *
 */
class TemplatecksViewTemplatecks extends JView {

    /**
     * Templatcks view display method
     * @return void
     * */
    function display($tpl = null) {
        JToolBarHelper::title(JText::_('CK_TEMPLATES_MANAGER'), 'home_templateck');
        JToolBarHelper::addNewX();
        JToolBarHelper::customX('copy', 'copy', 'copy', JText::_('CK_COPY_GABARIT'), true);
        JToolBarHelper::editListX();
        JToolBarHelper::deleteList();
        JToolBarHelper::customX('installGabarit', 'installGabarit', 'installGabarit', JText::_('CK_INSTALL_GABARIT'), false);
        JToolBarHelper::custom('exportGabarit', 'exportGabarit', 'exportGabarit', JText::_('CK_EXPORT_GABARIT'), true);

        // Get categories from the model
        $templates = $this->get('templates');
        $this->assignRef('templates', $templates);

        parent::display($tpl);
    }

    /**
     * private function to check if the template templatecreatorck is installed
     */
    function _checkIfTemplateInstalled() {
        $app = JFactory::getApplication();
        if (JFolder::exists(JPATH_ROOT . DS . 'templates' . DS . 'templatecreatorck')) {
            return;
        } else {
            $app->enqueueMessage(JText::_('TEMPLATE_TEMPLATECREATORCK_NOT_INSTALLED'), 'error');
        }

        return;
    }

}
