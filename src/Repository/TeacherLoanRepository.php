<?php

namespace App\Repository;

use App\Entity\TeacherLoan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TeacherLoan|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeacherLoan|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeacherLoan[]    findAll()
 * @method TeacherLoan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeacherLoanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeacherLoan::class);
    }

    // /**
    //  * @return TeacherLoan[] Returns an array of TeacherLoan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TeacherLoan
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
