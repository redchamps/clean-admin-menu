<?php
namespace RedChamps\CleanMenu\Plugin\Block;

use Magento\Config\Block\System\Config\Tabs;

class SystemConfigTabs
{
    public function afterGetTemplate(Tabs $subject, $result)
    {
        return "RedChamps_CleanMenu::system/config/tabs.phtml";
    }
}