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
 * @Route("/voiture")
 */
class VoitureController extends AbstractController
{
   /**
     * @Route("/v", name="voiture_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $voitures = $entityManager
        ->getRepository(Voiture::class)
        ->findAll();

    return $this->render('voiture/index.html.twig', [
        'voitures' => $voitures,
    ]);
    }
 
    /**
     * @Route("/new", name="voiture_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file=$voiture->getImage();
            $fileName = md5(uniqid().'.'.$file->guessExtension());
            try
            {
                $file->move(
                $this->getParameter('images_diractory'),
                $fileName);
            }catch (FileException $e){
                //...handle exception if something happens during uploading file
            }
            $voiture->setImage($fileName);
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voiture/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }
    

    /**
     * @Route("/{idVoiture}", name="voiture_show", methods={"GET"})
     */
    public function show(Voiture $voiture): Response
    {
        return $this->render('voiture/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    /**
     * @Route("/{idVoiture}/edit", name="voiture_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Voiture $voiture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voiture/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idVoiture}", name="voiture_delete", methods={"POST"})
     */
    public function delete(Request $request, Voiture $voiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getIdVoiture(), $request->request->get('_token'))) {
            $entityManager->remove($voiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voiture_index', [], Response::HTTP_SEE_OTHER);
    }
}
