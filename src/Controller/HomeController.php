<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
<<<<<<< HEAD
        return $this->render('base.html.twig', [
=======
        return $this->render('home/index.html.twig', [
>>>>>>> 849e895edaa0aa44bb175419cbb7e10ef84bde59
            'controller_name' => 'HomeController',
        ]);
    }
}
