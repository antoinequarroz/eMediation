<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Form\RechercheType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $page = $this->entityManager->getRepository(Product::class)->findAll();
        $page = $paginator->paginate(
            $page, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            11/*limit per page*/
        );
        $videos = $this->entityManager->getRepository(Product::class)->findAll();


        $search = new Search();
        $form = $this->createForm(RechercheType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $videos = $this->entityManager->getRepository(Product::class)->findWithSearch($search);
        }

        return $this->render('video/index.html.twig',[
            'videos' => $videos,
            'page' => $page,
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
