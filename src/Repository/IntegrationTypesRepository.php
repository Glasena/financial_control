<?php

namespace App\Repository;

use App\Entity\IntegrationTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IntegrationTypes>
 *
 * @method IntegrationTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method IntegrationTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method IntegrationTypes[]    findAll()
 * @method IntegrationTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntegrationTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IntegrationTypes::class);
    }

//    /**
//     * @return IntegrationTypes[] Returns an array of IntegrationTypes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?IntegrationTypes
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
