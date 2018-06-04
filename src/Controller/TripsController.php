<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Repository\TripRepository;

class TripsController extends Controller
{
    /**
     * @Route("/trips", name="my_trips", methods={"GET", "HEAD"})
     */
    public function myTripsAction(Request $request, TripRepository $tripRepository, ReservationRepository $reservationRepository)
    {
        $user = $this->getUser();
        $trips = $tripRepository->findByUser($user);
        $reservations = $reservationRepository->findByOwnerJoinedTrip($user);
        $yourReservations = $reservationRepository->findByUserJoinedTrip($user);
        $trip = new Trip();
        $form = $this->createFormBuilder($trip)
        ->setMethod("POST")->getForm();

        return $this->render(
            'trips/index.html.twig',
            [
                'trips' => $trips,
                'reservations' => $reservations,
                'yourReservations' =>  $yourReservations,
                'edit_form' => $form->createView(),
            ]
        );
    }

}
