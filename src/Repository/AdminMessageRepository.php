<?php

namespace App\Repository;

use App\Entity\AdminMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AdminMessage>
 *
 * @method AdminMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdminMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdminMessage[]    findAll()
 * @method AdminMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdminMessage::class);
    }

    public function add(AdminMessage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AdminMessage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AdminMessage[] Returns an array of AdminMessage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AdminMessage
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    /* Pour retrouver un message via son id*/

    public function findById(int $id) : AdminMessage
    {
        $qb = $this->createQueryBuilder('am')
            ->where('am.id =:id')
            ->setParameter('id', $id);
        return $qb->getQuery()->getOneOrNullResult();
    }

}
