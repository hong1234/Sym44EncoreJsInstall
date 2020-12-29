<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Location\Service\SearchService;
use App\Location\Service\LocationService;

/**
 * Class LocationController
 * @package App\Controller
 *
 * @Route(path="/api/location")
 */
class LocationController extends AbstractController
{
    /**
     * @Route("/search", name="api_location_search_by_name", methods={"GET"})
     */
    public function searchLocations(Request $request, SearchService $searchService)
    {
        //  /api/location/search?lname=Bam
        $searchkey = $request->query->get('lname');
        $locations = $searchService->searchLocationByName($searchkey);
        return $this->json($locations);
        //return new Response(json_encode($locations), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("", name="api_location_get_by_name", methods={"GET"})
     */
    public function getLocationByName(Request $request, LocationService $locationService)
    {
        //  /api/location?lname=Bamberg
        $lname = $request->query->get('lname');
        $location = $locationService->getLocationByName($lname);
        return $this->json($location);
        //return new Response(json_encode($location), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("", name="api_location_insert", methods={"POST"})
     */
    public function insertLocation(Request $request, LocationService $locationService)
    {
        // json Body format
        //{ 
        //    "name":"Testloc", 
        //    "parentid": 2,
        //    "level": 2
        //}

        $location = json_decode($request->getContent(), true);
        $status = $locationService->insertLocation($location);
        return new Response(json_encode($status), Response::HTTP_CREATED, ['Content-Type' => 'application/json']);
    }
}