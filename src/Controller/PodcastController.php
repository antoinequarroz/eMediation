<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Podcast;
use App\Form\RechercheType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /*
     * Création d'une route pour le controller
     */


    /**
     * @Route("/podcast", name="podcast")
     */

    /*Création d'un système de pagination */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $page = $this->entityManager->getRepository(Podcast::class)->findAll(); /*Passage de tous les podcasts au système de pagination*/
        $page = $paginator->paginate( /*Ajouter la variable page au paginatorInterface qui est un système de gestion des pages proposé par Symfony*/
            $page, /* query NOT result */
            $request->query->getInt('page', 1)/*numéro de page*/,
            11/*limite par page*/
        );

        $podcasts = $this->entityManager->getRepository(Podcast::class)->findAll(); /*Va chercher tout les champs de la table Podcast pour la retourner à la vue*/

        $search = new Search(); /*Création d'une nouvelle recherche*/
        $form = $this->createForm(RechercheType::class, $search); /*Crée un formulaire pour le système de filtre*/

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { /*Si le formulaire est envoyé et validé le code suivant s'exécute*/
            $podcasts = $this->entityManager->getRepository(Podcast::class)->findWithSearch($search); /*La recherche va chercher dans l'entité Podcast pour pouvoir retourner une valeur pour le système de filtre */
        }

        /*Retourne le contenu du controller dans la vue video/index.html.twig*/
        return $this->render('podcast/index.html.twig',[
            'podcasts' => $podcasts, /*Envoie les podcasts à la vue*/
            'page' => $page, /*Envoie la pagination à la vue*/
            'form' => $form->createView() /*Envoie le formulaire à la vue*/
        ]);
    }

    /*
     * Création d'une route show pour chaque podcast pour le controller
     */

    /**
     * @Route("/podcast/{slug}", name="podcasts")
     */

    /*Création des pages shows*/
    public function show($slug)
    {
        $podcast = $this->entityManager->getRepository(Podcast::class)->findOneBySlug($slug); /*Va chercher le slug dans l'entité Podcast*/

        if (!$podcast) {
            return $this->redirectToRoute('podcast'); /*Créer une route avec le slug pour les pages shows*/
        }

        /*Retourne le contenu du controller dans la vue podcast/show.html.twig*/
        return $this->render('podcast/show.html.twig',[
            'podcast' => $podcast /*Envoie le contenu de chaque vidéos de l'entité dans la vue*/
        ]);
    }
}
