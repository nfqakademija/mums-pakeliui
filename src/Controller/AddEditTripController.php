<?php
namespace App\Controller;
use App\Form\TripType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Trip;
class AddEditTripController extends AbstractController
{
    /**
     * @Route("/trip/add", name="add_edit_trip")
     */
    public function index(Request $request)
    {
        $isFormUpdate = $request->get('id') != null;
        $form = $this->createForm(TripType::class);
        $form->handleRequest($request);
        if (!$form->isSubmitted() && $isFormUpdate) {
            $id = $request->query->get('id');
            $trip = $this->getDoctrine()
                ->getRepository(Trip::class)
                ->find($id);
            if (!$trip) {
                throw $this->createNotFoundException(
                    'No trip found for id ' . $id
                );
            }
            $form->setData($trip);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $trip = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            if ($isFormUpdate) {
                $oldTrip = $entityManager->getRepository(Trip::class)->find($request->get('id'));
                $oldTrip->setTravelerType($trip->getTravelerType());
                $oldTrip->setDepartFrom($trip->getDepartFrom());
                $oldTrip->setDepartTime($trip->getDepartTime());
                $oldTrip->setInformation($trip->getInformation());
                $oldTrip->setPets($trip->getPets());
                $oldTrip->setSmoke($trip->getSmoke());
                $oldTrip->setSeats($trip->getSeats());
                $oldTrip->setDestination($trip->getDestination());
            } else {
                $entityManager->persist($trip);
            }
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        return  $this->render(
            'add_edit_trip/index.html.twig',
            [
                'our_form' => $form->createView()
            ]
        );
    }
}