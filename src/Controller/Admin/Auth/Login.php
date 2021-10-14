<?php

namespace App\Controller\Admin\Auth;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class Login extends AbstractController
{

    /**
     * @Route("/admin/connexion", name="admin_login")
     * @param AuthenticationUtils $utils
     * @return Response
     */
    public function login(AuthenticationUtils $utils): Response
    {
        return $this->render('admin/auth/login.html.twig', [
            'error' => $utils->getLastAuthenticationError() !== null,
            'username' => $utils->getLastUsername()
        ]);
    }

}