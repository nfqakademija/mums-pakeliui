<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SelectTripTypeController extends Controller
{
    /**
     * @Route("/trip/selectType", name="select_trip_type")
     */
    public function index()
    {
        return $this->render('select_trip_type/index.html.twig', [

        ]);
    }
}
