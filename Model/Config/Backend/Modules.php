<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model\Config\Backend;

use Magento\Backend\Block\Menu;
use Magento\Framework\App\Cache\Manager;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Value;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;

class Modules extends Value
{
    /**
     * @var Manager
     */
    private $cacheManager;

    public function __construct(
        Context $context,
        Registry $registry,
        ScopeConfigInterface $config,
        TypeListInterface $cacheTypeList,
        Manager $cacheManager,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->cacheManager = $cacheManager;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    public function afterSave()
    {
        if ($this->isValueChanged()) {
            $this->cacheManager->flush([Menu::CACHE_TAGS]);
        }

        return $this;
    }
}
