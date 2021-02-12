<?php

namespace App\Controller;

use App\Entity\Lives;
use App\Entity\OffreCulturelle;
use App\Entity\Podcast;
use App\Entity\Product;
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

    /*
     * Création d'une route pour la homepage
    */

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $videos = $this->entityManager->getRepository(Product::class)->findByIsBest(1); /*Intégration et retour des vues des trois vidéos mise en avant*/
        $lives = $this->entityManager->getRepository(Lives::class)->findByIsBest(1); /*Intégration et retour des vues des trois lives mis en avant*/
        $podcasts = $this->entityManager->getRepository(Podcast::class)->findByIsBest(1); /*Intégration et retour des vues des trois podcasts mis en avant*/
        $offres = $this->entityManager->getRepository(OffreCulturelle::class)->findByIsBest(1); /*Intégration et retour des vues des trois offre culturelle mise en avant*/

        /*Retourne le contenu du controller dans la vue home/index.html.twig*/
        return $this->render('home/index.html.twig', [
            'videos' => $videos, /*Envoie les vidéos à la vue*/
            'lives' => $lives, /*Envoie les lives à la vue*/
            'podcasts' => $podcasts, /*Envoie les podcasts à la vue*/
            'offres' => $offres /*Envoie les offres à la vue*/
        ]);
    }
}
