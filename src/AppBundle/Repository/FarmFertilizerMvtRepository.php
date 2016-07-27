<?php

namespace AppBundle\Repository;

/**
 * FarmFertilizerMvtRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FarmFertilizerMvtRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllByFarmFertilizer ($id)
    {
        $qb = $this->createQueryBuilder('m');

        $qb->where('m.fertilizer = :fertilizer')
            ->setParameter('fertilizer', $id)
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}