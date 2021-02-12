<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /*
     * Création d'une route pour les inscriptions
    */

    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {

        $user = new User(); /*Création d'un nouvel utilisateur*/
        $form = $this->createForm(RegisterType::class, $user); /*Création d'une formulaire d'inscription*/

        $form -> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){ /*Si le formulaire est envoyé et validé le code suivant s'exécute*/

            $user = $form->getData(); /*Envoie le résultat du formulaire dans la base de données*/

            $password = $encoder->encodePassword($user,$user->getPassword()); /*Crée un encodeur pour les mots de passes de chaque utilisateurs*/

            $user->setPassword($password);

            $this->entityManager->persist($user);
            $this->entityManager->flush(); /*Envoie le nouvel utilisateur créer avec le mot de passe crypter dans le formulaire dans la base de données*/
        }

        /*Retourne le contenu du controller dans la vue register/index.html.twig*/
        return $this->render('register/index.html.twig', [
            'form' => $form->createView() /*Envoie le formulaire à la vue*/
        ]);
    }
}
