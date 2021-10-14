<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Handler\UserHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Csrf\CsrfToken;

class Delete extends AbstractController
{
    /**
     * @Route("admin/utilisateurs/{id}/suppression", name="admin_user_delete", requirements={"id": "\d+"}, methods="POST")
     * @param Request $request
     * @param User $user
     * @param CsrfTokenManagerInterface $tokenManager
     * @return Response
     */
    public function delete(
        Request $request, 
        User $user, 
        EntityManagerInterface $entityManager, 
        CsrfTokenManagerInterface $tokenManager
    ): Response 
    {
        $this->denyAccessUnlessGranted("USER_DELETE");

        if ($tokenManager->isTokenValid(new CsrfToken("delete-user", $request->request->get('token')))) {
            $entityManager->remove($user);
            $entityManager->flush();

            $this->addFlash("success", "L'utilisateur a bien été supprimé.");
            return $this->redirectToRoute("admin_user_index");
        }

        $this->addFlash("danger", "Le jeton est invalide.");

        return $this->redirectToRoute("admin_user_index");
    }
}