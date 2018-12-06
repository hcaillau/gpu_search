<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Contrôleur de gestion de l'indexe des documents
 * 
 * @Route("/api/index")
 */
class IndexController extends BaseController
{
    /**
     * @Route("/document", name="api_index_document_list", methods={"GET","HEAD"})
     */
    public function listAction(Request $request)
    {
        $page = (int)$request->get('page',0);
        $result = $this->getDocumentIndex()->findAll($page);
        return $this->createJsonResponse($result);
    }

    /**
     * @Route("/document", name="api_index_document_create", methods="POST")
     */
    public function createAction(Request $request)
    {
            $document = $this->getDocumentFromRequest($request);
            $this->getDocumentIndex()->create($document);
            return $this->createSuccessResponse("document created");
    }

    /**
     * @Route("/document/reset", methods="POST")
     */
    public function resetAction(){
        $this->getDocumentIndex()->reset();
        return $this->createSuccessResponse("document index reseted");
    }

    /**
     * @Route("/document/{documentId}", name="api_index_document_update", methods="PUT")
     */
    public function updateAction(Request $request, $documentId)
    {
        $document = $this->getDocumentFromRequest($request);
        $this->getDocumentIndex()->update($document, $documentId);
        return $this->createSuccessResponse("document updated");
    }

    /**
     * @Route("/document/{documentId}", name="api_index_document_by_id", methods={"GET","HEAD"})
     */
    public function byIdAction($documentId)
    {
        $result = $this->getDocumentIndex()->find($documentId);
        return new JsonResponse($result);
    }

    /**
     * @Route("/document/{documentId}", name="api_index_document_remove", methods="DELETE")
     */
    public function removeAction($documentId)
    {
        $this->getDocumentIndex()->remove($documentId);
        return $this->createSuccessResponse("document deleted");
    }


    protected function getDocumentFromRequest(Request $request){
        $document = json_decode($request->getContent(),true);
        if ( ! isset($document['id']) ){
            throw new \Exception("missing document id");
        }
        // TODO contrôle en profondeur de document
        return $document;
    }


}
