<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewTripTypeController extends Controller
{
    /**
     * @Route("/new/trip/type", name="new_trip_type")
     */
    public function index()
    {
        return $this->render('new_trip_type/index.html.twig', [
            'controller_name' => 'NewTripTypeController',
        ]);
    }
}
