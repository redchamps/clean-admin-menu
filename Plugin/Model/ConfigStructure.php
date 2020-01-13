<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Config\Model\Config\ScopeDefiner;
use Magento\Config\Model\Config\Structure;
use Magento\Config\Model\Config\Structure\Data;
use Magento\Config\Model\Config\Structure\Element\Iterator\Tab;
use function in_array;

final class ConfigStructure
{
    /**
     * @var string[]
     */
    private const CORE_TABS = [
        'general',
        'catalog',
        'customer',
        'sales',
        'advanced',
        'service',
        'security',
        'yotpo',
        'ddg_automation'
    ];

    /**
     * @var array
     */
    private $thirdPartyTabs = [];

    /**
     * @var Data
     */
    private $structureData;

    /**
     * Config tab iterator
     *
     * @var Tab
     */
    private $tabIterator;

    /**
     * @var ScopeDefiner
     */
    private $scopeDefiner;

    public function __construct(
        Data $structureData,
        Tab $tabIterator,
        ScopeDefiner $scopeDefiner
    ) {
        $this->structureData = $structureData;
        $this->tabIterator = $tabIterator;
        $this->scopeDefiner = $scopeDefiner;
    }

    public function aroundGetTabs(Structure $subject, callable $proceed)
    {
        $data = $this->structureData->get();
        
        if (isset($data['sections'])) {
            foreach ($data['sections'] as $sectionId => $section) {
                if (isset($section['tab']) && $section['tab']) {
                    if (in_array($section['tab'], self::CORE_TABS, true)) {
                        $data['tabs'][$section['tab']]['children'][$sectionId] = $section;
                    } else {
                        $this->thirdPartyTabs[$section['tab']][$sectionId] = $section;
                    }
                }
            }
            foreach ($this->thirdPartyTabs as $sections) {
                $titleAdded = false;
                foreach ($sections as $section) {
                    if (!$titleAdded) {
                        $section['tab_original'] = $data['tabs'][$section['tab']];
                    }
                    $titleAdded = true;
                    $data['tabs']['extensions_list']['children'][$section['id']] = $section;
                }
            }
            $this->tabIterator->setElements($data['tabs'], $this->scopeDefiner->getScope());
        }

        return $this->tabIterator;
    }
}
