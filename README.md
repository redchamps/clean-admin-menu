# Clean Admin Menu - Magento 2 Extension

[![Latest Stable Version](https://img.shields.io/packagist/v/redchamps/module-clean-admin-menu.svg?style=flat-square)](https://packagist.org/packages/redchamps/module-clean-admin-menu)
[![License: MIT](https://img.shields.io/github/license/redchamps/clean-admin-menu.svg?style=flat-square)](./LICENSE)
[![Packagist](https://img.shields.io/packagist/dt/redchamps/module-clean-admin-menu.svg?style=flat-square)](https://packagist.org/packages/redchamps/module-clean-admin-menu/stats)
[![Packagist](https://img.shields.io/packagist/dm/redchamps/module-clean-menu.svg?style=flat-square)](https://packagist.org/packages/redchamps/module-clean-admin-menu/stats)
<img src="https://img.shields.io/badge/magento-2.4.0%E2%80%932.4.8+-brightgreen.svg?logo=magento&longCache=true&style=flat-square" alt="Supported Magento Versions" />

## Overview

Clean Admin Menu is a Magento 2 extension that organizes and simplifies your admin panel by consolidating third-party extension menus. It follows Magento's best practices for admin menu organization by:

1. Merging all third-party extension menu items into a single "**Extensions**" menu item in the backend's primary navigation
2. Consolidating third-party extension configuration tabs under `Stores > Configuration` into a single "**Extensions**" tab
3. Placing the consolidated "Extensions" tab after native Magento tabs

This organization aligns with Magento's official [Admin Best Practices](https://developer.adobe.com/commerce/php/best-practices/admin/placement-and-design/#feature-extensions) for feature-level extensions.

## Features

- Consolidates all third-party extension menus into a single "Extensions" section
- Organizes extension configuration settings under a unified tab
- Follows Magento's recommended admin menu structure
- Customizable menu organization through admin configuration
- Compatible with Magento 2.4.0 through 2.4.8+

## Installation

Install via Composer:

```bash
composer require redchamps/module-clean-admin-menu
```

After installation:
1. Run `bin/magento setup:upgrade`
2. Run `bin/magento setup:di:compile`
3. Run `bin/magento cache:clean`

## Configuration

Access the extension settings at:
> Stores > Configuration > Extensions > RedChamps > Clean Admin Menu

### Available Settings:
- Menu organization preferences
- Configuration tab placement
- Developer tools for custom menu ID management

## Visual Examples

### Main Navigation
![Primary Navigation](https://raw.githubusercontent.com/redchamps/repo-images/master/after-primary-menu.png)

### Extensions Configuration
![System Config](https://raw.githubusercontent.com/redchamps/repo-images/master/after-system-config.png)

### Before and After Comparison
![Before and after comparison](https://raw.githubusercontent.com/redchamps/repo-images/master/before-after.gif)

## Troubleshooting

If any extension menu item is not automatically moved under the "Extensions" menu:

1. Navigate to: Stores > Configuration > Extensions > RedChamps > Clean Admin Menu > Developer Tools
2. Find the menu ID of the extension that needs to be moved
3. Add the menu ID to the "Move Menu ID's" setting

## Requirements

- Magento 2.4.0 or higher
- PHP 7.4 or higher

## Support

- [GitHub Issues](https://github.com/redchamps/clean-admin-menu/issues/)
- [Documentation](https://redchamps.com/clean-admin-menu-magento-2-extension.html)
- [Contact Support](mailto:hello@redchamps.com)

## Authors

- **RedChamps** [Maintainer] [![Twitter Follow](https://img.shields.io/twitter/follow/_redChamps.svg?style=social)](https://twitter.com/_redChamps)
- **Ravinder** [Maintainer] [![Twitter Follow](https://img.shields.io/twitter/follow/_iAmRav.svg?style=social)](https://twitter.com/_iAmRav)
- **Thomas Klein** [Contributor] [![Twitter Follow](https://img.shields.io/twitter/follow/lead_dave.svg?style=social)](https://twitter.com/lead_dave)
- **Prince Antil** [Contributor] [![Twitter Follow](https://img.shields.io/twitter/follow/prince_antil.svg?style=social)](https://twitter.com/prince_antil)

## License

This project is licensed under the MIT License - see the [LICENSE](./LICENSE) file for details.

## More Extensions

Visit our [store](https://redchamps.com) for more free and paid Magento 2 extensions.
