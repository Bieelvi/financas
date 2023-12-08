<?php 

namespace Financas\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy(
            [], 
            ['createdAt' => 'DESC']
        );
    }
}