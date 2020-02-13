<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use function array_keys;

final class RuleConfig implements RuleConfigInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var ListInterface
     */
    private $list;

    /**
     * @var string[]
     */
    private $configPaths;

    /**
     * @var array
     */
    private $configCache;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ListInterface $list,
        array $configPaths
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->list = $list;
        $this->configPaths = $configPaths;
    }

    public function getRuleId(): string
    {
        return $this->configCache['ruleId'] ??
            $this->configCache['ruleId'] = (string) $this->scopeConfig->getValue($this->configPaths['ruleId']);
    }

    public function getItems(): array
    {
        return $this->configCache['items'] ??
            $this->configCache['items'] = explode(
                ',',
                $this->scopeConfig->getValue($this->configPaths['items']) ?? ''
            );
    }

    public function getDefaultItems(): array
    {
        return $this->configCache['defaultItems'] ??
            $this->configCache['defaultItems'] = array_keys($this->list->getList());
    }
}
