<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = $this->getClient();
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Démonstrateur', $crawler->filter('h1')->text());
        
        $form = $crawler->selectButton('Search')->form();
        $form['document_search[title]']      = 'test title';
        $form['document_search[organisme]'] = 'test organisme';
        
        $crawler = $client->submit($form);
        $this->assertEquals('200', $client->getResponse()->getStatusCode());
        $this->assertContains("test title", $client->getResponse()->getContent());
        $this->assertContains("test organisme", $client->getResponse()->getContent());
                
        // $documentSearch = $this->getEntityManager()->getRepository('AppBundle:Form:Type');
        // $this->assertNotNull($documentSearch);
        // $this->assertEquals('test title',$documentSearch->getTitle());
        // $this->assertEquals('test organisme',$documentSearch->getOrganisme());      

        // $this->markTestIncomplete("TODO mocker l'index, remplir et sousmettre le form");
        // see http://gitlab.dockerforge.ign.fr/gpu/gpu-site/blob/v3.2.14/src/Ign/Bundle/GPUAdminBundle/Tests/Controller/ArticleControllerTest.php#L30-54
    }
}
