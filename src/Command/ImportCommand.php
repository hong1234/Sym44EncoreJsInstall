<?php

// src/Command/HelloCommand.php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use App\Importe\Dao\ImmoDao;
use App\Importe\Service\XmlParser;
use App\Importe\Service\DataImport;
use App\Importe\Service\Importer;

class ImportCommand extends Command
{
    // the name of the command (the part after "bin/console")
    // php bin/console app:immo-import 'C:/PHPtest/IVD24/XML/users/queue' 'C:/PHPtest/IVD24/XML/users/bilder'
    protected static $defaultName = 'app:immo-import';

    private $idao;

    public function __construct(ImmoDao $idao)
    {
        $this->idao = $idao;
        parent::__construct();
    }

    protected function configure()
    {
        $this
        // configure an argument
        ->addArgument('quelle', InputArgument::REQUIRED, 'pfad to zips')
        ->addArgument('bilder', InputArgument::REQUIRED, 'pfad to bilder')
        //->addArgument('level', InputArgument::REQUIRED, 'The level of the location.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$output->writeln('Location '.$input->getArgument('locationname').' created.');
        $parser = new XmlParser();
        $dataimport = new DataImport($this->idao, $input->getArgument('bilder'));
        $importer = new Importer($parser, $dataimport);

        $users = array(
            //$ipConfig['quelle'], 
            //"C:/PHPtest/IVD24/XML/users/queue"
            $input->getArgument('quelle')
        );

        foreach ($users as $user) {
            $importer->dirHandling($user, $root = true);
        }
        
        return 0;
    }
}