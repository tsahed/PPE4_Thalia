<?php

namespace App\Repository;

use App\Entity\Client;
use App\Entity\Partie;
use App\Entity\Obstacle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Partie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partie[]    findAll()
 * @method Partie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partie::class);
    }

    public function findByClient(Client $client)
    {
        return $this->createQueryBuilder('p')
            ->andWhere(':value MEMBER OF p.client')
            ->setParameter('value', $client)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByObstacle(Obstacle $obstacle)
    {
        return $this->createQueryBuilder('p')
            ->andWhere(':value MEMBER OF p.obstacle')
            ->setParameter('value', $obstacle)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Partie[] Returns an array of Partie objects
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
    public function findOneBySomeField($value): ?Partie
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
