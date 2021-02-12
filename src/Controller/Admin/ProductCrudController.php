<?php

namespace App\Controller\Admin;

use App\Entity\Product;
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

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'), /*Crée un champ titre */
            SlugField::new('slug') /*Crée un champ slug */
                ->setTargetFieldName('title'),
            ImageField::new('image') /*Crée un champ image */
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads') /*Envoie la nouvelle image dans ce fichier*/
                ->setUploadedFileNamePattern('[randomhash].[extension]') /*Renomme le fichier random*/
                ->setRequired(false),
            TextField::new('media'), /*Crée un champ média pour les URL */
            TextareaField::new('description'), /*Crée un champ description */
            TextareaField::new('sousTitre'), /*Crée un champ sous-titre */
            NumberField::new('episode'),  /*Crée un champ episode */
            TextField::new('createur'), /*Crée un champ createur */
            BooleanField::new('isBest'), /*Crée un champ isBest pour afficher le contenu mis en avant sur la première page */
            DateField::new('date'), /*Crée un champ date */
            AssociationField::new('category'), /*Crée un champ catégory pour la sélection d'une des catégories */
            AssociationField::new('domaine'), /*Crée un champ domaine pour la sélection d'un des domaines */
            AssociationField::new('cycle') /*Crée un champ cycle pour la sélection d'un cycle */
        ];
    }

}
