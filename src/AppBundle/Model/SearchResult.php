<?php

namespace AppBundle\Model;

/**
 * Modèle pour les réponses aux requêtes de recherche
 *
 * @author MBorne
 */
class SearchResult {
    
    /**
     * Page recherchée
     * @var integer
     */
    private $page;
    
    /**
     * Nombre total d'élément dans la recherche
     * @var integer
     */
    private $total;
    
    /**
     * Liste des résultats (sources dans ES)
     * @var array
     */
    private $items = array();
    
    function getPage() {
        return $this->page;
    }

    function getTotal() {
        return $this->total;
    }

    function getItems() {
        return $this->items;
    }

    function setPage($page) {
        $this->page = $page;
        return $this;
    }

    function setTotal($total) {
        $this->total = $total;
        return $this;
    }

    function setItems($items) {
        $this->items = $items;
        return $this;
    }

    
}
