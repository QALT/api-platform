<?php

namespace App\Repository;

use App\Entity\PresentationPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PresentationPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PresentationPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PresentationPage[]    findAll()
 * @method PresentationPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresentationPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PresentationPage::class);
    }

    // /**
    //  * @return PresentationPage[] Returns an array of PresentationPage objects
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
    public function findOneBySomeField($value): ?PresentationPage
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
