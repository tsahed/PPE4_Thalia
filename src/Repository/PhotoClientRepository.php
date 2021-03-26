<?php

namespace App\Repository;

use App\Entity\PhotoClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PhotoClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoClient[]    findAll()
 * @method PhotoClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotoClient::class);
    }

    // /**
    //  * @return PhotoClient[] Returns an array of PhotoClient objects
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
    public function findOneBySomeField($value): ?PhotoClient
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
