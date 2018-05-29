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
    const STATUS_REJECTED = 2;
    const STATUS_CONFIRMED = 1;
    const RESERVATION_TYPE_OFFER = 1;
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

            $this->addFlash('success', 'Pavyko rezervuoti! Laukite vairuotojo rezervacijos patvirtinimo.');
            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        $form = $this->createForm(OfferType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $offerTrip = $tripRepository->findTripByUserAndDate($user, $trip->getDepartTime());
            if (isset($offerTrip[0]['id'])) {
                $reservation = new Reservation();
                $reservation->setOffer($offerTrip[0]['id']);
                $reservation->setType(self::RESERVATION_TYPE_OFFER);
                $reservation->setTrip($trip);
                $reservation->setUser($user);
                $entityManager->persist($reservation);
                $entityManager->flush();
                $this->addFlash('success', 'Sėkmingai pasiūlėte kelionę!');
                return $this->redirect($request->server->get('HTTP_REFERER'));
            } else {
                $this->addFlash('danger', 'Neturite kelionės šiai dienai!');
                return $this->redirect($request->server->get('HTTP_REFERER'));
            }
        }

        return $this->redirect($this->generateUrl('my_trips'));
    }

    /**
     * @Route("/reject/{id}", name="reject")
     */
    public function rejectAction(Reservation $reservation, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
        $trip = $reservation->getTrip();
        $owner = $trip->getUser();

        if ($user == $owner) {
            $reservation->setStatus(self::STATUS_REJECTED);
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
            $reservation->setStatus(self::STATUS_CONFIRMED);
            $entityManager->flush();
        }

        return $this->redirect($this->generateUrl('my_trips'));
    }
}
