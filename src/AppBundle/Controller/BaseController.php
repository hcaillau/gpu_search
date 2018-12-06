<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Base controller providing helpers
 *
 * @author MBorne
 */
class BaseController extends Controller {

    /**
     * @return DocumentIndex
     */
    protected function getDocumentIndex(){
        return $this->get('app.index.document');
    }

    /**
     * Create a JSON response (content is serialized with jms_serializer)
     * @param mixed $content
     * @param integer $status
     * @return Response
     */
    protected function createJsonResponse(
        $content, 
        $status = Response::HTTP_OK
    ){
        $serializer = $this->get('jms_serializer');
        $response = new Response(
            $serializer->serialize($content,'json'),
            $status
        );        
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    
    /**
     * Helper to create success response
     *
     * @param string $message
     * @return JsonResponse
     */
    protected function createSuccessResponse($message){
        return new JsonResponse([
            'success' => true,
            'message' => $message
        ]);
    }

    
    
}
