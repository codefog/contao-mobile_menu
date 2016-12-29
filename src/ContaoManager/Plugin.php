<?php

/**
 * mobile_menu extension for Contao Open Source CMS
 *
 * Copyright (C) 2011-2014 Codefog
 *
 * @package mobile_menu
 * @author  Codefog <http://codefog.pl>
 * @author  Andreas Schempp <https://github.com/aschempp>
 * @license LGPL
 */

namespace Codefog\MobileMenu\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{

    /**
     * @inheritdoc
     */
    public function getBundles(ParserInterface $parser)
    {
        return $parser->parse('mobile_menu', 'ini');
    }
}
