<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAccess\Business\Installer;

use Spryker\Zed\CustomerAccess\Business\Installer\CustomerAccessInstaller as SprykerCustomerAccessInstaller;

class CustomerAccessInstaller extends SprykerCustomerAccessInstaller
{
    protected const ALERT_MESSAGE = 'The current value of access type %s is %s. It will be changed to %s';

    /**
     * @return void
     */
    public function install(): void
    {
        $contentTypeAccess = $this->customerAccessConfig->getContentTypeAccess();
        $contentAccessByType = $this->customerAccessConfig->getContentAccessByType();

        foreach ($this->customerAccessConfig->getContentTypes() as $contentType) {
            if (($customerAccessTransfer = $this->customerAccessReader->findCustomerAccessByContentType($contentType)) !== null) {
                if ($customerAccessTransfer->getIsRestricted() == $contentAccessByType[$contentType]) {
                    $existingContentTypeValueToString = $customerAccessTransfer->getIsRestricted() ? 'Restricted' : 'Allowed';
                    $contentTypeValueToString = $contentAccessByType[$contentType] ? 'Allowed' : 'Restricted';
                    print sprintf(static::ALERT_MESSAGE . PHP_EOL,
                        $contentType,
                        $existingContentTypeValueToString,
                        $contentTypeValueToString
                    );
                }
            }
            $isGranted = $contentAccessByType[$contentType] ?? $contentTypeAccess;

            $this->customerAccessCreator->createCustomerAccess($contentType, !$isGranted);
        }
    }
}
