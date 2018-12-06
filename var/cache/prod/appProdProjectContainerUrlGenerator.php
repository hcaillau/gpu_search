<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdProjectContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;

    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = array(
        'api_autocomplete_document_organisme' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\AutocompleteController::autocompleteOrganismeAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/api/autocomplete/document/organisme',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'api_autocomplete_document_title' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\AutocompleteController::autocompleteTitleAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/api/autocomplete/document/title',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'homepage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'api_index_document_list' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\IndexController::listAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/api/index/document',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'api_index_document_create' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\IndexController::createAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/api/index/document',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'app_index_reset' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\IndexController::resetAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/api/index/document/reset',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'api_index_document_update' => array (  0 =>   array (    0 => 'documentId',  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\IndexController::updateAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'documentId',    ),    1 =>     array (      0 => 'text',      1 => '/api/index/document',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'api_index_document_by_id' => array (  0 =>   array (    0 => 'documentId',  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\IndexController::byIdAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'documentId',    ),    1 =>     array (      0 => 'text',      1 => '/api/index/document',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'api_index_document_remove' => array (  0 =>   array (    0 => 'documentId',  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\IndexController::removeAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'documentId',    ),    1 =>     array (      0 => 'text',      1 => '/api/index/document',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'api_search_document' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\SearchController::searchDocumentAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/api/search/document',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
    );
        }
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
