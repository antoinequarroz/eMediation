<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Cycle;
use App\Entity\Domains;
use App\Entity\Header;
use App\Entity\Lives;
use App\Entity\OffreCulturelle;
use App\Entity\Podcast;
use App\Entity\Product;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('eMédiation');
    }
    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('assets/css/admin.css');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Accueil', 'fas fa-home', 'home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Domaine', 'fas fa-list-alt', Domains::class);
        yield MenuItem::linkToCrud('Cycle', 'fas fa-cookie-bite', Cycle::class);
        yield MenuItem::linkToCrud('Vidéo', 'fas fa-video', Product::class);
        yield MenuItem::linkToCrud('Live', 'fas fa-photo-video', Lives::class);
        yield MenuItem::linkToCrud('Podcast', 'fas fa-microphone', Podcast::class);
        yield MenuItem::linkToCrud('Offre Culturelle', 'fas fa-calendar', OffreCulturelle::class);
    }
}
