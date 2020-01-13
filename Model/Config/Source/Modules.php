<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use RedChamps\CleanMenu\Model\CustomModuleList;

final class Modules implements OptionSourceInterface
{
    /**
     * @var CustomModuleList
     */
    private $customModuleList;

    /**
     * @var string[][]
     */
    private $options;

    public function __construct(
        CustomModuleList $customModuleList
    ) {
        $this->customModuleList = $customModuleList;
    }

    public function toOptionArray(): array
    {
        return $this->options ?? $this->options = $this->loadOptions();
    }

    private function loadOptions(): array
    {
        $options = [];

        foreach ($this->customModuleList->getList() as $module) {
            $options[] = ['label' => $module, 'value' => $module];
        }

        return $options;
    }
}
