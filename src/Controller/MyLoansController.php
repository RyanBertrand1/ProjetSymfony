<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\LoanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyLoansController extends AbstractController
{
    /**
     * @Route("/my_loans", name="my_loans")
     */
    public function index(LoanRepository $loanRepository)
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();

        $loans = $loanRepository->findLoansByUser($user);

        return $this->render('loan/my_loans.html.twig', [
            'controller_name' => 'MyLoansController',
            'loans' => $loans
        ]);
    }
}
