<?php

namespace Financas\Repository;

use Doctrine\ORM\EntityRepository;
use Financas\Filter\FarmerFilter;

class FarmerRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy(
            [], 
            ['date' => 'DESC']
        );
    }

    public function findAllWithFilter(array $filter = [], ?int $maxResult = 10)
    {
        $queryBuilder = $this
            ->createQueryBuilder('f')
            ->where('f.user = :user')
            ->setParameter('user', $_SESSION['logged']->getId());

        (new FarmerFilter)
            ->filter($queryBuilder, $filter);

        return $queryBuilder
            ->orderBy('f.date', 'DESC')
            ->setMaxResults($maxResult)
            ->getQuery()
            ->getResult();
    }
}
