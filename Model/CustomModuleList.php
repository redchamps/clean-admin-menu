<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Component\ComponentRegistrarInterface;
use RedChamps\CleanMenu\Spi\ListInterface;
use function array_combine;
use function array_filter;
use function array_keys;
use function strlen;
use function strncmp;
use const ARRAY_FILTER_USE_KEY;

final class CustomModuleList implements ListInterface
{
    private const MAGENTO_MODULE_PREFIX = 'Magento_';
    private const MODULE_NAME = 'RedChamps_CleanMenu';

    /**
     * @var ComponentRegistrarInterface
     */
    private $componentRegistrar;

    /**
     * @var string[]
     */
    private $list;

    public function __construct(
        ComponentRegistrarInterface $componentRegistrar
    ) {
        $this->componentRegistrar = $componentRegistrar;
    }

    public function getList(): array
    {
        return $this->list ?? $this->list = $this->prepareList();
    }

    private function prepareList(): array
    {
        $modules = $this->resolveCustomModules();

        return array_combine($modules, $modules);
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
