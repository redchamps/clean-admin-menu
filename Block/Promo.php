<?php
namespace RedChamps\CleanMenu\Block;

use Magento\Backend\Block\AbstractBlock;
use Magento\Backend\Block\Context;
use Magento\Framework\View\Page\Config;

class Promo extends AbstractBlock
{

    /**
     * @var Config
     */
    private $pageConfig;

    public function __construct(
        Config $pageConfig,
        Context $context,
        array $data = []
    ) {
        $this->pageConfig = $pageConfig;
        parent::__construct($context, $data);
    }

    /**
     * @override
     * @see \Magento\Backend\Block\AbstractBlock::_construct()
     * @return void
     */
    protected function _construct()
    {
        if($this->_scopeConfig->getValue("clean_admin_menu/settings/promo")) {
            $this->pageConfig->addPageAsset('RedChamps_CleanMenu::js/promo.js');
        }
    }
}
