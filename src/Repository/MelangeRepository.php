<?php

namespace App\Repository;

use App\Entity\Melange;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Melange|null find($id, $lockMode = null, $lockVersion = null)
 * @method Melange|null findOneBy(array $criteria, array $orderBy = null)
 * @method Melange[]    findAll()
 * @method Melange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MelangeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Melange::class);
    }

//    /**
//     * @return Melange[] Returns an array of Melange objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Melange
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
