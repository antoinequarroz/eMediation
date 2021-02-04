<?php

namespace App\Controller\Admin;

use App\Entity\Domains;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DomainsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Domains::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
