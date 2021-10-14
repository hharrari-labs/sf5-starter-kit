<?php

namespace App\Controller\Admin\Auth;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class RedirectToLogin extends AbstractController
{

    /**
     * @Route("/admin", name="admin_login_base")
     * @return RedirectResponse
     */
    public function redirectToAdminLogin(): RedirectResponse
    {
        return $this->redirectToRoute("admin_login", [], Response::HTTP_MOVED_PERMANENTLY);
    }

}