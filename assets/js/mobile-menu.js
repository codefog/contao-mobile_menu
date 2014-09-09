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

var mobileMenu = function(config) {

    var menu = config.menu;
    var trigger = config.trigger;
    var overlay = config.overlay;

    /**
     * Initialize the navigation
     * @param object
     */
    var initNavigation = function(navigation) {
        var submenus = [];
        var children = navigation.children;

        for (var i=0; i<children.length; i++) {
            if (hasClass(children[i], 'submenu')) {
                submenus.push(children[i]);
            }
        }

        for (var i=0; i<submenus.length; i++) {
            var item = submenus[i];
            var children = item.children;
            var link = null;

            // Find the link
            for (var j=0; j<children.length; j++) {
                if (children[j].tagName.toLowerCase() == 'a' || children[j].tagName.toLowerCase() == 'span') {
                    link = children[j];
                    break;
                }
            }

            // Open the submenu of the active item
            if (hasClass(link, 'active') || hasClass(link, 'trail')) {
                addClass(item, 'display_submenu');
            }

            // Open the submenu on click
            link.addEventListener('click', function(e) {
                var item = this.parentNode;

                if (!hasClass(item, 'display_submenu')) {
                    e.preventDefault();

                    for (var j=0; j<submenus.length; j++) {
                        removeClass(submenus[j], 'display_submenu');
                    }

                    addClass(item, 'display_submenu');
                }
            });

            var subnavigation = null;
            var children = item.children;

            // Find the subnavigation
            for (var j=0; j<children.length; j++) {
                if (children[j].tagName.toLowerCase() == 'ul') {
                    subnavigation = children[j];
                    break;
                }
            }

            // Recursively init subnavigation
            if (subnavigation) {
                initNavigation(subnavigation);
            }
        }
    };

    /**
     * Check if element has CSS class
     * @param object
     * @param string
     */
    var hasClass = function(el, selector) {
        return (el.className.split(' ').indexOf(selector) == -1) ? false : true;
    };

    /**
     * Add the CSS class to element
     * @param object
     * @param string
     */
    var addClass = function(el, selector) {
        if (hasClass(el, selector)) {
            return;
        }

        el.className = el.className + ' ' + selector;
    };

    /**
     * Remove the CSS class from element
     * @param object
     * @param string
     */
    var removeClass = function(el, selector) {
        if (!hasClass(el, selector)) {
            return;
        }

        var classes = el.className.split(' ');
        classes.splice(classes.indexOf(selector), 1);
        el.className = classes.join(' ');
    };

    /**
     * Initialize the menu
     */
    document.body.appendChild(menu);
    var navigation = (menu.getElementsByClassName('level_1'))[0];

    if (navigation) {
        initNavigation(navigation);
    }

    /**
     * Initialize the trigger
     */
    trigger.addEventListener('click', function(e) {
        e.preventDefault();

        addClass(menu, 'active');
        addClass(overlay, 'active');
    });

    /**
     * Initialize the overlay
     */
    document.body.appendChild(overlay);

    overlay.addEventListener('click', function() {
        removeClass(menu, 'active');
        removeClass(overlay, 'active');
    });
};
