<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Customer\Business\Anonymizer;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Customer\Business\Anonymizer\CustomerAnonymizer as SprykerAnonymizer;

class CustomerAnonymizer extends SprykerAnonymizer
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function process(CustomerTransfer $customerTransfer)
    {
        // overriding logic
    }
}
