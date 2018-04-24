<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Form\TripSearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * @Route("/search/results", name="search")
     */

    public function index(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(TripSearchType::class);
        $form->handleRequest($request);

        $trips = $entityManager->getRepository(Trip::class)->createQueryBuilder('t')
            ->orderBy('t.departTime', 'desc');

        if ($request->query->get('departFrom') !='') {
            $trips->andWhere('t.departFrom = :departFrom')
            ->setParameter('departFrom', $request->query->get('departFrom'));
        }

        if ($request->query->get('destination') !='') {
            $trips->andWhere('t.destination = :destination')
                ->setParameter('destination', $request->query->get('destination'));
        }

        if ($request->query->get('travelerType') !='') {
            $trips->andWhere('t.travelerType = :travelerType')
                ->setParameter('travelerType', $request->query->get('travelerType'));
        }

        if ($request->query->get('smoke') !='') {
            $trips->andWhere('t.smoke = :smoke')
                ->setParameter('smoke', $request->query->get('smoke'));
        }

        if ($request->query->get('pets') !='') {
            $trips->andWhere('t.pets = :pets')
                ->setParameter('pets', $request->query->get('pets'));
        }

        if (($request->query->get('departDate') !='')&&($request->query->get('departTime') =='')) {
            $departDate = date('Y-m-d', strtotime($request->query->get('departDate')));
            $trips->andWhere('t.departTime LIKE :departTime')
                ->setParameter('departTime', $departDate.'%');
        }

        if (($request->query->get('departDate') != '')&&($request->query->get('departTime') !='')) {
            $departDate = date('Y-m-d', strtotime($request->query->get('departDate')));
            $departTime = date('H:i', strtotime($request->query->get('departTime')));
            $date = new \DateTime(sprintf('%s %s', $departDate, $departTime));
            $trips->andWhere('t.departTime = :departTime')
                ->setParameter('departTime', $date);
        }
        $query = $trips->getQuery();

        return $this->render('search/index.html.twig', array(
            'form' => $form->createView(),
            'trips' => $query->getResult()
        ));
    }
}
