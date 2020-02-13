<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

/**
 * @api
 */
interface IsAllowedInterface
{
    public function isAllowed(string $name): bool;
}
