<?php

namespace App\Repository;

use App\Entity\VersionMotorisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VersionMotorisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method VersionMotorisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method VersionMotorisation[]    findAll()
 * @method VersionMotorisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VersionMotorisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VersionMotorisation::class);
    }

    // /**
    //  * @return VersionMotorisation[] Returns an array of VersionMotorisation objects
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
    public function findOneBySomeField($value): ?VersionMotorisation
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
