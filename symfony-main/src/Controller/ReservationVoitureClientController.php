<?php

namespace App\Controller;


use App\Entity\ReservationVoiture;
use App\Form\ReservationVoitureClientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationVoitureClientController extends AbstractController
{
    /**
     * @Route("/reservation/voiture/client", name="reservation_voiture_client")
     */
    public function index(): Response
    {
        return $this->render('reservation_voiture_client/index.html.twig', [
            'controller_name' => 'ReservationVoitureClientController',
        ]);
    }

    

}
