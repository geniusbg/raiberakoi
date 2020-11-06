<?php

/**
 * @copyright	Copyright (C) 2013 Cedric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * Module Playlist CK
 * @license		GNU/GPL
 * */
// no direct access
defined('_JEXEC') or die;
$com_path = JPATH_SITE . '/components/com_content/';
require_once $com_path . 'router.php';
require_once $com_path . 'helpers/route.php';
JModelLegacy::addIncludePath($com_path . '/models', 'ContentModel');
jimport('joomla.filesystem.folder');

class modPlaylistckHelper {

	/**
	 * Get a list of the items.
	 *
	 * @param	JRegistry	$params	The module options.
	 *
	 * @return	array
	 */
	static function getItems(&$params) {
		// load the libraries
		$items = json_decode(str_replace("|qq|", "\"", $params->get('slides')));
		foreach ($items as $i => $item) {
			if (!$item->imgname) {
				unset($items[$i]);
				continue;
			}

			if (isset($item->slidearticleid) && $item->slidearticleid) {
				$item = self::getArticle($item, $params);
			} else {
				$item->article = null;
			}

			if (stristr($item->imgname, "http")) {
				$item->imgthumb = $item->imgname;
			} else {
				$item->imgthumb = JURI::base(true) . '/' . $item->imgname;
				$item->imgname = JURI::base(true) . '/' . $item->imgname;
			}

			// set the videolink
			if ($item->imgvideo)
				$item->imgvideo = self::setVideolink($item->imgvideo);
		}
		return $items;
	}

