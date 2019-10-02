<?php

namespace App\Repository;

use App\Entity\Caroussel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Caroussel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caroussel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caroussel[]    findAll()
 * @method Caroussel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarousselRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caroussel::class);
    }

    // /**
    //  * @return Caroussel[] Returns an array of Caroussel objects
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
    public function findOneBySomeField($value): ?Caroussel
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
