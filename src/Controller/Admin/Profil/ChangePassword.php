<?php

namespace App\Controller\Admin\Profil;

use App\Form\PasswordUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ChangePassword extends AbstractController
{
    /**
     * @Route("admin/profil/mot-de-passe", name="admin_profile_password")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function changePassword(
        Request $request, 
        UserPasswordEncoderInterface $encoder,
        EntityManagerInterface $entityManager
    ): Response
    {
        $user = $this->getUser();

        $this->denyAccessUnlessGranted("USER_PROFIL", $user);

        $form = $this->createForm(PasswordUserType::class, $user);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $passwordData = $request->request->get("password_user");

            if($encoder->isPasswordValid($user, $passwordData["password"]) && ($passwordData["newPassword"]["first"] === $passwordData["newPassword"]["second"])) {
                $user->setPassword($encoder->encodePassword($user, $passwordData["newPassword"]["first"]));

                $entityManager->flush();
            } else {
                $this->addFlash("danger", "Le mot de passe actuel n'est pas valide.");
            }

            $this->addFlash("success", "Votre mot de passe a bien été changé.");
            return $this->redirectToRoute("admin_profile_edit");
        }

        return $this->render('admin/profile/password.html.twig', [
            "user" => $user,
            "form" => $form->createView()
        ]);
    }

}