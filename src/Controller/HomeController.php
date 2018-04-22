<?php

namespace App\Controller;

use App\Form\TripSearch;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $form = $this->createForm(TripSearch::class);
        return $this->render('base.html.twig',  array(
            'form' => $form->createView()
        ));
    }
}
