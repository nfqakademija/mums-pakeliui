<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Repository\TripRepository;

class TripsController extends Controller
{
    /**
     * @Route("/trips", name="my_trips")
     */
    public function myTripsAction(TripRepository $tripRepository, ReservationRepository $reservationRepository)
    {
        $user = $this->getUser();
        $trips = $tripRepository->findByUser($user);
        $reservations = $reservationRepository->findByOwnerJoinedTrip($user);
        $yourReservations = $reservationRepository->findByUserJoinedTrip($user);

        return $this->render(
            'trips/index.html.twig',
            [
                'trips' => $trips,
                'reservations' => $reservations,
                'yourReservations' =>  $yourReservations
            ]
        );
    }
}
