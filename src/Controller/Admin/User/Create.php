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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Create extends AbstractController
{
    /**
     * @Route("admin/utilisateurs/nouveau", name="admin_user_add")
     * @param Request $request
     * @return Response
     */
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $userPasswordEncoder
    ): Response
    {
        $this->denyAccessUnlessGranted("USER_ADD");

        $user = new User();
        
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encodedPassword = $userPasswordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encodedPassword);
            
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash("success", "L'utilisateur a bien été créé.");
            return $this->redirectToRoute("admin_user_index");
        }

        return $this->render('admin/user/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}