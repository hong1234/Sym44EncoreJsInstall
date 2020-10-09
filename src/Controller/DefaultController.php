<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProductRepository;
use App\Repository\LocationRepository;
use App\Service\Menu;

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
     * @Route("/", name="home_page")
     */
    public function home()
    {
        return $this->render('default/index.html.twig', [
            //'main_menu' => $menu
        ]);
    }

    /**
     * @Route("/main", name="main_page")
     */
    public function main(Menu $menu=null)
    {
        return $this->render('default/main.html.twig', [
            'main_menu2' => $menu
        ]);
    }

    /**
     * @Route("/search/location", name="search_location")
     */
    public function search()
    {
        return $this->render('default/location.html.twig', [
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
