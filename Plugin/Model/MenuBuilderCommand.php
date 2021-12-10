<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu\Builder\AbstractCommand;
use RedChamps\CleanMenu\Model\Config;
use RedChamps\CleanMenu\Model\IsAllowedMenuId;
use RedChamps\CleanMenu\Model\IsAllowedModule;

final class MenuBuilderCommand
{
    /**
     * @var IsAllowedModule
     */
    private $isAllowedModule;

    /**
     * @var IsAllowedMenuId
     */
    private $isAllowedMenuId;

    public function __construct(
        IsAllowedModule $isAllowedModule,
        IsAllowedMenuId $isAllowedMenuId
    ) {
        $this->isAllowedModule = $isAllowedModule;
        $this->isAllowedMenuId = $isAllowedMenuId;
    }

    public function afterExecute(AbstractCommand $subject, $result): array
    {
        if ((isset($result['id']) && $this->isAllowedMenuId->isAllowed($result['id'])) ||
            (
                isset($result['module']) &&
                !($result['parent'] ?? '') &&
                !$this->isAllowedModule->isAllowed($result['module'])
            )
        ) {
            $result['parent'] = Config::MENU_ID;
        }

        return $result;
    }
}
