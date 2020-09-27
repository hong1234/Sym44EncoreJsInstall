<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Repository\LocationRepository;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DefaultController.php',
        ]);
    }

    /**
     * @Route("/search/location")
     */
    public function search()
    {
        return $this->render('default/index.html.twig', [
            //'name' => $name,
        ]);
    }

    /**
     * @Route("/api/search", name="search_location_name", methods={"GET"})
     */
    public function searchLocations(Request $request, LocationRepository $locationRepository)
    {
        $searchkey = $request->query->get('lname');
        $locations = $locationRepository
                     //->searchLocation($searchkey)
                     ->searchLocation2($searchkey)
        ;
        //var_dump(locations);exit;

        //$data = array();
        //foreach ($locations as $location) {
        //   $data[]= array("lid"=>$location['l_id'], "name"=>$location['l_name'], "pid"=>$location['p_id'], "parent"=>$location['p_name']);
        //}
        //return $this->json($data);

        return $this->json($locations);
    }

}
