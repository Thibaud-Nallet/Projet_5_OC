<?php

namespace App\Repository;

use App\Entity\ImageShop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ImageShop|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageShop|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageShop[]    findAll()
 * @method ImageShop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageShop::class);
    }

    // /**
    //  * @return ImageShop[] Returns an array of ImageShop objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImageShop
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
