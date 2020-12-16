<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProductRepository;
use App\Repository\LocationRepository;
use App\Repository\TestRepository;
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
     * @Route("/search/location", name="location_search")
     */
    public function search()
    {
        return $this->render('default/location.html.twig', [
            //'name' => $name,
        ]);
    }

    /**
     * @Route("/api/search2", name="location_search_by_name2", methods={"GET"})
     */
    public function searchLocations(Request $request, LocationRepository $locationRepository)
    {
        $searchkey = $request->query->get('lname');

        $locations = $locationRepository->searchLocation2($searchkey);
        return $this->json($locations);

        // $locations = $locationRepository->searchLocation($searchkey);
        // $data = array();
        // foreach ($locations as $location) {
        //    $data[]= array("l_id"=>$location['l_id'], "l_name"=>$location['l_name'], "p_id"=>$location['p_id'], "p_name"=>$location['p_name']);
        // }
        // return $this->json($data);
    }

    /**
     * @Route("/api/search", name="location_search_by_name", methods={"GET"})
     */
    public function testDAO(Request $request, TestRepository $testRepository)
    {
        $searchkey = $request->query->get('lname');
        $locations = $testRepository->searchLocation2($searchkey);
        //var_dump($locations);
        return $this->json($locations);
    }

    /**
     * @Route("/api/getobjects", name="get_object_of_location", methods={"GET"})
     */
    public function getObjects(Request $request, TestRepository $testRepository)
    {
        $searchkey = (Int)$request->query->get('lid');
        $objects = $testRepository->getObjectsOfLocation($searchkey);
        return $this->json($objects);
    }

    /**
     * @Route("/api/getlocation", name="get_location_by_name", methods={"GET"})
     */
    public function getLocationByName(Request $request, TestRepository $testRepository)
    {
        $searchkey = $request->query->get('lname');
        $location = $testRepository->getLocationByName($searchkey);
        return $this->json($location);
    }

}