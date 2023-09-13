<?php

namespace App\Controller;


use App\Entity\Evenment;

use App\Entity\Vol;
use App\Form\EvenementType;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement", name="app_evenement")
     */
    public function index(): Response
    {
        return $this->render('evenement/evenment.html.twig', [
            'controller_name' => 'EvenementController',
        ]);
    }

    /**
     * @Route("/EvenementList", name="EvenementList")
     */
    public function readEvt()
    {
        $repository = $this->getDoctrine()->getRepository(Evenment::class);
        $Evenements = $repository->findAll();

        return $this->render('evenement/listeEvenement.html.twig', [
            'Evenements' => $Evenements,
        ]);
    }

    /**
     * @Route("/creat-evenement", name="create")
     */
    public function create(Request $request)
    {
        $evenement = new Evenment();
        $form = $this->createForm(EvenementType ::class, $evenement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //upload image
            $uploadFile = $form['image']->getData(); // valeur  image
            $filename = md5(uniqid()) . '.' .$uploadFile->guessExtension();//crypter image

            $uploadFile->move($this->getParameter('kernel.project_dir').'/public/uploads/hotel_image',$filename);


            $evenement->setImage($filename);

            //-----------
            $evenement = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($evenement);
            $em->flush();
            return $this->redirectToRoute('EvenementList');
        }
        
        return $this->render('evenement/create.html.twig', [
            'formA' => $form->createView()
        ])
            ;
    }
        /**
         * @Route("/edit_event/{idEven}", name="edit_event")
         */
        public function edit(\Symfony\Component\HttpFoundation\Request $request, $idEven)
    {
        $em = $this->getDoctrine()->getManager();
        $Evenement = $em->getRepository(Evenment::class)->find($idEven);
        $form = $this->createForm(EvenementType::class, $Evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //upload image
            $uploadFile = $form['image']->getData(); // valeur  image
            $filename = md5(uniqid()) . '.' .$uploadFile->guessExtension();//crypter image

            $uploadFile->move($this->getParameter('kernel.project_dir').'/public/uploads/hotel_image',$filename);


            $Evenement->setImage($filename);

            //-----------
            $em->flush();

            return $this->redirectToRoute('EvenementList');

        }

        return $this->render('evenement/modifierevent.html.twig', array("formA" => $form->createView()));


    }




        /**
         * @Route("/delete_event/{idEven}",name="delete_event")
         */
        public function delete(Request $request, $idEven) {
        $Evenement= $this->getDoctrine()->getRepository(Evenment::class)->find($idEven);


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($Evenement);
        $entityManager->flush();

        $response = new Response();
        $response->send();
        return $this->redirectToRoute('EvenementList');
    }

        /**
         * @Route("/detail_even/{$idEven}", name="detail")
         */
        public function detailEvenement(\Symfony\Component\HttpFoundation\Request $req, $idEven)
        {
            $em = $this->getDoctrine()->getManager();
            $evenement = $em->getRepository(Evenment::class)->find($idEven);


            return $this->render('evenement/detail.html.twig', array(
                'idEven' => $evenement->getidEven(),
                'detail' => $evenement->getDetail(),
                'dateDebut' => $evenement->getDateDebut(),

                'dureeEv' => $evenement->getDureeEv(),
                'commantaire' => $evenement->getCommentaire()

            ));
        }



        /**
         * @Route("/fronteven", name="fronteven")
         */
        public function indexFrontEvent(Request $request, PaginatorInterface $paginator)
    {

        $repo = $this ->getDoctrine()->getRepository(Evenment::class);



        $Evenements=$repo->findAll();





        return $this->render('client/evenment/listevenment.html.twig', [
            'controller_name' => 'EvenementController',
            'Evenements' => $Evenements

        ]);


    }


    /**
     * @Route("/show_event_pdf/{idEven}", name="showpdfh")
     */
    public function Showevenmentpdf(\Symfony\Component\HttpFoundation\Request $req, $idEven)
    {
        $em = $this->getDoctrine()->getManager();
        $absence = $em->getRepository(Evenment::class)->find($idEven);


        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('client/evenment/mypdf.html.twig', [
            'detail'=>$absence->getDetail(),
            'dateDebut' => $absence->getDateDebut(),
            'dateFin' => $absence->getDateFin(),
            'dureeEv' => $absence->getDureeEv(),

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
        $repository = $this->getDoctrine()->getRepository(Evenment::class);
        $requestString = $request->get('searchValue');
        $plan = $repository->findPlanBySujet($requestString);
        return $this->render('evenement/listEvenemeet.html.twig', [
            'Evenements' => $plan,
        ]);
    }

}
