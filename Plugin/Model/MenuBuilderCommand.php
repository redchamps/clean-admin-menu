<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu\Builder\AbstractCommand;
use RedChamps\CleanMenu\Model\AllowedModule;
use RedChamps\CleanMenu\Model\Config;

final class MenuBuilderCommand
{
    /**
     * @var AllowedModule
     */
    private $allowedModule;

    public function __construct(
        AllowedModule $allowedModule
    ) {
        $this->allowedModule = $allowedModule;
    }

    public function afterExecute(AbstractCommand $subject, $result): array
    {
        if (isset($result['module'])) {
            $moduleName = $result['module'] ?? '';
            $parentId = $result['parent'] ?? null;
            if ($parentId === null && $this->allowedModule->isAllowed($moduleName)) {
                $result['parent'] = Config::MENU_ID;
            }
        }

        return $result;
    }
}
