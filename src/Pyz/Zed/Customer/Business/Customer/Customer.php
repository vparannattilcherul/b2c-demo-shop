<?php

namespace Pyz\Zed\Customer\Business\Customer;

use Spryker\Zed\Customer\Business\Customer\Customer as SprykerCustomer;
use Pyz\Zed\Customer\Communication\Plugin\Mail\CustomMailTypePlugin;
use Generated\Shared\Transfer\MailTransfer;

class Customer extends SprykerCustomer
{
    public function sendCustomMail()
    {
        $mailTransfer = new MailTransfer();
        $mailTransfer->setType(CustomMailTypePlugin::MAIL_TYPE);

        $this->mailFacade->handleMail($mailTransfer);
    }
}