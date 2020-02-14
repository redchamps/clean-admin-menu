<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model\AllowedRule;

use RedChamps\CleanMenu\Api\IsAllowedInterface;
use function array_diff;
use function in_array;

/**
 * This rule has the following behavior:
 *    - The value is allowed if it does not exists in the default list.
 *    - The value is allowed if it does exists in the allowed list.
 */
final class DeniedByDefault implements IsAllowedInterface
{
    public const RULE_CODE = 'deniedByDefault';

    /**
     * @var string[]
     */
    private $forbiddenList;

    public function __construct(array $defaultItems, array $items)
    {
        $this->forbiddenList = array_diff($defaultItems, $items);
    }

    public function isAllowed(string $name): bool
    {
        return !in_array($name, $this->forbiddenList, true);
    }
}
