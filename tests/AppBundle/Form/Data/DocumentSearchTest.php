<?php

namespace Tests\AppBundle\Form\Data;

use Tests\AppBundle\WebTestCase;

use AppBundle\Form\Data\DocumentSearch;

class DocumentSearchTest extends WebTestCase {

    public function testSerializeEmpty() {
        $searchDocument = new DocumentSearch();
        $result = $this->getSerializer()->serialize($searchDocument, 'json');
        $this->assertEquals('{"page":0}', $result);
    }

    public function testSerializeWithData() {
        $searchDocument = new DocumentSearch();
        $searchDocument->setTitle("PLU");
        $searchDocument->setOrganisme("Mairie de Loray");
        $searchDocument->setGeometry("POINT(3.0 4.0)");
        $searchDocument->setPage(9);
        $result = $this->getSerializer()->serialize($searchDocument, 'json');
        $this->assertEquals(
            '{"page":9,"title":"PLU","organisme":"Mairie de Loray","geometry":"POINT(3.0 4.0)"}', $result
        );
    }

    public function testDeserializeEmpty() {
        /* @var $documentSearch DocumentSearch */
        $documentSearch = $this->getSerializer()->deserialize('', DocumentSearch::class, 'json');
        $this->assertInstanceOf(DocumentSearch::class, $documentSearch);
        $this->assertEquals(0, $documentSearch->getPage());
        $this->assertFalse($documentSearch->hasType());
        $this->assertFalse($documentSearch->hasTitle());
        $this->assertFalse($documentSearch->hasOrganisme());
        $this->assertFalse($documentSearch->hasGeometry());
    }

    public function testDeserializeWithData() {
        $data = '{"title" : "CC de Belleville", "organisme" : "Organisme A", "geometry" : "POINT(3.0 4.0)", "type" : "CC"}';
        $documentSearch = $this->getSerializer()->deserialize($data, DocumentSearch::class, 'json');
        $this->assertInstanceOf(DocumentSearch::class, $documentSearch);
        $this->assertEquals(0, $documentSearch->getPage());
        $this->assertEquals('CC', $documentSearch->getType());
        $this->assertEquals('Organisme A', $documentSearch->getOrganisme());
        $this->assertEquals('POINT(3.0 4.0)', $documentSearch->getGeometry());
        $this->assertEquals('CC de Belleville', $documentSearch->getTitle());
    }

    /**
     * @return \JMS\Serializer\Serializer
     */
    protected function getSerializer() {
        return $this->getContainer()->get('jms_serializer');
    }

}
