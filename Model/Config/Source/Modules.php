<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model\Config\Source;

use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Component\ComponentRegistrarInterface;
use Magento\Framework\Data\OptionSourceInterface;
use function array_filter;
use function array_keys;
use function strlen;
use function strncmp;
use const ARRAY_FILTER_USE_KEY;

final class Modules implements OptionSourceInterface
{
    private const MAGENTO_MODULE_PREFIX = 'Magento_';
    private const MODULE_NAME = 'RedChamps_CleanMenu';

    /**
     * @var ComponentRegistrarInterface
     */
    private $componentRegistrar;

    /**
     * @var string[][]
     */
    private $options;

    public function __construct(
        ComponentRegistrarInterface $componentRegistrar
    ) {
        $this->componentRegistrar = $componentRegistrar;
    }

    public function toOptionArray(): array
    {
        return $this->options ?? $this->options = $this->loadOptions();
    }

    private function loadOptions(): array
    {
        $options = [];

        foreach ($this->resolveCustomModules() as $module) {
            $options[] = ['label' => $module, 'value' => $module];
        }

        return $options;
    }

    private function resolveCustomModules(): array
    {
        return array_keys(array_filter(
            $this->componentRegistrar->getPaths(ComponentRegistrar::MODULE),
            static function (string $moduleName): bool {
                return strncmp($moduleName, self::MAGENTO_MODULE_PREFIX, strlen(self::MAGENTO_MODULE_PREFIX)) !== 0
                    && $moduleName !== self::MODULE_NAME;
            },
            ARRAY_FILTER_USE_KEY
        ));
    }
}
