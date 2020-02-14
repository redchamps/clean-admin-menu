<?php
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
}
