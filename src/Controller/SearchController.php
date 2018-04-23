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
        $formData = $request->query->all();

        if(($request->query->get('departDate')=='')&&($request->query->get('departTime')==''))  {
            $criteria = array_filter($request->query->all(), "strlen");

        }
        else {
            if($formData['departDate']==''){
                $formData['departDate'] =  date('Y-m-d');

            }
            if($formData['departTime']==''){
                $formData['departTime'] =  date('H:i');

            }
            $departDate = date('Y-m-d', strtotime($formData['departDate']));
            $departTime = date('H:i', strtotime($formData['departTime']));
            $date = new \DateTime(sprintf('%s %s', $departDate, $departTime));

            $criteria = array_filter($request->query->all(), "strlen");
            unset($criteria['departDate']);
            $criteria['departTime'] = $date;
        }
        $trips = $entityManager->getRepository(Trip::class)->findBy($criteria);
        return $this->render('search/index.html.twig', array(
            'form' => $form->createView(),
            'trips' => $trips
        ));
    }
}
