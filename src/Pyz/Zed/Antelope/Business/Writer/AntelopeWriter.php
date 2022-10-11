<?php

namespace Pyz\Zed\Antelope\Business\Writer;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

class AntelopeWriter implements AntelopeWriterInterface
{
    /**
     * @var \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface
     */
    protected $antelopeRepository;

    /**
     * @param \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface $antelopeRepository
     */
    public function __construct(AntelopeRepositoryInterface $antelopeRepository)
    {
        $this->antelopeRepository = $antelopeRepository;
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $antelopeTransfer
     */
    public function  saveAntelope(AntelopeTransfer $antelopeTransfer)
    {
        $antelope = $this->antelopeRepository->getAntelopeEntityFromId($antelopeTransfer->getIdAntelope());
        $antelope->fromArray($antelopeTransfer->toArray());
        $antelope->save();
    }
}
