<?php

namespace Pyz\Zed\HelloSpryker\Communication;
use Pyz\Zed\HelloSpryker\HelloSprykerDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class HelloSprykerCommunicationFactory extends AbstractCommunicationFactory
{
    public function getStringReverserFacade()
    {
       return $this->getProvidedDependency(HelloSprykerDependencyProvider::FACADE_STRING_REVERSER);
    }
}