<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Customer\Business;

use Spryker\Zed\Customer\Business\CustomerFacade as SprykerCustomerFacade;

class CustomerFacade extends SprykerCustomerFacade
{
    public function sendCustomMail()
    {
        $this->getFactory()->createCustomer()->sendCustomMail();
    }
}