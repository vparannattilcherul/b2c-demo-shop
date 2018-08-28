<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductSet\Business\Model;

use Generated\Shared\Transfer\EventEntityTransfer;
use Generated\Shared\Transfer\ProductSetTransfer;
use Orm\Zed\ProductSet\Persistence\SpyProductAbstractSet;
use Orm\Zed\ProductSet\Persistence\SpyProductSet;
use Spryker\Zed\Event\Business\EventFacadeInterface;
use Spryker\Zed\Product\Dependency\ProductEvents;
use Spryker\Zed\ProductSet\Business\Model\Data\ProductSetDataUpdaterInterface;
use Spryker\Zed\ProductSet\Business\Model\Image\ProductSetImageSaverInterface;
use Spryker\Zed\ProductSet\Business\Model\ProductSetEntityReaderInterface;
use Spryker\Zed\ProductSet\Business\Model\ProductSetUpdater as SprykerProductSetUpdater;
use Spryker\Zed\ProductSet\Business\Model\Touch\ProductSetTouchInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;

class ProductSetUpdater extends SprykerProductSetUpdater
{
    use DatabaseTransactionHandlerTrait;

    /**
     * @var \Spryker\Zed\ProductSet\Business\Model\ProductSetEntityReaderInterface
     */
    protected $productSetEntityReader;

    /**
     * @var \Spryker\Zed\ProductSet\Business\Model\Data\ProductSetDataUpdaterInterface
     */
    protected $productSetDataUpdater;

    /**
     * @var \Spryker\Zed\ProductSet\Business\Model\Touch\ProductSetTouchInterface
     */
    protected $productSetTouch;

    /**
     * @var \Spryker\Zed\ProductSet\Business\Model\Image\ProductSetImageSaverInterface
     */
    protected $productSetImageSaver;

    /**
     * @var \Spryker\Zed\Event\Business\EventFacadeInterface
     */
    protected $eventFacade;

