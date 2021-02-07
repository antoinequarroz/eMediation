<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Header;
use App\Entity\Lives;
use App\Entity\OffreCulturelle;
use App\Entity\Podcast;
use App\Entity\Product;
use App\Form\RechercheType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;

    /**
     * HomeController constructor.
     * @param $entityManager
     */

    public function __construct(EntityManagerInterface $entityManager)
{
    $this->entityManager = $entityManager;
}

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $videos = $this->entityManager->getRepository(Product::class)->findByIsBest(1);
        $lives = $this->entityManager->getRepository(Lives::class)->findByIsBest(1);
        $podcasts = $this->entityManager->getRepository(Podcast::class)->findByIsBest(1);
        $offres = $this->entityManager->getRepository(OffreCulturelle::class)->findByIsBest(1);

        return $this->render('home/index.html.twig', [
            'videos' => $videos,
            'lives' => $lives,
            'podcasts' => $podcasts,
            'offres' => $offres
        ]);
    }
}
