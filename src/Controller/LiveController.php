<?php

namespace App\Controller;

use App\Entity\Lives;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function index(): Response
    {
        $lives = $this->entityManager->getRepository(Lives::class)->findAll();

        return $this->render('live/index.html.twig',[
            'lives' => $lives
        ]);
    }
}