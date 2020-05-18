<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use RedChamps\CleanMenu\Api\IsAllowedInterface;

final class IsAllowedMenuId implements IsAllowedInterface
{
    /**
     * @var Config
     */
    private $config;

    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    public function isAllowed(string $name): bool
    {
        return in_array($name, $this->config->allowedMenuIds());
    }
}
