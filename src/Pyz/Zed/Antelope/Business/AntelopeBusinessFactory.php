<?php

namespace Pyz\Zed\Antelope\Business;

use Pyz\Zed\Antelope\Business\Reader\AntelopeReader;
use Pyz\Zed\Antelope\Business\Reader\AntelopeReaderInterface;
use Pyz\Zed\Antelope\Business\Writer\AntelopeWriter;
use Pyz\Zed\Antelope\Business\Writer\AntelopeWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeQueryContainerInterface getQueryContainer()
 */
class AntelopeBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\Antelope\Business\Reader\AntelopeReaderInterface
     */
    public function createAntelopeReader(): AntelopeReaderInterface
    {
        return new AntelopeReader(
            $this->getRepository()
        );
    }

    /**
     * @return \Pyz\Zed\Antelope\Business\Writer\AntelopeWriterInterface
     */
    public function createAntelopeWriter(): AntelopeWriterInterface
    {
        return new AntelopeWriter(
            $this->getRepository()
        );
    }
}
