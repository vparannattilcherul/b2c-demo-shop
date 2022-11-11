<?php

namespace Pyz\Zed\StringReverser\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;
use Generated\Shared\Transfer\HelloSprykerTransfer;

class StringReverserFacade extends AbstractFacade implements StringReverserFacadeInterface
{
	/**
    * @param HelloSprykerTransfer $helloSprykerTransfer
    *
    * @return HelloSprykerTransfer
    */
    public function reverseString(HelloSprykerTransfer $helloSprykerTransfer):? HelloSprykerTransfer
    {
        return $this->getFactory()
            ->createStringReverser()
            ->reverseString($helloSprykerTransfer);
    }
}