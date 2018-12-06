<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\WebTestCase;
use AppBundle\Model\SearchResult;
use AppBundle\Form\Data\DocumentSearch;

/**
 * Test de régression sur DocumentIndex
 */
class DocumentIndexTest extends WebTestCase
{

    public function setUp(){
        parent::setUp();

        $documentIndex = $this->getDocumentIndex();
        $documentIndex->reset();
        /* create some items (also tests create) */
        $documentIndex->create(array(
            'id'=>'1',
            'type' => 'PLU', 
            'title' => 'PLU de la commune A',
            'organisme' => 'organisme A',
            'name' => 'b60'
        ));
        $documentIndex->create(array(
            'id'=>'2',
            'type' => 'POS', 
            'organisme' => 'organisme B',
            'title' => 'POS de la commune B',
            'name' => 'b30'
        ));
        $documentIndex->create(array(
            'id'=>'3',
            'type' => 'POS', 
            'title' => 'POS de la commune C',
            'organisme' => 'organisme C',
            'name' => 'b50'
        ));
    }
    
    /**
     * find('1') - Recherche de l'élément avec id=1
     */
    public function testFind(){
        $documentIndex = $this->getDocumentIndex();
        $result = $documentIndex->find('1');
        $this->assertNotNull($result);
        $this->assertEquals(
            array(
                'id'=>'1',
                'type' => 'PLU', 
                'title' => 'PLU de la commune A',
                'organisme' => 'organisme A',
                'name' => 'b60'
            ),
            $result
        );
    }
    
    /**
     * find('not-existing') - Recherche d'un élément non existant
     */
    public function testFindNotFound(){
        $documentIndex = $this->getDocumentIndex();
        $result = $documentIndex->find('not-existing');
        $this->assertNull($result);
    }

    /**
     * update('1') - Modification des champs de l'élément 1
     */
    public function testUpdate(){
        $documentIndex = $this->getDocumentIndex();
        /* doit modifier la valeur */        
        $result = $documentIndex->update(array(
            'id'=> '1',
            'title' => 'new title'
        ), '1');
        $final = $documentIndex->find('1');
        $this->assertNotNull($final);
        $this->assertEquals('new title', $final['title']);
        // non répété donc supprimé
        $this->assertArrayNotHasKey('type',$final);
    }

    
    /**
     * remove('2') - Destruction de l'élément d id 2
     */
    public function testRemove(){
        $documentIndex = $this->getDocumentIndex();
        $this->assertNotNull($documentIndex->find('2'));
        $documentIndex->remove('2');
        $this->assertNull($documentIndex->find('2'));
    }

    
    /**
     * findAll(0) - Recherche de tous les éléments sur page 0
     */
    public function testFindAll(){
        $documentIndex = $this->getDocumentIndex();
        $result = $documentIndex->findAll();
        $this->assertNotNull($result);
        $this->assertInstanceOf(SearchResult::class, $result);
        $this->assertEquals(0, $result->getPage());
        $this->assertEquals(3, $result->getTotal());
        $this->assertCount(3, $result->getItems());
        
        $items = $result->getItems();
        //TODO a supprimer après gestion du sort
        usort($items,function($a,$b){
            return strcmp($a['id'], $b['id']);
        });
        $item0 = $items[0];
        $this->assertEquals('PLU', $item0['type']);
    }
    
    /**
     * findAll(6) - Recherche de tous les éléments sur page 6 (vide)
     */
    public function testFindAllEmptyPage6(){
        $documentIndex = $this->getDocumentIndex();
        $result = $documentIndex->findAll(6);
        $this->assertNotNull($result);
        $this->assertInstanceOf(SearchResult::class, $result);
        $this->assertEquals(6, $result->getPage());
        $this->assertEquals(3, $result->getTotal());
        $this->assertCount(0, $result->getItems());
    }

    /**
     * search(default) - Recherche avec aucun filtrage <=> findAll
     */
    public function testSearchNoFilterPage0(){
        $documentIndex = $this->getDocumentIndex();
        $documentSearch = new DocumentSearch();
        $result = $documentIndex->search($documentSearch);
        /* le résultat doit être le même que celui d'un findAll */
        $expectedResult = $documentIndex->findAll();
        $this->assertEquals($expectedResult,$result);
    }
    
    /**
     * search(default) - Recherche avec aucun filtrage sur page 6 <=> findAll(6)
     */
    public function testSearchNoFilterPage6(){
        $documentIndex = $this->getDocumentIndex();
        $documentSearch = new DocumentSearch();
        $documentSearch->setPage(6);
        $result = $documentIndex->search($documentSearch);
        /* le résultat doit être le même que celui d'un findAll */
        $expectedResult = $documentIndex->findAll(6);
        $this->assertEquals($expectedResult,$result);
    }

    /**
     * search(default) - Recherche avec filtrage 'type'
     */
    public function testSearchPLUPage0(){
        $documentIndex = $this->getDocumentIndex();
        $documentSearch = new DocumentSearch();
        $documentSearch->setType('PLU');
        $result = $documentIndex->search($documentSearch);
        $this->assertNotNull($result);
        $this->assertInstanceOf(SearchResult::class, $result);
        $this->assertEquals(1, $result->getTotal());
        $this->assertCount(1, $result->getItems());
    }

    /**
     * search(default) - Recherche avec filtrage 'type' en page 6
     */
    public function testSearchPLUPage6(){
        $documentIndex = $this->getDocumentIndex();
        $documentSearch = new DocumentSearch();
        $documentSearch->setType('PLU');
        $documentSearch->setPage(6);
        $result = $documentIndex->search($documentSearch);
        $this->assertNotNull($result);
        $this->assertInstanceOf(SearchResult::class, $result);
        $this->assertEquals(1, $result->getTotal());
        $this->assertCount(0, $result->getItems());
    }

    /**
     * search(default) - Recherche avec tous filtrages
     */
    public function testSearchAllfilter(){
        $documentIndex = $this->getDocumentIndex();
        $documentSearch = new DocumentSearch();
        $documentSearch->setType('PLU');
        $documentSearch->setOrganisme('organisme A');
        $documentSearch->setTitle('commune A');
        $result = $documentIndex->search($documentSearch);
        $this->assertNotNull($result);
        $this->assertInstanceOf(SearchResult::class, $result);
        $this->assertEquals(1, $result->getTotal());
        $item = $result->getItems();
        $this->assertEquals($item[0]['title'], 'PLU de la commune A');
    }

    /**
     * autocomplete('orga') - Autocomplétion de la chaîne orga
     */
    public function testAutocompleteOrga(){
        $documentIndex = $this->getDocumentIndex();
        $result = $documentIndex->autocomplete('organisme', 'orga');
        $expectedResult = array("organisme A", "organisme B", "organisme C");
        $this->assertNotNull($result);
        $this->assertEquals($result, $expectedResult);
    }

    /**
     * autocomplete('inexistant') - Autocomplétion d'une chaîne inexistante
     */
    public function testAutocompleteinexistant(){
        $documentIndex = $this->getDocumentIndex();
        $result = $documentIndex->autocomplete('organisme', 'inexistant');
        $this->assertNotNull($result);
        $this->assertEquals($result, array());
    }
}