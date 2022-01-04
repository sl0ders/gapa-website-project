<?php

namespace App\Repository;

use App\Entity\VehicleMark;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VehicleMark|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleMark|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleMark[]    findAll()
 * @method VehicleMark[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleMarkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleMark::class);
    }

    // /**
    //  * @return VehicleMark[] Returns an array of VehicleMark objects
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
    public function findOneBySomeField($value): ?VehicleMark
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
