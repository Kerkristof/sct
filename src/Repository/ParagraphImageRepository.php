<?php

namespace App\Repository;

use App\Entity\ParagraphImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParagraphImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParagraphImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParagraphImage[]    findAll()
 * @method ParagraphImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParagraphImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParagraphImage::class);
    }

    // /**
    //  * @return ParagraphImage[] Returns an array of ParagraphImage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ParagraphImage
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
