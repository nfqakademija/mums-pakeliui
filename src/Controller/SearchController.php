<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Form\TripSearch;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class SearchController extends AbstractController
{
    /**
     * @Route("/search/results", name="search")
     */

    public function index(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $criteria = array_filter($request->query->all(),"strlen");
        $trips = $entityManager->getRepository(Trip::class)->findBy($criteria);
        $form = $this->createForm(TripSearch::class);
        return $this->render('search/index.html.twig', array(
            'form' => $form->createView(),
            'trips' => $trips
        ));
    }
}
