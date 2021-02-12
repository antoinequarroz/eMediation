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

    /*
     * Création d'une route pour le controller
     */

    /**
     * @Route("/live", name="live")
     */

    /*Création d'un système de pagination */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $page = $this->entityManager->getRepository(Lives::class)->findAll(); /*Passage de toutes les vidéos au système de pagination*/
        $page = $paginator->paginate( /*Ajouter la variable page au paginatorInterface qui est un système de gestion des pages proposé par Symfony*/
            $page, /* query NOT result */
            $request->query->getInt('page', 1)/*numéro de page*/,
            11/*limite par page*/
        );

        $lives = $this->entityManager->getRepository(Lives::class)->findAll(); /*Va chercher tout les champs de la table Lives pour la retourner à la vue*/

        $search = new Search(); /*Création d'une nouvelle recherche*/
        $form = $this->createForm(RechercheType::class, $search); /*Crée un formulaire pour le système de filtre*/

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { /*Si le formulaire est envoyé et validé le code suivant s'exécute*/
            $lives = $this->entityManager->getRepository(Lives::class)->findWithSearch($search); /*La recherche va chercher dans l'entité Lives pour pouvoir retourner une valeur pour le système de filtre */

        }

        /*Retourne le contenu du controller dans la vue live/index.html.twig*/
        return $this->render('live/index.html.twig',[
            'lives' => $lives, /*Envoie les lives à la vue*/
            'page' => $page, /*Envoie la pagination à la vue*/
            'form' => $form->createView() /*Envoie le formulaire à la vue*/
        ]);
    }

    /*
     * Création d'une route show pour chaque vidéos pour le controller
     */

    /**
     * @Route("/live/{slug}", name="lives")
     */

    /*Création des pages shows*/
    public function show($slug)
    {
        $live = $this->entityManager->getRepository(Lives::class)->findOneBySlug($slug); /*Va chercher le slug dans l'entité Lives*/

        if (!$live) {
            return $this->redirectToRoute('live'); /*Créer une route avec le slug pour les pages shows*/
        }

        /*Retourne le contenu du controller dans la vue live/show.html.twig*/
        return $this->render('live/show.html.twig',[
            'live' => $live /*Envoie le contenu de chaque lives de l'entité dans la vue*/
        ]);
    }
}
