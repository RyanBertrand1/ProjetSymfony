<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $userRole = $this->getUser()->getRoles()[0];

        if($userRole === "ROLE_ADMIN") {
            return $this->redirectToRoute('admin_dashboard');
        } else if($userRole === "ROLE_USER") {
            return $this->redirectToRoute('create_loan');
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);

    }
}
