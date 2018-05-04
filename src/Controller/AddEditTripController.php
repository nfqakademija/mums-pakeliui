<?php

namespace App\Controller;

use App\Form\TripType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Trip;

class AddEditTripController extends AbstractController
{
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
    public function editAction(Request $request, Trip $trip)
    {
        return $this->processForm($request, $trip);
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

            return $this->redirectToRoute('home');
        }

        return  $this->render(
            'add_edit_trip/index.html.twig',
            [
                'our_form' => $form->createView()
            ]
        );
    }
}
