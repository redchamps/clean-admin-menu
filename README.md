# Clean Admin Menu - Magento 2 Extension 

[![Latest Stable Version](https://img.shields.io/packagist/v/redchamps/module-clean-admin-menu.svg?style=flat-square)](https://packagist.org/packages/redchamps/module-clean-admin-menu)
[![License: MIT](https://img.shields.io/github/license/redchamps/clean-admin-menu.svg?style=flat-square)](./LICENSE) 
[![Packagist](https://img.shields.io/packagist/dt/redchamps/module-clean-admin-menu.svg?style=flat-square)](https://packagist.org/packages/redchamps/module-clean-admin-menu/stats)
[![Packagist](https://img.shields.io/packagist/dm/redchamps/module-clean-admin-menu.svg?style=flat-square)](https://packagist.org/packages/redchamps/module-clean-admin-menu/stats)

It will merge all 3rd party extension's menu items in backend's primary menu to a common menu item named "**Extensions**". It will also merge different 3rd party extension tabs under path 
> Stores > Configuration 

to a single tab named "**Extensions**" and place it after native Magento tabs.

Did you knwo this module makes the "Extensions" level entry true? As explained in the Magento official documentation, the best practice is to live feature-level extensions under a single "extensions" level: [Admin Best Practices](https://developer.adobe.com/commerce/php/best-practices/admin/placement-and-design/#feature-extensions).

>
> Feature Extensions
>
> These are extensions which provide additional functionality that do not already exist as a feature. These extensions usually demand an additional primary navigation item.
> 
> Placement:  
> 
> There will be a new, dedicated section designed for such exclusive extensions. When feature-level extensions are installed, those extensions will live under this section. The exact final name of this new section has not been decided (we welcome your feedback), but in the image below it is named Extensions.
>
> ![Feature Placement](https://developer.adobe.com/commerce/php/static/69d88b5949fc0871abfe8f55a5a55a17/78631/feature-placement.webp)
>

## Screenshots
### Main Navigation
![Primary Navigation](https://raw.githubusercontent.com/redchamps/repo-images/master/after-primary-menu.png)

### Extensions configuration

![System Config](https://raw.githubusercontent.com/redchamps/repo-images/master/after-system-config.png)

## Comparision - admin before this extension and after

![Before and after comparision](https://raw.githubusercontent.com/redchamps/repo-images/master/before-after.gif)

## Installation

> composer require redchamps/module-clean-admin-menu

## Configuration

Various settings to tweak the extension behaviour are located under admin path

> Store > Configuration > Extensions > RedChamps > Clean Admin Menu 

## Troubleshooting

If any extension menu item is not moved under "Extensions" menu then just find its menu id and enter it in setting

> Store > Configuration > Extensions > RedChamps > Clean Admin Menu > Developer Tools > Move Menu ID's 

## Authors

- RedChamps [Maintainer] [![Twitter Follow](https://img.shields.io/twitter/follow/_redChamps.svg?style=social)](https://twitter.com/_redChamps)

- Ravinder [Maintainer] [![Twitter Follow](https://img.shields.io/twitter/follow/_iAmRav.svg?style=social)](https://twitter.com/_iAmRav)

- Thomas Klein [Contributor] [![Twitter Follow](https://img.shields.io/twitter/follow/lead_dave.svg?style=social)](https://twitter.com/lead_dave)

- Prince Antil [Contributor] [![Twitter Follow](https://img.shields.io/twitter/follow/prince_antil.svg?style=social)](https://twitter.com/prince_antil)

## License

This project is licensed under the MIT License - see the [LICENSE](./LICENSE) details.

## ADS

Please visit our [store](https://redchamps.com) for more free/paid extensions from us.
