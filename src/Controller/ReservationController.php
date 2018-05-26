<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Trip;
use App\Form\OfferType;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/reservation", name="reservation_")
 */
class ReservationController extends Controller
{
    const REJECTED = 2;
    const CONFIRMED = 1;
    const OFFER_TYPE = 1;
    /**
     * @Route("/add/{id}", name="add")
     */
    public function reservationAction(
        Request $request,
        Trip $trip,
        EntityManagerInterface $entityManager,
        TripRepository $tripRepository,
        Reservation $reservation = null
    ) {
        $user = $this->getUser();

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reservation = new Reservation();
            $reservation ->setSeats($form["seats"]->getData()) ;
            $reservation->setTrip($trip);
            $reservation->setUser($user);
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('my_trips');
        }

        $form = $this->createForm(OfferType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $offerTrip = $tripRepository->findTripByUserAndDate($user, $trip->getDepartTime());
            $reservation = new Reservation();
            $reservation ->setOffer($offerTrip[0]['id']);
            $reservation ->setType(self::OFFER_TYPE);
            $reservation->setTrip($trip);
            $reservation->setUser($user);
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('my_trips');
        }

        return $this->redirect($this->generateUrl('search'));
    }

    /**
     * @Route("/reject/{id}", name="reject")
     */
    public function rejectAction(Reservation $reservation, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
        $trip = $reservation->getTrip();
        //$owner = $entityManager->find(Trip::class, $trip->getId())->getUser();
        $owner = $trip->getUser();

        if ($user == $owner) {
            $reservation->setStatus(self::REJECTED);
            $entityManager->flush();
        }

        return $this->redirect($this->generateUrl('my_trips'));
    }

    /**
     * @Route("/confirmed/{id}", name="confirmed")
     */
    public function confirmedAction(Reservation $reservation, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
        $trip = $reservation->getTrip();
        $owner = $entityManager->find(Trip::class, $trip->getId())->getUser();

        if ($user == $owner && $user->getId() == $owner->getId()) {
            $reservation->setStatus(self::CONFIRMED);
            $entityManager->flush();
        }

        return $this->redirect($this->generateUrl('my_trips'));
    }
}
