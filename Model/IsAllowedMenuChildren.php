<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use Magento\Backend\Model\Menu\Item;

final class IsAllowedMenuChildren
{
    public function execute(Item $menuItem): bool
    {
        foreach ($menuItem->getChildren() as $child) {
            if ($child->isAllowed() && !$child->isDisabled()) {
                return true;
            }
        }

        return false;
    }
}
