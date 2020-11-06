<?php

/**
 * @name		Template Creator CK 3
 * @package		com_templateck
 * @copyright	Copyright (C) 2013. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');

/**
 * Templateck model.
 */
class TemplateckModelTemplate extends JModelForm {

	var $_item = null;

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState() {
		$app = JFactory::getApplication('com_templateck');

		// Load state from the request userState on edit or from the passed variable on default
		if (JRequest::getCmd('layout') == 'edit') {
			$id = JFactory::getApplication()->getUserState('com_templateck.edit.template.id');
		} else {
			$id = JRequest::getInt('id'); //var_dump($id);die();
			JFactory::getApplication()->setUserState('com_templateck.edit.template.id', $id);
		}
		$this->setState('template.id', $id);

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);
	}

	/**
	 * Method to get an ojbect.
	 *
	 * @param	integer	The id of the object to get.
	 *
	 * @return	mixed	Object on success, false on failure.
	 */
	public function &getData($id = null) {
		$app = JFactory::getApplication();
		if ($this->_item === null) {
			$this->_item = false;

			if (empty($id)) {
				$id = $app->input->get('id', '', 'int');
			}

			// Get a level row instance.
			$table = $this->getTable();

			// Attempt to load the row.
			if ($table->load($id)) {
				// Check published state.
				if ($published = $this->getState('filter.published')) {
					if ($table->state != $published) {
						return $this->_item;
					}
				}

				// Convert the JTable to a clean JObject.
				$properties = $table->getProperties(1);
				$this->_item = JArrayHelper::toObject($properties, 'JObject');
			} elseif ($error = $table->getError()) {
				$this->setError($error);
			}
		}

		return $this->_item;
	}

	public function getTable($type = 'Template', $prefix = 'TemplateckTable', $config = array()) {
		$this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR . '/tables');
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to check in an item.
	 *
	 * @param	integer		The id of the row to check out.
	 * @return	boolean		True on success, false on failure.
	 * @since	1.6
	 */
	public function checkin($id = null) {
		// Get the id.
		$id = (!empty($id)) ? $id : (int) $this->getState('template.id');

		if ($id) {

			// Initialise the table
			$table = $this->getTable();

			// Attempt to check the row in.
			if (method_exists($table, 'checkin')) {
				if (!$table->checkin($id)) {
					$this->setError($table->getError());
					return false;
				}
			}
		}

		return true;
	}

	/**
	 * Method to check out an item for editing.
	 *
	 * @param	integer		The id of the row to check out.
	 * @return	boolean		True on success, false on failure.
	 * @since	1.6
	 */
	public function checkout($id = null) {
		// Get the user id.
		$id = (!empty($id)) ? $id : (int) $this->getState('template.id');

		if ($id) {

			// Initialise the table
			$table = $this->getTable();

			// Get the current user object.
			$user = JFactory::getUser();

			// Attempt to check the row out.
			if (method_exists($table, 'checkout')) {
				if (!$table->checkout($user->get('id'), $id)) {
					$this->setError($table->getError());
					return false;
				}
			}
		}

		return true;
	}

	/**
	 * Method to get the profile form.
	 *
	 * The base form is loaded from XML
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true) {
		// Get the form.
		$form = $this->loadForm('com_templateck.template', 'template', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData() {
		$data = $this->getData();

		return $data;
	}

	/**
	 * Method to save the form data.
	 *
	 * @param	array		The form data.
	 * @return	mixed		The user id on success, false on failure.
	 * @since	1.6
	 */
	public function save($data) {
		$id = (!empty($data['id'])) ? $data['id'] : (int) $this->getState('template.id');
		$user = JFactory::getUser();
		$data['htmlcode'] = JRequest::getVar('htmlcode', '', 'post', 'string', JREQUEST_ALLOWRAW);
		if ($id) {
			//Check the user can edit this item
			$authorised = $user->authorise('core.edit', 'template.' . $id);
		} else {
			//Check the user can create new items in this section
			$authorised = $user->authorise('core.create', 'com_templateck');
		}

		if ($authorised !== true) {
			JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
			return false;
		}

		$table = $this->getTable();
		if ($table->save($data) === true) {
			return $table->id;
		} else {
			return false;
		}
	}

}