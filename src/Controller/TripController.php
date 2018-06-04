<?php

namespace App\Controller;

use App\Form\OfferType;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\TripType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Trip;

/**
 * @Route("/trips", name="trips_")
 */
class TripController extends Controller
{
    /**
     * @Route("/", name="my", methods={"GET", "HEAD"})
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
    /**
     * @Route("/show/{id}", name="show", methods={"GET", "HEAD"})
     */
    public function showAction(Trip $trip)
    {
        $form = $this->getReservationForm($trip);
        $formOffer = $this->getOfferForm($trip);

        return $this->render(
            'show_trip/index.html.twig',
            [
            'trip' => $trip, 'form' => $form->createView(), 'form_offer' => $formOffer->createView()
            ]
        );
    }

    /**
     * @Route("/add", name="add")
     */
    public function addAction(Request $request)
    {
        return $this->processForm($request);
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"POST"})
     */
    public function editAction(Request $request, Trip $trip)
    {
        $user = $this->getUser();
        $owner = $trip->getUser();
        if ($user == $owner) {
            return $this->processForm($request, $trip);
        }
            return $this->redirectToRoute('trips_my');
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     */
    public function deleteAction(Trip $trip, EntityManagerInterface $entityManager)
    {

        $user = $this->getUser();
        $owner = $trip->getUser();

        if ($user == $owner) {
            $entityManager->remove($entityManager->find(Trip::class, $trip));
            $entityManager->flush();
        }

        $response = new JsonResponse();
        return $response->setData(array(
            'reponse'=>'OK',
        ));
    }

    protected function processForm(Request $request, Trip $trip = null)
    {
        $form = $this->createForm(TripType::class, $trip);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $trip = $form->getData();
            $user = $this->getUser();
            $trip->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trip);
            $entityManager->flush();

            return $this->redirectToRoute('trips_my');
        }

        return  $this->render(
            'add_edit_trip/index.html.twig',
            [
                'our_form' => $form->createView()
            ]
        );
    }

    protected function getReservationForm(Trip $trip)
    {
        return $this->createForm(
            ReservationType::class,
            null,
            [
                'method' => 'POST',
                'action' => $this->generateUrl('reservation_add', ['id'=>$trip->getId()])
            ]
        );
    }

    protected function getOfferForm(Trip $trip)
    {
        return $this->createForm(
            OfferType::class,
            null,
            [
                'method' => 'POST',
                'action' => $this->generateUrl('reservation_add', ['id'=>$trip->getId()])
            ]
        );
    }
}
