<?php

namespace Pyz\Zed\Antelope\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Antelope\Communication\AntelopeCommunicationFactory getFactory()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeQueryContainerInterface getQueryContainer()
 */
class EditController extends AbstractController
{
    public const ID_ANTELOPE = 'id-antelope';

    public const MESSAGE_UPDATE_SUCCESS = 'The antelope has been updated successfully';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request)
    {
        $idAntelope = $this->castId($request->query->get(self::ID_ANTELOPE));

        $dataProvider = $this
            ->getFactory()
            ->createAttributeFormDataProvider();

        $antelopeForm = $this
            ->getFactory()
            ->getAttributeForm($dataProvider->getData($idAntelope))
            ->handleRequest($request);

        if (!$antelopeForm->isSubmitted() || !$antelopeForm->isValid()) {
            return $this->viewResponse([
                'form' => $antelopeForm->createView(),
            ]);
        }

        $antelopeTransfer = $this->getFactory()
            ->createAttributeFormTransferGenerator()
            ->createTransfer($antelopeForm);

        $this->getFacade()
            ->updateAntelope($antelopeTransfer);

        $this->addSuccessMessage(static::MESSAGE_UPDATE_SUCCESS);

        return $this->redirectResponse(sprintf(
            '/antelope/edit?id-antelope=%d',
            $antelopeTransfer->getIdAntelope()
        ));
    }

}
