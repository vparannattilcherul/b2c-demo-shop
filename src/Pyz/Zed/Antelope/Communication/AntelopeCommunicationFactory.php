<?php

namespace Pyz\Zed\Antelope\Communication;

use Pyz\Zed\Antelope\Communication\Table\AntelopeTable;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Pyz\Zed\Antelope\Communication\Form\DataProvider\AttributeFormDataProvider;
use Pyz\Zed\Antelope\Communication\Form\AntelopeForm;
use Pyz\Zed\Antelope\Communication\Mapper\AntelopeMapper;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeQueryContainerInterface getQueryContainer()
 */
class AntelopeCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Pyz\Zed\Antelope\Communication\Table\AntelopeTable
     */
    public function createAntelopeTable()
    {
        return new AntelopeTable(
            $this->getQueryContainer()
        );
    }

    /**
     * @return \Spryker\Zed\ProductAttributeGui\Communication\Form\DataProvider\AttributeFormDataProvider
     */
    public function createAttributeFormDataProvider()
    {
        return new AttributeFormDataProvider(
            $this->getQueryContainer()
        );
    }

    /**
     * @param array $data
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getAttributeForm(array $data = [], array $options = [])
    {
        return $this->getFormFactory()->create(AntelopeForm::class, $data, $options);
    }

    /**
     * @return \Pyz\Zed\Antelope\Communication\Mapper\AntelopeMapperInterface
     */
    public function createAttributeFormTransferGenerator()
    {
        return new AntelopeMapper;
    }
}
