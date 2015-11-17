/**
 * mobile_menu extension for Contao Open Source CMS
 *
 * Copyright (C) 2011-2015 Codefog
 *
 * @package mobile_menu
 * @author  Codefog <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @license LGPL
 */

;(function ($, window, document, undefined) {
    'use strict';

    // Create the defaults once
    var pluginName = 'mobileMenu',
        defaults = {
            'animation': false, // Enable the animation
            'animationSpeed': 500, // The animation speed in milliseconds
            'breakPoint': 0, // The breakpoint to show the menu
            'menuActiveClass': 'active', // The menu active CSS class
            'menuSubNavigationCssClass': 'submenu_show', // The sub navigation active CSS class
            'offCanvas': false, // The off canvas mode
            'offCanvasWrapper': null, // The off canvas content wrapper
            'offCanvasWrapperClass': 'mobile_menu_wrapper', // The off canvas content wrapper class
            'overlay': false, // Display overlay or not
            'overlayActiveCssClass': 'active', // The overlay active CSS class
            'overlayBackgroundCssClass': 'background', // The overlay background CSS class
            'overlayCssClass': 'mobile_menu_overlay', // The overlay CSS class
            'position': 'left', // The position of the menu (left, top, right, bottom)
            'size': 75, // The size of the menu in percent
            'trigger': null // The menu trigger
        };

    // The actual plugin constructor
    function Plugin(element, options) {
        this.element = $(element);
        this.overlay = null;
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    // Avoid Plugin.prototype conflicts
    $.extend(Plugin.prototype, {

        /**
         * Initialize the plugin
         */
        init: function () {
            var body = $('body');

            // Hide the menu on IE8-9 as they are not supported
            if (body.hasClass('ie8') || body.hasClass('ie9')) {
                return;
            }

            // Set the default wrapper
            if (this.settings.offCanvasWrapper === null) {
                this.settings.offCanvasWrapper = $('#wrapper');
            }

            this.initMenu();
            this.initTrigger();
            this.initOverlay();

            if (this.settings.offCanvas) {
                this.initOffCanvasWrapper();
            }

            var self = this;

            $(window).on('resize', function() {
                self.updateElementsVisibility();
            });

            this.updateElementsVisibility();

            // Once everything is ready make sure the menu is visible
            this.element.css('display', 'block');
        },

        /**
         * Initialize the menu
         */
        initMenu: function () {
            var self = this;
            var size = ((this.settings.size > 100) ? 100 : this.settings.size) + '%';
            var animationSpeed = this.getAnimationSpeed();

            // Init the navigation
            this.element.find('.level_1').each(function() {
                self.initMenuNavigation($(this));
            });

            // Init the close buttons
            this.element.find('[data-mobile-menu="close"]').on('click', function(e) {
                e.preventDefault();
                self.hideMenu();
            });

            // Set the position CSS class
            this.element.addClass('position_' + this.settings.position);

            // Append the menu to <body>
            this.element.appendTo('body');

            switch (this.settings.position) {
                case 'left':
                    this.element.css({'left': 0, 'top': 0, 'width': size, 'height': '100%'});
                    this.element.css(this.getCssTranslateRules('-100%', 0));
                    break;

                case 'top':
                    this.element.css({'left': 0, 'top': 0, 'height': size, 'width': '100%'});
                    this.element.css(this.getCssTranslateRules(0, '-100%'));
                    break;

                case 'bottom':
                    this.element.css({'left': 0, 'bottom': 0, 'height': size, 'width': '100%'});
                    this.element.css(this.getCssTranslateRules(0, '100%'));
                    break;

                case 'right':
                    this.element.css({'right': 0, 'top': 0, 'width': size, 'height': '100%'});
                    this.element.css(this.getCssTranslateRules('100%', 0));
                    break;
            }

            this.element.css({
                '-webkit-backface-visibility': 'hidden',
                '-moz-backface-visibility': 'hidden',
                '-ms-backface-visibility': 'hidden',
                '-o-backface-visibility': 'hidden',
                'backface-visibility': 'hidden'
            });

            // Enable animation
            if (animationSpeed) {
                this.element.css({
                    '-webkit-transition': '-webkit-transform ' + animationSpeed + 'ms ease',
                    '-moz-transition': '-moz-transform ' + animationSpeed + 'ms ease',
                    '-o-transition': '-o-transform ' + animationSpeed + 'ms ease',
                    'transition': 'transform ' + animationSpeed + 'ms ease'
                });
            }
        },

        /**
         * Initialize the navigation in the menu
         *
         * @param {object} navigation
         */
        initMenuNavigation: function (navigation) {
            var self = this;
            var subMenus = navigation.children('.submenu');

            subMenus.each(function() {
                var item = $(this);
                var link = item.children('a, span').eq(0);

                // Open the submenu of the active item
                if (link.hasClass('active') || link.hasClass('trail')) {
                    item.addClass(self.settings.menuSubNavigationCssClass);
                }

                // Open the submenu on click
                link.on('click', function(e) {
                    var parent = $(this).parent();

                    if (!parent.hasClass(self.settings.menuSubNavigationCssClass)) {
                        e.preventDefault();
                        subMenus.removeClass(self.settings.menuSubNavigationCssClass);
                        parent.addClass(self.settings.menuSubNavigationCssClass);
                    }
                });

                var subNavigation = item.children('ul').eq(0);

                //  Recursively init sub navigation
                if (subNavigation) {
                    self.initMenuNavigation(subNavigation);
                }
            });
        },

        /**
         * Initialize the trigger
         */
        initTrigger: function () {
            if (!this.settings.trigger) {
                return;
            }

            var self = this;

            this.settings.trigger.on('click', function() {
                self.toggleMenu();
            });
        },

        /**
         * Initialize the off canvas wrapper
         */
        initOffCanvasWrapper: function () {
            var animationSpeed = this.getAnimationSpeed();
            var wrapper = $('<div>', {'class': this.settings.offCanvasWrapperClass});

            // Create the wrapper if it does not exist
            if (!this.settings.offCanvasWrapper.parent().hasClass(this.settings.offCanvasWrapperClass)) {
                this.settings.offCanvasWrapper.wrap(wrapper);
            }

            // Add CSS to the content wrapper
            this.settings.offCanvasWrapper.css({
                '-webkit-transform': 'translate3d(0, 0, 0)',
                '-moz-transform': 'translate3d(0, 0, 0)',
                '-ms-transform': 'translate3d(0, 0, 0)',
                '-o-transform': 'translate3d(0, 0, 0)',
                'transform': 'translate3d(0, 0, 0)',
                '-webkit-backface-visibility': 'hidden',
                '-moz-backface-visibility': 'hidden',
                '-ms-backface-visibility': 'hidden',
                '-o-backface-visibility': 'hidden',
                'backface-visibility': 'hidden'
            });

            // Enable animation
            if (animationSpeed > 0) {
                this.settings.offCanvasWrapper.css({
                    '-webkit-transition': '-webkit-transform ' + animationSpeed + 'ms ease',
                    '-moz-transition': '-moz-transform ' + animationSpeed + 'ms ease',
                    '-o-transition': '-o-transform ' + animationSpeed + 'ms ease',
                    'transition': 'transform ' + animationSpeed + 'ms ease'
                });
            }

            switch (this.settings.position) {
                case 'left':
                    this.settings.offCanvasWrapper.css('left', 0);
                    break;

                case 'top':
                    this.settings.offCanvasWrapper.css('top', 0);
                    break;

                case 'bottom':
                    this.settings.offCanvasWrapper.css('bottom', 0);
                    break;

                case 'right':
                    this.settings.offCanvasWrapper.css('right', 0);
                    break;
            }
        },

        /**
         * Initialize the overlay
         */
        initOverlay: function () {
            var self = this;
            var cssClass = this.settings.overlayCssClass;

            // Mark the background as active
            if (this.settings.overlay) {
                cssClass = cssClass + ' ' + this.settings.overlayBackgroundCssClass;
            }

            this.overlay = $('<div>', {
                'id': this.element.attr('id') + '-overlay',
                'class': cssClass
            }).on('click', function() {
                self.hideMenu();
            }).hide().appendTo('body');
        },

        /**
         * Update the visibility of the elements depending
         * on the break point settings and the current window size
         */
        updateElementsVisibility: function () {
            if (this.getViewportWidth() <= this.settings.breakPoint) {
                this.showTrigger();
            } else {
                this.hideMenu();
                this.hideTrigger();
            }
        },

        /**
         * Get the correct viewport width in pixels
         *
         * @see http://stackoverflow.com/a/22161545/3628692
         *
         * @return {int}
         */
        getViewportWidth: function () {
            var body  = $('body');
            var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

            // Fix the bug in Safari 9 and IE (the initial window.innerWidth value can be incorrect)
            if (body.hasClass('sf9') || body.hasClass('ie')) {
                width = document.documentElement.clientWidth || document.body.clientWidth;
            }

            return width;
        },

        /**
         * Show the trigger
         */
        showTrigger: function() {
            if (!this.settings.trigger) {
                return;
            }

            this.settings.trigger.show();
        },

        /**
         * Hide the trigger
         */
        hideTrigger: function() {
            if (!this.settings.trigger) {
                return;
            }

            this.settings.trigger.hide();
        },

        /**
         * Show the overlay
         */
        showOverlay: function() {
            if (!this.overlay) {
                return;
            }

            this.overlay.show();
            this.overlay.addClass(this.settings.overlayActiveCssClass);
        },

        /**
         * Hide the overlay
         */
        hideOverlay: function() {
            if (!this.overlay) {
                return;
            }

            this.overlay.hide();
            this.overlay.removeClass(this.settings.overlayActiveCssClass);
        },

        /**
         * Show the menu
         */
        showMenu: function () {
            switch (this.settings.position) {
                case 'left':
                    this.element.css(this.getCssTranslateRules(0, 0, true));

                    if (this.settings.offCanvas) {
                        this.settings.offCanvasWrapper.css(this.getCssTranslateRules(this.settings.size + '%', 0, true));
                    }
                    break;

                case 'top':
                    this.element.css(this.getCssTranslateRules(0, 0, true));

                    if (this.settings.offCanvas) {
                        this.settings.offCanvasWrapper.css(this.getCssTranslateRules(0, ($(window).height() * (this.settings.size / 100)) + 'px', true));
                    }
                    break;

                case 'bottom':
                    this.element.css(this.getCssTranslateRules(0, 0, true));

                    if (this.settings.offCanvas) {
                        this.settings.offCanvasWrapper.css(this.getCssTranslateRules(0, (-1 * $(window).height() * (this.settings.size / 100)) + 'px', true));
                    }
                    break;

                case 'right':
                    this.element.css(this.getCssTranslateRules(0, 0, true));

                    if (this.settings.offCanvas) {
                        this.settings.offCanvasWrapper.css(this.getCssTranslateRules((-1 * this.settings.size) + '%', 0, true));
                    }
                    break;
            }

            this.showOverlay();
            this.element.addClass(this.settings.menuActiveClass);

            // Add class to trigger
            if (this.settings.trigger) {
                this.settings.trigger.addClass(this.settings.menuActiveClass);
            }
        },

        /**
         * Hide the menu
         */
        hideMenu: function () {
            switch (this.settings.position) {
                case 'left':
                    this.element.css(this.getCssTranslateRules('-100%', 0, true));

                    if (this.settings.offCanvas) {
                        this.settings.offCanvasWrapper.css(this.getCssTranslateRules(0, 0, true));
                    }
                    break;

                case 'top':
                    this.element.css(this.getCssTranslateRules(0, '-100%', true));

                    if (this.settings.offCanvas) {
                        this.settings.offCanvasWrapper.css(this.getCssTranslateRules(0, 0, true));
                    }
                    break;

                case 'bottom':
                    this.element.css(this.getCssTranslateRules(0, '100%', true));

                    if (this.settings.offCanvas) {
                        this.settings.offCanvasWrapper.css(this.getCssTranslateRules(0, 0, true));
                    }
                    break;

                case 'right':
                    this.element.css(this.getCssTranslateRules('100%', 0, true));

                    if (this.settings.offCanvas) {
                        this.settings.offCanvasWrapper.css(this.getCssTranslateRules(0, 0, true));
                    }
                    break;
            }

            this.hideOverlay();
            this.element.removeClass(this.settings.menuActiveClass);

            // Remove the class from trigger
            if (this.settings.trigger) {
                this.settings.trigger.removeClass(this.settings.menuActiveClass);
            }
        },

        /**
         * Toggle the menu
         */
        toggleMenu: function () {
            if (this.isActive()) {
                this.hideMenu();
            } else {
                this.showMenu();
            }
        },

        /**
         * Return true if the menu is active
         *
         * @return {bool}
         */
        isActive: function () {
            return this.element.hasClass(this.settings.menuActiveClass);
        },

        /**
         * Get the CSS translate3d rules
         *
         * @param {int} x
         * @param {int} y
         * @param {bool} scale
         *
         * @return {object}
         */
        getCssTranslateRules: function (x, y, scale) {
            scale = scale ? ' scale3d(1, 1, 1)' : '';

            return {
                '-webkit-transform': 'translate3d(' + x + ', ' + y + ', 0)' + scale,
                '-moz-transform': 'translate3d(' + x + ', ' + y + ', 0)' + scale,
                '-ms-transform': 'translate3d(' + x + ', ' + y + ', 0)' + scale,
                '-o-transform': 'translate3d(' + x + ', ' + y + ', 0)' + scale,
                'transform': 'translate3d(' + x + ', ' + y + ', 0)' + scale
            };
        },

        /**
         * Get the animation speed
         *
         * @return {int}
         */
        getAnimationSpeed: function() {
            if (!this.settings.animation) {
                return 0;
            }

            return this.settings.animationSpeed;
        }
    });

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    $.fn[pluginName] = function (options) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
            }
        });
    };
})(jQuery, window, document);