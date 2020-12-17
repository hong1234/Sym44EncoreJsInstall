<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

//use GuzzleHttp\Client;

class GuzzleCommand extends Command
{
    // php bin/console app:guzzle-test
    protected static $defaultName = 'app:guzzle-test';

    public function __construct()
    {
        //$this->locationRepository = $locationRepository;
        parent::__construct();
    }

    protected function configure()
    {
        //$this
        // configure an argument
        //->addArgument('locationname', InputArgument::REQUIRED, 'The name of the location.')
        //;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$output->writeln('Location '.$input->getArgument('locationname').' created.');
        //return 0;
        $client = new \GuzzleHttp\Client();
        //$response = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');
        
        //echo $response->getStatusCode() . "\n"; // 200
        //echo $response->getHeaderLine('content-type') . "\n"; // 'application/json; charset=utf8'
        //echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
        //var_dump(json_decode ($response->getBody()));



        //$response = $client->request('GET', 'http://localhost:8000/api/location?lname=München');
        //var_dump(json_decode ($response->getBody()));
        //echo (int)json_decode ($response->getBody())->l_id;

        //$response = $client->request('GET', 'http://localhost:8000/api/location/search?lname=berg');
        //var_dump(json_decode ($response->getBody()));
        // foreach (json_decode ($response->getBody()) as $obj) {
        //     echo "------------\n";
        //     echo $obj->l_id . " | " . $obj->l_name . "\n";
        // }


        // $client = new Client();
        // $res = $client->request('GET', 'https://api.github.com/user', [
        //     'auth' => ['user', 'pass']
        // ]);
        // echo $res->getStatusCode();
        // // "200"
        // echo $res->getHeader('content-type')[0];
        // // 'application/json; charset=utf8'
        // echo $res->getBody();
        // // {"type":"User"...'



        $response = $client->post('http://localhost:8000/api/location', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                "name" => "Hanoi", 
                "parentid" => 2,
                "level" => 2
            ])
        ]);

        echo $response->getStatusCode() . "\n";
    }

}