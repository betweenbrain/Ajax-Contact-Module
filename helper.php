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
	public function __construct()
	{
		$this->db = JFactory::getDbo();
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

		if ($input->get('suburb'))
		{
			$where .= ' AND ' . $db->quoteName('suburb') . ' = ' . $db->quote($input->get('suburb', '', 'HTML'));
		}

		if ($input->get('state'))
		{
			$where .= ' AND ' . $db->quoteName('state') . ' = ' . $db->quote($input->get('state', '', 'HTML'));
		}

		if ($input->get('country'))
		{
			$where .= ' AND ' . $db->quoteName('country') . ' = ' . $db->quote($input->get('country', '', 'HTML'));
		}

		$query
			->select('*')
			->from($db->quoteName('#__contact_details'))
			->where($where);

		$query->order('ordering ASC');

		$db->setQuery($query);

		return $db->loadObjectList();
	}

	/**
	 * Method to get distinct values for the form options
	 *
	 * @return stdClass
	 */
	public function getFormOptions()
	{
		$options = new stdClass;

		$query = $this->db->getQuery(true);

		$query
			->select('DISTINCT ' . $this->db->quoteName('suburb'))
			->from($this->db->quoteName('#__contact_details'))
			->where($this->db->quoteName('published') . ' = ' . $this->db->quote('1'))
			->order('suburb ASC');

		$this->db->setQuery($query);

		$options->suburb = $this->db->loadColumn();

		$query = $this->db->getQuery(true);

		$query
			->select('DISTINCT ' . $this->db->quoteName('state'))
			->from($this->db->quoteName('#__contact_details'))
			->where($this->db->quoteName('published') . ' = ' . $this->db->quote('1'))
			->order('state ASC');

		$this->db->setQuery($query);

		$options->state = $this->db->loadColumn();

		$query = $this->db->getQuery(true);

		$query
			->select('DISTINCT ' . $this->db->quoteName('country'))
			->from($this->db->quoteName('#__contact_details'))
			->where($this->db->quoteName('published') . ' = ' . $this->db->quote('1'))
			->order('country ASC');

		$this->db->setQuery($query);

		$options->country = $this->db->loadColumn();

		return $options;
	}
}
