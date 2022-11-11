<?php

namespace Pyz\Zed\Customer\Communication\Controller;

use Spryker\Zed\Customer\Communication\Controller\IndexController as SprykerIndexController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method Pyz\Zed\HelloSpryker\Communication\HelloSprykerCommunicationFactory getFactory()
 */
class IndexController extends SprykerIndexController
{
    /**
    * @param Request $request
    *
    * @return array
    */
    public function testAction(Request $request)
    {
        // $stringTransfer = new HelloSprykerTransfer;
        // $stringTransfer->setOriginalString($request->get('string'));
        // $stringTransfer = $this->getFactory()->getStringReverserFacade()->reverseString($stringTransfer);
        $this->getFacade()->sendCustomMail();
        return ['string' => 'Mail successfully sent.'];
    }


}