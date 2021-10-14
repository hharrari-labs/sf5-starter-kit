<?php

namespace App\Form;

use App\Entity\User;
use App\Form\FormTrait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilType extends AbstractType
{
    use FormTrait;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->setOptions('Prénom'))
            ->add('lastName', TextType::class, $this->setOptions('Nom'))
            ->add('email', EmailType::class, $this->setOptions('E-mail'))
            ->add('username', TextType::class, $this->setOptions('Nom d\'utilisateur'))
            ->add('submit', SubmitType::class, $this->setOptions('Sauvegarder'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
