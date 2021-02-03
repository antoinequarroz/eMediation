<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Form\RechercheType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request)
    {
        $videos = $this->entityManager->getRepository(Product::class)->findAll();

        $search = new Search();
        $form = $this->createForm(RechercheType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $videos = $this->entityManager->getRepository(Product::class)->findWithSearch($search);
        }

        return $this->render('video/index.html.twig',[
            'videos' => $videos,
            'form' => $form->createView()
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
            'video' => $video
        ]);
    }
}
