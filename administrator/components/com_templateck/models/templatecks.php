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

class TemplatecksModelTemplatecks extends JModel {

    /**
     * Templates data array
     *
     * @var array
     */
    var $_data;

    /**
     * Retrieves the templates data
     * @return array Array of objects containing the data from the database
     */
    function getTemplates() {

        // Lets load the data if it doesn't already exist
        if (empty($this->_data)) {

            // constructs the query
            $query = ' SELECT * '
                    . ' FROM #__templateck';

            // retrieves the data
            $this->_data = $this->_getList($query);
        }

        return $this->_data;
    }

}
