<?php
/**
 * @version     1.0.0
 * @package     com_translationck
 * @copyright   Copyright (C) 2011. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of Translationck.
 */
class TranslationckViewItems extends JView
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		/*$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');*/

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		// $this->addToolbar();
		if (JRequest::getVar('layout') == 'ajaxresult') $this->translations	= $this->makeTranslations();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'translationck.php';

		$state	= $this->get('State');
		$canDo	= TranslationckHelper::getActions($state->get('filter.category_id'));

		JToolBarHelper::title(JText::_('COM_TRANSLATIONCK_TITLE_ITEMS'), 'items.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR.DS.'views'.DS.'item';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
			    JToolBarHelper::addNew('item.add','JTOOLBAR_NEW');
		    }

		    if ($canDo->get('core.edit')) {
			    JToolBarHelper::editList('item.edit','JTOOLBAR_EDIT');
		    }

        }

		if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::custom('items.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			    JToolBarHelper::custom('items.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'items.delete','JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::archiveList('items.archive','JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
            	JToolBarHelper::custom('items.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
		}
        
        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
		    if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
			    JToolBarHelper::deleteList('', 'items.delete','JTOOLBAR_EMPTY_TRASH');
			    JToolBarHelper::divider();
		    } else if ($canDo->get('core.edit.state')) {
			    JToolBarHelper::trash('items.trash','JTOOLBAR_TRASH');
			    JToolBarHelper::divider();
		    }
        }

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_translationck');
		}


	}
	
	/**
	 * Add the page title and toolbar.
	 */
	protected function makeTranslations()
	{
		jimport('joomla.filesystem.file');
		$componentname = JRequest::getVar('componentname');
		$languageprefix = JRequest::getVar('languageprefix');
		$componentpath = JPATH_ROOT.DS.'administrator'.DS.'components'.DS.$componentname;
		$inipath = JPATH_ROOT.DS.'administrator'.DS.'language'.DS.'en-GB'.DS.$languageprefix.'.'.$componentname.'.ini';
		$inicontent = JFile::read($inipath);
		$componentfileslist = JFolder::files($componentpath, '.php', true, true);
		$regex = "#JText::_\((.*?)\)#s"; // masque de recherche 
		 
		foreach($componentfileslist as $file) {
			$filecontent = JFile::read($file);
			preg_match_all($regex, $filecontent, $jtexts);
			foreach($jtexts[1] as $jtext) {
				$jtext = str_replace("'","",$jtext);
				$jtext = trim($jtext);
				
				if (!stristr($inicontent, $jtext.' ') AND !stristr($inicontent, $jtext.'=')) {
					$translation = new StdClass();
					$translation->jtext = $jtext;
					$translation->file = $file;
					$translations[] = $translation;
					$inicontent .= $jtext." =\"".$jtext."\"\r\n";
					//echo '<p>'.$file.' : <b>'.$jtext.'</b></p>';
				}
			}
		}
		$inioutputpath = JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_translationck'.DS.$languageprefix.'.'.$componentname.'.ini';
		JFile::write($inioutputpath, $inicontent);
		return $translations;
		
	}
}
