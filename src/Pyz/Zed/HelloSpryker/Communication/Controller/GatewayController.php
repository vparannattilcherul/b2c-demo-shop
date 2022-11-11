<?php


namespace Pyz\Zed\HelloSpryker\Communication\Controller;

use Generated\Shared\Transfer\HelloSprykerTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

class GatewayController extends AbstractGatewayController
{
    /**
    * @param HelloSprykerTransfer $helloSprykerTransfer
    *
    * @return HelloSprykerTransfer
    */
    public function reverseStringAction(HelloSprykerTransfer $helloSprykerTransfer)
    {
	    return $this->getFactory()->getStringReverserFacade()->reverseString($helloSprykerTransfer);
    }
}