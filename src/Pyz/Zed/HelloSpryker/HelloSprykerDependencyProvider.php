<?php

namespace Pyz\Zed\HelloSpryker;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class HelloSprykerDependencyProvider extends AbstractBundleDependencyProvider
{
    const FACADE_STRING_REVERSER = 'FACADE_STRING_REVERSER';

    /**
    * @param \Spryker\Zed\Kernel\Container $container
    *
    * @return \Spryker\Zed\Kernel\Container
    */
    public function provideCommunicationLayerDependencies(Container $container)
    {
	    $container = $this->addStringReverserFacade($container);

	    return $container;
    }

    /**
    * @param \Spryker\Zed\Kernel\Container $container
    *
    * @return \Spryker\Zed\Kernel\Container
    */
    protected function addStringReverserFacade(Container $container)
    {
	    $container[static::FACADE_STRING_REVERSER] = function (Container $container) {
		    return $container->getLocator()->stringReverser()->facade();
	    };

	    return $container;
    }
}																	