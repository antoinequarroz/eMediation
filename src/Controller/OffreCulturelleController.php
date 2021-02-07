<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\OffreCulturelle;
use App\Entity\Product;
use App\Form\RechercheType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $page = $this->entityManager->getRepository(OffreCulturelle::class)->findAll();
        $page = $paginator->paginate(
            $page, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            11/*limit per page*/
        );

        $offres = $this->entityManager->getRepository(OffreCulturelle::class)->findAll();

        $search = new Search();
        $form = $this->createForm(RechercheType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offres = $this->entityManager->getRepository(OffreCulturelle::class)->findWithSearch($search);
        }

        return $this->render('offre_culturelle/index.html.twig',[
            'offres' => $offres,
            'page' => $page,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/offre_culturelle/{slug}", name="offres_culturelles")
     */
    public function show($slug)
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
