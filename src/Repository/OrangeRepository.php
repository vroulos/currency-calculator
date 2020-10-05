<?php

namespace App\Repository;

use App\Entity\Orange;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Orange|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orange|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orange[]    findAll()
 * @method Orange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orange::class);
    }

    // /**
    //  * @return Orange[] Returns an array of Orange objects
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
    public function findOneBySomeField($value): ?Orange
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
