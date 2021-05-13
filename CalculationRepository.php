<?php

declare(strict_types=1);

namespace App\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

class CalculationRepository extends EntityRepository
{
    /**
     * @param string $equationHandle
     *
     * @return Equation|null
     *
     * @throws NonUniqueResultException
     */
    public function fetchEquationByHandle(string $equationHandle): ?Equation
    {
        $qb = $this->getEntityManager()->createQueryBuilder('equation');
        $ex = $qb->expr();

        return $qb->where($ex->eq('equation.handle', ':handle'))
            ->setParameter('handle', $equationHandle)
            ->getQuery()
            ->getOneOrNullResult();
    }
}