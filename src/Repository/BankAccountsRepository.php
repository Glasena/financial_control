<?php

namespace App\Repository;

use App\Entity\BankAccounts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BankAccounts>
 *
 * @method BankAccounts|null find($id, $lockMode = null, $lockVersion = null)
 * @method BankAccounts|null findOneBy(array $criteria, array $orderBy = null)
 * @method BankAccounts[]    findAll()
 * @method BankAccounts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BankAccountsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BankAccounts::class);
    }

//    /**
//     * @return BankAccounts[] Returns an array of BankAccounts objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BankAccounts
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