	static function getArticle(&$item, $params) {
		// Access filter
		$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		// Get an instance of the generic articles model
		$articles = JModel::getInstance('Articles', 'ContentModel', array('ignore_request' => true));
		// Set application parameters in model
		$app = JFactory::getApplication();
		$appParams = $app->getParams();
		$articles->setState('params', $appParams);
		$articles->setState('filter.published', 1);
		$articles->setState('filter.article_id', $item->slidearticleid);
		$items2 = $articles->getItems();
		$item->article = $items2[0];
		$item->article->text = JHTML::_('content.prepare', $item->article->introtext);
		$item->article->text = self::truncate($item->article->text, $params->get('articlelength', '150'));
		// $item->article->text = JHTML::_('string.truncate',$item->article->introtext,'150');
		// set the item link to the article depending on the user rights
		if ($access || in_array($item->article->access, $authorised)) {
			// We know that user has the privilege to view the article
			$item->slug = $item->article->id . ':' . $item->article->alias;
			$item->catslug = $item->article->catid ? $item->article->catid . ':' . $item->article->category_alias : $item->article->catid;
			$item->article->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug));
		} else {
			$app = JFactory::getApplication();
			$menu = $app->getMenu();
			$menuitems = $menu->getItems('link', 'index.php?option=com_users&view=login');
			if (isset($menuitems[0])) {
				$Itemid = $menuitems[0]->id;
			} elseif (JRequest::getInt('Itemid') > 0) {
				$Itemid = JRequest::getInt('Itemid');
			}
			$item->article->link = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $Itemid);
		}
		return $item;
	}

	/**
	 * Get a list of the items.
	 *
	 * @param	JRegistry	$params	The module options.
	 *
	 * @return	array
	 */
	static function getItemsFromfolder(&$params) {
		$authorisedExt = array('png', 'jpg', 'JPG', 'JPEG', 'jpeg', 'bmp', 'tiff', 'gif');
		$items = json_decode(str_replace("|qq|", "\"", $params->get('slidesfromfolder')));
		foreach ($items as & $item) {
			$item->imgname = trim($item->imgname, '/');
			$item->imgname = trim($item->imgname, '\\');
			$item->imgthumb = JURI::base(true) . '/' . $item->imgname;
			$item->imgvideo = null;
			$item->slideselect = null;
			$item->slideselect = null;
			$item->imgcaption = null;
			$item->article = null;
			$item->slidearticleid = null;
			$item->imgalignment = null;
			$item->imgtarget = null;
			$item->imgtime = null;
			$item->imglink = null;

			if (!in_array(strToLower(JFile::getExt($item->imgname)), $authorisedExt))
				continue;

			// load the image data from txt
			$item = self::getImageDataFromfolder($item, $params);
			$item->imgname = JURI::base(true) . '/' . $item->imgname;
		}

		return $items;
	}

	static function getItemsAutoloadfolder(&$params) {
		$authorisedExt = array('png', 'jpg', 'JPG', 'JPEG', 'jpeg', 'bmp', 'tiff', 'gif');
		$items = JFolder::files($params->get('autoloadfoldername'), '.jpg|.png|.jpeg|.gif|.JPG|.JPEG|.jpeg', false, true);
		foreach ($items as $i => $name) {
			$item = new stdClass();
			$item->imgname = trim(str_replace('\\', '/', $name), '/');
			$item->imgname = trim($item->imgname, '\\');
			$item->imgthumb = JURI::base(true) . '/' . $item->imgname;
			$item->imgvideo = null;
			$item->slideselect = null;
			$item->slideselect = null;
			$item->imgcaption = null;
			$item->article = null;
			$item->slidearticleid = null;
			$item->imgalignment = null;
			$item->imgtarget = null;
			$item->imgtime = null;
			$item->imglink = null;

			if (!in_array(strToLower(JFile::getExt($item->imgname)), $authorisedExt))
				continue;

			// load the image data from txt
			$item = self::getImageDataFromfolder($item, $params);
			$item->imgname = JURI::base(true) . '/' . $item->imgname;
			$items[$i] = $item;
		}

		return $items;
	}
	
	static function getItemsAutoloadarticlecategory(&$params) {
		// Get an instance of the generic articles model
		$articles = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

		// Set application parameters in model
		$app = JFactory::getApplication();
		$appParams = $app->getParams();
		$articles->setState('params', $appParams);

		// Set the filters based on the module params
		$articles->setState('list.start', 0);
		$articles->setState('list.limit', 0);
		$articles->setState('filter.published', 1);

		// Access filter
		$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		$articles->setState('filter.access', $access);

		// Prep for Normal or Dynamic Modes
		$mode = $params->get('mode', 'normal');
		switch ($mode)
		{
			case 'dynamic':
				$option = $app->input->get('option');
				$view = $app->input->get('view');
				if ($option === 'com_content')
				{
					switch($view)
					{
						case 'category':
							$catids = array($app->input->getInt('id'));
							break;
						case 'categories':
							$catids = array($app->input->getInt('id'));
							break;
						case 'article':
							if ($params->get('show_on_article_page', 1))
							{
								$article_id = $app->input->getInt('id');
								$catid = $app->input->getInt('catid');

								if (!$catid)
								{
									// Get an instance of the generic article model
									$article = JModelLegacy::getInstance('Article', 'ContentModel', array('ignore_request' => true));

									$article->setState('params', $appParams);
									$article->setState('filter.published', 1);
									$article->setState('article.id', (int) $article_id);
									$item = $article->getItem();

									$catids = array($item->catid);
								}
								else
								{
									$catids = array($catid);
								}
							}
							else {
								// Return right away if show_on_article_page option is off
								return;
							}
							break;

						case 'featured':
						default:
							// Return right away if not on the category or article views
							return;
					}
				}
				else {
					// Return right away if not on a com_content page
					return;
				}

				break;

			case 'normal':
			default:
				$catids = $params->get('catid');
				$articles->setState('filter.category_id.include', (bool) $params->get('category_filtering_type', 1));
				break;
		}

		// Category filter
		if ($catids)
		{
			if ($params->get('show_child_category_articles', 0) && (int) $params->get('levels', 0) > 0)
			{
				// Get an instance of the generic categories model
				$categories = JModelLegacy::getInstance('Categories', 'ContentModel', array('ignore_request' => true));
				$categories->setState('params', $appParams);
				$levels = $params->get('levels', 1) ? $params->get('levels', 1) : 9999;
				$categories->setState('filter.get_children', $levels);
				$categories->setState('filter.published', 1);
				$categories->setState('filter.access', $access);
				$additional_catids = array();

				foreach ($catids as $catid)
				{
					$categories->setState('filter.parentId', $catid);
					$recursive = true;
					$items = $categories->getItems($recursive);

					if ($items)
					{
						foreach ($items as $category)
						{
							$condition = (($category->level - $categories->getParent()->level) <= $levels);
							if ($condition)
							{
								$additional_catids[] = $category->id;
							}

						}
					}
				}

				$catids = array_unique(array_merge($catids, $additional_catids));
			}

			$articles->setState('filter.category_id', $catids);
		}

		// Ordering
		$articles->setState('list.ordering', $params->get('article_ordering', 'a.ordering'));
		$articles->setState('list.direction', $params->get('article_ordering_direction', 'ASC'));

		// New Parameters
		$articles->setState('filter.featured', $params->get('show_front', 'show'));
//		$articles->setState('filter.author_id', $params->get('created_by', ""));
//		$articles->setState('filter.author_id.include', $params->get('author_filtering_type', 1));
//		$articles->setState('filter.author_alias', $params->get('created_by_alias', ""));
//		$articles->setState('filter.author_alias.include', $params->get('author_alias_filtering_type', 1));
		$excluded_articles = $params->get('excluded_articles', '');

		if ($excluded_articles)
		{
			$excluded_articles = explode("\r\n", $excluded_articles);
			$articles->setState('filter.article_id', $excluded_articles);
			$articles->setState('filter.article_id.include', false); // Exclude
		}

		$date_filtering = $params->get('date_filtering', 'off');
		if ($date_filtering !== 'off')
		{
			$articles->setState('filter.date_filtering', $date_filtering);
			$articles->setState('filter.date_field', $params->get('date_field', 'a.created'));
			$articles->setState('filter.start_date_range', $params->get('start_date_range', '1000-01-01 00:00:00'));
			$articles->setState('filter.end_date_range', $params->get('end_date_range', '9999-12-31 23:59:59'));
			$articles->setState('filter.relative_date', $params->get('relative_date', 30));
		}

		// Filter by language
		$articles->setState('filter.language', $app->getLanguageFilter());

		$items = $articles->getItems();

		// Display options
		$show_date = $params->get('show_date', 0);
		$show_date_field = $params->get('show_date_field', 'created');
		$show_date_format = $params->get('show_date_format', 'Y-m-d H:i:s');
		$show_category = $params->get('show_category', 0);
		$show_hits = $params->get('show_hits', 0);
		$show_author = $params->get('show_author', 0);
		$show_introtext = $params->get('show_introtext', 0);
		$introtext_limit = $params->get('introtext_limit', 100);

		// Find current Article ID if on an article page
		$option = $app->input->get('option');
		$view = $app->input->get('view');

		if ($option === 'com_content' && $view === 'article')
		{
			$active_article_id = $app->input->getInt('id');
		}
		else
		{
			$active_article_id = 0;
		}

		// Prepare data for display using display options
		$slideItems = Array();
		foreach ($items as &$item)
		{
			
			$item->slug = $item->id.':'.$item->alias;
			$item->catslug = $item->catid ? $item->catid .':'.$item->category_alias : $item->catid;

			if ($access || in_array($item->access, $authorised))
			{
				// We know that user has the privilege to view the article
				$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug));
			}
			else
			{
				$app  = JFactory::getApplication();
				$menu = $app->getMenu();
				$menuitems = $menu->getItems('link', 'index.php?option=com_users&view=login');
				if (isset($menuitems[0]))
				{
					$Itemid = $menuitems[0]->id;
				}
				elseif ($app->input->getInt('Itemid') > 0)
				{
					// Use Itemid from requesting page only if there is no existing menu
					$Itemid = $app->input->getInt('Itemid');
				}

				$item->link = JRoute::_('index.php?option=com_users&view=login&Itemid='.$Itemid);
			}

			// Used for styling the active article
			$item->active = $item->id == $active_article_id ? 'active' : '';

			$item->displayDate = '';
			if ($show_date)
			{
				$item->displayDate = JHTML::_('date', $item->$show_date_field, $show_date_format);
			}

			if ($item->catid)
			{
				$item->displayCategoryLink = JRoute::_(ContentHelperRoute::getCategoryRoute($item->catid));
				$item->displayCategoryTitle = $show_category ? '<a href="'.$item->displayCategoryLink.'">'.$item->category_title.'</a>' : '';
			}
			else {
				$item->displayCategoryTitle = $show_category ? $item->category_title : '';
			}

			$item->displayHits = $show_hits ? $item->hits : '';
			$item->displayAuthorName = $show_author ? $item->author : '';
