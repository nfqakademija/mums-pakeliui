<?php

namespace App\Controller;

use App\Form\OfferType;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\TripType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Trip;

/**
 * @Route("/trip", name="trip_")
 */
class TripController extends Controller
{
    /**
     * @Route("/show/{id}", name="show")
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
     * @Route("/edit/{id}", name="edit")
     */
    public function editAction(Request $request, Trip $trip)
    {
        if ($trip->getUser()) {
            return $this->processForm($request, $trip);
        }
            return $this->redirectToRoute('my_trips');
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAction(Trip $trip, EntityManagerInterface $entityManager)
    {

        $user = $this->getUser();
        $owner = $trip->getUser();

        if ($user == $owner) {
            $entityManager->remove($entityManager->find(Trip::class, $trip));
            $entityManager->flush();
        }

        return $this->redirect($this->generateUrl('my_trips'));
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

            return $this->redirectToRoute('my_trips');
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
