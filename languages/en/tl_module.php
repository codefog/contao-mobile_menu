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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_phones']         = [
    'Display on phones',
    'Display the menu on phone devices (767px screen width).'
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_tablets']        = [
    'Display on tablets',
    'Display the menu on tablet devices (991px screen width).'
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_breakpoint']     = [
    'Custom breakpoint (px)',
    'Here you can enter a custom breakpoint when the menu will be shown in pixels. This value will override the above predefined breakpoints for phones and tablets!'
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_position']       = ['Position', 'Here you can choose the menu position.'];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_size']           = [
    'Custom menu size (%s)',
    'Here you can enter the custom menu width or height in %.'
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_overlay']        = [
    'Enable the overlay',
    'Enable the overlay over the content when menu is active.'
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_offCanvas']      = [
    'Off canvas effect',
    'Use the off canvas effect when menu is active.'
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_noShadow']       = [
    'Disable menu shadow',
    'Disable the default menu shadow when it is active.'
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_animation']      = [
    'Enable animation',
    'Enable animation of showing and hiding the menu.'
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_animationSpeed'] = [
    'Animation speed (ms)',
    'Here you can enter the animation speed of the menu (1000ms = 1 second).'
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_trigger']        = [
    'Trigger content',
    'Here you can add the HTML content of the trigger.'
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_html']           = [
    'Menu content',
    'Here you can add the HTML content of the menu.'
];

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_position']['left']   = 'Left side';
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_position']['right']  = 'Right side';
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_position']['top']    = 'On the top';
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_position']['bottom'] = 'On the bottom';

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_display_legend'] = 'Display settings';
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_design_legend']  = 'Design settings';
