<?php

namespace App\Controller;

use App\Form\TripSearchType;
use App\Repository\TripRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
     * @Route("/search/{page}/", name="search", requirements={"page" ="\d+"})
     * @Method("GET")
     */
    public function searchAction(Request $request, TripRepository $tripRepository, $page)
    {
        $form = $this->getSearchForm($page, true);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trips = $tripRepository->findBySomeField($page, $form->getData());

            $pagination = [
                'page' => $page,
                'nbPages' => ceil(count($trips) / TripRepository::MAX_PER_PAGE),
                'nomRoute' => 'search',
                'paramsRoute' => $request->query->all(),
            ];

            return $this->render(
                'search/index.html.twig',
                [
                    'form' => $form->createView(),
                    'trips' => $trips,
                    'pagination' => $pagination
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

    protected function getSearchForm($addFilterFields = false)
    {
        return $this->createForm(
            TripSearchType::class,
            null,
            [
                'method' => 'GET',
                'action' => $this->generateUrl('search', ['page' => 1]),
                'add_filter_fields' => $addFilterFields,
            ]
        );
    }
}
