<?php

namespace App\Controller;

use App\Entity\OffreCulturelle;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreCulturelleController extends AbstractController
{
    private $entityManager;

    /**
     * VideoController constructor.
     * @param $entityManager
     */

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/offre_culturelle", name="offre_culturelle")
     */
    public function index(): Response
    {
        $offres = $this->entityManager->getRepository(OffreCulturelle::class)->findAll();

        return $this->render('offre_culturelle/index.html.twig',[
            'offres' => $offres
        ]);
    }

    /**
     * @Route("/offre_culturelle/{slug}", name="offres_culturelles")
     */
    public function show($slug): Response
    {
        $offre = $this->entityManager->getRepository(OffreCulturelle::class)->findOneBySlug($slug);

        if (!$offre) {
            return $this->redirectToRoute('offre_culturelle');
        }

        return $this->render('offre_culturelle/show.html.twig',[
            'offre' => $offre
        ]);
    }
}
