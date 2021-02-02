<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Email'
                ]
            ])
            ->add('old_password', PasswordType::class,[
                'label' => 'Mon mot de passe',
                'mapped'=> false,
                'attr' => [
                    'placeholder' => 'Mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être indentique',
                'label' => 'Nouveau mot de passe',
                'required' => true,
                'first_options' => [ 'label' => 'Nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Mon nouveau mot de passe'
                    ]
                ],
                'second_options' => [ 'label' => 'Confirmer mon nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmer mon nouveau mot de passe'
                    ]
                ],
            ])
            ->add('prenom', TextType::class, [
                'disabled' => true,
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('nom', TextType::class, [
                'disabled' => true,
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
