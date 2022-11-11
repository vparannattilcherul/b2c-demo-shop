<?php

namespace Pyz\Zed\StringReverser\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Pyz\Zed\StringReverser\Business\Model\StringReverser;
use Pyz\Zed\StringReverser\StringReverserDependencyProvider;

class StringReverserBusinessFactory extends AbstractBusinessFactory
{
	/**
    * @return StringReverser
    */
    public function createStringReverser()
    {
        return new StringReverser($this->getFlashMessengerFacade());
    }

    protected function getFlashMessengerFacade()
    {
        return $this->getProvidedDependency(StringReverserDependencyProvider::FACADE_MESSENGER);
    }
}