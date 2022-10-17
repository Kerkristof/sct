<?php

namespace App\Repository;

use App\Entity\DocFolder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocFolder|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocFolder|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocFolder[]    findAll()
 * @method DocFolder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocFolderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocFolder::class);
    }

    // /**
    //  * @return DocFolder[] Returns an array of DocFolder objects
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
    public function findOneBySomeField($value): ?DocFolder
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
