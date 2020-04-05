<?php

namespace App\Controller;

use App\Entity\Loan;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $l;

    public function __construct(LoggerInterface $l)
    {
        $this->l = $l;
    }

    /**
     * @Route("/utilisateurs", name="users")
     */
    public function index(UserRepository $userRepository, Request $request)
    {
        $users = $userRepository->findUserToDisplay("");

        $searchform = $this->createFormBuilder()
            ->add('search', TextType::class, ['required' => false, 'label' => false, 'help' => 'Rechercher par prénom, nom ou e-mail'])
            ->getForm();
        $searchform->handleRequest($request);

        if($searchform->isSubmitted() && $searchform->isValid()) {
            $users = $userRepository->findUserToDisplay($searchform->get('search')->getData());
        }

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'users' => $users,
            'searchForm' => $searchform->createView()
        ]);
    }

    /**
     * @Route("/utilisateurs/{id}", name="user")
     */
    public function show(User $user, Request $request, EntityManagerInterface $em) {

        $form = $this->createFormBuilder($user)
            ->add('problem', SubmitType::class, ['label' => ($user->getProblem() ? 'Annuler le problème signaler' : 'Signaler un problème'), 'attr' => ["class" => 'btn btn-secondary']])
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user->setProblem(!$user->getProblem());

            $em->persist($user);
            $em->flush();
        }

        return $this->render('user/show.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}
