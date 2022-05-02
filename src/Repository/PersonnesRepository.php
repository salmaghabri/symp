<?php

namespace App\Repository;

use App\Entity\Personnes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Personnes>
 *
 * @method Personnes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personnes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personnes[]    findAll()
 * @method Personnes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personnes::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Personnes $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Personnes $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Personnes[] Returns an array of Personnes objects
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

    
   /* public function findOneBySomeField($min, $max): ?Personnes
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.age > :min and p.age< :max')
            ->setParameters(['min'=> $min,'max'=>$max])
            //->setParameter()
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }*/
    public function findByExampleField($min, $max)
    {
        // return $this->createQueryBuilder('p')
        //     ->andWhere('p.exampleField = :val')
        //     ->setParameter('val', $value)
        //     ->orderBy('p.id', 'ASC')
        //     ->setMaxResults(10)
        //     ->getQuery()
        //     ->getResult()
        // ;
        return $this->createQueryBuilder('p')
            ->andWhere('p.age > :min and p.age< :max')
            ->setParameters(['min'=> $min,'max'=>$max])
            ->getQuery()->getResult()
        ;
    }
    public function stats()
    {
        // return $this->createQueryBuilder('p')
        //     ->andWhere('p.exampleField = :val')
        //     ->setParameter('val', $value)
        //     ->orderBy('p.id', 'ASC')
        //     ->setMaxResults(10)
        //     ->getQuery()
        //     ->getResult()
        // ;
        return $this->createQueryBuilder('p')
        ->select('avg(p.age) as ageMoyen, count(p.nom) as total')
            //->setParameters(['min'=> $min,'max'=>$max])
            ->getQuery()->getResult()
        ;
    }

}
