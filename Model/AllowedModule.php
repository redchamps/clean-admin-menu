<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use function in_array;

final class AllowedModule
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var CustomModuleList
     */
    private $customModuleList;

    public function __construct(
        Config $config,
        CustomModuleList $customModuleList
    ) {
        $this->config = $config;
        $this->customModuleList = $customModuleList;
    }

    public function isAllowed(string $moduleName): bool
    {
        return !in_array($moduleName, $this->customModuleList->getList(), true)
            || in_array($moduleName, $this->config->getAllowedModules(), true);
    }
}
