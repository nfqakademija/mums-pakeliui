<?php

namespace App\Controller;

use App\Form\TripType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddTripController extends AbstractController
{
    /**
     * @Route("/add/trip", name="add_trip")
     */
    public function index()
    {
        //return $this->render('add_trip/index.html.twig', [
          //  'controller_name' => 'AddTripController',
        //]);


        $form = $this->createForm(TripType::class);
   return  $this->render('add_trip/index.html.twig',[
        'our_form' => $form->createView()
    ]);


    }


}
