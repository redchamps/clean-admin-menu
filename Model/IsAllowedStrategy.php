<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use RedChamps\CleanMenu\Api\IsAllowedInterface;
use RedChamps\CleanMenu\Spi\RuleConfigInterface;

/**
 * @api
 */
final class IsAllowedStrategy implements IsAllowedInterface
{
    /**
     * @var IsAllowedInterface
     */
    private $isAllowed;

    public function __construct(
        RuleFactory $ruleFactory,
        RuleConfigInterface $config
    ) {
        $this->isAllowed = $ruleFactory->create(
            $config->getRuleId(),
            ['defaultItems' => $config->getDefaultItems(), 'items' => $config->getItems()]
        );
    }

    public function isAllowed(string $name): bool
    {
        return $this->isAllowed->isAllowed($name);
    }
}
