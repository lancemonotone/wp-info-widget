/**
 * Front-end JavaScript
 *
 * @version 1.0.0
 * @since 1.0.0
 */

// IIFE - Immediately Invoked Function Expression
(function (yourcode) {

    // The global jQuery object is passed as a parameter
    yourcode(window.jQuery, window, document);

}(function ($) {

    // The $ is now locally scoped
    // Listen for the jQuery ready event on the document
    $(function () {
        // console.log('The DOM is ready');

        $('.meerkat-info-widget').meerkatExpander();

    });

    // console.log('The DOM may not be ready');
    // The rest of code goes here!

}));

// Meerkat Expander
(function ($) {

    // here we go!
    $.meerkatExpander = function (element, options) {

        // plugin's default options
        // this is private property and is  accessible only from inside the plugin
        var defaults = {};

        // to avoid confusions, use "plugin" to reference the
        // current instance of the object
        var plugin = this;

        // this will hold the merged default, and user-provided options
        // plugin's properties will be available through this object like:
        // plugin.settings.propertyName from inside the plugin or
        // element.data('meerkatExpander').settings.propertyName from outside the plugin,
        // where "element" is the element the plugin is attached to;
        plugin.settings = {};

        var $ul = $(element).find('ul');
        var $element = $(element).find('li');
        var $targets = $(element).find('.target');
        var orientation;
        var collapse = parseInt($ul.data('collapse'));
        var is_mobile = $('html').hasClass('ui-mobile');


        // the "constructor" method that gets called when the object is created
        plugin.init = function () {
            // the plugin's final properties are the merged default and
            // user-provided options (if any)
            plugin.settings = $.extend({}, defaults, options);

            // Vertical layout is impractical on mobile devices, so force horizontal.
            if (is_mobile == true) {
                orientation = 'horizontal';
                $ul.removeClass('vertical');
            } else {
                orientation = $ul.data('orientation');
            }

            // Set height of content area to be the height of the containing UL.
            if (orientation === 'vertical') {
                doResize();
                $(window).resize(doResize());
            }

            // code goes here
            if (collapse == 0) {
                $element.first().find('.trigger').addClass('active');
                doExpand($element.not(':first-child').find('.target'), 0);
            } else {
                doExpand($element.find('.target'), 0);
            }

            $element.find('.trigger').click(function () {
                var $trigger = $(this);
                var $parent = $trigger.parent();
                var $target = $trigger.next('.target');

                if (!$target.is(':visible')) {
                    // close all
                    doExpand($(element).find('.target'), 0);
                    $('.active', $element).removeClass('active');
                    // expand current
                    doExpand($target, 1);
                    $trigger.addClass('active');
                } else if (orientation == 'horizontal') {
                    // close current
                    doExpand($target, 0);
                    $('.active', $parent).removeClass('active');
                }
            });
        };

        // private methods
        // these methods can be called only from inside the plugin like:
        // methodName(arg1, arg2, ... argn)

        var doResize = function () {
            var $firstTarget = $targets.first();
            var borderBottom = parseInt($firstTarget.css('border-bottom-width')) * 2;
            var padding = parseInt($firstTarget.css('padding-top')) + parseInt($firstTarget.css('padding-bottom'));
            $targets.height($ul.height() - padding - borderBottom);
        };

        // a private method. for demonstration purposes only - remove it!
        var doExpand = function ($target, open) {
            switch (open) {
                case 0:
                    if (orientation == 'horizontal') {
                        $target.slideUp('fast').removeClass('open');
                    } else {
                        $target.fadeOut('fast').removeClass('open');
                    }
                    break;
                case 1:
                    if (orientation == 'horizontal') {
                        $target.slideDown('fast').addClass('open');
                    } else {
                        $target.fadeIn('fast').removeClass('open');
                    }
                    break;
            }

        };

        // fire up the plugin!
        // call the "constructor" method
        plugin.init();

    };

    // add the plugin to the jQuery.fn object
    $.fn.meerkatExpander = function (options) {
        if (undefined == options) {
            options = {}
        }
        options.selector = this.selector;
        // iterate through the DOM elements we are attaching the plugin to
        return this.each(function () {

            // if plugin has not already been attached to the element
            if (undefined == $(this).data('meerkatExpander')) {

                // create a new instance of the plugin
                // pass the DOM element and the user-provided options as arguments
                var plugin = new $.meerkatExpander(this, options);

                // in the jQuery version of the element
                // store a reference to the plugin object
                // you can later access the plugin and its methods and properties like
                // element.data('meerkatExpander').publicMethod(arg1, arg2, ... argn) or
                // element.data('meerkatExpander').settings.propertyName
                $(this).data('meerkatExpander', plugin);

            }

        });

    }

})(jQuery);