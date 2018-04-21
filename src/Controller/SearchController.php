<?php

namespace App\Controller;

use App\Entity\Trip;
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
        $criteria = array();
        $entityManager = $this->getDoctrine()->getManager();
        $depart = $_GET['depart'];
        If($_GET['depart'] !=''){
            $criteria['departFrom'] = $depart;
        }
        $destination = $_GET['destination'];
        If($_GET['destination'] !=''){
            $criteria['destination'] = $destination;
        }

        $trips = $entityManager->getRepository(Trip::class)->findBy($criteria);

        return $this->render('search/index.html.twig', [

            'trips' => $trips
        ]);
    }
}
