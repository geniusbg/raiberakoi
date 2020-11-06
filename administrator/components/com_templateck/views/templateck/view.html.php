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
jimport('joomla.filesystem.file');

class TemplatecksViewTemplateck extends JView {

    /**
     * display method of template view
     * @return void
     * */
    function display($tpl = null) {

        // call js and css file
        JHTML::_('stylesheet', 'templateck_template.css', 'administrator/components/com_templateck/assets/');
        //JHTML::_('script', 'jscolor.js', 'administrator/components/com_templateck/assets/jscolor/');

        include_once JPATH_COMPONENT . DS . 'classes' . DS . 'menustyles.php';
        include_once JPATH_COMPONENT . DS . 'classes' . DS . 'stylescss.php';

        JHtml::_('behavior.formvalidation');
        JHtml::_('behavior.framework', true);
        JHtml::_('behavior.modal');

        JText::script('TEMPLATE_MUST_HAVE_NAME');
        JText::script('TEMPLATE_MUST_HAVE_WIDTH');
        JText::script('CK_LOADING');
        JText::script('CK_LOAD_SUCCESS_STEP1');
        JText::script('CK_LOAD_FAILURE_STEP1');
        JText::script('CK_LOAD_SUCCESS_STEP_ARCHIVE');
        JText::script('CK_LOAD_FAILURE_STEP_ARCHIVE');
        JText::script('CK_LOAD_SUCCESS_STEP_XML');
        JText::script('CK_LOAD_FAILURE_STEP_XML');
        JText::script('CK_LOAD_SUCCESS_STEP_CSS');
        JText::script('CK_LOAD_FAILURE_STEP_CSS');
        JText::script('CK_PREVIEW_TEMPLATE');
        JText::script('CK_ONLY_ONE_COMPONENT');
        JText::script('CK_COPYTOCLIPBOARD');
        JText::script('CK_COPYFROMCLIPBOARD');
        JText::script('CK_CLIPBOARDEMPTY');
        JText::script('TEMPLATE_MUST_HAVE_CONTENT');

        $template = $this->get('Template');
        $fontfamilies = $this->get('Fontfamilies');

        $isNew = ($template->id < 1);
        $layout = JRequest::getVar('layout');

        $text = $isNew ? JText::_('New') : JText::_('CK_EDIT');
        JToolBarHelper::title(JText::_('CK_TEMPLATES_MANAGER') . ': <small>[ ' . $text . ' ]</small>', 'home_templateck');
        if ($layout != 'export' && $layout != 'install') {
            JToolBarHelper::save();
            JToolBarHelper::apply();
        }

        if ($isNew) {
            JToolBarHelper::cancel();
        } else {
            // for existing items the button is renamed `close`
            JToolBarHelper::cancel('cancel', 'Close');
        }

        $mobiledata = $this->get('Mobiledata');
        $this->assignRef('mobiledata', $mobiledata);
        $this->assignRef('template', $template);
        $this->assignRef('cssparams', $cssparams);
        $this->assignRef('fontfamilies', $fontfamilies);

        parent::display($tpl);
    }

    /**
     * private function to load the fonts in the page
     */
    function _callfontsSquirrel() {
        $fontstyles = '';
        $db = JFactory::getDBO();
        $query = "SELECT *
		FROM " . $db->nameQuote('#__templateck_fonts') . ";
		  ";
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        if (!$rows) return false;
        foreach ($rows as $row) {
            $fontstyles .= str_replace("url('", "url('".JURI::root()."components/com_templateck/fonts/" . $row->name . "/", $row->styles);
        }
        echo "<style type=\"text/css\">" . $fontstyles . "</style>";
    }


    /**
     * private function to check if the template templatecreatorck is installed
     */
    function _checkIfTemplateInstalled() {
	$app = JFactory::getApplication();
        if (JFolder::exists(JPATH_ROOT.DS.'templates'.DS.'templatecreatorck')) {
            return;
        } else {
            $app->enqueueMessage( JText::_('TEMPLATE_TEMPLATECREATORCK_NOT_INSTALLED'), 'error' );
        }

		return;
    }

}