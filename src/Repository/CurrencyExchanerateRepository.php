<?php

namespace App\Repository;

use App\Entity\CurrencyExchanerate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CurrencyExchanerate|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrencyExchanerate|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrencyExchanerate[]    findAll()
 * @method CurrencyExchanerate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyExchanerateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrencyExchanerate::class);
    }

    // /**
    //  * @return CurrencyExchanerate[] Returns an array of CurrencyExchanerate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CurrencyExchanerate
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
