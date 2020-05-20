<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use RedChamps\CleanMenu\Api\IsAllowedInterface;

final class IsAllowedModule implements IsAllowedInterface
{
    private const MODULE_NAME = 'Magento_Marketplace';

    private const CONFIG_PATH_MAGENTO_MARKETPLACE_MOVED = 'clean_admin_menu/marketplace/move';

    /**
     * @var IsAllowedInterface
     */
    private $isAllowed;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(
        IsAllowedInterface $isAllowed,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->isAllowed = $isAllowed;
        $this->scopeConfig = $scopeConfig;
    }

    public function isAllowed(string $name): bool
    {
        $isAllowed = true;

        if ($name === self::MODULE_NAME) {
            $isAllowed = !$this->scopeConfig->isSetFlag(self::CONFIG_PATH_MAGENTO_MARKETPLACE_MOVED);
        }

        return $isAllowed && $this->isAllowed->isAllowed($name);
    }
}
