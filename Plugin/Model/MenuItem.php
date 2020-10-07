<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu\Item;
use RedChamps\CleanMenu\Model\Config;
use function reset;

final class MenuItem
{
    public function afterGetChildren(Item $subject, $result)
    {
        if ($subject->getId() === Config::MENU_ID) {
            $firstItem = reset($result);
            if ($firstItem && $firstItem->getId()) {
                $firstItem->setTooltip(Config::MENU_ID);
            }
        }

        return $result;
    }

    /*
     * Force allowed ACL for Extensions menu
     * */
    public function afterIsAllowed(Item $subject, $result)
    {
        $menuItemData = $subject->toArray();
        if(isset($menuItemData["resource"]) && $menuItemData["resource"] == Config::MENU_ID) {
            return true;
        }
        return $result;
    }
}
