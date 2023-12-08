<?php 

namespace Financas\Filter;

use Doctrine\ORM\QueryBuilder;

class FarmerFilter
{
    public function filter(QueryBuilder &$queryBuilder, array $filter = []): void
    {
        if (count($filter) === 0) return;

        if (isset($filter['type'])) {
            $queryBuilder
                ->andWhere('f.type = :type')
                ->setParameter('type', $filter['type']);
        }

        if (isset($filter['product_id'])) {
            $queryBuilder
                ->andWhere('f.product = :product_id')
                ->setParameter('product_id', $filter['product_id']);
        }

        if (isset($filter['initial_value']) || isset($filter['final_value'])) {
            $queryBuilder
                ->andWhere('f.value BETWEEN :initial_value AND :final_value')
                ->setParameter('initial_value', isset($filter['initial_value']) ? $filter['initial_value'] : 0)
                ->setParameter('final_value', isset($filter['final_value']) ? $filter['final_value'] : 1000000000000);
        }

        if (isset($filter['initial_date']) || isset($filter['final_date'])) {
            $tz = new \DateTimeZone('America/Sao_Paulo');

            $initialDate = (new \DateTime('01-01-1900', $tz));
            $finalDate   = (new \DateTime('now', $tz))->add(new \DateInterval('P1Y'));

            $queryBuilder
                ->andWhere('f.date BETWEEN :initial_date AND :final_date')
                ->setParameter('initial_date', isset($filter['initial_date']) ? $filter['initial_date'] : $initialDate)
                ->setParameter('final_date', isset($filter['final_date']) ? $filter['final_date'] : $finalDate);
        }
    }
}