//			if ($show_introtext) {
//				$item->introtext = JHtml::_('content.prepare', $item->introtext, '', 'mod_articles_category.content');
//				$item->introtext = self::_cleanIntrotext($item->introtext);
//			}
			$item->displayIntrotext = $show_introtext ? self::truncate($item->introtext, $introtext_limit) : '';
			$item->displayReadmore = $item->alternative_readmore;
			
			// add the article to the slide
			$registry = new JRegistry;
			$registry->loadString($item->images);
			$item->images = $registry->toArray();
			
			if (isset($item->images['image_intro']) && $item->images['image_intro']
					&& (count($slideItems) < (int) $params->get('count', 0) || (int) $params->get('count', 0) == 0)) {
				
				$slideItem = new stdClass();
				$slideItem->imgname = trim(str_replace('\\', '/', $item->images['image_intro']), '/');
				$slideItem->imgname = trim($slideItem->imgname, '\\');
				$slideItem->imgthumb = JURI::base(true) . '/' . $slideItem->imgname;
				$slideItem->imgname = JURI::base(true) . '/' . $slideItem->imgname;
				$slideItem->imgvideo = null;
				$slideItem->slideselect = null;
				$slideItem->imgcaption = null;
				$slideItem->article = new stdClass();
				$slideItem->slidearticleid = null;
				$slideItem->imgalignment = null;
				$slideItem->imgtarget = null;
				$slideItem->imgtime = null;
				$slideItem->imglink = null;
				$slideItem->imgtitle = null;
				$slideItem->article->title = $item->title;
				$slideItem->article->text = JHTML::_('content.prepare', $item->introtext);
				$slideItem->article->text = self::truncate($slideItem->article->text, $params->get('articlelength', '150'));
				$slideItem->article->link = $item->link;
				
				$slideItems[] = $slideItem;
			}
		}

		return $slideItems;
	}

	static protected function getImageDataFromfolder(&$item, $params) {
		$item->imgvideo = null;
		$item->slideselect = null;
		$item->imgcaption = null;
		$item->imgtitle = null;
		$item->article = null;
		$item->slidearticleid = null;
		$item->imgalignment = null;
		$item->imgtarget = null;
		$item->imgtime = null;
		$item->imglink = null;
		// load the image data from txt
		$datafile = JPATH_ROOT . '/' . str_replace(JFile::getExt($item->imgname), 'txt', $item->imgname);
		$data = JFile::exists($datafile) ? JFile::read($datafile) : '';
		$imgdatatmp = explode("\n", $data);

		$parmsnumb = count($imgdatatmp);
		for ($i = 0; $i < $parmsnumb; $i++) {
			$imgdatatmp[$i] = trim($imgdatatmp[$i]);
			$item->imgcaption = stristr($imgdatatmp[$i], "desc=") ? str_replace('desc=', '', $imgdatatmp[$i]) : $item->imgcaption;
			$item->imgtitle = stristr($imgdatatmp[$i], "title=") ? str_replace('title=', '', $imgdatatmp[$i]) : $item->imgtitle;
			$item->slidearticleid = stristr($imgdatatmp[$i], "articleid=") ? str_replace('articleid=', '', $imgdatatmp[$i]) : $item->slidearticleid;
			$item->imgvideo = stristr($imgdatatmp[$i], "video=") ? str_replace('video=', '', $imgdatatmp[$i]) : $item->imgvideo;
			$item->imglink = stristr($imgdatatmp[$i], "link=") ? str_replace('link=', '', $imgdatatmp[$i]) : $item->imglink;
			$item->imgtime = stristr($imgdatatmp[$i], "time=") ? str_replace('time=', '', $imgdatatmp[$i]) : $item->imgtime;
			$item->imgtarget = stristr($imgdatatmp[$i], "target=") ? str_replace('target=', '', $imgdatatmp[$i]) : $item->imgtarget;
		}

		if ($item->imgvideo)
			$item->slideselect = 'video';

		if (isset($item->slidearticleid) && $item->slidearticleid) {
			$item = self::getArticle($item, $params);
		}

		return $item;
	}

	/**
	 * Set the correct video link
	 *
	 * $videolink string the video path
	 *
	 * @return string the new video path
	 */
	static function setVideolink($videolink) {
		// youtube
		if (stristr($videolink, 'youtu.be')) {
			$videolink = str_replace('youtu.be', 'www.youtube.com/embed', $videolink);
		} else if (stristr($videolink, 'www.youtube.com') AND !stristr($videolink, 'embed')) {
			$videolink = str_replace('youtube.com', 'youtube.com/embed', $videolink);
		}

		$videolink .= (stristr($videolink, '?')) ? '&wmode=transparent' : '?wmode=transparent';

		return $videolink;
	}

	/**
	 * Create the css
	 *
	 * $params JRegistry the module params
	 * $prefix integer the prefix of the params
	 *
	 * @return Array of css
	 */
	static function createCss($params, $prefix = 'menu') {
		$css = Array();
		$csspaddingtop = ($params->get($prefix . 'paddingtop') AND $params->get($prefix . 'usemargin')) ? 'padding-top: ' . $params->get($prefix . 'paddingtop', '0') . 'px;' : '';
		$csspaddingright = ($params->get($prefix . 'paddingright') AND $params->get($prefix . 'usemargin')) ? 'padding-right: ' . $params->get($prefix . 'paddingright', '0') . 'px;' : '';
		$csspaddingbottom = ($params->get($prefix . 'paddingbottom') AND $params->get($prefix . 'usemargin') ) ? 'padding-bottom: ' . $params->get($prefix . 'paddingbottom', '0') . 'px;' : '';
		$csspaddingleft = ($params->get($prefix . 'paddingleft') AND $params->get($prefix . 'usemargin')) ? 'padding-left: ' . $params->get($prefix . 'paddingleft', '0') . 'px;' : '';
		$css['padding'] = $csspaddingtop . $csspaddingright . $csspaddingbottom . $csspaddingleft;
		$cssmargintop = ($params->get($prefix . 'margintop') AND $params->get($prefix . 'usemargin')) ? 'margin-top: ' . $params->get($prefix . 'margintop', '0') . 'px;' : '';
		$cssmarginright = ($params->get($prefix . 'marginright') AND $params->get($prefix . 'usemargin')) ? 'margin-right: ' . $params->get($prefix . 'marginright', '0') . 'px;' : '';
		$cssmarginbottom = ($params->get($prefix . 'marginbottom') AND $params->get($prefix . 'usemargin')) ? 'margin-bottom: ' . $params->get($prefix . 'marginbottom', '0') . 'px;' : '';
		$cssmarginleft = ($params->get($prefix . 'marginleft') AND $params->get($prefix . 'usemargin')) ? 'margin-left: ' . $params->get($prefix . 'marginleft', '0') . 'px;' : '';
		$css['margin'] = $cssmargintop . $cssmarginright . $cssmarginbottom . $cssmarginleft;
		$css['background'] = ($params->get($prefix . 'bgcolor1') AND $params->get($prefix . 'usebackground')) ? 'background: ' . $params->get($prefix . 'bgcolor1') . ';' : '';
		$css['background'] .= ( $params->get($prefix . 'bgimage') AND $params->get($prefix . 'usebackground')) ? 'background-image: url("' . JURI::ROOT() . $params->get($prefix . 'bgimage') . '");' : '';
		$css['background'] .= ( $params->get($prefix . 'bgimage') AND $params->get($prefix . 'usebackground')) ? 'background-repeat: ' . $params->get($prefix . 'bgimagerepeat') . ';' : '';
		$css['background'] .= ( $params->get($prefix . 'bgimage') AND $params->get($prefix . 'usebackground')) ? 'background-position: ' . $params->get($prefix . 'bgpositionx') . ' ' . $params->get($prefix . 'bgpositiony') . ';' : '';
		$css['gradient'] = ($css['background'] AND $params->get($prefix . 'bgcolor2') AND $params->get($prefix . 'usegradient')) ?
				"background: -moz-linear-gradient(top,  " . $params->get($prefix . 'bgcolor1', '#f0f0f0') . " 0%, " . $params->get($prefix . 'bgcolor2', '#e3e3e3') . " 100%);"
				. "background: -webkit-gradient(linear, left top, left bottom, color-stop(0%," . $params->get($prefix . 'bgcolor1', '#f0f0f0') . "), color-stop(100%," . $params->get($prefix . 'bgcolor2', '#e3e3e3') . ")); "
				. "background: -webkit-linear-gradient(top,  " . $params->get($prefix . 'bgcolor1', '#f0f0f0') . " 0%," . $params->get($prefix . 'bgcolor2', '#e3e3e3') . " 100%);"
				. "background: -o-linear-gradient(top,  " . $params->get($prefix . 'bgcolor1', '#f0f0f0') . " 0%," . $params->get($prefix . 'bgcolor2', '#e3e3e3') . " 100%);"
				. "background: -ms-linear-gradient(top,  " . $params->get($prefix . 'bgcolor1', '#f0f0f0') . " 0%," . $params->get($prefix . 'bgcolor2', '#e3e3e3') . " 100%);"
				. "background: linear-gradient(top,  " . $params->get($prefix . 'bgcolor1', '#f0f0f0') . " 0%," . $params->get($prefix . 'bgcolor2', '#e3e3e3') . " 100%); "
				. "filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='" . $params->get($prefix . 'bgcolor1', '#f0f0f0') . "', endColorstr='" . $params->get($prefix . 'bgcolor2', '#e3e3e3') . "',GradientType=0 );" : '';
		$css['borderradius'] = ($params->get($prefix . 'useroundedcorners')) ?
				'-moz-border-radius: ' . $params->get($prefix . 'roundedcornerstl', '0') . 'px ' . $params->get($prefix . 'roundedcornerstr', '0') . 'px ' . $params->get($prefix . 'roundedcornersbr', '0') . 'px ' . $params->get($prefix . 'roundedcornersbl', '0') . 'px;'
				. '-webkit-border-radius: ' . $params->get($prefix . 'roundedcornerstl', '0') . 'px ' . $params->get($prefix . 'roundedcornerstr', '0') . 'px ' . $params->get($prefix . 'roundedcornersbr', '0') . 'px ' . $params->get($prefix . 'roundedcornersbl', '0') . 'px;'
				. 'border-radius: ' . $params->get($prefix . 'roundedcornerstl', '0') . 'px ' . $params->get($prefix . 'roundedcornerstr', '0') . 'px ' . $params->get($prefix . 'roundedcornersbr', '0') . 'px ' . $params->get($prefix . 'roundedcornersbl', '0') . 'px;' : '';
		$shadowinset = $params->get($prefix . 'shadowinset', 0) ? 'inset ' : '';
		$css['shadow'] = ($params->get($prefix . 'shadowcolor') AND $params->get($prefix . 'shadowblur') AND $params->get($prefix . 'useshadow')) ?
				'-moz-box-shadow: ' . $shadowinset . $params->get($prefix . 'shadowoffsetx', '0') . 'px ' . $params->get($prefix . 'shadowoffsety', '0') . 'px ' . $params->get($prefix . 'shadowblur', '') . 'px ' . $params->get($prefix . 'shadowspread', '0') . 'px ' . $params->get($prefix . 'shadowcolor', '') . ';'
				. '-webkit-box-shadow: ' . $shadowinset . $params->get($prefix . 'shadowoffsetx', '0') . 'px ' . $params->get($prefix . 'shadowoffsety', '0') . 'px ' . $params->get($prefix . 'shadowblur', '') . 'px ' . $params->get($prefix . 'shadowspread', '0') . 'px ' . $params->get($prefix . 'shadowcolor', '') . ';'
				. 'box-shadow: ' . $shadowinset . $params->get($prefix . 'shadowoffsetx', '0') . 'px ' . $params->get($prefix . 'shadowoffsety', '0') . 'px ' . $params->get($prefix . 'shadowblur', '') . 'px ' . $params->get($prefix . 'shadowspread', '0') . 'px ' . $params->get($prefix . 'shadowcolor', '') . ';' : '';
		$css['border'] = ($params->get($prefix . 'bordercolor') AND $params->get($prefix . 'borderwidth') AND $params->get($prefix . 'useborders')) ?
				'border: ' . $params->get($prefix . 'bordercolor', '#efefef') . ' ' . $params->get($prefix . 'borderwidth', '1') . 'px solid;' : '';
		$css['fontsize'] = ($params->get($prefix . 'usefont') AND $params->get($prefix . 'fontsize')) ?
				'font-size: ' . $params->get($prefix . 'fontsize') . ';' : '';
		$css['fontcolor'] = ($params->get($prefix . 'usefont') AND $params->get($prefix . 'fontcolor')) ?
				'color: ' . $params->get($prefix . 'fontcolor') . ';' : '';
		$css['fontweight'] = ($params->get($prefix . 'usefont') AND $params->get($prefix . 'fontweight')) ?
				'font-weight: ' . $params->get($prefix . 'fontweight') . ';' : '';
		/* $css['fontcolorhover'] = ($params->get($prefix . 'usefont') AND $params->get($prefix . 'fontcolorhover')) ?
		  'color: ' . $params->get($prefix . 'fontcolorhover') . ';' : ''; */
		$css['descfontsize'] = ($params->get($prefix . 'usefont') AND $params->get($prefix . 'descfontsize')) ?
				'font-size: ' . $params->get($prefix . 'descfontsize') . ';' : '';
		$css['descfontcolor'] = ($params->get($prefix . 'usefont') AND $params->get($prefix . 'descfontcolor')) ?
				'color: ' . $params->get($prefix . 'descfontcolor') . ';' : '';
		return $css;
	}

	/**
	 * Truncates text blocks over the specified character limit and closes
	 * all open HTML tags. The method will optionally not truncate an individual
	 * word, it will find the first space that is within the limit and
	 * truncate at that point. This method is UTF-8 safe.
	 *
	 * @param   string   $text       The text to truncate.
	 * @param   integer  $length     The maximum length of the text.
	 * @param   boolean  $noSplit    Don't split a word if that is where the cutoff occurs (default: true).
	 * @param   boolean  $allowHtml  Allow HTML tags in the output, and close any open tags (default: true).
	 *
	 * @return  string   The truncated text.
	 *
	 * @since   11.1
	 */
	public static function truncate($text, $length = 0, $noSplit = true, $allowHtml = true) {
		// Check if HTML tags are allowed.
		if (!$allowHtml) {
			// Deal with spacing issues in the input.
			$text = str_replace('>', '> ', $text);
			$text = str_replace(array('&nbsp;', '&#160;'), ' ', $text);
			$text = JString::trim(preg_replace('#\s+#mui', ' ', $text));

			// Strip the tags from the input and decode entities.
			$text = strip_tags($text);
			$text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');

			// Remove remaining extra spaces.
			$text = str_replace('&nbsp;', ' ', $text);
			$text = JString::trim(preg_replace('#\s+#mui', ' ', $text));
		}

		// Truncate the item text if it is too long.
		if ($length > 0 && JString::strlen($text) > $length) {
			// Find the first space within the allowed length.
			$tmp = JString::substr($text, 0, $length);

			if ($noSplit) {
				$offset = JString::strrpos($tmp, ' ');
				if (JString::strrpos($tmp, '<') > JString::strrpos($tmp, '>')) {
					$offset = JString::strrpos($tmp, '<');
				}
				$tmp = JString::substr($tmp, 0, $offset);

				// If we don't have 3 characters of room, go to the second space within the limit.
				if (JString::strlen($tmp) > $length - 3) {
					$tmp = JString::substr($tmp, 0, JString::strrpos($tmp, ' '));
				}
			}

			if ($allowHtml) {
				// Put all opened tags into an array
				preg_match_all("#<([a-z][a-z0-9]*)\b.*?(?!/)>#i", $tmp, $result);
				$openedTags = $result[1];
				$openedTags = array_diff($openedTags, array("img", "hr", "br"));
				$openedTags = array_values($openedTags);

				// Put all closed tags into an array
				preg_match_all("#</([a-z]+)>#iU", $tmp, $result);
				$closedTags = $result[1];

				$numOpened = count($openedTags);

				// All tags are closed
				if (count($closedTags) == $numOpened) {
					return $tmp . '...';
				}
				$tmp .= '...';
				$openedTags = array_reverse($openedTags);

				// Close tags
				for ($i = 0; $i < $numOpened; $i++) {
					if (!in_array($openedTags[$i], $closedTags)) {
						$tmp .= "</" . $openedTags[$i] . ">";
					} else {
						unset($closedTags[array_search($openedTags[$i], $closedTags)]);
					}
				}
			}

			$text = $tmp;
		}

		return $text;
	}

}
