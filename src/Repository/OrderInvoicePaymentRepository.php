<?php

namespace App\Repository;

use App\Entity\OrderInvoicePayment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderInvoicePayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderInvoicePayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderInvoicePayment[]    findAll()
 * @method OrderInvoicePayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderInvoicePaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderInvoicePayment::class);
    }

    // /**
    //  * @return OrderInvoicePayment[] Returns an array of OrderInvoicePayment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderInvoicePayment
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
