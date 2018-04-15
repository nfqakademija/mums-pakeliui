<?php

namespace App\Controller;

use App\Form\TripType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AddTripController extends AbstractController
{
    /**
     * @Route("/add/trip", name="add_trip")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(TripType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $trip= $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($trip);
             $entityManager->flush();

            return $this->redirectToRoute('home');
        }


        return  $this->render('add_trip/index.html.twig',[
            'our_form' => $form->createView()
        ]);

    }
}
