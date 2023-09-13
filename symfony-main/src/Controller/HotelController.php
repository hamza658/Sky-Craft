<?php

namespace App\Controller;

use App\api\MailerApi;
use App\api\TwilioApi;
use App\Entity\Hotel;
use App\Form\HotelType;
use App\Repository\HotelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hotel")
 */
class HotelController extends AbstractController
{
    /**
     * @Route("/", name="app_hotel_index", methods={"GET"})
     */
    public function index(HotelRepository $hotelRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Hotel::class)->findBy([], ['locale' => 'asc']);

        $hotel = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            1// Nombre de résultats par page

        );

        return $this->render('hotel/index.html.twig', [
            'hotels' => $hotel
        ]);
    }
    /**
     * @Route("/codenameone/add", name="code_add")
     */
    public function addHotel(Request $request )
    {

        $libelle = $request->query->get("libelle");
        $locale= $request->query->get("locale");
        $caracteristique= $request->query->get("caracteristique");


        // $roles = $request->query->get("roles");




        $hotel = new Hotel();
        $hotel->setLibelle($libelle);
        $hotel->setLocale($locale);
        $hotel->setCaracteristique($caracteristique);



        try{

            $em = $this->getDoctrine()->getManager();
            $em->persist($hotel);
            $em->flush();

            return new JsonResponse("Compte creé avec succés", 200);
        }catch(\Exception $ex){

            return new Response("exception".$ex->getMessage());
        }


    }
    /**
     * @Route("/codenameone", name="code_show", methods={"GET"})
     */
    public function showMobile(HotelRepository $hotelRepository): Response
    {
        $hotels = $hotelRepository->findAll();
        $data = array();

        foreach ($hotels as $key => $hotel){
            $data[$key]['locale'] = $hotel->getLocale();
            $data[$key]['caracteristique'] = $hotel->getCaracteristique();

        }
        return new JsonResponse($data);
    }

    /**
     * @Route("/new", name="app_hotel_new", methods={"GET", "POST"})
     */
    public function new(Request $request, HotelRepository $hotelRepository,MailerInterface $mailer): Response
    {
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hotelRepository->add($hotel);

           // $email = new MailerApi();
            $twilio = new TwilioApi('AC1f9a1f7122a509849b1444f52979ce5e','a7774e6ead73a2ee1f7b792a2d54b462','+19402919789');
            $twilio->sendSMS('+21629801440','Hotel Crée avec success');
           // $email->sendEmail( $mailer,'skycraft.noreply123@gmail.com','mahdi.homrani@esprit.tn','testing email','Hotel Crée avec success');
            $this->addFlash(
                'info' ,' ');

            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hotel/new.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Listhotel", name="hotel_List", methods={"GET"})
     */
    public function listhotel(HotelRepository $hotelRepository): Response
    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Courier');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $hotel = $hotelRepository->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('hotel/ListHotel.html.twig', [
            'hotels' => $hotel
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Hotel.pdf", [
            "Attachment" => true
        ]);

        $html = $this->renderView('hotel/ListHotel.html.twig', [
            'hotels' => $hotel
        ]);
    }

    /**
     * @Route("/{id}", name="app_hotel_show", methods={"GET"})
     */
    public function show(Hotel $hotel): Response
    {
        return $this->render('hotel/show.html.twig', [
            'hotel' => $hotel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_hotel_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Hotel $hotel, HotelRepository $hotelRepository): Response
    {
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hotelRepository->add($hotel);
            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hotel/edit.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_hotel_delete", methods={"POST"})
     */
    public function delete(Request $request, Hotel $hotel, HotelRepository $hotelRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hotel->getId(), $request->request->get('_token'))) {
            $hotelRepository->remove($hotel);
        }

        return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
    }




}
