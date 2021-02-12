<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * Crée un route de connexion
     */

    /**
     * @Route("/connexion", name="app_login")
     */

    /*Crée un système d'authentifications pour se loger*/
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('account');
        }

        // Obtient l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        // Le dernier nom d'utilisateur saisi par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        /*Retourne le contenu du controller dans la vue security/login.html.twig*/
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, /*Envoie le dernier nom d'utilisateur*/
            'error' => $error /*Envoie un message d'erreur*/
        ]);
    }

    /**
     * Crée un route de déconnexion
     */

    /**
     * @Route("/deconnexion", name="app_logout")
     */

    /*Crée un système d'authentifications pour se déloger*/
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
