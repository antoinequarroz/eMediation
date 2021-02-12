<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\OffreCulturelle;
use App\Form\RechercheType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /*
     * Création d'une route pour le controller
     */

    /**
     * @Route("/offre_culturelle", name="offre_culturelle")
     */
    /*Création d'un système de pagination */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $page = $this->entityManager->getRepository(OffreCulturelle::class)->findAll(); /*Passage de toutes les offres culturelles au système de pagination*/
        $page = $paginator->paginate( /*Ajouter la variable page au paginatorInterface qui est un système de gestion des pages proposé par Symfony*/
            $page, /* query NOT result */
            $request->query->getInt('page', 1)/*numéro de page*/,
            11/*limite par page*/
        );

        $offres = $this->entityManager->getRepository(OffreCulturelle::class)->findAll(); /*Va chercher tout les champs de la table OffreCulturelle pour la retourner à la vue*/

        $search = new Search(); /*Création d'une nouvelle recherche*/
        $form = $this->createForm(RechercheType::class, $search); /*Crée un formulaire pour le système de filtre*/

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { /*Si le formulaire est envoyé et validé le code suivant s'exécute*/
            $offres = $this->entityManager->getRepository(OffreCulturelle::class)->findWithSearch($search); /*La recherche va chercher dans l'entité OffreCulturelle pour pouvoir retourner une valeur pour le système de filtre */
        }

        /*Retourne le contenu du controller dans la vue offre_culturelle/index.html.twig*/
        return $this->render('offre_culturelle/index.html.twig',[
            'offres' => $offres, /*Envoie les offres culturelles à la vue*/
            'page' => $page, /*Envoie la pagination à la vue*/
            'form' => $form->createView() /*Envoie le formulaire à la vue*/
        ]);
    }

    /*
     * Création d'une route show pour chaque vidéos pour le controller
     */

    /**
     * @Route("/offre_culturelle/{slug}", name="offres_culturelles")
     */

    /*Création des pages shows*/
    public function show($slug)
    {
        $offre = $this->entityManager->getRepository(OffreCulturelle::class)->findOneBySlug($slug); /*Va chercher le slug dans l'entité OffreCulturelle*/

        if (!$offre) {
            return $this->redirectToRoute('offre_culturelle'); /*Créer une route avec le slug pour les pages shows*/
        }

        /*Retourne le contenu du controller dans la vue offre_culturelle/show.html.twig*/
        return $this->render('offre_culturelle/show.html.twig',[
            'offre' => $offre /*Envoie le contenu de chaque vidéos de l'entité dans la vue*/
        ]);
    }
}
