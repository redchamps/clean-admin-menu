<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu;
use Magento\Backend\Model\Menu\Item;
use RedChamps\CleanMenu\Model\Config;
use RedChamps\CleanMenu\Model\IsAllowedMenuId;
use RedChamps\CleanMenu\Model\IsAllowedModule;

class MenuPlugin
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

    public function beforeAdd(Menu $subject, Item $item, $parentId = null, $index = null): array
    {
        if ($parentId === null &&
            $subject->get(Config::MENU_ID) &&
            (
                $this->isAllowedMenuId->isAllowed($item->getId()) ||
                !$this->isAllowedModule->isAllowed($item->toArray()['module'])
            )
        ) {
            $parentId = Config::MENU_ID;
        }

        return [$item, $parentId, $index];
    }
}
