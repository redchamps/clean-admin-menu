<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu;
use Magento\Backend\Model\Menu\Builder;
use RedChamps\CleanMenu\Model\Config;

final class MenuBuilder
{
    public function afterGetResult(Builder $subject, Menu $result): Menu
    {
        $shouldRemoveMenu = false;
        if ($result && $result->get(Config::MENU_ID) &&
            !$result->get(Config::MENU_ID)->hasChildren()
        ) {
            $shouldRemoveMenu = true;
        } elseif ($result && $result->get(Config::MENU_ID)) {
            foreach ($result->get(Config::MENU_ID)->getChildren() as $child) {
                $shouldRemoveMenu = false;
                if ($child->isAllowed()) {
                    break;
                }
                $shouldRemoveMenu = true;
            }
        }
        if($shouldRemoveMenu) {
            $result->remove(Config::MENU_ID);
        }

        return $result;
    }
}
