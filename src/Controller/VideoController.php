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

    /*
     * Création d'une route pour le controller
     */

    /**
     * @Route("/video", name="videos")
     */

    /*Création d'un système de pagination */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $page = $this->entityManager->getRepository(Product::class)->findAll(); /*Passage de toutes les vidéos au système de pagination*/
        $page = $paginator->paginate( /*Ajouter la variable page au paginatorInterface qui est un système de gestion des pages proposé par Symfony*/
            $page, /* query NOT result */
            $request->query->getInt('page', 1)/*numéro de page*/,
            11/*Limite par page*/
        );
        $videos = $this->entityManager->getRepository(Product::class)->findAll(); /*Va chercher tout les champs de la table Product pour la retourner à la vue*/


        $search = new Search(); /*Création d'une nouvelle recherche*/
        $form = $this->createForm(RechercheType::class, $search); /*Crée un formulaire pour le système de filtre*/

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { /*Si le formulaire est envoyé et validé le code suivant s'exécute*/
            $videos = $this->entityManager->getRepository(Product::class)->findWithSearch($search); /*La recherche va chercher dans l'entité Product pour pouvoir retourner une valeur pour le système de filtre */
        }

        /*Retourne le contenu du controller dans la vue video/index.html.twig*/
        return $this->render('video/index.html.twig',[
            'videos' => $videos, /*Envoie les vidéos à la vue*/
            'page' => $page, /*Envoie la pagination à la vue*/
            'form' => $form->createView() /*Envoie le formulaire à la vue*/
        ]);
    }

    /*
     * Création d'une route show pour chaque vidéos pour le controller
     */

    /**
     * @Route("/video/{slug}", name="video")
     */

    /*Création des pages shows*/
    public function show($slug)
    {

        $video = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug); /*Va chercher le slug dans l'entité Product*/

        if (!$video) {
            return $this->redirectToRoute('videos'); /*Créer une route avec le slug pour les pages shows*/
        }

        /*Retourne le contenu du controller dans la vue video/show.html.twig*/
        return $this->render('video/show.html.twig',[
            'video' => $video /*Envoie le contenu de chaque vidéos de l'entité dans la vue*/
        ]);
    }
}
