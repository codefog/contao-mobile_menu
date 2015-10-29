<?php

/**
 * mobile_menu extension for Contao Open Source CMS
 *
 * Copyright (C) 2011-2014 Codefog
 *
 * @package mobile_menu
 * @author  Codefog <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @license LGPL
 */

/**
 * Extension version
 */
@define('MOBILE_MENU_VERSION', '2.2');
@define('MOBILE_MENU_BUILD', '1');

/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['navigation']['mobile_menu'] = 'Codefog\MobileMenu\MobileMenuModule';
