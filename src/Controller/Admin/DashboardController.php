<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\BookType;
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
            ->setTitle('Book Management');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Book', 'fas fa-book', Book::class);
        yield MenuItem::linkToCrud('Book Type', 'fas fa-list', BookType::class);
    }
}
