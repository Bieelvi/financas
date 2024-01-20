<?php 

namespace Financas\Repository;

use Doctrine\ORM\EntityRepository;

class UserConfigRepository extends EntityRepository
{
    public function findOneByEmail(array $criteria, ?array $orderBy = null)
    {
        $persister = $this->_em->getUnitOfWork()->getEntityPersister($this->_entityName);

        $result = $persister->load($criteria, null, null, [], null, 1, $orderBy);
        if (is_null($result) || empty($result)) {
            throw new \DomainException(translate('Invalid credentials'));
        }

        return $result;
    }
}