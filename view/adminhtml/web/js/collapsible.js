/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */

require([
    "jquery",
    "collapsible",
    "domReady!"
], function ($) {
    "use strict";

    $("[data-role=ext-tabs]").collapsible({
        "openedState": "_show",
        "closedState": "_hide",
        "collapsible": true,
        "animate": 200
    });
    $(".rc-section-title ._active").closest(".rc-section-title").collapsible("activate");
});
