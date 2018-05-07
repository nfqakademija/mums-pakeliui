<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\TripType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Trip;
use App\Repository\TripRepository;
use App\Repository\UserRepository;

class TripController extends Controller
{
    /**
     * @Route("/trip", name="show_trip")
     */
    public function index(Request $request)
    {
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
    /**
     * @Route("/trip/add", name="add_edit_trip")
     */
    public function addAction(Request $request)
    {
        return $this->processForm($request);
    }
    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editAction(Request $request, Trip $trip, TripRepository $tripRepository)
    {
        $user = $this->getUser()->getId();
        if($user == $trip->getUser()->getId()) {
            return $this->processForm($request, $trip);
        } else{
            return $this->redirectToRoute('my_trips');
        }
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

    /**
     * @Route("/trip/delete/{id}", name="delete_trip")
     */
    public function deleteAction($id){

        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser()->getId();
        $owner = $entityManager->find(Trip::class, $id)->getUser()->getId();

        if($user == $owner ) {
           $entityManager->remove($entityManager->find(Trip::class, $id));
           $entityManager->flush();
        }


        return $this->redirect($this->generateUrl('my_trips'));
    }
    /**
     * @Route("/trips", name="my_trips")
     */
    public function myTripsAction(TripRepository $tripRepository, UserRepository $userRepository)
    {
        $user = $this->getUser()->getId();
        $trips = $tripRepository->findByUser($user);
        return $this->render(
            'trips/index.html.twig',
            [
                'trips' => $trips
            ]
        );
    }
}
