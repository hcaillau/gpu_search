<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\WebTestCase;

use AppBundle\Model\SearchResult;
use AppBundle\Index\DocumentIndex;

use GuzzleHttp\RequestOptions;

class IndexControllerTest extends WebTestCase
{


    public function setUp(){
        parent::setUp();

        $documentIndex = $this->getDocumentIndex();
        $documentIndex->reset();
    }
    
    public function testListAction()
    {
        /* mock DocumentIndex */
        $documentIndex = $this->getMockBuilder(DocumentIndex::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $searchResult = new SearchResult();
        $searchResult->setPage(0);
        $documentIndex
            ->expects($this->exactly(1))
            ->method('findAll')
            ->willReturn($searchResult)
        ;
        
        $this->getContainer()->set('app.index.document', $documentIndex);
        /* Invoke controller */        
        $client = $this->getClient();
        $crawler = $client->request('GET', '/api/index/document');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"page":0,"items":[]}',$client->getResponse()->getContent());
    }


    public function testCreateAction()
    {
        $document = array("id" => "123456", "name" => 'test');
         /* mock DocumentIndex */
        $documentIndex = $this->getMockBuilder(DocumentIndex::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $documentIndex
            ->expects($this->exactly(1))
            ->method('create')
            ->with($document)
            ->willReturn(true)
        ;
        $this->getContainer()->set('app.index.document', $documentIndex);

        $client = $this->getClient();
        $client->request(
            'POST',
            '/api/index/document',
            array(),
            array(),
            array(
                'CONTENT_TYPE' => 'application/json'
            ),
            json_encode($document)
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            '{"success":true,"message":"document created"}',
            $client->getResponse()->getContent()
        );
    }
    
    
    public function testResetAction()
    {
        /* mock DocumentIndex */
        $documentIndex = $this->getMockBuilder(DocumentIndex::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $documentIndex
            ->expects($this->exactly(1))
            ->method('reset')
        ;
        $this->getContainer()->set('app.index.document', $documentIndex);
        $client = $this->getClient();
        $client->request('POST', '/api/index/document/reset');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"success":true,"message":"document index reseted"}',$client->getResponse()->getContent());
    }

public function testUpdateAction()
    {
        $document = array("id" => "123456", "name" => "plouf");
         /* mock DocumentIndex */
        $documentIndex = $this->getMockBuilder(DocumentIndex::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $documentIndex
            ->expects($this->exactly(1))
            ->method('update')
            ->with($document,
                   $document['id']
            )
            ->willReturn(true)
        ;
        $this->getContainer()->set('app.index.document', $documentIndex);
        $client = $this->getClient();
        $client->request(
            'PUT',
            '/api/index/document/'.$document['id'],
            array(),
            array(),
            array(
                'CONTENT_TYPE' => 'application/json'
            ),
            json_encode($document)
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            '{"success":true,"message":"document updated"}',
            $client->getResponse()->getContent()
        );
    }
    
    public function testByIdAction()
    {
        $documentId = '123456';
        $fakeDocument = array('id'=>$documentId,'name'=>'test');
         /* mock DocumentIndex */
        $documentIndex = $this->getMockBuilder(DocumentIndex::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $documentIndex
            ->expects($this->exactly(1))
            ->method('find')
            ->with($documentId)
            ->willReturn($fakeDocument)
        ;
        $this->getContainer()->set('app.index.document', $documentIndex);       
        $client = $this->getClient();
        $client->request('GET', '/api/index/document/'.$documentId);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"id":"123456","name":"test"}',$client->getResponse()->getContent());
    }


    public function testRemoveAction()
    {
        $documentId = '123456';
        $fakeDocument = array('id'=>$documentId,'name'=>'test');
         /* mock DocumentIndex */
        $documentIndex = $this->getMockBuilder(DocumentIndex::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $documentIndex
            ->expects($this->exactly(1))
            ->method('remove')
            ->with($documentId)
        ;
        $this->getContainer()->set('app.index.document', $documentIndex);       
        $client = $this->getClient();
        $client->request('DELETE', '/api/index/document/'.$documentId);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            '{"success":true,"message":"document deleted"}',
            $client->getResponse()->getContent());
    }
    
    
}
