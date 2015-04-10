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
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['mobile_menu'] = '{title_legend},name,type;{config_legend},mobile_menu_phones,mobile_menu_tablets,mobile_menu_position,mobile_menu_size,mobile_menu_trigger,mobile_menu_html;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['mobile_menu_phones'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['mobile_menu_phones'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['mobile_menu_tablets'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['mobile_menu_tablets'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['mobile_menu_position'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['mobile_menu_position'],
    'default'                 => 'left',
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => array('left', 'right', 'top', 'bottom'),
    'reference'               => &$GLOBALS['TL_LANG']['tl_module']['mobile_menu_position'],
    'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => "varchar(8) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['mobile_menu_size'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['mobile_menu_size'],
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => array('rgxp'=>'prcnt', 'tl_class'=>'w50'),
    'sql'                     => "varchar(3) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['mobile_menu_trigger'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['mobile_menu_trigger'],
    'exclude'                 => true,
    'inputType'               => 'textarea',
    'eval'                    => array('allowHtml'=>true, 'class'=>'monospace', 'rte'=>'ace|html', 'helpwizard'=>true, 'tl_class'=>'clr'),
    'explanation'             => 'insertTags',
    'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['mobile_menu_html'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['mobile_menu_html'],
    'exclude'                 => true,
    'inputType'               => 'textarea',
    'eval'                    => array('allowHtml'=>true, 'class'=>'monospace', 'rte'=>'ace|html', 'helpwizard'=>true),
    'explanation'             => 'insertTags',
    'sql'                     => "text NULL"
);
