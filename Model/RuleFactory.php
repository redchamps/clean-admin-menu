<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use Magento\Framework\ObjectManagerInterface;
use RedChamps\CleanMenu\Api\IsAllowedInterface;

final class RuleFactory
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string[]
     */
    private $rules;

    public function __construct(
        ObjectManagerInterface $objectManager,
        array $rules
    ) {
        $this->objectManager = $objectManager;
        $this->rules = $rules;
    }

    public function create(string $ruleId, array $arguments): IsAllowedInterface
    {
        return $this->objectManager->create($this->rules[$ruleId], $arguments);
    }
}
