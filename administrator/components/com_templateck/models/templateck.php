<?php

/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.template-creator.com
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class TemplatecksModelTemplateck extends JModel {

    /**
     * Template id
     *
     * @var int
     */
    var $_id;
    /**
     * Template object
     *
     * @var object
     */
    var $_data;
    /**
     * Mobile template data object
     *
     * @var object
     */
    var $_mobiledata;
    /**
     * Template names object
     *
     * @var object
     */
    var $_templates;

    /**
     * Constructor that retrieves the ID from the request
     *
     * @access	public
     * @return	void
     */
    function __construct() {
        parent::__construct();

        $array = JRequest::getVar('cid', 0, '', 'array');
        $this->setId((int) $array[0]);
    }

    /**
     * Method to set the template identifier
     *
     * @access	public
     * @param	int category identifier
     * @return	void
     */
    function setId($id) {
        // Set id and wipe data
        $this->_id = $id;
        $this->_data = null;
    }

    /**
     * Method to get the template identifier
     *
     * @access	public
     * @return	void
     */
    function getId() {
        return $this->_id;
    }

    /**
     * Method to get a template
     * @return object with data
     */
    function &getTemplate() {
        // Load the data
        if (empty($this->_data)) {
            $query = ' SELECT * FROM #__templateck' .
                    ' WHERE id = ' . $this->_id;
            $this->_db->setQuery($query);
            $this->_data = $this->_db->loadObject();
        }
        if (!$this->_data) {
            $this->_data = new stdClass();
            $this->_data->id = 0;
            $this->_data->joomlaversion = 'j15';
            $this->_data->name = null;
            $this->_data->ordering = null;
            $this->_data->published = 1;
            $this->_data->creationDate = null;
            $this->_data->author = null;
            $this->_data->authorEmail = null;
            $this->_data->authorUrl = null;
            $this->_data->copyright = null;
            $this->_data->license = null;
            $this->_data->version = null;
            $this->_data->description = null;
            $this->_data->htmlcode = '<div id="body" class="body"><div class="controlCss isControl" id="bodycss">BODY CSS</div><div id="wrapper" class="wrapper"><div class="controlCss isControl" id="wrappercss">WRAPPER CSS</div><div class="clr"></div></div></div>';
            $this->_data->theme = null;
            $this->_data->cssparams = null;
        }
        return $this->_data;
    }

    /**
     * Method to get a template mobiledata
     * @return object with data
     */
    function &getMobiledata() {
        // Load the data
        if (empty($this->_mobiledata)) {
            $query = ' SELECT * FROM #__templateck_mobile' .
                    ' WHERE templateid = ' . $this->_id;
            $this->_db->setQuery($query);
            $this->_mobiledata = $this->_db->loadObject();
        }
        if (!$this->_mobiledata) {
            $this->_mobiledata = new stdClass();
            $this->_mobiledata->id = 0;
            $this->_mobiledata->resolution1 = null;
            $this->_mobiledata->resolution2 = null;
            $this->_mobiledata->resolution3 = null;
            $this->_mobiledata->resolution4 = null;
            $this->_mobiledata->templateid = $this->_id;
        }
        return $this->_mobiledata;
    }

    /**
     * Method to store a record
     *
     * @access	public
     * @return	boolean	True on success
     */
    function store() {

        $row = $this->getTable();
        $data = JRequest::get('post');

        // needed for html encoding in table
        $data['htmlcode'] = JRequest::getVar('htmlcode', '', 'post', 'string', JREQUEST_ALLOWRAW);
        $data['name'] = str_replace(" ", "_", $data['name']);

        // Bind the form fields to the table
        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // Make sure the record is valid
        if (!$row->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // Store the table to the database
        if (!$row->store()) {
            $this->setError($row->getErrorMsg());
            return false;
        }

        $this->setId($row->id);

        return true;
    }

    /**
     * Method to store a record
     *
     * @access	public
     * @return	boolean	True on success
     */
    function copy() {

        $row = & $this->getTable();
        $data = & $this->getTemplate();
        $data->id = 0;
        $data->name .= '(copy)';

        // Bind the form fields to the table
        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // Make sure the record is valid
        if (!$row->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // Store the table to the database
        if (!$row->store()) {
            $this->setError($row->getErrorMsg());
            return false;
        }

        $this->setId($row->id);

        return true;
    }

    /**
     * Method to delete record(s)
     *
     * @access	public
     * @return	boolean	True on success
     */
    function delete() {
        $cids = JRequest::getVar('cid', array(0), 'post', 'array');

        $row = & $this->getTable();

        if (count($cids)) {
            foreach ($cids as $cid) {
                if (!$row->delete($cid)) {
                    $this->setError($row->getErrorMsg());
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Method to install a gabarit
     *
     * @access	public
     * @return	true on success
     */
    function installGabarit() {
        if (!is_array(JRequest::getVar('file', '', 'files', 'array')))
            return false;

        // include file and zip archive libraries
        jimport('joomla.filesystem.file');

        // declare some variables
        $app = &JFactory::getApplication();
        $file = JRequest::getVar('file', '', 'files', 'array');

        //Clean up filename to get rid of strange characters like spaces etc
        $filename = JFile::makeSafe($file['name']);

        //Set up the source and destination of the file
        $src = $file['tmp_name'];

        // check if the file exists
        if (!$src || !JFile::exists($src)) {
            $msg = JText::_('CK_FILE_NOT_EXISTS');
            $app->redirect("index.php?option=com_templateck&view=templateck&layout=install", $msg, 'error');
            return false;
        }


        // read the file
        if (!$filecontent = JFile::read($src)) {
            $msg = JText::_('CK_UNABLE_READ_FILE');
            $app->redirect("index.php?option=com_templateck&view=templateck&layout=install", $msg, 'error');
            return false;
        }

        // get the two parts, template and mobile data
        $gabarittmp = explode("||TCK||", $filecontent);
        $gabarit = isset($gabarittmp[0]) ? json_decode($gabarittmp[0]) : json_decode($filecontent);
        $gabaritmobile = isset($gabarittmp[1]) ? json_decode($gabarittmp[1]) : json_decode('{}');
        $gabarit->id = '0'; // set id to 0 to automatically increment value in database


        $row = $this->getTable();
        // Bind the form fields to the table
        if (!$row->bind($gabarit)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // Make sure the record is valid
        if (!$row->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // Store the table to the database
        if (!$row->store()) {
            $this->setError($row->getErrorMsg());
            return false;
        }

        // store the mobile data
        if (isset($gabaritmobile->id)) {
            // set id to 0 to automatically increment value in database
            $gabaritmobile->id = '0';
            // set the correct templateid
            $gabaritmobile->templateid = $row->id;
            if (!$this->save_item($gabaritmobile, 'mobile'))
                return false;
        }

        return true;
    }

    /**
     * Method to save data in the database
     *
     * @param	array		The data.
     * @param	string		The table name.
     * @return	mixed		The item ID, False on failure.
     */
    function save_item($data, $table='invoice') {

        // load the table
        JTable::addIncludePath(JPATH_ROOT . '/administrator/components/com_templateck/tables');
        $row = JTable::getInstance($table, 'Table');

        // bind data
        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // check data
        if (!$row->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // save data
        if (!$row->store()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        return $row->id;
    }

}

?>
