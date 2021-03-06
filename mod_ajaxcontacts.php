<?php defined('_JEXEC') or die;

/**
 * File       mod_ajaxcontacts.php
 * Created    10/2/14 12:38 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2014 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v2 or later
 */

require_once __DIR__ . '/helper.php';

$helper  = new modAjaxcontactsHelper;
$options = $helper->getFormOptions();

JHtml::_('jquery.framework');

JFactory::getDocument()->addScript(JURI::base(true) . '/media/mod_ajaxcontacts/js/ajaxcontacts.min.js');

require(JModuleHelper::getLayoutPath('mod_ajaxcontacts'));