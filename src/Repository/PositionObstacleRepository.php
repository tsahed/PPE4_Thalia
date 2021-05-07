<?php

namespace App\Repository;

use App\Entity\PositionObstacle;
use App\Entity\Partie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PositionObstacle|null find($id, $lockMode = null, $lockVersion = null)
 * @method PositionObstacle|null findOneBy(array $criteria, array $orderBy = null)
 * @method PositionObstacle[]    findAll()
 * @method PositionObstacle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PositionObstacleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PositionObstacle::class);
    }
    public function findByPartie(Partie $partie)
    {
        return $this->createQueryBuilder('p')
            ->andWhere(':value MEMBER OF p.partie')
            ->setParameter('value', $partie)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return PositionObstacle[] Returns an array of PositionObstacle objects
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
    public function findOneBySomeField($value): ?PositionObstacle
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
