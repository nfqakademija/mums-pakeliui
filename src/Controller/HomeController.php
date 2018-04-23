<?php

namespace App\Controller;

use App\Form\TripSearchType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $form = $this->createForm(TripSearchType::class);
        return $this->render(
            'home/index.html.twig',
            array(
            'form' => $form->createView()
            )
        );
    }
}
