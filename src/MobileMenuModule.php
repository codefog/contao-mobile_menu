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
class MobileMenuModule extends \Contao\Module
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
        $request = \Contao\System::getContainer()->get('request_stack')->getCurrentRequest();

        if ($request && \Contao\System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request))
        {
            $objTemplate = new \Contao\BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ' . mb_strtoupper($GLOBALS['TL_LANG']['FMD']['mobile_menu'][0]) . ' ###';
            $objTemplate->title    = $this->headline;
            $objTemplate->id       = $this->id;
            $objTemplate->link     = $this->name;
            $objTemplate->href = \Contao\StringUtil::specialcharsUrl(\Contao\System::getContainer()->get('router')->generate('contao_backend', array('do'=>'themes', 'table'=>'tl_module', 'act'=>'edit', 'id'=>$this->id)));


            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile()
    {
        $this->Template->trigger           = $this->mobile_menu_trigger;
        $this->Template->html              = $this->mobile_menu_html;
        $this->Template->position          = $this->mobile_menu_position;
        $this->Template->size              = (int)$this->mobile_menu_size;
        $this->Template->overlay           = $this->mobile_menu_overlay;
        $this->Template->offCanvas         = $this->mobile_menu_offCanvas;
        $this->Template->animation         = $this->mobile_menu_animation;
        $this->Template->animationSpeed    = (int)$this->mobile_menu_animationSpeed;
        $this->Template->mediaQuery        = $this->mobile_menu_mediaQuery;
        $this->Template->noShadow          = $this->mobile_menu_noShadow;
        $this->Template->disableNavigation = $this->mobile_menu_disableNavigation;
        $this->Template->parentTogglers    = $this->mobile_menu_parentTogglers;
        $this->Template->closeOnLinkClick  = $this->mobile_menu_closeOnLinkClick;
        $this->Template->keepInPlace       = $this->mobile_menu_keepInPlace;

        $breakPoint = 0;

        // Display on phones
        if ($this->mobile_menu_phones) {
            $breakPoint = 767;
        }

        // Display on tablets
        if ($this->mobile_menu_tablets) {
            $breakPoint = 991;
        }

        // Set a custom break point
        if ($this->mobile_menu_breakpoint) {
            $breakPoint = (int)$this->mobile_menu_breakpoint;
        }

        $this->Template->breakPoint = $breakPoint;

        $this->addMobileMenuAssets();
    }

    /**
     * Add the mobile menu assets
     */
    protected function addMobileMenuAssets()
    {
        $GLOBALS['TL_CSS']['mobileMenu']        = 'system/modules/mobile_menu/assets/css/mobile-menu.min.css||static';
        $GLOBALS['TL_JAVASCRIPT']['mobileMenu'] = 'system/modules/mobile_menu/assets/js/mobile-menu.jquery.min.js|static';
    }
}
