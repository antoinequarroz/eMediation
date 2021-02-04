<?php

namespace App\Repository;

use App\Classe\Search;
use App\Entity\OffreCulturelle;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OffreCulturelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method OffreCulturelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method OffreCulturelle[]    findAll()
 * @method OffreCulturelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreCulturelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffreCulturelle::class);
    }
    /**
     * @return OffreCulturelle[]
     */
    public function findWithSearch(Search $search)
    {
        $query = $this
            ->createQueryBuilder('o')
            ->select('c', 'o')
            ->select('d', 'o')
            ->join('o.category','c')
            ->join('o.domains', 'd');

        if (!empty($search->categories)){
            $query = $query
                ->andWhere('c.id IN (:categories)')
                ->setParameter('categories', $search->categories);
        }
        if (!empty($search->domaines)){
            $query = $query
                ->andWhere('d.id IN (:domaines)')
                ->setParameter('domaines', $search->domaines);
        }

        if (!empty($search->string)) {
            $query = $query
                ->andWhere('o.title LIKE :string')
                ->setParameter('string', "%{$search->string}%");
        }

        return $query->getQuery()->getResult();

    }

    // /**
    //  * @return OffreCulturelle[] Returns an array of OffreCulturelle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OffreCulturelle
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
