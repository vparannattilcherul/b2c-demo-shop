<?php

namespace Pyz\Zed\CompanyUserStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\CompanyUserStorage\CompanyUserStorageConfig as SprykerCompanyUserStorageConfig;

class CompanyUserStorageConfig extends SprykerCompanyUserStorageConfig
{
    public function getCompanyUserSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
