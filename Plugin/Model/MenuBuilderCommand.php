<?php
namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu\Builder\AbstractCommand;
use RedChamps\CleanMenu\Model\Config;
use RedChamps\CleanMenu\Model\IsAllowedInterface;

final class MenuBuilderCommand
{
    /**
     * @var IsAllowedInterface
     */
    private $allowedModule;

    public function __construct(
        IsAllowedInterface $allowedModule
    ) {
        $this->allowedModule = $allowedModule;
    }

    public function afterExecute(AbstractCommand $subject, $result): array
    {
        if (isset($result['module'])) {
            $moduleName = $result['module'] ?? '';
            $parentId = $result['parent'] ?? null;
            if ($parentId === null && !$this->allowedModule->isAllowed($moduleName)) {
                $result['parent'] = Config::MENU_ID;
            }
        }

        return $result;
    }
}
