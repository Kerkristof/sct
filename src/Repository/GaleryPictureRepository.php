<?php

namespace App\Repository;

use App\Entity\GaleryPicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GaleryPicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method GaleryPicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method GaleryPicture[]    findAll()
 * @method GaleryPicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GaleryPictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GaleryPicture::class);
    }

    // /**
    //  * @return GaleryPicture[] Returns an array of GaleryPicture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GaleryPicture
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
