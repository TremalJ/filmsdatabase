<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Director;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DirectorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Director::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
        yield DateField::new('born_date');
        yield AssociationField::new('films')->autocomplete()->onlyOnForms();
    }
}
