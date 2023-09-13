<?php

namespace App\Controller;

use App\Entity\Voiture;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureClientController extends AbstractController
{
    
    /**
     * @Route("/voiture/client", name="voiture_client")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $voitures = $entityManager
            ->getRepository(Voiture::class)
            ->findAll();

        return $this->render('voiture_client/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }


    /**
     * @Route("/{idVoiture}", name="voiture_client_show", methods={"GET"})
     */
    public function show(Voiture $voiture): Response
    {
        return $this->render('voiture_client/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }

}
