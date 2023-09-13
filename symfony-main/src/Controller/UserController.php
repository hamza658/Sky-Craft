<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
    /**
     * @Route("/searchuser", name="utilsearchuser")
     */
    public function searchPlan(Request $request)//ajax
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $requestString = $request->get('searchValue');
        $plan = $repository->findPlanBySujet($requestString);
        return $this->render('user/utilajax.html.twig', [
            'users' => $plan,
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET", "POST"})
     */
    public function new(Request $request,UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {  //isValid() mta3 l controle de saisie bech tchoufou 7i7 walle
            $user->setPassword( // mta3 cryptage mta3 l password
                $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );


            $entityManager->persist($user); //t7ot l utilisateur jdid fel table User
            $entityManager->flush(); //enregistrement mt3 l modification fel table user fel base de donnés

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }



    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user,UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/ban", name="user_ban", methods={"GET", "POST"})
     */
    public function ban(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('ban'.$user->getId(), $request->request->get('_token'))) {

            $user->setIsBanned(true);


            $entityManager->flush();


        }
        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/{id}/unban", name="user_unban", methods={"GET", "POST"})
     */
    public function unban(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('unban'.$user->getId(), $request->request->get('_token'))) {

            $user->setIsBanned(false);


            $entityManager->flush();


        }
        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {   //recuperation mta3 l user par l id mta3ou
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user); //remove l user ela recuperitou mel table fel base
            $entityManager->flush();   // enregistrement mta3 l modification
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }

}
