<?php

namespace Pyz\Yves\HelloSpryker\Controller;

use Generated\Shared\Transfer\HelloSprykerTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

    /**
    * @method \Pyz\Client\HelloSpryker\HelloSprykerClientInterface getClient()
    */
    class IndexController extends AbstractController
    {
    /**
    * @param Request $request
    *
    * @return \Spryker\Yves\Kernel\View\View
    */
    public function indexAction(Request $request)
    {
	    $helloSprykerTransfer = new HelloSprykerTransfer();
        $helloSprykerTransfer->setOriginalString($request->get('string'));

        $helloSprykerTransfer = $this->getClient()
            ->reverseString($helloSprykerTransfer);

        $data = ['reversedString' => $helloSprykerTransfer->getReversedString()];
	    return $this->view(
		    $data,
		    [],
		    '@HelloSpryker/views/index/index.twig'
	    );
    }
}