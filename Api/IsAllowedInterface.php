<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Api;

/**
 * @api
 */
interface IsAllowedInterface
{
    public function isAllowed(string $name): bool;
}
