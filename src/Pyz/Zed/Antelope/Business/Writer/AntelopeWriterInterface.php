<?php

namespace Pyz\Zed\Antelope\Business\Writer;

use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $antelopeTransfer
     *
     */
    public function saveAntelope(AntelopeTransfer $antelopeTransfer);
}
