<?php

namespace App\Repository;

use App\Entity\Hourly;
use App\Entity\User;
use App\Search\Admin\HourlyAdminSearch;
use App\Search\Hospital\HourlyHospitalSearch;
use App\Search\User\HourlySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Hourly>
 *
 * @method Hourly|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hourly|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hourly[]    findAll()
 * @method Hourly[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HourlyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hourly::class);
    }

    public function add(Hourly $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Hourly $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Hourly[] Returns an array of Hourly objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Hourly
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    /**
     * @throws NonUniqueResultException
     */
    public function findById($id): Hourly {
        $qb = $this->createQueryBuilder('a')
            ->where('a.id=:id')
            ->setParameter('id', $id)
            ->orderBy('a.date', 'ASC')
        ;
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findAllWithServices() {
        $qb = $this->createQueryBuilder('a')
            ->leftJoin('a.Service', 'b')
            ->addSelect('b');

        return $qb->getQuery()->getResult();
    }

    public function findAllWithHospital(){
        $qb=$this->createQueryBuilder('b')
            ->leftJoin('b.Hospital', 'c')
            ->addSelect('c');
        return $qb->getQuery()->getResult();
    }
//$events = $qb->select( 'e' )
//->from( 'Entity\Event',  'e' )
//->orderBy('e.dateStart', 'DESC')
//->setFirstResult( $offset )
//->setMaxResults( $limit )
//->getQuery()
//->getResult();

    public function findBySearch(HourlySearch $hourlySearch)
    {
        $qb = $this->createQueryBuilder('a')
        ->orderBy('a.date', 'ASC');
        if (count($hourlySearch->getHospitals())) {
            $qb->andWhere('a.Hospital in (:hospitals)')
                ->setParameter('hospitals', $hourlySearch->getHospitals());
        }

        if (count($hourlySearch->getServices())){
            $qb->andWhere('a.Service in (:services)')
                ->setParameter('services', $hourlySearch->getServices());
        }


        return $qb->getQuery()->getResult();
    }


    public function findByAdminSearch(HourlyAdminSearch $hourlyAdminSearch)
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC');

        if (count($hourlyAdminSearch->getHospitals())) {
            $qb->andWhere('a.Hospital in (:hospitals)')
                ->setParameter('hospitals', $hourlyAdminSearch->getHospitals());
        }

        if (count($hourlyAdminSearch->getServices())) {
            $qb->andWhere('a.Service in (:services)')
                ->setParameter('services', $hourlyAdminSearch->getServices());
        }

        return $qb->getQuery()->getResult();
    }

    public function findByHospitalSearch(HourlyHospitalSearch $hourlyHospitalSearch)
    {

        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.date', 'ASC');

        if (count($hourlyHospitalSearch->getHospitals())) {
            $qb->andWhere('a.Hospital in (:hospitals)')
                ->setParameter('hospitals', $hourlyHospitalSearch->getHospitals());
        }

        if (count($hourlyHospitalSearch->getServices())) {
            $qb->andWhere('a.Service in (:services)')
                ->setParameter('services', $hourlyHospitalSearch->getServices());
        }

        return $qb->getQuery()->getResult();
    }
}
