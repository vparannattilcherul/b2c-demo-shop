<?php

namespace Pyz\Zed\Antelope\Communication\Mapper;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Communication\Mapper\AntelopesMapperInterface;
use Symfony\Component\Form\FormInterface;

class AntelopeMapper implements AntelopesMapperInterface
{
    /**
     * @param \Symfony\Component\Form\FormInterface $attributeForm
     *
     * @return \Generated\Shared\Transfer\ProductManagementAttributeTransfer
     */
    public function createTransfer(FormInterface $attributeForm)
    {
        print_r($attributeForm->getData());
        $attributeTransfer = (new AntelopeTransfer())
            ->fromArray($attributeForm->getData(), true);

        return $attributeTransfer;
    }
}
