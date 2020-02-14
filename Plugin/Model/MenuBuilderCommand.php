<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu\Builder\AbstractCommand;
use RedChamps\CleanMenu\Api\IsAllowedInterface;
use RedChamps\CleanMenu\Model\Config;

final class MenuBuilderCommand
{
    /**
     * @var IsAllowedInterface
     */
    private $isAllowed;

    public function __construct(
        IsAllowedInterface $isAllowed
    ) {
        $this->isAllowed = $isAllowed;
    }

    public function afterExecute(AbstractCommand $subject, $result): array
    {
        if (isset($result['module'])) {
            $moduleName = $result['module'] ?? '';
            $parentId = $result['parent'] ?? null;
            if ($parentId === null && !$this->isAllowed->isAllowed($moduleName)) {
                $result['parent'] = Config::MENU_ID;
            }
        }

        return $result;
    }
}
