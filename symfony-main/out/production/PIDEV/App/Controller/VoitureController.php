<?php

namespace App\Controller;

use App\Entity\Evenment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    /**
     * @Route("/voiture", name="voiture")
     */
    public function index(): Response
    {
        return $this->render('voiture/index.html.twig', [
            'controller_name' => 'VoitureController',
        ]);
    }

    /**
     * @Route("/VoitureList", name="VoitureList")
     */
    public function readVoiture()
    {
        $repository = $this->getDoctrine()->getRepository(Voiture::class);
        $Voitures = $repository->findAll();

        return $this->render('evenement/listeEvenement.html.twig', [
            'Voitures' => $Voitures,
        ]);
    }
}
