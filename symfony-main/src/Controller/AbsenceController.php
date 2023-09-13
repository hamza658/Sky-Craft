<?php

namespace App\Controller;

use App\Entity\Absence;

use App\Form\AbsenceType;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AbsenceController extends AbstractController
{
    /**
     * @Route("/", name="absence")
     */
    public function index(): Response
    {

        return $this->render('base2.html.twig', [

            'controller_name' => 'AbsenceController',
        ]);
    }

    /**
     * @Route("/AbsenceListe", name="AbsenceListe")
     */
    public function readEvt()
    {
        $repository = $this->getDoctrine()->getRepository(Absence::class);
        $Absences = $repository->findAll();

        return $this->render('absence/listeAbsence.html.twig', [
            'Absences' => $Absences,
        ]);
    }


    /**
     * @Route("/creat-absence", name="create_abs")
     */
    public function create(Request $request)
    {
        $absence = new Absence();
        $form = $this->createForm(AbsenceType ::class, $absence);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $absence = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($absence);
            $em->flush();
            return $this->redirectToRoute('AbsenceListe');
        }
        return $this->render('absence/create.html.twig', [
            'formA' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit_abs/{idAb}", name="edit_abs")
     */
    public function edit(\Symfony\Component\HttpFoundation\Request $request, $idAb)
    {
        $em = $this->getDoctrine()->getManager();
        $Absence = $em->getRepository(Absence::class)->find($idAb);
        $form = $this->createForm(AbsenceType::class, $Absence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('AbsenceListe');

        }

        return $this->render('absence/modifierabs.html.twig', array("formA" => $form->createView()));


    }

    /**
     * @Route("/delete_abs/{idAb}",name="delete_abs")
     */
    public function delete(Request $request, $idAb)
    {
        $Absence = $this->getDoctrine()->getRepository(Absence::class)->find($idAb);


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($Absence);
        $entityManager->flush();

        $response = new Response();
        $response->send();
        return $this->redirectToRoute('AbsenceListe');
    }

    /**
     * @Route("/detail_abs/{$idAb}", name="detail_abs")
     */
    public function detail()
    {
        $repository = $this->getDoctrine()->getRepository(Absence::class);
        $Absences = $repository->findAll();

        return $this->render('absence/detail.html.twig', [
            'Absences' => $Absences,
        ]);
    }
    /**
     * @Route("/detail_abs1/{$idAb}", name="detail_abs1")
     */
    public function detail1()
    {
        $repository = $this->getDoctrine()->getRepository(Absence::class);
        $Absences = $repository->findAll();

        return $this->render('absence/detail1.html.twig', [
            'Absences' => $Absences,
        ]);
    }
    /**
     * @Route("/detail_abs2/{$idAb}", name="detail_abs2")
     */
    public function detail2()
    {
        $repository = $this->getDoctrine()->getRepository(Absence::class);
        $Absences = $repository->findAll();

        return $this->render('absence/detail2.html.twig', [
            'Absences' => $Absences,
        ]);
    }
    /**
     * @Route("/detail_abs3/{$idAb}", name="detail_abs3")
     */
    public function detail3()
    {
        $repository = $this->getDoctrine()->getRepository(Absence::class);
        $Absences = $repository->findAll();

        return $this->render('absence/detail3.html.twig', [
            'Absences' => $Absences,
        ]);
    }
    /**
     * @Route("/detail_abs4/{$idAb}", name="detail_abs4")
     */
    public function detail4()
    {
        $repository = $this->getDoctrine()->getRepository(Absence::class);
        $Absences = $repository->findAll();

        return $this->render('absence/detail4.html.twig', [
            'Absences' => $Absences,
        ]);
    }
    /**
     * @Route("/detail_abs5/{$idAb}", name="detail_abs5")
     */
    public function detail5()
    {
        $repository = $this->getDoctrine()->getRepository(Absence::class);
        $Absences = $repository->findAll();

        return $this->render('absence/detail5.html.twig', [
            'Absences' => $Absences,
        ]);
    }
    /**
     * @Route("/detail_abs6/{$idAb}", name="detail_abs6")
     */
    public function detail6()
    {
        $repository = $this->getDoctrine()->getRepository(Absence::class);
        $Absences = $repository->findAll();

        return $this->render('absence/detail6.html.twig', [
            'Absences' => $Absences,
        ]);
    }
    /**
     * @Route("/show_Absence_pdf/{idAb}", name="showpdf")
     */
    public function Showabsencepdf(\Symfony\Component\HttpFoundation\Request $req, $idAb)
    {
        $em = $this->getDoctrine()->getManager();
        $absence = $em->getRepository(Absence::class)->find($idAb);


        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('absence/mypdf.html.twig', [
            'id'=>$absence->getId(),
            'etatAbsence' => $absence->getEtatAbsence(),
            'dateAb' => $absence->getDateAb(),
            'finAb' => $absence->getFinAb(),

        ]);


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
     * @Route("/searchuser", name="utilsearchuser")
     */
    public function searchPlan(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Absence::class);
        $requestString = $request->get('searchValue');
        $plan = $repository->findPlanBySujet($requestString);
        return $this->render('absence/listeAbsence.html.twig', [
            'users' => $plan,
        ]);
    }
}
