<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\WebTestCase;

use AppBundle\Model\SearchResult;
use AppBundle\Index\DocumentIndex;
use AppBundle\Form\Data\DocumentSearch;

use GuzzleHttp\RequestOptions;

class SearchControllerTest extends WebTestCase
{
    public function setUp(){
        parent::setUp();

        $documentIndex = $this->getDocumentIndex();
        $documentIndex->reset();
    }

    public function testSearchDocumentAction()
    {
        $document = array("title" => "en", "organisme" => 'Organisme A');
        $fakedocumentSearch = new DocumentSearch;
        $fakedocumentSearch->setTitle('en');
        $fakedocumentSearch->setOrganisme('Organisme A');
        $fakeResult = new SearchResult;
        $fakeResult->setTotal(5);
        $fakeResult->setItems(array("TEST" => "TEST"));
         /* mock DocumentIndex */
        $documentIndex = $this->getMockBuilder(DocumentIndex::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $documentIndex
            ->expects($this->exactly(1))
            ->method('search')
            ->with($fakedocumentSearch)
            ->willReturn($fakeResult)
        ;
        $this->getContainer()->set('app.index.document', $documentIndex);
        $client = $this->getClient();
        $client->request(
            'POST',
            '/api/search/document',
            array(),
            array(),
            array(
                'CONTENT_TYPE' => 'application/json'
            ),
            json_encode($document)
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            '{"TEST":"TEST"}',
            $client->getResponse()->getContent()
        );
    }
}