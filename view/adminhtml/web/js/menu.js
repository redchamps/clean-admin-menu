require([
    'jquery'
    ], function ($){
    $(
        '<div class="powered-by">' +
        '   <span>' +
        '      Menu powered by' +
        '      <a href="https://redchamps.com?utm_source=clean-admin-menu-main-menu" target="_blank">redChamps</a>' +
        '   </span>' +
        '</div>'
    ).insertAfter("#menu-redchamps-cleanmenu-extensions > .submenu > .submenu-title");
});
