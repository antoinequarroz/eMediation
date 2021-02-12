<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /*
     * Création d'une route pour le controller
     */

    /**
     * @Route("/compte/mot-de-passe", name="account_password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response /* Gestion de modification de mot de passe*/
    {
        $notification = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user); /*Crée un formulaire pour le changement de mot de passe*/

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { /*Si le formulaire est envoyé et validé le code suivant s'exécute*/
            $old_pwd = $form->get('old_password')->getData(); /*Le formulaire va chercher l'ancien mot de passe*/

            if ($encoder->isPasswordValid($user, $old_pwd)) { /*Si le mot de passe est valide et si il est relié à l'utilisateur*/
                $new_pwd = $form->get('new_password')->getData(); /*Le formulaire crée un nouveau mot de passe*/
                $password = $encoder->encodePassword($user, $new_pwd); /*Le formulaire encode le nouveau mot de passe*/

                $user->setPassword($password); /*Change le mot de passe de l'utilisateur*/
                $this->entityManager->flush(); /*Envoie le nouveau mot de passe crypté à la base de données*/
                $notification = 'Votre mot de passe à bien été mis à jour'; /*Envoie un notification si le mot de passe à été modifié*/
            } else{
                $notification = "Votre mot de passe actuel n'est pas le bon"; /*Envoie un notification su le mot de passe n'a pas été modifié*/
            }
        }

        /*Retourne le contenu du controller dans la vue account/password.html.twig*/
        return $this->render('account/password.html.twig',[
            'form' => $form->createView(), /*Envoie le formulaire à la vue*/
            'notification' => $notification /*Envoie les notifications à la vue*/
        ]);
    }
}