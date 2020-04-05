<?php

namespace App\Controller;

use App\Entity\Loan;
use App\Entity\StudentLoan;
use App\Entity\TeacherLoan;
use App\Form\LoanNextType;
use App\Form\StudentLoanType;
use App\Form\TeacherLoanType;
use App\Service\LoanService;
use Doctrine\ORM\EntityManagerInterface;
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

    /**
     * @Route("/create_loan", name="create_loan")
     */
    public function create(Request $request) {

        if($this->getUser()->getType() === 'etudiant') {
            $loan = new StudentLoan();
            $form =  $this->createForm(StudentLoanType::class, $loan);
        } else {
            $loan = new TeacherLoan();
            $form =  $this->createForm(TeacherLoanType::class, $loan);
        }

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->container->get('session')->set('loan', $loan);

            return $this->redirectToRoute("create_loan_next");
        }

        return $this->render('loan/create.html.twig', [
            'controller_name' => 'LoanController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/create_loan_next", name="create_loan_next")
     */
    public function create2(Request $request, EntityManagerInterface $em) {
        /**
         * @var Loan $loan
         */
        $loan = $this->container->get('session')->get('loan');

        if($loan === null) {
            return $this->redirectToRoute("create_loan");
        }

        $form = $this->createForm(LoanNextType::class, $loan);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if($form->get('retour')->isClicked()) {
                return $this->redirectToRoute('create_loan');
            }

            if($form->get('valider')->isClicked()) {
                $loan->setStatut('En attente');
                $loan->setUser($this->getUser());

                $em->persist($loan);
                $em->flush();

                return $this->redirectToRoute("my_loans");
            }
        }

        return $this->render('/loan/create2.html.twig', [
            'controller_name' => 'LoanController',
            'form' => $form->createView()
        ]);
    }
}
