<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use function explode;

final class Config
{
    public const MENU_ID = 'RedChamps_CleanMenu::extensions';

    private const CONFIG_PATH_RESTRICTED_MODULES = 'extensions_list_settings/general/restricted_module';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var string[]
     */
    private $restrictedModules;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function getRestrictedModules(): array
    {
        return $this->restrictedModules
            ?? $this->restrictedModules = explode(
                ',',
                $this->scopeConfig->getValue(self::CONFIG_PATH_RESTRICTED_MODULES) ?? ''
            );
    }
}
