<?php defined('_JEXEC') or die;

/**
 * File       helper.php
 * Created    10/2/14 12:38 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2014 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v2 or later
 */

jimport('joomla.application.menu');

class modAjaxcontactsHelper
{
	/**
	 * Constructor
	 *
	 * @param JRegistry $params : module parameters
	 *
	 * @since 0.1
	 *
	 */
	public function __construct($params)
	{
		$this->app    = JFactory::getApplication();
		$this->db     = JFactory::getDbo();
		$this->menu   = $this->app->getMenu();
		$this->active = $this->menu->getActive();
		$this->params = $params;
	}

	/**
	 * Method to retrieve select contacts based on passed parameter values
	 *
	 * @return mixed
	 */
	public static function getAjax()
	{
		$input = JFactory::getApplication()->input;

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$where = $db->quoteName('published') . ' = ' . $db->quote('1');

		if ($input->get('category'))
		{
			$where .= ' AND ' . $db->quoteName('catid') . ' = ' . $db->quote($input->get('category', '', 'INT'));
		}

		if ($input->get('product'))
		{
			$where .= ' AND ' . $db->quoteName('params') . ' REGEXP \'"solutions":[^\]]*"' . $input->get('product', '', 'HTML') . '".*\'';
		}

		if ($input->get('country'))
		{
			$where .= ' AND ' . $db->quoteName('params') . ' REGEXP \'"country":[^\]]*"' . $input->get('country', '', 'HTML') . '".*\'';
		}

		if ($input->get('region'))
		{
			$where .= ' AND ('
				. $db->quoteName('params') . ' REGEXP \'"region":[^\]]*"' . $input->get('region', '', 'HTML') . '".*\' ' .
				'OR ' . $db->quoteName('params') . ' REGEXP \'"region":[^\]]*"all".*\'' .
				')';
		}

		$query
			->select('*')
			->from($db->quoteName('#__contact_details'))
			->where($where);

		$query->order('ordering ASC');

		$db->setQuery($query);

		return $db->loadObjectList();
	}
}
