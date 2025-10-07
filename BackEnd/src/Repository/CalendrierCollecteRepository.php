<?php

namespace App\Repository;

use App\Entity\CalendrierCollecte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CalendrierCollecte>
 */
class CalendrierCollecteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CalendrierCollecte::class);
    }

    public function findByAdressePartialMatch(string $query): array
{
    return $this->createQueryBuilder('c')
        ->where('c.adresse LIKE :query')
        ->setParameter('query', '%'.addcslashes($query, '%_').'%')
        ->getQuery()
        ->getResult();
}

    //    /**
    //     * @return CalendrierCollecte[] Returns an array of CalendrierCollecte objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CalendrierCollecte
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
