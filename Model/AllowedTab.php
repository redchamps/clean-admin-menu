<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use function in_array;

final class AllowedTab implements IsAllowed
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var CustomTabList
     */
    private $customTabList;

    public function __construct(
        Config $config,
        CustomTabList $customTabList
    ) {
        $this->config = $config;
        $this->customTabList = $customTabList;
    }

    public function isAllowed(string $tabName): bool
    {
        return !in_array($tabName, $this->customTabList->getList(), true)
            || in_array($tabName, $this->config->getAllowedTabs(), true);
    }
}
