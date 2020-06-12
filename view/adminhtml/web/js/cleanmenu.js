require([
    'jquery',
    'collapsible',  // the alias for "mage/collapsible"
    'domReady'
], function ($) {
    $('[data-role=ext-tabs]') // we expect that page contains the <tag data-role="example">..</tag> markup
        .collapsible({ // now we can use "accordion" as jQuery plugin
            "openedState": "_show",
            "closedState": "_hide",
            "collapsible": true,
            "animate": 200
        });
    $('._active').closest('.rc-section-title').collapsible('activate');
});
