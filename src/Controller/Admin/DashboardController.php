<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Tables;
use App\Entity\GuestList;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
	#[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        //return parent::index();
		return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Административная панель');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Столы', 'fa fa-comments', Tables::class);
        yield MenuItem::linkToCrud('Гости', 'fa fa-map-marker', GuestList::class);
    }
}
