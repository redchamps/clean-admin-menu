require([
    'jquery',
    'collapsible',
    'domReady'
], function ($) {
    $('[data-role=ext-tabs]')
        .collapsible({
            "openedState": "_show",
            "closedState": "_hide",
            "collapsible": true,
            "animate": 200
        });
    $('.rc-section-title ._active').closest('.rc-section-title').collapsible('activate');
});
