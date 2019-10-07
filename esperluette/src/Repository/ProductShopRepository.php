<?php

namespace App\Repository;

use App\Entity\ProductShop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductShop|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductShop|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductShop[]    findAll()
 * @method ProductShop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductShop::class);
    }

    // /**
    //  * @return ProductShop[] Returns an array of ProductShop objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductShop
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
