<?php

namespace App\Controller\Admin;

use App\Controller\SearchController;
use App\Entity\Book;
use App\Entity\BookType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(BookCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Book Management')
            ->setFaviconPath('')
            ->disableUrlSignatures();

    }


    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Book', 'fas fa-book', Book::class);
        yield MenuItem::linkToCrud('Book Type', 'fas fa-list', BookType::class);
        yield MenuItem::linkToRoute('Search for Book', 'fas fa-search', 'searchForm');
    }
}
