<?php
namespace App\Importe\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class LocationClient
{
    public $params;

    function __construct(ContainerBagInterface $params) {
        $this->params = $params;
    }

    function getLocationByName(String $ortName) {

        $location_get_url = $this->params->get('location_get_url');

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $location_get_url.$ortName);
        //var_dump(json_decode ($response->getBody()));
        //echo (int)json_decode ($response->getBody())->l_id;
        return (int)json_decode ($response->getBody())->l_id;
    }

    function searchLocationByName(String $searchkey) {

        $location_search_url = $this->params->get('location_search_url');

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $location_search_url.$searchkey);
        //var_dump(json_decode ($response->getBody()));
        // foreach (json_decode ($response->getBody()) as $obj) {
        //     echo "------------\n";
        //     echo $obj->l_id . " | " . $obj->l_name . "\n";
        // }
        return json_decode ($response->getBody());
    }

    function insertLocation(iterable $location) {
        //$location = [
        //    "name" => "Hanoi", 
        //    "parentid" => 2,
        //    "level" => 2
        //];
        $location_insert_url = $this->params->get('location_insert_url'); 

        $client = new \GuzzleHttp\Client();
        $response = $client->post($location_insert_url, [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($location)
        ]);

        return $response->getStatusCode();
    }

}

