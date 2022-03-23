<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Film;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FilmCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Film::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title')->setMaxLength(255);
        yield DateField::new('date_published')->setFormat('dd-MM-yyyy');
        yield TextField::new('duration')->setMaxLength(255);
        yield TextField::new('genre')->setMaxLength(255);
        yield TextField::new('production_company')->setMaxLength(255);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            // this will forbid to create or delete entities in the backend
            ->disable(Action::NEW, Action::EDIT, Action::DELETE)
            ;
    }
}
