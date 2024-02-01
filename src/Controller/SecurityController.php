<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Attribute\Route;

class SecurityController extends AbstractController
{

    #[Route('/login', name: 'login')]
    public function loginAction(AuthenticationUtils $authenticationUtils): Response
    {

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    #[Route('/login_check', name: 'login_check')]
    public function loginCheck()
    {
        // This code is never executed.
    }

    #[Route('/logout', name: 'logout')]
    public function logoutCheck()
    {
        // This code is never executed.
    }
}