<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use function array_key_exists;
use function in_array;

final class AllowedModule implements IsAllowed
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
        return !array_key_exists($moduleName, $this->customModuleList->getList())
            || in_array($moduleName, $this->config->getAllowedModules(), true);
    }
}
