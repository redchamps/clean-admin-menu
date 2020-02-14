<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Api;

/**
 * @api
 */
interface IsAllowedInterface
{
    public function isAllowed(string $name): bool;
}
