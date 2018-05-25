<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Trip;
use App\Form\OfferType;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/reservation", name="reservation_")
 */
class ReservationController extends Controller
{
    /**
     * @Route("/add/{id}", name="add")
     */
    public function reservationAction(
        Request $request,
        Trip $trip,
        EntityManagerInterface $entityManager,
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
            $reservation = new Reservation();
            //$reservation ->setOffer($form["offer"]->getData()) ;
            $reservation ->setType(1);
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
        $owner = $entityManager->find(Trip::class, $trip->getId())->getUser();

        if ($user == $owner && $user->getId() == $owner->getId()) {
            $reservation->setStatus(2);
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
            $reservation->setStatus(1);
            $entityManager->flush();
        }

        return $this->redirect($this->generateUrl('my_trips'));
    }
}
