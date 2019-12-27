<?php
namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu\Item;
use RedChamps\CleanMenu\Plugin\Base;

class MenuItem extends Base
{
    public function afterGetChildren(Item $subject, $result)
    {
        if ($subject->getId() == self::MENU_ID) {
            $firstItem = $this->getFirstItem($result);
            if ($firstItem && $firstItem->getId()) {
                $firstItem->setTooltip($subject->getId());
            }
        }
        return $result;
    }
}
