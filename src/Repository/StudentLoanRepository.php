<?php

namespace App\Repository;

use App\Entity\StudentLoan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StudentLoan|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentLoan|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentLoan[]    findAll()
 * @method StudentLoan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentLoanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentLoan::class);
    }

    // /**
    //  * @return StudentLoan[] Returns an array of StudentLoan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StudentLoan
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
