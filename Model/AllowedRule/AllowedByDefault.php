<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model\AllowedRule;

use RedChamps\CleanMenu\Api\IsAllowedInterface;
use function in_array;

/**
 * This rule has the following behavior:
 *    - The value is allowed if it exists in the default list.
 *    - The value is allowed if it does not exists in the forbidden list.
 */
final class AllowedByDefault implements IsAllowedInterface
{
    public const RULE_CODE = 'allowedByDefault';

    /**
     * @var string[]
     */
    private $forbiddenList;

    public function __construct(array $items)
    {
        $this->forbiddenList = $items;
    }

    public function isAllowed(string $name): bool
    {
        return !in_array($name, $this->forbiddenList, true);
    }
}
