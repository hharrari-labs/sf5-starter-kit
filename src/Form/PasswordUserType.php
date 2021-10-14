<?php

namespace App\Form;

use App\Form\FormTrait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordUserType extends AbstractType
{
    use FormTrait;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', PasswordType::class, $this->setOptions("Mot de passe actuel", [
                "mapped" => false
            ]))
            ->add('newPassword', RepeatedType::class, $this->setOptions("", [
                "mapped" => false,
                "type" => PasswordType::class,
                "invalid_message" => "Les mots de passe doivent être identiques.",
                "required" => true,
                "first_options"  => ["label_format" => "Nouveau mot de passe"],
                "second_options" => ["label_format" => "Confirmer le nouveau mot de passe"],
            ]))
            ->add('submit', SubmitType::class, $this->setOptions("Sauvegarder"));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);
    }
}
