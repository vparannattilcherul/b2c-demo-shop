<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ShopApplication;

use SprykerShop\Yves\AgentPage\Plugin\Provider\AgentPageSecurityServiceProvider;
use SprykerShop\Yves\AgentPage\Plugin\Provider\AgentPageControllerProvider;
use SprykerShop\Yves\AgentWidget\Plugin\Provider\AgentWidgetControllerProvider;
use SprykerShop\Yves\ShopApplication\Bootstrap\YvesBootstrap as SprykerYvesBootstrap;

class YvesBootstrap extends SprykerYvesBootstrap
{
    /**
     * @return void
     */
    protected function registerServiceProviders()
    {
        $this->application->register(new AgentPageSecurityServiceProvider()); # AgentFeature
    }

    /**
     * @param bool|null $isSsl
     *
     * @return \SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider[]
     */
    protected function getControllerProviderStack($isSsl)
    {
        return [
            new AgentPageControllerProvider($isSsl), #AgentFeature
            new AgentWidgetControllerProvider($isSsl), #AgentFeature
        ];
    }
}
