<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use RedChamps\CleanMenu\Api\IsAllowedInterface;
use function in_array;
use function preg_split;

final class IsAllowedMenuId implements IsAllowedInterface
{
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

    public function isAllowed(string $name): bool
    {
        return in_array($name, $this->resolveAllowedMenus(), true);
    }

    public function resolveAllowedMenus(): array
    {
        return preg_split(
            '/\r\n|[\r\n]/',
            (string) $this->scopeConfig->getValue(self::CONFIG_PATH_ALLOWED_MENU_IDS)
        ) ?: [];
    }
}
