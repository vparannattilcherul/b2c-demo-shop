<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAccess\Business;

use Spryker\Zed\CustomerAccess\Business\CustomerAccessBusinessFactory as SprykerCustomerAccessBusinessFactory;
use Spryker\Zed\CustomerAccess\Business\Installer\CustomerAccessInstallerInterface;

use Pyz\Zed\CustomerAccess\Business\Installer\CustomerAccessInstaller;

class CustomerAccessBusinessFactory extends SprykerCustomerAccessBusinessFactory
{
    /**
     * @return \Spryker\Zed\CustomerAccess\Business\Installer\CustomerAccessInstallerInterface
     */
    public function createInstaller(): CustomerAccessInstallerInterface
    {
        return new CustomerAccessInstaller(
            $this->getConfig(),
            $this->createCustomerAccessCreator(),
            $this->createCustomerAccessReader()
        );
    }
}
