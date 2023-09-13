<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/voiture/clint")
 */

class VoitureClintController extends AbstractController
{
    /**
     * @Route("/voiture/clint", name="voiture_clint", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $voitures = $entityManager
            ->getRepository(Voiture::class)
            ->findAll();

        return $this->render('voiture_clint/index.html.twig', [
            'controller_name' => 'VoitureClintController',
        ]);
    }
}
