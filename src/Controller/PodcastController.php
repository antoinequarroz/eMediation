<?php

namespace App\Controller;

use App\Entity\OffreCulturelle;
use App\Entity\Podcast;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PodcastController extends AbstractController
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
     * @Route("/podcast", name="podcast")
     */
    public function index(): Response
    {
        $podcasts = $this->entityManager->getRepository(Podcast::class)->findAll();

        return $this->render('podcast/index.html.twig',[
            'podcasts' => $podcasts
        ]);
    }

    /**
     * @Route("/podcast/{slug}", name="podcasts")
     */
    public function show($slug): Response
    {
        $podcast = $this->entityManager->getRepository(Podcast::class)->findOneBySlug($slug);

        if (!$podcast) {
            return $this->redirectToRoute('podcast');
        }

        return $this->render('podcast/show.html.twig',[
            'podcast' => $podcast
        ]);
    }
}
