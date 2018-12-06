<?php

namespace AppBundle\Command\Extract;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Symfony\Component\Console\Logger\ConsoleLogger;

/**
 * Extraction des documents du GpU pour construire un jeu test
 */
class ExtractDocumentCommand extends ContainerAwareCommand {

    /**
     * {@inheritDoc}
     */
    protected function configure() {
        $this
            ->setName('ign_gpu_search:extract:document')
            ->setDescription("Extraire les données des documents pour la recherche elastic search")
            ->addArgument('path', InputArgument::REQUIRED, "output bulk path")
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $logger = new ConsoleLogger($output);
        $path = $input->getArgument('path');
        $extractor = $this->getDocumentExtractor();
        $extractor->setLogger($logger); 
        $extractor->extract($path);
    }

    /**
     * @return \AppBundle\Extractor\DocumentExtractor
     */
    protected function getDocumentExtractor(){
        return $this->getContainer()->get("app.extractor.document");
    }

}
