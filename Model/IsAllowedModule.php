<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use RedChamps\CleanMenu\Api\IsAllowedInterface;

final class IsAllowedModule implements IsAllowedInterface
{
    private const MODULE_NAME = 'Magento_Marketplace';

    /**
     * @var IsAllowedInterface
     */
    private $isAllowed;

    /**
     * @var Config
     */
    private $config;

    public function __construct(
        IsAllowedInterface $isAllowed,
        Config $config
    ) {
        $this->isAllowed = $isAllowed;
        $this->config = $config;
    }

    public function isAllowed(string $name): bool
    {
        $isAllowed = true;

        if ($name === self::MODULE_NAME) {
            $isAllowed = !$this->config->isMagentoMarketplaceMoved();
        }

        return $isAllowed && $this->isAllowed->isAllowed($name);
    }
}
