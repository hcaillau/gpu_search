<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Form\Data\DocumentSearch;

use Symfony\Component\HttpFoundation\Response;

/**
 * API publique pour la recherche de document
 */
class SearchController extends BaseController
{
    /**
     * @Route("/api/search/document", name="api_search_document", methods={"GET","POST"})
     */
    public function searchDocumentAction(Request $request){
        $serializer = $this->get('jms_serializer');
        $documentSearch = $serializer->deserialize(
            $request->getContent(),
            DocumentSearch::class,
            'json'
        );

        $validator = $this->get('validator');
        $errors = $validator->validate($documentSearch);
        
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return new Response($errorsString);
        }
        $result = $this->getDocumentIndex()->search($documentSearch);
        return new JsonResponse([
            "items" => $result->getItems(),
            "total" => $result->getTotal(),
            "page"  => $result->getPage()
            ]);
    }


}