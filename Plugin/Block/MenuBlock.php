<?php
namespace RedChamps\CleanMenu\Plugin\Block;

use Magento\Backend\Block\Menu;
use RedChamps\CleanMenu\Plugin\Base;

class MenuBlock extends Base
{
    public function beforeRenderNavigation(Menu $subject, $menu, $level = 0, $limit = 0, $colBrakes = [])
    {
        $firstItem = $this->getFirstItem($menu);
        if ($firstItem && $firstItem->toArray()['toolTip'] == self::MENU_ID) {
            $level = $level == 1 ? 0 : $level;
        }
        return [$menu, $level, $limit, $colBrakes];
    }
}
