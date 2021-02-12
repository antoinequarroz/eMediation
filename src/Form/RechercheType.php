<?php
namespace App\Form;

use App\Classe\Search;
use App\Entity\Category;
use App\Entity\Domains;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheType extends AbstractType
{
    /*Crée le formulaire pour le système de filtre*/
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder /*Crée le formulaire*/

            /*Intègre dans le formulaire les champs catégorie*/
            ->add('categories', EntityType::class, [  /*Va chercher les données de l'entité Category*/
                'label' => false, /*Pas de label*/
                'required' => false,
                'class' => Category::class,
                'multiple' => true,
                'expanded' => true
            ])
            /*Intègre dans le formulaire les champs domaines*/
            ->add('domaines', EntityType::class, [ /*Va chercher les données de l'entité Domaines*/
                'label' => false, /*Pas de label*/
                'required' => false,
                'class' => Domains::class,
                'multiple' => true,
                'expanded' => true
            ])
            /*Intègre dans le formulaire le bouton de recherche*/
            ->add('submit', SubmitType::class, [ /*Bouton et validation pour le système de recherche*/
                'label' => 'Filtrer', /*Label du nom du bouton*/
                'attr' => [
                    'class' => 'btn-block btn-primary' /*bouton de recherche*/
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class, /*Cherche dans les entités Category et Domaine grâce à la classe php Search*/
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}