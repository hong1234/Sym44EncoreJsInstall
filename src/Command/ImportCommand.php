<?php

// src/Command/HelloCommand.php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use App\Importe\Service\Importer;

class ImportCommand extends Command
{
    // the name of the command (the part after "bin/console")
    // php bin/console app:immo-import 'C:/PHPtest/IVD24/XML/users/queue'
    protected static $defaultName = 'app:immo-import';

    private $importer;
    public function __construct(Importer $importer)
    {
        $this->importer = $importer;
        parent::__construct();
    }

    protected function configure()
    {
        $this
        // configure an argument
        ->addArgument('quelle', InputArgument::REQUIRED, 'pfad to zips')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // $users = array(    
        //  "C:/PHPtest/IVD24/XML/users/user1"
        //  $input->getArgument('quelle')  //"C:/PHPtest/IVD24/XML/users/queue"
        // );

        // foreach ($users as $user) {
        //     $this->importer->dirHandling($user, $root = true);
        // }

        $this->importer->dirHandling($input->getArgument('quelle'), $root = true);
        
        return true;
    }
}