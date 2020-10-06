<?php

// src/Command/HelloCommand.php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use App\Repository\LocationRepository;
use App\Entity\Location;

class AddLocationCommand extends Command
{
    // the name of the command (the part after "bin/console")
    // php bin/console app:add-location Starnberg 2 2
    
    protected static $defaultName = 'app:add-location';

    private $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this
        // configure an argument
        ->addArgument('locationname', InputArgument::REQUIRED, 'The name of the location.')
        ->addArgument('parentid', InputArgument::REQUIRED, 'The id of the parent.')
        ->addArgument('level', InputArgument::REQUIRED, 'The level of the location.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ...
        //echo "Hello!\n";
        $parent = $this->locationRepository->find($input->getArgument('parentid'));  // bayern
        $location = new Location();
        // This will trigger an error: the column isn't nullable in the database
        $location->setName($input->getArgument('locationname'))   // 'Starnberg'
                ->setParent($parent)
                ->setLevel($input->getArgument('level'));
       
        $this->locationRepository->addLocation($location);

        //$output->write('Location '.$input->getArgument('locationname').' created.');
        $output->writeln('Location '.$input->getArgument('locationname').' created.');
        
        
        return 0;
    }
}
