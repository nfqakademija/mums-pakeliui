<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Form\TripSearchType;
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

        $criteria = array_filter($request->query->all(), "strlen");
        //$criteria = $request->query->all();
        // var_dump($request->query->all());
        $trips = $entityManager->getRepository(Trip::class)->findBy($criteria);
        $form = $this->createForm(TripSearchType::class);
        return $this->render(
            'search/index.html.twig',
            array(
            'form' => $form->createView(),
            'trips' => $trips
            )
        );
    }
}
