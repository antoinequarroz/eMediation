<?php

namespace App\Repository;

use App\Entity\Lives;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lives|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lives|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lives[]    findAll()
 * @method Lives[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lives::class);
    }

    // /**
    //  * @return Lives[] Returns an array of Lives objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lives
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
