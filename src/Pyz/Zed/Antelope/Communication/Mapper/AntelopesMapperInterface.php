<?php

namespace Pyz\Zed\Antelope\Communication\Mapper;

use Symfony\Component\Form\FormInterface;

interface AntelopesMapperInterface
{
    /**
     * @param \Symfony\Component\Form\FormInterface $attributeForm
     *
     * @return \Generated\Shared\Transfer\ProductManagementAttributeTransfer
     */
    public function createTransfer(FormInterface $attributeForm);
}
