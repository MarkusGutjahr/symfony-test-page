<?php
namespace App\Repository;

use App\Entity\ContactBookEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ContactBookRepository extends ServiceEntityRepository
{
    public function __construct(private readonly ManagerRegistry $registry)
    {
        parent::__construct($this->registry, ContactBookEntity::class);
    }

    public function add(ContactBookEntity $contactBook)
    {
        $manager = $this->getEntityManager();
        $manager->persist($contactBook);
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }

    public function getPaginatedEntries(int $limit, int $page): array {
        //offset beginnt bei 0, deswegen -1 (weil erste page = 1)
        $offset = ($page - 1) * $limit;

        //laden aus bestimmter Tabelle ($this->repository)
        //entry bekommen (WHERE, ORDER BY, LIMIT, OFFSET)
        return $this->findBy([],['createdAt' => 'DESC'], $limit, $offset);
    }

    public function findByUser($user, int $limit, int $offset): array
    {
        return $this->findBy(['user' => $user], ['createdAt' => 'DESC'], $limit, $offset);
    }

    public function countByUser($user): int
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->where('c.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleScalarResult();
    }

}

