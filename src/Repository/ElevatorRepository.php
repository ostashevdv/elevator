<?php

namespace App\Repository;

use App\Entity\Elevator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Elevator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Elevator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Elevator[]    findAll()
 * @method Elevator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElevatorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Elevator::class);
    }

    public function findNearlyElevator(int $floor)
    {
        $result = $this->createQueryBuilder('e')
            ->addSelect('abs(e.currentFloor - :floor) as distance')
            ->setParameter('floor', $floor)
            ->orderBy('distance', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
        return array_shift($result);
    }



//    /**
//     * @return Elevator[] Returns an array of Elevator objects
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
    public function findOneBySomeField($value): ?Elevator
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
