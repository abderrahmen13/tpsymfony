<?php

namespace App\Repository;

use App\Entity\Bid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bid|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bid|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bid[]    findAll()
 * @method Bid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BidRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bid::class);
    }


    public function findByProduct($id)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.product = :product_id')
            ->setParameter('product_id', $id)
            ->getQuery()
            ->getResult()
        ;
    }


    public function findBidsItemsByUser($id)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.user = :user_id')
            ->setParameter('user_id', $id)
            ->select('count(DISTINCT b.product)')
            ->getQuery()
            ->getResult()
        ;
    }


    //SELECT COUNT(DISTINCT product_id) FROM `bid` 


    // /**
    //  * @return Bid[] Returns an array of Bid objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bid
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
