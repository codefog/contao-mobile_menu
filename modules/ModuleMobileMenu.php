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

namespace MobileMenu;

/**
 * Class ModuleMobileMenu
 *
 * Front end module "mobile menu".
 */
class ModuleMobileMenu extends \Module
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
        $this->Template->trigger = $this->mobile_menu_trigger;
        $this->Template->html = $this->mobile_menu_html;
        $strClass = '';

        // Display on phones
        if ($this->mobile_menu_phones) {
            $strClass .= ' display_phones';
        }

        // Display on tablets
        if ($this->mobile_menu_tablets) {
            $strClass .= ' display_tablets';
        }

        $this->Template->triggerClass = $strClass;

        // Add assets
        $GLOBALS['TL_CSS']['mobileMenu'] = 'system/modules/mobile_menu/assets/css/mobile-menu.min.css||static';
        $GLOBALS['TL_JAVASCRIPT']['mobileMenu'] = 'system/modules/mobile_menu/assets/js/mobile-menu.min.js|static';
    }
}
