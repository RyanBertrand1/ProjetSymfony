<?php

namespace App\Controller;

use App\Entity\Loan;
use App\Repository\LoanRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/tableau-de-bord", name="admin_dashboard")
     */
    public function index(LoanRepository $loanRepository)
    {
        $loansAttente = $loanRepository->findLoansByStatut('En attente');
        $loansFinaliser = $loanRepository->findLoansByStatut('À finaliser');
        $loansTraitees = $loanRepository->findLoansByStatut('Traitée');
        $loansRefusees = $loanRepository->findLoansByStatut('Refusée');

        return $this->render('admin_dashboard/index.html.twig', [
            'controller_name' => 'AdminDashboardController',
            'loansAttente' => $loansAttente,
            'loansFinaliser' => $loansFinaliser,
            'loansTraitees' => $loansTraitees,
            'loansRefusees' => $loansRefusees
        ]);
    }
}
