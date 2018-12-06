<?php

namespace AppBundle\Extractor;

use Psr\Log\LoggerInterface;
use GuzzleHttp\Client as HttpClient;

use Ign\Component\GeoCatalogue\Client as CswClient;

/**
 * Extraction des documents du GpU sous forme d'un bulk
 * 
 * ATTENTION : A vocation à générer des jeux tests en attendant l'intégration des appels côté GpU
 */
class DocumentExtractor {
    
    const MAX_PAGES = 2;
    
    /*
     * @var HttpClient
     */
    private $gpuClient;

    /**
     * @var LoggerInterface
     */
    private $logger;
    
    function __construct(
        $gpuUrl,
        LoggerInterface $logger
    ) {
        $this->gpuClient = new HttpClient([
            'base_uri' => $gpuUrl,
            'timeout' => 30.0,
            'read_timeout' => 300.0
        ]);
        $this->logger = $logger;
    }

    protected function getLogger() {
        return $this->logger;
    }

    public function setLogger(LoggerInterface $logger) {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @param string $bulkPath
     * @return void
     */
    public function extract($bulkPath = 'php://output'){
        $file = new \SplFileObject($bulkPath,'w+');
        
        $documentIds = $this->listDocuments();
        foreach ($documentIds as $key => $documentId) {
            try {
                $this->getLogger()->info(sprintf("Get document %s...",$documentId));
                $outputDocument = $this->getOutputDocument($documentId);
                $operation = [
                    "index" => ["_index" => "document", "_type" => "_doc", "_id" => $outputDocument['id']]
                ];
                $file->fwrite(json_encode($operation) . PHP_EOL);
                $file->fwrite(json_encode($outputDocument) . PHP_EOL);                
            } catch (\Exception $e) {
                $this->getLogger()->error($e->getMessage());
            }

        }
    }
    
    /**
     * List documents
     */
    private function listDocuments() {
        $this->getLogger()->info("Listing documents...");
        $documentIds = array();
        $i = 0;
        for ($page = 0; $page < self::MAX_PAGES; $page++) {
            $url = "/api/document?page=" . $page . "&limit=100";
            $this->getLogger()->debug(sprintf("GET %s...",$url));
            $response = $this->gpuClient->get($url);
            $data = (string) $response->getBody();
            $documents = json_decode($data, true);
            if (empty($documents)) {
                break;
            }
            foreach ($documents as $document) {
                if (!in_array($document['status'], array('document.production', 'document.deleted'))) {
                    continue;
                }
                $documentIds[] = $document['id'];
                $i++;
            }
        }
        return $documentIds;
    }

    /**
     * @param string $documentId
     * @return array
     */
    protected function getOutputDocument($documentId){
        $documentDetails = $this->getDocumentDetails($documentId);
        
        $result = array(
            'id' => $documentDetails['id'],
            'name' => $documentDetails['name'],
            'type' => $documentDetails['type'],
            'title' => $documentDetails['type'] . ' de ' . $documentDetails['grid']['title'] . ' (' . $documentDetails['grid']['name'] . ')'
        );
        
        $fileIdentifier = $documentDetails['fileIdentifier'];
        $result['organisme'] = $this->getOrganisme($fileIdentifier);
        
        $grid = $this->getGridDetails($documentDetails['grid']['name']);
        $result['geometry'] = $grid['geometry'];
        
        return $result;
    }

    /**
     * Get document details
     * @param string $documentId
     * @return array
     */
    private function getDocumentDetails($documentId) {
        $url = "/api/document/" . $documentId . "/details";
        $this->getLogger()->debug(sprintf("GET %s...",$url));
        $response = $this->gpuClient->get($url);
        $data = (string) $response->getBody();
        return json_decode($data, true);
    }
    
    /**
     * @param string $gridName
     * return array
     */
    private function getGridDetails($gridName){
        $url = '/_hidden/grid/api/grid/'.$gridName;
        $this->getLogger()->debug(sprintf("GET %s...",$url));
        $response = $this->gpuClient->get($url);
        $data = (string) $response->getBody();
        return json_decode($data, true);
    }

    /**
     * Retrieve organism from
     * @param type $fileIdentifier
     * @return type
     */
    private function getOrganisme($fileIdentifier) {
        $fakeOrganismes = array(
            'Organisme A',
            'Organisme B',
            'Organisme C',
            'Mairie de Loray',
            'Mairie de Paris',
            'Communauté de commune du haut-doubs'
        );
        $index = rand(0,count($fakeOrganismes)-1);
        return $fakeOrganismes[$index];
        /*
        if ( empty($fileIdentifier) ){
            return null;
        }
         $this->getLogger()->debug(sprintf("GET metadata %s...",$fileIdentifier));
        $cswClient = new CswClient('http://www.mongeosource.fr/geosource/1270/fre/csw');
        $metadata = $cswClient->findById($fileIdentifier);
        if (is_null($metadata)) {
            return null;
        }
        $contact = $metadata->getMetadataContact();
        return $contact[0]['organisation'];*/
    }


}
