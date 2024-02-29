<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 *
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findOneByUser(int $userId)
    {
        return $this->createQueryBuilder('t')
            ->join('t.user', 'u')
            ->andWhere('u.id = :userId')
            ->setParameter('userId', $userId)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }
    //    /**
    //     * @return Task[] Returns an array of Trick objects
    //     */
    //    public function findByUserNotDone($userId): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->join('t.user', 'u')
    //            ->where('t.isDone = true')
    //            ->andWhere('u.id = :val')
    //            ->setParameter('val', $userId)
    //            ->getQuery()
    //            ->getResult();
    //    }

    //    public function findOneBySomeField($value): ?Trick
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
