<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\WebTestCase;

use AppBundle\Model\SearchResult;
use AppBundle\Index\DocumentIndex;

use GuzzleHttp\RequestOptions;

class AutocompleteControllerTest extends WebTestCase
{

    public function setUp(){
        parent::setUp();

        $documentIndex = $this->getDocumentIndex();
        $documentIndex->reset();
    }

    public function testautocompleteOrganismeAction() {
    	$documentIndex = $this->getMockBuilder(DocumentIndex::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;
        // exemple de terme en entrée
        $term = 'org';
        $documentIndex
            ->expects($this->exactly(1))
            ->method('autocomplete')
            ->with(
                $this->equalTo('organisme'),
                $this->equalTo($term)
            )
            ->willReturn(array('Organisme A', 'Organisme B'))
        ;

        $this->getContainer()->set('app.index.document', $documentIndex);
        $client = $this->getClient();
        $client->request(
            'GET',
            '/api/autocomplete/document/organisme?term='.$term
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            '["Organisme A","Organisme B"]',
            $client->getResponse()->getContent()
        );
    }
}