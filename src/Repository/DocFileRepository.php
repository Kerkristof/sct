<?php

namespace App\Repository;

use App\Entity\DocFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocFile[]    findAll()
 * @method DocFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocFile::class);
    }

    // /**
    //  * @return DocFile[] Returns an array of DocFile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DocFile
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
