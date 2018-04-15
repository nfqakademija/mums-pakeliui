<?php

namespace App\Controller;

use App\Entity\Trip;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $trips = $entityManager->getRepository(Trip::class)->findAll();
        return $this->render('home/index.html.twig', [
            'trips' => $trips
        ]);
    }
}
