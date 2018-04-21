<?php

namespace App\Controller;


use App\Form\Search;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    /**
     * @Route("/search/results", name="search")
     */

    public function index(Request $request)
    {
        //$entityManager = $this->getDoctrine()->getManager();
       // $trips = $entityManager->getRepository(Trip::class)->findAll();
        $form = $this->createForm(Search::class);
        $form->handleRequest($request);
        return $this->render('base.html.twig',[
            'search_form' => $form->createView()
        ]);
    }
}
