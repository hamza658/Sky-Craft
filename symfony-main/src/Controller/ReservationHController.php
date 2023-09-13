<?php

namespace App\Controller;

use App\api\MailerApi;
use App\api\TwilioApi;
use App\Entity\ReservationH;
use App\Form\ReservationHType;
use App\Repository\ReservationHRepository;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation/h")
 */
class ReservationHController extends AbstractController
{
    /**
     * @Route("/", name="app_reservation_h_index", methods={"GET"})
     */
    public function index(ReservationHRepository $reservationHRepository): Response
    {
        return $this->render('reservation_h/index.html.twig', [
            'reservation_hs' => $reservationHRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_reservation_h_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ReservationHRepository $reservationHRepository,MailerInterface $mailer): Response
    {
        $reservationH = new ReservationH();
        $form = $this->createForm(ReservationHType::class, $reservationH);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservationHRepository->add($reservationH);
           // $email = new MailerApi();
            $twilio = new TwilioApi('ACb2983d38243faf53a2feff8577791bb6','cf7eb799bc39d4083eedd7cd80931e75','+12393635138');
            $twilio->sendSMS('+21653763599','Reservation Créer avec success');
           // $email->sendEmail( $mailer,'skycraft.noreply123@gmail.com','benromdhane.zeineb@esprit.tn','testing email','Reservation Créer avec success');


            return $this->redirectToRoute('app_reservation_h_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation_h/new.html.twig', [
            'reservation_h' => $reservationH,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_reservation_h_show", methods={"GET"})
     */
    public function show(ReservationH $reservationH): Response
    {
        return $this->render('reservation_h/show.html.twig', [
            'reservation_h' => $reservationH,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_reservation_h_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ReservationH $reservationH, ReservationHRepository $reservationHRepository): Response
    {
        $form = $this->createForm(ReservationHType::class, $reservationH);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservationHRepository->add($reservationH);
            return $this->redirectToRoute('app_reservation_h_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation_h/edit.html.twig', [
            'reservation_h' => $reservationH,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_reservation_h_delete", methods={"POST"})
     */
    public function delete(Request $request, ReservationH $reservationH, ReservationHRepository $reservationHRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationH->getId_rh(), $request->request->get('_token'))) {
            $reservationHRepository->remove($reservationH);
        }

        return $this->redirectToRoute('app_reservation_h_index', [], Response::HTTP_SEE_OTHER);
    }
}
