<?php

namespace App\Repository;

use App\Entity\Evenment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Evenment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenment[]    findAll()
 * @method Evenment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenment::class);
    }

    // /**
    //  * @return Evenment[] Returns an array of Evenment objects
    //  */
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
    public function findOneBySomeField($value): ?Evenment
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    */
    /**
     * @return Evenment[]
     */
    public function findPlanBySujet($sujet){
        return $this->createQueryBuilder('Evenment')
            ->andWhere(' Evenment.detail LIKE :sujet or Evenment.commantaire LIKE :sujet ')
            ->setParameter('sujet', '%'.$sujet.'%')
            ->getQuery()
            ->getResult();
    }

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e
                FROM AppBundle:Entity e
                WHERE e.foo LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }
}
