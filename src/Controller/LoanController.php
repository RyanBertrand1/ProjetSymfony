<?php

namespace App\Controller;

use App\Entity\Loan;
use App\Service\LoanService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoanController extends AbstractController
{
    private $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    /**
     * @Route("/loan/{id}", name="loan")
     */
    public function index(Loan $loan, Request $request)
    {
        $refusForm = $this->createFormBuilder()
            ->add('raison', TextareaType::class, ['label' => 'Raison du refus', 'attr' => array('class' => 'form-control')])
            ->getForm();

        $refusForm->handleRequest($request);

        $traiterForm = $this->createFormBuilder()
            ->add('traiter', SubmitType::class, ['label' => 'Traiter', 'attr' => array('class' => 'dropdown-item')])
            ->getForm();

        $traiterForm->handleRequest($request);

        if ($refusForm->isSubmitted() && $refusForm->isValid()) {
            $raison = $refusForm->get('raison')->getData();

            $this->loanService->refuser($loan, $raison);
        }

        if ($traiterForm->isSubmitted() && $traiterForm->isValid()) {

            $this->loanService->traiter($loan);
        }

        return $this->render('loan/show.html.twig', [
            'controller_name' => 'LoanController',
            'loan' => $loan,
            'refusForm' => $refusForm->createView(),
            'traiterForm' => $traiterForm->createView()
        ]);
    }
}
