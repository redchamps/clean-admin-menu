<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu;
use Magento\Backend\Model\Menu\Builder;
use RedChamps\CleanMenu\Model\Config;

final class MenuBuilder
{
    /**
     * @param Builder $subject
     * @param Menu $result
     * @return Menu
     */
    public function afterGetResult(Builder $subject, $result): Menu
    {
        if ($result && $menuItem = $result->get(Config::MENU_ID)) {
            if (!$menuItem->hasChildren()) {
                $result->remove(Config::MENU_ID);
            }
        }
        return $result;
    }
}