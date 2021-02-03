<?php

namespace App\Controller\Admin;

use App\Entity\Lives;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LivesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lives::class;
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
