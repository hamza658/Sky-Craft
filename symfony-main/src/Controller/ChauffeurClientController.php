<?php

namespace App\Controller;
use App\Entity\Chauffeur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChauffeurClientController extends AbstractController
{
    /**
     * @Route("/chauffeur/client", name="chauffeur_client")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $chauffeurs = $entityManager
            ->getRepository(Chauffeur::class)
            ->findAll();
        
        return $this->render('chauffeur_client/index.html.twig', [
            'chauffeurs' => $chauffeurs,
        ]);
    }
}
