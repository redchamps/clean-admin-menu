<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

final class Config
{
    public const MENU_ID = 'RedChamps_CleanMenu::extensions';
    private const CONFIG_PATH_MAGENTO_MARKETPLACE_ENABLED = 'clean_admin_menu/settings/enable_marketplace';
    private const CONFIG_PATH_MAGENTO_MARKETPLACE_MOVED = 'clean_admin_menu/settings/move_marketplace';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function isMagentoMarketplaceEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::CONFIG_PATH_MAGENTO_MARKETPLACE_ENABLED);
    }

    public function isMagentoMarketplaceMoved(): bool
    {
        return $this->scopeConfig->isSetFlag(self::CONFIG_PATH_MAGENTO_MARKETPLACE_MOVED);
    }
}
