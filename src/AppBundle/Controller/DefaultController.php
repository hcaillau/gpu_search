<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Form\Data\DocumentSearch;
use AppBundle\Form\Type\DocumentSearchType;

/**
 * Démonstrateur
 */
class DefaultController extends BaseController
{
    /**
     * Affichage d'un formulaire de recherche des documents et des résultats
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $documentSearch = new DocumentSearch();
        $form = $this->createForm(DocumentSearchType::class,$documentSearch);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchResult = $this->getDocumentIndex()->search($documentSearch);
        }else{
            // on lance une recherche avec un DocumentSearch vide
            $documentSearch = new DocumentSearch();
            $searchResult = $this->getDocumentIndex()->search($documentSearch);
        }
        return $this->render('default/index.html.twig', array(
            'searchResult' => $searchResult,
            'documentSearch' => $documentSearch,
            'form' => $form->createView(),
        ));
    }

}
