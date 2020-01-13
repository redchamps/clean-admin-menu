<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu\Builder\AbstractCommand;
use RedChamps\CleanMenu\Model\Config;
use function in_array;

final class MenuBuilderCommand
{
    /**
     * @var Config
     */
    private $config;

    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    public function afterExecute(AbstractCommand $subject, $result): array
    {
        if (isset($result['module'])) {
            $moduleName = $result['module'] ?? '';
            $parentId = $result['parent'] ?? null;
            if ($parentId === null && in_array($moduleName, $this->config->getRestrictedModules(), true)) {
                $result['parent'] = Config::MENU_ID;
            }
        }

        return $result;
    }
}
