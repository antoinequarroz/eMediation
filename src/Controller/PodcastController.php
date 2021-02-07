<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\OffreCulturelle;
use App\Entity\Podcast;
use App\Entity\Product;
use App\Form\RechercheType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $page = $this->entityManager->getRepository(Podcast::class)->findAll();
        $page = $paginator->paginate(
            $page, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            11/*limit per page*/
        );

        $podcasts = $this->entityManager->getRepository(Podcast::class)->findAll();

        $search = new Search();
        $form = $this->createForm(RechercheType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $podcasts = $this->entityManager->getRepository(Podcast::class)->findWithSearch($search);
        }

        return $this->render('podcast/index.html.twig',[
            'podcasts' => $podcasts,
            'page' => $page,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/podcast/{slug}", name="podcasts")
     */
    public function show($slug)
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
