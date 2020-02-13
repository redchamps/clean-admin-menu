<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

/**
 * @api
 */
interface IsAllowed
{
    public function isAllowed(string $name): bool;
}
