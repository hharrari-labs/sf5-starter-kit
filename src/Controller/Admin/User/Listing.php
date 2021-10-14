<?php

namespace App\Controller\Admin\User;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Listing extends AbstractController
{

    /**
     * @Route("admin/utilisateurs", name="admin_user_index")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function listing(UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted("USER_LIST");

        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll()
        ]);
    }

}