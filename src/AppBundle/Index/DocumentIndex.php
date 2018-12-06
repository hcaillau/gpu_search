<?php

namespace AppBundle\Index;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;

use AppBundle\Form\Data\DocumentSearch;
use AppBundle\Model\SearchResult;


/**
 * Classe d'indexation des documents dans elasticsearch
 */
class DocumentIndex
{
    const PAGE_SIZE = 500;

    private $pageSize;

    /**
     * TODO : ES Client
     * 
     * https://github.com/elastic/elasticsearch-php
     *
     * @var HttpClient
     */
    private $client;

    public function __construct($urlElasticSearch, $options = array())
    {
        $this->client = new HttpClient(['base_uri' => $urlElasticSearch, 'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => ''
        ]]);

        if(isset($options['page_size'])){
            $this->pageSize = $options['page_size'];
        }else {
            $this->pageSize = self::PAGE_SIZE;
        }
        

    }

    /**
     * Test l'existence de l'index
     * @return boolean
     */
    public function hasIndex()
    {
        try {
            $this->client->get('/document');
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Recréation de l'indexe
     * @return void
     */
    public function reset()
    {
        if ($this->hasIndex()) {
            $this->client->delete('/document');
        }
        $mapping = file_get_contents(dirname(__FILE__).'/../Resources/mapping/document.json');
        $mapping = json_decode($mapping,true);
        $this->client->put('/document', [RequestOptions::JSON => $mapping]);
    }
    

    /**
     * Find by id (null if not found)
     *
     * @param string $id
     * @return array
     */
    public function find($id)
    {
        try {
            $response = $this->client->get('/document/_doc/' . $id);
            $result = json_decode($response->getBody(), true);
            if (empty($result)) {
                return null;
            }
            return $result['_source'];
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Create a document
     *
     * @param array $document
     * @return void
     */
    public function create(array $document)
    {
        $documentId = $document['id'];
        $response = $this->client->put('/document/_doc/' . $documentId . '?refresh=wait_for', [
            RequestOptions::JSON => $document
        ]);
        return true;
    }

    /**
     * Update a document according to $document['id']
     *
     * @param array $document
     */
    public function update(array $document, $documentId)
    {
        // use create to update documents
        $response = $this->client->put('/document/_doc/' . $documentId . '?refresh=wait_for', [
            RequestOptions::JSON => $document
        ]);
        return true;
    }

    /**
     * Remove document by id
     *
     * @param boolean $documentId
     */
    public function remove($documentId)
    {
        if (is_null($this->find($documentId))) {
            return;
        }
        $this->client->delete('/document/_doc/' . $documentId . '?refresh=wait_for');
    }
    
    
    /**
     * Recherche de tous les documents pour un page donnée
     * @param integer $page
     * @return \AppBundle\Model\SearchResult
     */
    public function findAll($page = 0)
    {
        $from = $page * $this->pageSize;
        
        $searchResult = new SearchResult();
        $searchResult->setPage($page);
        $response = $this->client->get('/document/_search?size=' . $this->pageSize . '&from=' . $from);
        $result = json_decode($response->getBody(), true);
        //TODO voir si ça peut vraiment arriver
        if (empty($result)) {
            $searchResult->setTotal(0);
            return $searchResult;
        }
        $searchResult->setTotal($result['hits']['total']);
        $searchResult->setItems($this->hitsToItems($result['hits']['hits']));
        return $searchResult;
    }

    /**
     * Recherche des documents en fonction de paramètres
     * @param DocumentSearch $documentSearch
     * @return \AppBundle\Model\SearchResult
     */
    public function search(DocumentSearch $documentSearch)
    {
        $query = $this->createSearchQuery($documentSearch);
      //   var_dump($query);
        // exit;
        if (empty($query)){
            return $this->findAll($documentSearch->getPage());
        }
        
        $searchResult = new SearchResult();
        $searchResult->setPage($documentSearch->getPage());
        
        $response = $this->client->post('/document/_search', [RequestOptions::JSON => $query]);
        $result = json_decode($response->getBody(), true);

        
        if (empty($result)) {
            $searchResult->setTotal(0);
            return $searchResult;
        }
        $searchResult->setTotal($result['hits']['total']);
        $searchResult->setItems($this->hitsToItems($result['hits']['hits']));
        return $searchResult;
    }


    /**
     * @param array $hits
     * @return array
     */
    private function hitsToItems(array $hits){
        $items = array();
        foreach ( $hits as $hit ){
            $item = $hit['_source'];
            $item['_score'] = $hit['_score'];
            $items[] = $item;
        }
        return $items;
    }
    
    
    /**
     * @param DocumentSearch $search
     * @return array
     */
    private function createSearchQuery(DocumentSearch $search)
    {


        $mustParts = array();
        $geoParts = array();
        $sortPart = $search->getSort();

        if ( $search->hasType() ){
            $mustParts[] = $this->createMustPart('type',$search->getType());
        }

        if ( $search->hasTitle() ){
            $mustParts[] = $this->createMatchPhrasePart('title',$search->getTitle());
        }

         if ( $search->hasOrganisme() ){
            $mustParts[] = $this->createMatchPhrasePart('organisme',$search->getOrganisme());
        }

        if ( $search->hasSupCat() ){
            $mustParts[] = $this->createMustPart('sup_cat',$search->getSupCat());
        }

        if ( $search->hasGeometry() ){
            $geoParts[] = ["geo_shape" => [
                "geometry" => [
                    "shape" => $search->getGeometry(),
                    "relation" => "intersects"
                ]
            ]];
        }

        if ( empty($mustParts) && empty($geoParts)){
            return array();
        }

        if ( empty($mustParts) ){
            $mustParts = "match_all" => (object)[];
        }


        return array(
            "from"  => $search->getPage() * $this->pageSize, 
            "size"  => $this->pageSize,
            "sort" => $sortPart,
            'query' => ['bool' => ['must' => [$mustParts], 'filter' => $geoParts]

        ]);
    }

    /**
     * Renvoie une liste de valeur autocomplétée pour "fieldName" contenant "term"
     *
     * TODO : à optimiser
     */
    public function autocomplete($fieldName, $term){
        $output = [];
        $mustParts[] = ["multi_match" => ["query" => $term, "type" => "phrase_prefix", "fields" => [$fieldName, $fieldName.".suggest"]]];
        $query = array('query' => ['bool' => ['must' => $mustParts]]);
        $response = $this->client->post('/document/_search', [RequestOptions::JSON => $query]);
        $result = json_decode($response->getBody(), true);
        foreach ($result['hits']['hits'] as $key => $value)
        {
            if (isset($output) && in_array($value['_source'][$fieldName], $output))
                continue;
            else
                array_push($output, $value['_source'][$fieldName]);
        } 
        sort($output, SORT_NATURAL );
        return $output;
    }

    /**
     * Bulk batch on index
     */
    public function bulk($path)
    {
        $response = $this->client->post('/document/_bulk', [
            'body' => file_get_contents($path)
        ]);
    }

    private function createMustPart($attribut,$value,$options = array()){
        return ["match" => [ $attribut => $value]];
    }

    private function createMatchPhrasePart($attribut,$value,$options = array()){
        
        return ["match_phrase" => [
                 $attribut => ["query" => $value]
             ]];
    }
}


