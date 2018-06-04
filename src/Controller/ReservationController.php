<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Trip;
use App\Form\OfferType;
use App\Form\ReservationType;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    const RESERVATION_TYPE_RESERVATION = 0;

    /**
     * @Route("/add/{id}", name="add", methods={"POST"})
     */
    public function reservationAction(
        Request $request,
        Trip $trip,
        TripRepository $tripRepository,
        EntityManagerInterface $entityManager,
        Reservation $reservation = null
    ) {
        $user = $this->getUser();

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->reservationAddAction(
                $entityManager,
                $user,
                $trip,
                self::RESERVATION_TYPE_RESERVATION,
                $form["seats"]->getData()
            );
            $this->addFlash('success', 'Pavyko rezervuoti! Laukite vairuotojo rezervacijos patvirtinimo.');
            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        $form = $this->createForm(OfferType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $driverTrip = $tripRepository->findOneByUserAndDate($user, $trip->getDepartTime());
            if (isset($driverTrip['id'])) {
                $this->reservationAddAction(
                    $entityManager,
                    $user,
                    $trip,
                    self::RESERVATION_TYPE_OFFER,
                    $seats = 0,
                    $driverTrip['id']
                );

                $this->addFlash('success', 'Sėkmingai pasiūlėte kelionę!');
                return $this->redirect($request->server->get('HTTP_REFERER'));
            }
                $this->addFlash('danger', 'Neturite kelionės šiai dienai!');
                return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        return $this->redirect($this->generateUrl('my_trips'));
    }

    /**
     * @Route("/reject/{id}", name="reject", methods={"PUT"})
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
        $response = new JsonResponse();
        return $response->setData(array(
            'reponse'=>'OK',
        ));
    }

    /**
     * @Route("/confirmed/{id}", name="confirmed", methods={"PUT"})
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
        $response = new JsonResponse();
        return $response->setData(array(
            'reponse'=>'OK',
        ));
    }

    private function reservationAddAction(
        EntityManagerInterface $entityManager,
        $user,
        $trip,
        $type,
        $seats,
        $driverTrip = 0
    ) {
        $reservation = new Reservation();
        if ($type == self::RESERVATION_TYPE_OFFER) {
            $reservation->setOffer($driverTrip);
        }
        $reservation ->setSeats($seats);
        $reservation->setType($type);
        $reservation->setTrip($trip);
        $reservation->setUser($user);
        $entityManager->persist($reservation);
        $entityManager->flush();
    }
}