    /**
     * @param \Spryker\Zed\ProductSet\Business\Model\ProductSetEntityReaderInterface $productSetEntityReader
     * @param \Spryker\Zed\ProductSet\Business\Model\Data\ProductSetDataUpdaterInterface $productSetDataUpdater
     * @param \Spryker\Zed\ProductSet\Business\Model\Image\ProductSetImageSaverInterface $productSetImageSaver
     * @param \Spryker\Zed\ProductSet\Business\Model\Touch\ProductSetTouchInterface $productSetTouch
     * @param \Spryker\Zed\Event\Business\EventFacadeInterface $eventFacade
     */
    public function __construct(
        ProductSetEntityReaderInterface $productSetEntityReader,
        ProductSetDataUpdaterInterface $productSetDataUpdater,
        ProductSetImageSaverInterface $productSetImageSaver,
        ProductSetTouchInterface $productSetTouch,
        EventFacadeInterface $eventFacade
    ) {
        $this->productSetEntityReader = $productSetEntityReader;
        $this->productSetDataUpdater = $productSetDataUpdater;
        $this->productSetTouch = $productSetTouch;
        $this->productSetImageSaver = $productSetImageSaver;
        $this->eventFacade = $eventFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductSetTransfer $productSetTransfer
     *
     * @return \Generated\Shared\Transfer\ProductSetTransfer
     */
    public function updateProductSet(ProductSetTransfer $productSetTransfer)
    {
        return $this->handleDatabaseTransaction(function () use ($productSetTransfer) {
            return $this->executeUpdateProductSetTransaction($productSetTransfer);
        });
    }

    /**
     * @param \Generated\Shared\Transfer\ProductSetTransfer $productSetTransfer
     *
     * @return \Generated\Shared\Transfer\ProductSetTransfer
     */
    protected function executeUpdateProductSetTransaction(ProductSetTransfer $productSetTransfer)
    {
        $productSetEntity = $this->productSetEntityReader->getProductSetEntity($productSetTransfer);

        $this->updateSpyProductSetEntity($productSetEntity, $productSetTransfer);
        $this->updateProductAbstractSetEntities($productSetEntity, $productSetTransfer);
        $this->updateProductSetData($productSetEntity, $productSetTransfer);
        $this->updateImageSets($productSetTransfer);
        $this->touchProductSet($productSetTransfer);

        return $productSetTransfer;
    }

    /**
     * @param \Orm\Zed\ProductSet\Persistence\SpyProductSet $productSetEntity
     * @param \Generated\Shared\Transfer\ProductSetTransfer $productSetTransfer
     *
     * @return void
     */
    protected function updateSpyProductSetEntity(SpyProductSet $productSetEntity, ProductSetTransfer $productSetTransfer)
    {
        $productSetEntity->fromArray($productSetTransfer->modifiedToArray());
        $productSetEntity->save();
    }

    /**
     * @param \Orm\Zed\ProductSet\Persistence\SpyProductSet $productSetEntity
     * @param \Generated\Shared\Transfer\ProductSetTransfer $productSetTransfer
     *
     * @return void
     */
    protected function updateProductAbstractSetEntities(SpyProductSet $productSetEntity, ProductSetTransfer $productSetTransfer)
    {
        if (!$productSetTransfer->isPropertyModified(ProductSetTransfer::ID_PRODUCT_ABSTRACTS)) {
            return;
        }

        $this->cleanProductAbstractSets($productSetEntity);

        $abstractIds = [];
        if (!$productSetEntity->getSpyProductAbstractSets()->isEmpty()) {
            foreach ($productSetEntity->getSpyProductAbstractSets() as $productAbstractSets) {
                $abstractIds[] = $productAbstractSets->getFkProductAbstract();
            }
        }
        $idProductAbstracts = array_values($productSetTransfer->getIdProductAbstracts());
        foreach ($idProductAbstracts as $index => $idProductAbstract) {
            $position = $index + 1;
            $productAbstractSetEntity = $this->createProductAbstractSetEntity($idProductAbstract, $position);
            $productSetEntity->addSpyProductAbstractSet($productAbstractSetEntity);
            $abstractIds[] = $productAbstractSetEntity->getFkProductAbstract();
        }

        foreach ($abstractIds as $id) {
            $this->eventFacade->trigger(ProductEvents::PRODUCT_ABSTRACT_PUBLISH, (new EventEntityTransfer())->setId($id));
        }

        $productSetEntity->save();
    }

    /**
     * @param \Orm\Zed\ProductSet\Persistence\SpyProductSet $productSetEntity
     *
     * @return void
     */
    protected function cleanProductAbstractSets(SpyProductSet $productSetEntity)
    {
        $productSetEntity->getSpyProductAbstractSets()->delete();
    }

    /**
     * @param int $idProductAbstract
     * @param int $position
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSet
     */
    protected function createProductAbstractSetEntity($idProductAbstract, $position)
    {
        $productAbstractSetEntity = new SpyProductAbstractSet();
        $productAbstractSetEntity
            ->setFkProductAbstract($idProductAbstract)
            ->setPosition($position);

        return $productAbstractSetEntity;
    }

    /**
     * @param \Orm\Zed\ProductSet\Persistence\SpyProductSet $productSetEntity
     * @param \Generated\Shared\Transfer\ProductSetTransfer $productSetTransfer
     *
     * @return void
     */
    protected function updateProductSetData(SpyProductSet $productSetEntity, ProductSetTransfer $productSetTransfer)
    {
        foreach ($productSetTransfer->getLocalizedData() as $localizedProductSetTransfer) {
            $this->productSetDataUpdater->updateProductSetData($localizedProductSetTransfer, $productSetEntity->getIdProductSet());
        }
    }

    /**
     * @param \Generated\Shared\Transfer\ProductSetTransfer $productSetTransfer
     *
     * @return void
     */
    protected function updateImageSets(ProductSetTransfer $productSetTransfer)
    {
        if (!$productSetTransfer->isPropertyModified(ProductSetTransfer::IMAGE_SETS)) {
            return;
        }

        $this->productSetImageSaver->saveImageSets($productSetTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductSetTransfer $productSetTransfer
     *
     * @return void
     */
    protected function touchProductSet(ProductSetTransfer $productSetTransfer)
    {
        $this->productSetTouch->touchProductSetByStatus($productSetTransfer);
    }
}
