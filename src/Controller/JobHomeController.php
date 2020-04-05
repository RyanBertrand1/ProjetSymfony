<?php

namespace App\Controller;

use App\Entity\Loan;
use App\Repository\LoanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class JobHomeController extends AbstractController
{
    /**
     * @Route("/job_home", name="job_home")
     */
    public function index(LoanRepository $loanRepository)
    {
        $loansDepart = array_filter($loanRepository->findAll(), function (Loan $loan) {
           $today = new \DateTime();
           $todayString = $today->format('d-m-Y');
           $leavingDateString = $loan->getLeavingDate()->format('d-m-Y');

           return $todayString === $leavingDateString;
        });
        $loansArrive = array_filter($loanRepository->findAll(), function (Loan $loan) {
            $today = new \DateTime();
            $todayString = $today->format('d-m-Y');
            $returnDateString = $loan->getReturnDate()->format('d-m-Y');

            return $todayString === $returnDateString;
        });

        return $this->render('job_home/index.html.twig', [
            'controller_name' => 'JobHomeController',
            'loansDepart' => $loansDepart,
            "loansArrive" => $loansArrive
        ]);
    }
}
