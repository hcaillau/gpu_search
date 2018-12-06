<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if ('/_profiler' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not__profiler_home;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', '_profiler_home'));
                    }

                    return $ret;
                }
                not__profiler_home:

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ('/_profiler/search' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ('/_profiler/search_bar' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_phpinfo
                if ('/_profiler/phpinfo' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler_open_file
                if ('/_profiler/open' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:openAction',  '_route' => '_profiler_open_file',);
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        elseif (0 === strpos($pathinfo, '/api')) {
            // api_autocomplete_document_organisme
            if ('/api/autocomplete/document/organisme' === $pathinfo) {
                $ret = array (  '_controller' => 'AppBundle\\Controller\\AutocompleteController::autocompleteOrganismeAction',  '_route' => 'api_autocomplete_document_organisme',);
                if (!in_array($canonicalMethod, array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_autocomplete_document_organisme;
                }

                return $ret;
            }
            not_api_autocomplete_document_organisme:

            // api_autocomplete_document_title
            if ('/api/autocomplete/document/title' === $pathinfo) {
                $ret = array (  '_controller' => 'AppBundle\\Controller\\AutocompleteController::autocompleteTitleAction',  '_route' => 'api_autocomplete_document_title',);
                if (!in_array($canonicalMethod, array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_autocomplete_document_title;
                }

                return $ret;
            }
            not_api_autocomplete_document_title:

            if (0 === strpos($pathinfo, '/api/index/document')) {
                // api_index_document_list
                if ('/api/index/document' === $pathinfo) {
                    $ret = array (  '_controller' => 'AppBundle\\Controller\\IndexController::listAction',  '_route' => 'api_index_document_list',);
                    if (!in_array($canonicalMethod, array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_index_document_list;
                    }

                    return $ret;
                }
                not_api_index_document_list:

                // api_index_document_create
                if ('/api/index/document' === $pathinfo) {
                    $ret = array (  '_controller' => 'AppBundle\\Controller\\IndexController::createAction',  '_route' => 'api_index_document_create',);
                    if (!in_array($requestMethod, array('POST'))) {
                        $allow = array_merge($allow, array('POST'));
                        goto not_api_index_document_create;
                    }

                    return $ret;
                }
                not_api_index_document_create:

                // app_index_reset
                if ('/api/index/document/reset' === $pathinfo) {
                    $ret = array (  '_controller' => 'AppBundle\\Controller\\IndexController::resetAction',  '_route' => 'app_index_reset',);
                    if (!in_array($requestMethod, array('POST'))) {
                        $allow = array_merge($allow, array('POST'));
                        goto not_app_index_reset;
                    }

                    return $ret;
                }
                not_app_index_reset:

                // api_index_document_update
                if (preg_match('#^/api/index/document/(?P<documentId>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, array('_route' => 'api_index_document_update')), array (  '_controller' => 'AppBundle\\Controller\\IndexController::updateAction',));
                    if (!in_array($requestMethod, array('PUT'))) {
                        $allow = array_merge($allow, array('PUT'));
                        goto not_api_index_document_update;
                    }

                    return $ret;
                }
                not_api_index_document_update:

                // api_index_document_by_id
                if (preg_match('#^/api/index/document/(?P<documentId>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, array('_route' => 'api_index_document_by_id')), array (  '_controller' => 'AppBundle\\Controller\\IndexController::byIdAction',));
                    if (!in_array($canonicalMethod, array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_index_document_by_id;
                    }

                    return $ret;
                }
                not_api_index_document_by_id:

                // api_index_document_remove
                if (preg_match('#^/api/index/document/(?P<documentId>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, array('_route' => 'api_index_document_remove')), array (  '_controller' => 'AppBundle\\Controller\\IndexController::removeAction',));
                    if (!in_array($requestMethod, array('DELETE'))) {
                        $allow = array_merge($allow, array('DELETE'));
                        goto not_api_index_document_remove;
                    }

                    return $ret;
                }
                not_api_index_document_remove:

            }

            // api_search_document
            if ('/api/search/document' === $pathinfo) {
                $ret = array (  '_controller' => 'AppBundle\\Controller\\SearchController::searchDocumentAction',  '_route' => 'api_search_document',);
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_api_search_document;
                }

                return $ret;
            }
            not_api_search_document:

        }

        // homepage
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_homepage;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'homepage'));
            }

            return $ret;
        }
        not_homepage:

        if ('/' === $pathinfo && !$allow) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
