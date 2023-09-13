<?php

namespace App\Controller;

use App\Entity\Chauffeur;
use App\Form\ChauffeurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/chauffeur")
 */
class ChauffeurController extends AbstractController
{
    /**
     * @Route("/", name="chauffeur_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $chauffeurs = $entityManager
            ->getRepository(Chauffeur::class)
            ->findAll();

        return $this->render('chauffeur/index.html.twig', [
            'chauffeurs' => $chauffeurs,
        ]);
    }

    /**
     * @Route("/new", name="chauffeur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $chauffeur = new Chauffeur();
        $form = $this->createForm(ChauffeurType::class, $chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($chauffeur);
            $entityManager->flush();

            return $this->redirectToRoute('chauffeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chauffeur/new.html.twig', [
            'chauffeur' => $chauffeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idChauffeur}", name="chauffeur_show", methods={"GET"})
     */
    public function show(Chauffeur $chauffeur): Response
    {
        return $this->render('chauffeur/show.html.twig', [
            'chauffeur' => $chauffeur,
        ]);
    }



    /**
     * @Route("/{idChauffeur}/pdf", name="chauffeur_pdff", methods={"GET"})
     */
    public function pdf(Chauffeur $chauffeur): Response
    {
       
                // Configure Dompdf according to your needs
                $pdfOptions = new Options();
                $pdfOptions->set('defaultFont', 'Arial');
                
                // Instantiate Dompdf with our options
                $dompdf = new Dompdf($pdfOptions);
                
                // Retrieve the HTML generated in our twig file
                $html = $this->render('chauffeur/pdfchauffeur.html.twig', [
                    'chauffeur' => $chauffeur,]);
                
                // Load HTML to Dompdf
                $dompdf->loadHtml($html);
                
                // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
                $dompdf->setPaper('A4', 'portrait');
        
                // Render the HTML as PDF
                $dompdf->render();
        
                // Output the generated PDF to Browser (force download)
                $dompdf->stream("mypdf.pdf", [
                    "Attachment" => true
                ]);
            }
        


    /**
     * @Route("/{idChauffeur}/edit", name="chauffeur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Chauffeur $chauffeur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChauffeurType::class, $chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('chauffeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chauffeur/edit.html.twig', [
            'chauffeur' => $chauffeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idChauffeur}", name="chauffeur_delete", methods={"POST"})
     */
    public function delete(Request $request, Chauffeur $chauffeur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chauffeur->getIdChauffeur(), $request->request->get('_token'))) {
            $entityManager->remove($chauffeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chauffeur_index', [], Response::HTTP_SEE_OTHER);
    }
}
