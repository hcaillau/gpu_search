<?php

namespace AppBundle\Command\Bulk;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Symfony\Component\Console\Logger\ConsoleLogger;

/**
 * Extraction des documents du GpU pour construire un jeu test
 */
class BulkDocumentCommand extends ContainerAwareCommand {

    /**
     * {@inheritDoc}
     */
    protected function configure() {
        $this
            ->setName('ign_gpu_search:bulk:document')
            ->setDescription("Charger les données dans l'indexe des documents")
            ->addArgument('path', InputArgument::REQUIRED, "bulk path")
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $logger = new ConsoleLogger($output);
        $path = $input->getArgument('path');
        $this->getDocumentIndex()->reset();
        $this->getDocumentIndex()->bulk($path);
    }

    /**
     * @return \AppBundle\Index\DocumentIndex
     */
    protected function getDocumentIndex(){
        return $this->getContainer()->get("app.index.document");
    }

}
