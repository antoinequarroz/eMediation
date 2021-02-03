<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
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
     * @Route("/video", name="videos")
     */
    public function index()
    {
        $videos = $this->entityManager->getRepository(Product::class)->findAll();

        return $this->render('video/index.html.twig',[
            'videos' => $videos
        ]);
    }

    /**
     * @Route("/video/{slug}", name="video")
     */
    public function show($slug)
    {

        $video = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);

        if (!$video) {
            return $this->redirectToRoute('videos');
        }

        return $this->render('video/show.html.twig',[
            'videos' => $videos
        ]);
    }
}
