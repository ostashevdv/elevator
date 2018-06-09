<?php

namespace App\Repository;

use App\Entity\ElevatorLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ElevatorLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method ElevatorLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method ElevatorLog[]    findAll()
 * @method ElevatorLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElevatorLogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ElevatorLog::class);
    }

//    /**
//     * @return ElevatorLog[] Returns an array of ElevatorLog objects
//     */
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
    public function findOneBySomeField($value): ?ElevatorLog
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
