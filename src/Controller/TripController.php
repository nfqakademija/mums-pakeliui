<?php

namespace App\Controller;

use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\TripType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Trip;
use App\Repository\TripRepository;

/**
 * @Route("/trip", name="trip_")
 */
class TripController extends Controller
{
    /**
     * @Route("/show/{id}", name="show")
     */
    public function showAction(Request $request, Trip $trip)
    {
        $form = $this->getReservationForm($request, $trip);
        $show = $this->getDoctrine()
                      ->getRepository(Trip::class)
                      ->find($trip);

        if (!$show) {
            throw $this->createNotFoundException(
                'No trip found '
            );
        }
        return $this->render('show_trip/index.html.twig', ['trip' => $show, 'form' => $form->createView()]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function addAction(Request $request)
    {
        return $this->processForm($request);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editAction(Request $request, Trip $trip)
    {
        if ($trip->getUser()) {
            return $this->processForm($request, $trip);
        }
            return $this->redirectToRoute('trip_my_trips');
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAction(Trip $trip, EntityManagerInterface $entityManager)
    {

        $user = $this->getUser();
        $owner = $entityManager->find(Trip::class, $trip)->getUser();

        if ($user == $owner && $user->getId() == $owner->getId()) {
            $entityManager->remove($entityManager->find(Trip::class, $trip));
            $entityManager->flush();
        }

        return $this->redirect($this->generateUrl('trip_my_trips'));
    }

    /**
     * @Route("/trips", name="my_trips")
     */
    public function myTripsAction(TripRepository $tripRepository, ReservationRepository $reservationRepository)
    {
        $user = $this->getUser();
        $trips = $tripRepository->findByUser($user);
        $reservations = $reservationRepository->findByUserJoinedTrip($user);

        return $this->render(
            'trips/index.html.twig',
            [
                'trips' => $trips,
                'reservations' => $reservations
            ]
        );
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

            return $this->redirectToRoute('trip_my_trips');
        }

        return  $this->render(
            'add_edit_trip/index.html.twig',
            [
                'our_form' => $form->createView()
            ]
        );
    }
    protected function getReservationForm(Request $request, Trip $trip)
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
}
