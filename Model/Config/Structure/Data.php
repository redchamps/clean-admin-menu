<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model\Config\Structure;

use Magento\Config\Model\Config\ScopeDefiner;
use Magento\Config\Model\Config\Structure\Data as StructureData;
use Magento\Config\Model\Config\Structure\Reader;
use Magento\Framework\Config\CacheInterface;
use Magento\Framework\Config\ScopeInterface;
use Magento\Framework\Serialize\SerializerInterface;
use RedChamps\CleanMenu\Api\IsAllowedInterface;

class Data extends StructureData
{
    /**
     * @var IsAllowedInterface
     */
    private $isAllowed;

    protected $scope;

    public function __construct(
        ScopeDefiner $scopeDefiner,
        Reader $reader,
        ScopeInterface $configScope,
        CacheInterface $cache,
        string $cacheId,
        SerializerInterface $serializer,
        IsAllowedInterface $isAllowed
    ) {
        $this->scope = $scopeDefiner->getScope();
        $this->isAllowed = $isAllowed;
        parent::__construct($reader, $configScope, $cache, $cacheId, $serializer);
    }

    public function get($path = null, $default = null)
    {
        $data = parent::get($path, $default);
        if (isset($data['tabs'], $data['sections'])) {
            $thirdPartyTabs = [];
            foreach ($data['sections'] as $sectionId => $section) {
                $sectionTab = $section['tab'] ?? '';
                if ($sectionTab && !$this->isAllowed->isAllowed($sectionTab)) {
                    if (isset($data['tabs'][$sectionTab]) && $this->isSectionVisible($section)) {
                        $section['tab_original'] = $data['tabs'][$sectionTab];
                        unset($data['tabs'][$sectionTab]);
                    }
                    $section['tab'] = 'extensions_list';
                    $thirdPartyTabs[$sectionTab][$sectionId] = $section;
                    unset($data['sections'][$sectionId]);
                }
            }
            $data['sections'] = array_merge($data['sections'], array_merge(...array_values($thirdPartyTabs)));
        }

        return $data;
    }

    protected function isSectionVisible($section)
    {
        $scope = "showIn" . ucfirst($this->scope);
        return isset($section[$scope]) && $section[$scope];
    }
}
