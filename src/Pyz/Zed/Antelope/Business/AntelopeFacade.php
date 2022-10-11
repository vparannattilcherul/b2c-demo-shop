<?php

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeBusinessFactory getFactory()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */
class AntelopeFacade extends AbstractFacade implements AntelopeFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $antelopeTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeTransfer
     */
    public function getAntelope(AntelopeTransfer $antelopeTransfer)
    {
        return $this->getFactory()
            ->createAntelopeReader()
            ->getAntelope($antelopeTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $antelopeTransfer
     *
     * @return bool
     */
    public function updateAntelope($antelopeTransfer)
    {
        return $this->getFactory()
            ->createAntelopeWriter()
            ->saveAntelope($antelopeTransfer);
    }
}
