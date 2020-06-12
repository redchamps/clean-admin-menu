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

    /**
     * @var RuleFactory
     */
    private $ruleFactory;

    /**
     * @var RuleConfigInterface
     */
    private $config;

    public function __construct(
        RuleFactory $ruleFactory,
        RuleConfigInterface $config
    ) {
        $this->ruleFactory = $ruleFactory;
        $this->config = $config;
    }

    public function isAllowed(string $name): bool
    {
        if (!$this->isAllowed) {
            $this->isAllowed = $this->ruleFactory->create(
                $this->config->getRuleId(),
                ['defaultItems' => $this->config->getDefaultItems(), 'items' => $this->config->getItems()]
            );
        }

        return $this->isAllowed->isAllowed($name);
    }
}
