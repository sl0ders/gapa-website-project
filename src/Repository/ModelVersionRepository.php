<?php

namespace App\Repository;

use App\Entity\ModelVersion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ModelVersion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModelVersion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModelVersion[]    findAll()
 * @method ModelVersion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelVersionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModelVersion::class);
    }

    // /**
    //  * @return ModelVersion[] Returns an array of ModelVersion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ModelVersion
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
