<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Lives;
use App\Form\RechercheType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @ORM\Entity
 * @ORM\Table(name="live_controller")
 */
class LiveController extends AbstractController
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
     * @Route("/live", name="live")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $page = $this->entityManager->getRepository(Lives::class)->findAll();
        $page = $paginator->paginate(
            $page, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            11/*limit per page*/
        );

        $lives = $this->entityManager->getRepository(Lives::class)->findAll();

        $search = new Search();
        $form = $this->createForm(RechercheType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lives = $this->entityManager->getRepository(Lives::class)->findWithSearch($search);

        }

        return $this->render('live/index.html.twig',[
            'lives' => $lives,
            'page' => $page,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/live/{slug}", name="lives")
     */
    public function show($slug)
    {
        $live = $this->entityManager->getRepository(Lives::class)->findOneBySlug($slug);

        if (!$live) {
            return $this->redirectToRoute('live');
        }

        return $this->render('live/show.html.twig',[
            'live' => $live
        ]);
    }
}
