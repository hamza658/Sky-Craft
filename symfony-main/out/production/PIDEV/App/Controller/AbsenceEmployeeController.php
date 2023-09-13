<?php

namespace App\Controller;

use App\Entity\Absence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbsenceEmployeeController extends AbstractController
{
    /**
     * @Route("/absence/employee", name="absence_employee")
     */
    public function index(): Response
    {
        return $this->render('absence_employee/mesAbsence.html.twig', [
            'controller_name' => 'AbsenceEmployeeController',
        ]);
    }
    /**
     * @Route("/AbsenceList", name="AbsenceList")
     */
    public function readEvt()
    {
        $repository = $this->getDoctrine()->getRepository(Absence::class);
        $Absences = $repository->findAll();

        return $this->render('absence_employee/mesAbsence.html.twig', [
            'Absences' => $Absences,
        ]);
    }
}
