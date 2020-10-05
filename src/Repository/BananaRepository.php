<?php

namespace App\Repository;

use App\Entity\Banana;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Banana|null find($id, $lockMode = null, $lockVersion = null)
 * @method Banana|null findOneBy(array $criteria, array $orderBy = null)
 * @method Banana[]    findAll()
 * @method Banana[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BananaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Banana::class);
    }

    /**
     * @return Banana[] Returns an array of Banana objects
     */
    
    public function findCurrency($from, $to)
    {
        return $this->createQueryBuilder('banana')
            ->andWhere('banana.FromCurrencyId = :val')
            ->andWhere('banana.ToCurrencyId = :to')
            ->setParameter('val', $from)
            ->setParameter('to', $to)
            //->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Banana
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
