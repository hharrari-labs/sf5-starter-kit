<?php

namespace App\Controller\Admin\Profil;

use App\Form\ProfilType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class Update extends AbstractController
{
    /**
    * @Route("admin/profil", name="admin_profile_edit")
    * @param Request $request
    * @return Response
    */
    public function update(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $user = $this->getUser();

        $this->denyAccessUnlessGranted("USER_PROFIL", $user);

        $form = $this->createForm(ProfilType::class, $user);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "Votre profil a été mis à jour.");
            return $this->redirectToRoute("admin_profile_edit");
        }

        return $this->render('admin/profile/edit.html.twig', [
            "user" => $user,
            "form" => $form->createView()
        ]);
    }

}