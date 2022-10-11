<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeRepository extends AbstractRepository implements AntelopeRepositoryInterface
{
    /**
     * @param int $idAntelope
     *
     * @return \Generated\Shared\Transfer\AntelopeTransfer|null
     */
    public function findAntelopeById(int $idAntelope): ?AntelopeTransfer
    {
        $antelopeEntity = $this->getAntelopeEntityFromId($idAntelope);

        if ($antelopeEntity === null) {
            return null;
        }

        $antelopeTransfer = new AntelopeTransfer();

        return $antelopeTransfer->fromArray($antelopeEntity->toArray());
    }

    public function getAntelopeEntityFromId(int $idAntelope)
    {
        return $this->getFactory()
            ->createPyzAntelopeQuery()
            ->filterByIdAntelope($idAntelope)
            ->findOneOrCreate();
    }
}
