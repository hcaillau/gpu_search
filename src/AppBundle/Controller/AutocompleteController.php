<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Autocomplétion sur certains champs
 */
class AutocompleteController extends BaseController
{
    /**
     * @Route("/api/autocomplete/document/organisme", name="api_autocomplete_document_organisme", methods={"GET","HEAD"})
     */
    public function autocompleteOrganismeAction(Request $request)
    {
        $term = $request->get('term');
        $result = $this->getDocumentIndex()->autocomplete('organisme',$term);
        return new JsonResponse($result);
    }

     /**
     * @Route("/api/autocomplete/document/title", name="api_autocomplete_document_title", methods={"GET","HEAD"})
     */
    public function autocompleteTitleAction(Request $request)
    {
        $term = $request->get('term');
        $result = $this->getDocumentIndex()->autocomplete('title',$term);
        return new JsonResponse($result);
    }

    /**
     * @return DocumentIndex
     */
    protected function getDocumentIndex(){
        return $this->get('app.index.document');
    }

}