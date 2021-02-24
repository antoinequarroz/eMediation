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
    /*Crée le formulaire pour le système de modification de mot de passe*/
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder /*Crée le formulaire*/

        /*Intègre dans le formulaire les champs email*/
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'Email', /*Label email*/
                'attr' => [
                    'placeholder' => 'Email'
                ]
            ])
            /*Intègre dans le formulaire les champs de l'ancien mot de passe*/
            ->add('old_password', PasswordType::class,[
                'label' => 'Mon mot de passe', /*Label mot de passe actuelle*/
                'mapped'=> false,
                'attr' => [
                    'placeholder' => 'Mot de passe actuel'
                ]
            ])
            /*Intègre dans le formulaire les champs du nouveau mot de passe*/
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Mon nouveau mot de passe',
                'label' => 'Nouveau mot de passe',
                'required' => true,
                'first_options' => [ 'label' => 'Nouveau mot de passe', /*Label nouveau mot de passe*/
                    'attr' => [
                        'placeholder' => 'Mon nouveau mot de passe'
                    ]
                ],
                'second_options' => [ 'label' => 'Confirmer mon nouveau mot de passe', /*Label confirmer le nouveau mot de passe*/
                    'attr' => [
                        'placeholder' => 'Confirmer mon nouveau mot de passe'
                    ]
                ],
            ])
            /*Intègre dans le formulaire les champs prénom*/
            ->add('prenom', TextType::class, [
                'disabled' => true,
                'label' => 'Prénom', /*Label prénom*/
                'attr' => [
                    'placeholder' => 'Prénom'
                ]
            ])
            /*Intègre dans le formulaire les champs nom*/
            ->add('nom', TextType::class, [
                'disabled' => true,
                'label' => 'Nom', /*Label nom*/
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            /*Intègre dans le formulaire le bouton de changement de mot de passe*/
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer' /*Label s'enregistrer*/
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
