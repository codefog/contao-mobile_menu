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

namespace Codefog\MobileMenu;

/**
 * Class MobileMenuModule
 *
 * Front end module "mobile menu".
 */
class MobileMenuModule extends \Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_mobile_menu';

    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['mobile_menu'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile()
    {
        $position = $this->mobile_menu_position;

        // Backwards compatibility
        if ($position == '') {
            $position = 'left';
        }

        $this->Template->trigger = $this->mobile_menu_trigger;
        $this->Template->html = $this->mobile_menu_html;
        $this->Template->position = $position;
        $this->Template->size = $this->mobile_menu_size;

        $triggerClass = '';

        // Display on phones
        if ($this->mobile_menu_phones) {
            $triggerClass .= ' display_phones';
        }

        // Display on tablets
        if ($this->mobile_menu_tablets) {
            $triggerClass .= ' display_tablets';
        }

        $this->Template->triggerClass = $triggerClass;
        $this->Template->menuStyle = array();

        // Add the mobile menu custom size
        if ($this->mobile_menu_size) {
            switch ($position) {
                case 'left':
                case 'right':
                    $property = 'width';
                    break;

                case 'top':
                case 'bottom':
                    $property = 'height';
                    break;
            }

            $this->Template->menuStyle = array(
                'property' => $property,
                'value'    => $this->mobile_menu_size . '%',
            );
        }

        // Add assets
        $GLOBALS['TL_CSS']['mobileMenu'] = 'system/modules/mobile_menu/assets/css/mobile-menu.min.css||static';
        $GLOBALS['TL_JAVASCRIPT']['mobileMenu'] = 'system/modules/mobile_menu/assets/js/mobile-menu.min.js|static';
    }
}
