<?php

namespace App\Repository;

use App\Entity\VersionYears;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VersionYears|null find($id, $lockMode = null, $lockVersion = null)
 * @method VersionYears|null findOneBy(array $criteria, array $orderBy = null)
 * @method VersionYears[]    findAll()
 * @method VersionYears[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VersionYearsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VersionYears::class);
    }

    /**
     * @return VersionYears[] Returns an array of VersionYears objects
     */
    public function getVersionYearsByMark($mark): array
    {
        return $this->createQueryBuilder('vy')
            ->leftJoin("vy.version", "version")
            ->leftJoin("version.model", "model")
            ->andWhere("model.vehicleMark = :mark")
            ->setParameter(":mark", $mark)
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?VersionYears
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
