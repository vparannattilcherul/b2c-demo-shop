<?php
namespace Pyz\Zed\StringReverser\Business;

use Generated\Shared\Transfer\HelloSprykerTransfer;

interface StringReverserFacadeInterface
{
    public function reverseString(HelloSprykerTransfer $helloSprykerTransfer):? HelloSprykerTransfer;
}