<?php

/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.template-creator.com
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access to this file
defined('_JEXEC') or die();

class TemplatecksControllerMobile extends TemplatecksController {

    /**
     * constructor (registers additional tasks to methods)
     * @return void
     */
    function __construct() {
        parent::__construct();
		JRequest::setVar('hidemainmenu', 1);
        // Register Extra tasks
        $this->registerTask('add', 'edit');
        $this->registerTask('apply', 'save');
        // $this->registerTask('unpublish', 'publish');
    }

    /**
     * display the edit form
     * @return void
     */
    function edit() {
        JRequest::setVar('view', 'mobile');
        JRequest::setVar('layout', 'default');
        JRequest::setVar('hidemainmenu', 1);
        parent::display();
    }

    /**
     * save a record (and redirect to main page)
     * @return void
     */
    function save() {
        $model = $this->getModel('mobile');
        $task = $this->getTask();

        if ($model->store()) {
            $msg = JText::_('CK_TEMPLATE_SAVED');
            $type = 'message';
        } else {
            $msg = JText::_('CK_TEMPLATE_SAVE_ERROR');
            $type = 'error';
        }

        // Check the table in so it can be edited.... we are done with it anyway
        if ($task == 'save') {
            $link = 'index.php?option=com_templateck';
        } else {
            $link = 'index.php?option=com_templateck&controller=mobile&task=edit&templateid=' . $model->getTemplateId();
        }
        $this->setRedirect($link, $msg, $type);
    }

    /**
     * remove record(s)
     * @return void
     */
    // function remove() {
        // $model = $this->getModel('Templateck');
        // if (!$model->delete()) {
            // $msg = JText::_('CK_TEMPLATE_DELETE_ERROR');
            // $type = 'error';
        // } else {
            // $msg = JText::_('CK_TEMPLATE_DELETED');
            // $type = 'message';
        // }

        // $this->setRedirect('index.php?option=com_Templateck', $msg, $type);
    // }

    /**
     * cancel editing a record
     * @return void
     */
    function cancel() {
        $msg = JText::_('CK_OPERATION_CANCEL');
        $this->setRedirect('index.php?option=com_templateck', $msg);
    }

    /**
     * copy an existing template
     * @return void
     */
    function copy() {

        $model = $this->getModel('templateck');
        if (!$model->copy()) {
            $msg = JText::_('CK_TEMPLATE_COPY_ERROR');
            $type = 'error';
        } else {
            $msg = JText::_('CK_TEMPLATE_COPIED');
            $type = 'message';
        }

        $this->setRedirect('index.php?option=com_templateck', $msg, $type);
    }

    /**
     * display input form to select a file
     * @return void
     */
    function installGabarit() {

        JRequest::setVar('view', 'templateck');
        JRequest::setVar('layout', 'install');

        parent::display();
    }

    /**
     * display input form to select a file
     * @return void
     */
    function exportGabarit() {

        JRequest::setVar('view', 'templateck');
        JRequest::setVar('layout', 'export');

        parent::display();
    }

    /**
     * import a theme from a zip file
     * @return void
     */
    function importtck() {

        $model = $this->getModel('templateck');
        if (!$model->installGabarit()) {
            $msg = JText::_('CK_INSTALL_GABARIT_ERROR');
            $link = 'index.php?option=com_templateck&view=templateck&layout=install';
            $type = 'error';
        } else {
            $msg = JText::_('CK_GABARIT_INSTALLED');
            $link = 'index.php?option=com_templateck&view=templatecks';
            $type = 'message';
        }

        $this->setRedirect($link, $msg, $type);
    }

    /**
     * Update the session timer
     * @return void
     */
    function updatesession() {
        $session = &JSession::getInstance('none', array());
    }

}

?>
