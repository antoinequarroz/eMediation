<?php

namespace App\Controller\Admin;

use App\Entity\Cycle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CycleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cycle::class;
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
