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
 * Register the namespace
 */
ClassLoader::addNamespace('Codefog\MobileMenu');

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    'Codefog\MobileMenu\MobileMenuModule' => 'system/modules/mobile_menu/src/MobileMenuModule.php'
));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'mod_mobile_menu' => 'system/modules/mobile_menu/templates/modules'
));
