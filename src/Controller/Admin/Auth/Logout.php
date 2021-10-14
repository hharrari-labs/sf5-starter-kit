<?php

namespace App\Controller\Admin\Auth;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Logout extends AbstractController
{

     /**
     * @Route("/admin/deconnexion", name="logout")
     * @return void
     */
    public function logout(): void
    { }

}