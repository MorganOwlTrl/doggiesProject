<?php

namespace App\Controller\admin;

use App\Entity\Annonce;
use App\Entity\Breed;
use App\Entity\Dog;
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
            ->setTitle('Mille et Un Toutous Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Accueil', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Annonces', 'fas fa-sticky-note', Annonce::class );
        yield MenuItem::linkToCrud('Chiens', 'fas fa-dog', Dog::class);
        yield MenuItem::linkToCrud('Races de chiens', 'fas fa-list', Breed::class);

    }
}
