<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Config\Model\Config\ScopeDefiner;
use Magento\Config\Model\Config\Structure;
use Magento\Config\Model\Config\Structure\Data;
use Magento\Config\Model\Config\Structure\Element\Iterator\Tab;
use RedChamps\CleanMenu\Model\IsAllowedInterface;

final class ConfigStructure
{
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

    /**
     * @var IsAllowedInterface
     */
    private $allowedTab;

    public function __construct(
        Data $structureData,
        Tab $tabIterator,
        ScopeDefiner $scopeDefiner,
        IsAllowedInterface $allowedTab
    ) {
        $this->structureData = $structureData;
        $this->tabIterator = $tabIterator;
        $this->scopeDefiner = $scopeDefiner;
        $this->allowedTab = $allowedTab;
    }

    public function aroundGetTabs(Structure $subject, callable $proceed)
    {
        $data = $this->structureData->get();

        if (isset($data['sections'])) {
            foreach ($data['sections'] as $sectionId => $section) {
                if (isset($section['tab']) && $section['tab']) {
                    $currentTab = $section['tab'];
                    if ($this->allowedTab->isAllowed($currentTab)) {
                        $data['tabs'][$currentTab]['children'][$sectionId] = $section;
                    } else {
                        $this->thirdPartyTabs[$currentTab][$sectionId] = $section;
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
