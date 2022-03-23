<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Actor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class ActorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actor::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name')->setMaxLength(255);
        yield DateField::new('born_date')->setFormat('dd-MM-yyyy');
        yield DateField::new('dead_date');
        yield TextField::new('born_place')->setMaxLength(255);
        yield AssociationField::new('films')->setCrudController(FilmCrudController::class)->autocomplete()->onlyOnForms();
    }
}
