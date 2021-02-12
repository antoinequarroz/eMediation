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

class RegisterType extends AbstractType
{
    /*Crée le formulaire pour le système d'inscription*/
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder /*Crée le formulaire*/

            /*Intègre dans le formulaire les champs prénom*/
            ->add('prenom', TextType::class, [
                'label' => 'Prénom', /*Label prénom*/
                'attr' => [
                    'placeholder' => 'Votre prénom'
                ]
            ])
            /*Intègre dans le formulaire les champs nom*/
            ->add('nom', TextType::class, [
                'label' => 'Nom', /*Label nom*/
                'attr' => [
                    'placeholder' => 'Votre nom'
                ]
            ])
            /*Intègre dans le formulaire les champs email*/
            ->add('email', EmailType::class, [
                'label' => 'Email', /*Label email*/
                'attr' => [
                    'placeholder' => 'Votre email'
                ]
            ])
            /*Intègre dans le formulaire les champs mot de passe et confirmation de mot de passe*/
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être indentique',
                'label' => 'Mot de passe', /*Label mot de passe*/
                'required' => true,
                'first_options' => [ 'label' => 'Mot de passe', /*Label mot de passe*/
                    'attr' => [
                        'placeholder' => 'Votre mot de passe'
                    ]
                ],
                'second_options' => [ 'label' => 'Confirmer votre mot de passe', /*Label confirmer le mot de passe*/
                    'attr' => [
                        'placeholder' => 'Confirmer votre mot de passe'
                    ]
                ],
            ])
            /*Intègre dans le formulaire le bouton d'inscription*/
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire" /*Label du nom du bouton*/
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
