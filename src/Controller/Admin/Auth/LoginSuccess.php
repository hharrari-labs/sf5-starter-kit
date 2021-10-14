<?php

namespace App\Controller\Admin\Auth;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginSuccess extends AbstractController
{

     /**
     * @Route("/connexion/success", name="login_success")
     * 
     * @return Response
     */
    public function onLoginSuccess()
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_DEV')) return $this->redirectToRoute('admin_user_index');
        else return $this->redirectToRoute('home_index');
    }

}