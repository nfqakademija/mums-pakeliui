<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Trip;

class ShowTripController extends Controller
{
    /**
     * @Route("/trip/show", name="show_trip")
     */
    public function index(Request $request)
    {
        $request->getPathInfo();
        $id = $request->query->get('id');


        $trip = $this->getDoctrine()
            ->getRepository(Trip::class)
            ->find($id);

        if (!$trip) {
            throw $this->createNotFoundException(
                'No trip found for id ' . $id
            );
        }

        return $this->render('show_trip/index.html.twig', ['trip' => $trip]);

    }
}
