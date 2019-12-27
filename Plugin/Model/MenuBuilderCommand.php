<?php
namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu\Builder\AbstractCommand;
use RedChamps\CleanMenu\Plugin\Base;

class MenuBuilderCommand extends Base
{
    public function afterExecute(AbstractCommand $subject, $result)
    {
        $moduleName = $result["module"];
        $parentId = isset($result["parent"]) ? $result["parent"] : null;
        if ($parentId == null && strpos($moduleName, "Magento_") !== 0 && $moduleName != "RedChamps_CleanMenu") {
            $result["parent"] = self::MENU_ID;
        }
        return $result;
    }
}
