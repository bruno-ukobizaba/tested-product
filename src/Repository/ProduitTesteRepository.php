<?php

namespace App\Repository;

use App\Entity\ProduitTeste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProduitTeste|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitTeste|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitTeste[]    findAll()
 * @method ProduitTeste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitTesteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProduitTeste::class);
    }

//    /**
//     * @return ProduitTeste[] Returns an array of ProduitTeste objects
//     */
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
    public function findOneBySomeField($value): ?ProduitTeste
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
