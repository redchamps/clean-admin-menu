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
    private const CONFIG_PATH_MAGENTO_MARKETPLACE_ENABLED = 'clean_admin_menu/marketplace/enabled';
    private const CONFIG_PATH_MAGENTO_MARKETPLACE_MOVED = 'clean_admin_menu/marketplace/move';
    private const CONFIG_PATH_ALLOWED_MENU_IDS = 'clean_admin_menu/developer/allowed_menu_ids';

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

    public function allowedMenuIds(): array
    {
        $data = $this->scopeConfig->getValue(self::CONFIG_PATH_ALLOWED_MENU_IDS);
        if (!empty($data)) {
            return preg_split('/\r\n|[\r\n]/', $data);
        }
        return [];
    }
}
