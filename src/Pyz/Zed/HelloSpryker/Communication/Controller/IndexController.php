<?php

namespace Pyz\Zed\HelloSpryker\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Generated\Shared\Transfer\HelloSprykerTransfer;
use Exception;

/**
 * @method Pyz\Zed\HelloSpryker\Communication\HelloSprykerCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
        /**
    * @param Request $request
    *
    * @return array
    */
    public function reverseAction(Request $request)
    {
        return ['string' => 'Hello Spryker!'];
    }
    
    /**
    * @param Request $request
    *
    * @return array
    */
    public function indexAction(Request $request)
    {
        $stringTransfer = new HelloSprykerTransfer;
        $stringTransfer->setOriginalString($request->get('string'));
        $stringTransfer = $this->getFactory()->getStringReverserFacade()->reverseString($stringTransfer);
        
        return ['string' => $stringTransfer->getReversedString()];
    }


}