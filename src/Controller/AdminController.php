<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Location;
use App\Form\Type\LocationType;

class AdminController extends AbstractController
{
    /**
    * @Route("/admin/new", name="location_new")
    */
    public function new(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $location = new Location();
        //$location->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createForm(LocationType::class, $location, array(
            'entityManager' => $entityManager,
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $location = $form->getData();
            //var_dump($location);exit;
            
            $parent = $entityManager->getRepository(Location::class)->find($location->getParentId());
            $location->setParent($parent);          
            $entityManager->getRepository(Location::class)->addLocation($location);
            return $this->redirectToRoute('location_search', [
                 //'id' => $product->getId()
            ]);
        }

        return $this->render('location/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

