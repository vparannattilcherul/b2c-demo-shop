<?php

namespace Pyz\Zed\Application\Communication\Controller;

use Spryker\Zed\Application\Communication\Controller\IndexController as SprykerIndexController;

class IndexController extends SprykerIndexController

{
    /**
	 * @return string
	 */
	public function indexAction()
	{
		die('Hello DE Store!');
	}

}
