<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

final class IsAllowedStrategy implements IsAllowedInterface
{
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
        return $this->resolveRule()->isAllowed($name);
    }

    private function resolveRule(): IsAllowedInterface
    {
        return $this->ruleFactory->create(
            $this->config->getRuleId(),
            ['defaultItems' => $this->config->getDefaultItems(), 'items' => $this->config->getItems()]
        );
    }
}
