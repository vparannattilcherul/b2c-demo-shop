<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Customer\Business;

use Pyz\Zed\Customer\Business\Anonymizer\CustomerAnonymizer;
use Spryker\Zed\Customer\Business\CustomerBusinessFactory as SprykerCustomerBusinessFactory;

/**
 * @method \Spryker\Zed\Customer\CustomerConfig getConfig()
 * @method \Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Customer\Persistence\CustomerEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\Customer\Persistence\CustomerRepositoryInterface getRepository()
 */
class CustomerBusinessFactory extends SprykerCustomerBusinessFactory
{
    /**
     * @return \Spryker\Zed\Customer\Business\Anonymizer\CustomerAnonymizer
     */
    public function createCustomerAnonymizer()
    {
        return new CustomerAnonymizer(
            $this->getQueryContainer(),
            $this->createCustomer(),
            $this->createAddress(),
            $this->getCustomerAnonymizerPlugins(),
        );
    }
}
