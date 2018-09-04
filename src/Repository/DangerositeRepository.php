<?php

namespace App\Repository;

use App\Entity\Dangerosite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dangerosite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dangerosite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dangerosite[]    findAll()
 * @method Dangerosite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DangerositeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dangerosite::class);
    }

//    /**
//     * @return Dangerosite[] Returns an array of Dangerosite objects
//     */
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
    public function findOneBySomeField($value): ?Dangerosite
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
