<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu;
use Magento\Backend\Model\Menu\Builder;
use RedChamps\CleanMenu\Model\Config;

final class MenuBuilder
{
    public function afterGetResult(Builder $subject, Menu $result): Menu
    {
        if ($result && $result->get(Config::MENU_ID) && !$result->get(Config::MENU_ID)->hasChildren()) {
            $result->remove(Config::MENU_ID);
        }

        return $result;
    }
}
