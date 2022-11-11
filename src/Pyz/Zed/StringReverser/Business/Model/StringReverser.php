<?php

namespace Pyz\Zed\StringReverser\Business\Model;
use Generated\Shared\Transfer\HelloSprykerTransfer;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Spryker\Zed\Messenger\Business\MessengerFacade as FlashMessengerFacade;
use Generated\Shared\Transfer\MessageTransfer;

class StringReverser
{
    protected $flashMessengerFacade;

    public function __construct(FlashMessengerFacade $flashMessengerFacade)
    {
        $this->flashMessengerFacade = $flashMessengerFacade;
    }


    public function reverseString(HelloSprykerTransfer $helloSprykerTransfer):? HelloSprykerTransfer
    {
        if (!$helloSprykerTransfer->getOriginalString()) {
            $messageTransfer = new MessageTransfer;
            $messageTransfer->setValue('String not found!');
            $this->flashMessengerFacade->addErrorMessage($messageTransfer);
        }
        return $helloSprykerTransfer->setReversedString(strrev($helloSprykerTransfer->getOriginalString()));
    }
}