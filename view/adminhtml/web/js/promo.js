require([
    'jquery',
    'domReady!'
    ], function ($){
    $(
        '<div class="powered-by">' +
        '   <span>' +
        '      Menu powered by' +
        '      <a href="https://redchamps.com?utm_source=clean-admin-menu-main-menu" target="_blank">redChamps</a>' +
        '   </span>' +
        '</div>'
    ).insertAfter("#menu-redchamps-cleanmenu-extensions > .submenu > .submenu-title");

    $("#system_config_tabs > .rc-cam-tab > .admin__page-nav-items").append(
        '<div class="powered-by">' +
        '   <span>' +
        '      Section powered by' +
        '      <a href="https://redchamps.com?utm_source=clean-admin-menu-tab" target="_blank">redChamps</a>' +
        '   </span>' +
        '</div>'
    );
});
