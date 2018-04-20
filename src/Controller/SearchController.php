<?php

namespace App\Controller;

use App\Entity\Trip;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    /**
     * @Route("/search/results", name="search")
     */

    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $trips = $entityManager->getRepository(Trip::class)->findAll();
        return $this->render('search/index.html.twig', [
            'trips' => $trips
        ]);
    }
}
