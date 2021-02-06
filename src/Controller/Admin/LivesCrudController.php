<?php

namespace App\Controller\Admin;

use App\Entity\Lives;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class LivesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lives::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            SlugField::new('slug')
                ->setTargetFieldName('title'),
            ImageField::new('image')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            UrlField::new('media'),
            TextareaField::new('description'),
            TextareaField::new('sousTitre'),
            NumberField::new('episode'),
            TextField::new('createur'),
            BooleanField::new('isBest'),
            DateField::new('date'),
            AssociationField::new('category'),
            AssociationField::new('domaine')
        ];
    }
}
