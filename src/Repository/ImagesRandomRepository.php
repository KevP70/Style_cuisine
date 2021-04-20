<?php

namespace App\Repository;

use App\Entity\ImagesRandom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImagesRandom|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImagesRandom|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImagesRandom[]    findAll()
 * @method ImagesRandom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagesRandomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImagesRandom::class);
    }

    // /**
    //  * @return IamgesRandom[] Returns an array of IamgesRandom objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IamgesRandom
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
