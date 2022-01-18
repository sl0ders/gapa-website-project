<?php

namespace App\Repository;

use App\Entity\VehicleRange;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VehicleRange|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleRange|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleRange[]    findAll()
 * @method VehicleRange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleRangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleRange::class);
    }

    // /**
    //  * @return VehicleRange[] Returns an array of VehicleRange objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VehicleRange
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
