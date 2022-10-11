<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Antelope\Communication\Form\DataProvider;

use Pyz\Zed\Antelope\Persistence\AntelopeQueryContainerInterface;
use Pyz\Zed\Antelope\Communication\Form\AntelopeForm;

class AttributeFormDataProvider
{
    /**
     * @var \Pyz\Zed\Antelope\Persistence\AntelopeQueryContainerInterface
     */
    protected $antelopeQueryContainer;

    /**
     * @param \Pyz\Zed\Antelope\Persistence\AntelopeQueryContainerInterface
     */
    public function __construct(
        AntelopeQueryContainerInterface $antelopeQueryContainer
    ) {
        $this->antelopeQueryContainer = $antelopeQueryContainer;
    }

    /**
     * @param int|null idAntelope
     *
     * @return array
     */
    public function getData($idAntelope = null)
    {
        $antelopeEntity = $this->getAntelopeEntity($idAntelope);
        return [
            AntelopeForm::FIELD_ID_ANTELOPE => $antelopeEntity->getIdAntelope(),
            AntelopeForm::FIELD_NAME => $antelopeEntity->getName(),
            AntelopeForm::FIELD_COLOR => $antelopeEntity->getColor(),
        ];
    }

    /**
     * @param int $idAntelope
     *
     * @return \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttribute|null
     */
    protected function getAntelopeEntity(int $idAntelope)
    {
        return $this->antelopeQueryContainer
            ->queryAntelopes()
            ->findOneByIdAntelope($idAntelope);
    }
}
