<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Actor;
use App\Entity\Director;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/easyadmin", name="easyadmin")
     */
    public function index(): Response
    {
        $adminUrlGenerator = $this->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(FilmCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Films Database');
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDateTimeFormat('medium', 'short');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName($user->getFullName());
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Films', 'fa fa-home');
        yield MenuItem::linkToCrud('Actors', 'fa fa-users', Actor::class);
        yield MenuItem::linkToCrud('Directors', 'fa fa-file-text-o', Director::class);
    }
}
