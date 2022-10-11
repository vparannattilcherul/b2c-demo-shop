<?php

namespace Pyz\Zed\DataImport\Business\Model\Antelope;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

use Pyz\Zed\Antelope\Dependency\AntelopeEvents;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;

class AntelopeWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    public const KEY_NAME = 'name';
    public const KEY_COLOR = 'color';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     * @throws \Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException
     *
     */
    public function execute(DataSetInterface $dataSet)
    {
        $antelopeEntity = PyzAntelopeQuery::create()
            ->filterByName($dataSet[static::KEY_NAME])
            ->findOneOrCreate();

        $antelopeEntity->setColor($dataSet[static::KEY_COLOR]);

        if ($antelopeEntity->isNew() || $antelopeEntity->isModified()) {
            $antelopeEntity->save();
        }

        $this->addPublishEvents(AntelopeEvents::ENTITY_PYZ_ANTELOPE_CREATE, $antelopeEntity->getIdAntelope());
    }
}
