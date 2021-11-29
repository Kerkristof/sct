<?php

namespace App\Repository;

use App\Entity\EventFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EventFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventFile[]    findAll()
 * @method EventFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventFile::class);
    }

    // /**
    //  * @return EventFile[] Returns an array of EventFile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventFile
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
