<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreCulturelleController extends AbstractController
{
    /**
     * @Route("/offre_culturelle", name="offre_culturelle")
     */
    public function index(): Response
    {
        return $this->render('offre_culturelle/index.html.twig', [
            'controller_name' => 'OffreCulturelleController',
        ]);
    }
}
