<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class Update extends AbstractController
{
    /**
     * @Route("/admin/utilisateurs/{id}", name="admin_user_edit", requirements={"id": "\d+"})
     * @param Request $request
     * @param User $user
     * @param EntityManagerInterface $entityManager,
     * @return Response
     */
    public function update(
        Request $request, 
        User $user, 
        EntityManagerInterface $entityManager
    ): Response
    {
        $this->denyAccessUnlessGranted("USER_EDIT");

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "L'utilisateur a bien été mis à jour.");
            return $this->redirectToRoute("admin_user_index");
        }

        return $this->render('admin/user/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}