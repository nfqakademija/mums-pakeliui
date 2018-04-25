<?php

namespace App\Controller;

use App\Form\TripSearchType;
use App\Repository\TripRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\VarDumper;

class HomeController extends Controller
{

    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $form = $this->getSearchForm();
        return $this->render(
            'home/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request, TripRepository $tripRepository)
    {
        $form = $this->getSearchForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cloner = new VarCloner();
            $dumper = new VarDumper();
            $dumper->dump($cloner->cloneVar($tripRepository));

            $trips = $tripRepository->findBySomeField($form->getData());
            //die(1);
            return $this->render(
                'search/index.html.twig',
                [
                    'form' => $form->createView(),
                    'trips' => $trips
                ]
            );
        }

        return $this->render(
            'home/index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    protected function getSearchForm()
    {
        return $this->createForm(
            TripSearchType::class,
            null,
            [
                'method' => 'GET',
                'action' => $this->generateUrl('search')
            ]
        );
    }
}
