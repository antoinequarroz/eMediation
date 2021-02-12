<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /*
     * Création d'une route pour le controller
     */

    /**
     * @Route("/compte", name="account")
     */
    public function index()
    {
        /*Retourne le contenu du controller dans la vue account/index.html.twig*/
        return $this->render('account/index.html.twig');
    }
}