<?php

namespace App\Repository;

use App\Entity\Documentations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Documentations>
 *
 * @method Documentations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Documentations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Documentations[]    findAll()
 * @method Documentations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Documentations::class);
    }

//    /**
//     * @return Documentations[] Returns an array of Documentations objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Documentations
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
