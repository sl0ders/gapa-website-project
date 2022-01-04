<?php

namespace App\Repository;

use App\Entity\VersionFrame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VersionFrame|null find($id, $lockMode = null, $lockVersion = null)
 * @method VersionFrame|null findOneBy(array $criteria, array $orderBy = null)
 * @method VersionFrame[]    findAll()
 * @method VersionFrame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VersionFrameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VersionFrame::class);
    }

    // /**
    //  * @return VersionFrame[] Returns an array of VersionFrame objects
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
    public function findOneBySomeField($value): ?VersionFrame
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
