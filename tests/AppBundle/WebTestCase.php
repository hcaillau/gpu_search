<?php

namespace Tests\AppBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseTestCase ;

/**
 * @author MBorne
 */
class WebTestCase extends BaseTestCase {
    
    private $client;
    
    private $container;
    
    public function setUp(){
        $this->client = static::createClient();
        $this->container = $this->client->getContainer() ; 
    }
    
    /**
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    protected function getClient(){
        return $this->client;
    }    
    
    /**
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected function getContainer(){
        return $this->container;
    }
    
    /**
     * @return \AppBundle\Index\DocumentIndex
     */
    protected function getDocumentIndex(){
        return $this->getContainer()->get('app.index.document');
    }
    
}
