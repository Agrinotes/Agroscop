<?php

namespace AppBundle\Repository;

/**
 * CropCycleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CropCycleRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByCropAndCampaign($crop, $startDatetime,$endDatetime, $farm)
    {

        $qb = $this->createQueryBuilder('c');

        $qb->join('c.crops','crops')
            ->addSelect('crops')
            ->join('c.plot','p')
            ->addSelect('p')
            ->join('p.farm','farm')
            ->addSelect('farm')
            ->where('crops.id = :crop AND farm.id =:farm AND c.startDatetime BETWEEN :yearStart AND :yearEnd')
            ->setParameter('crop', $crop)
            ->setParameter('farm', $farm)
            ->setParameter('yearStart', $startDatetime)
            ->setParameter('yearEnd', $endDatetime)
            ->orWhere('crops.id = :crop AND farm.id =:farm  AND c.endDatetime BETWEEN :yearStart AND :yearEnd')
            ->setParameter('crop', $crop)
            ->setParameter('farm', $farm)
            ->setParameter('yearStart', $startDatetime)
            ->setParameter('yearEnd', $endDatetime)
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByPlotAndCampaign($plot, $startDatetime,$endDatetime)
    {

        $qb = $this->createQueryBuilder('c');

        $qb->join('c.plot','p')
            ->addSelect('p')
            ->where('p.id = :plot AND c.startDatetime BETWEEN :yearStart AND :yearEnd')
            ->setParameter('plot', $plot)
            ->setParameter('yearStart', $startDatetime)
            ->setParameter('yearEnd', $endDatetime)
            ->orWhere('p.id = :plot AND c.endDatetime BETWEEN :yearStart AND :yearEnd')
            ->setParameter('plot', $plot)
            ->setParameter('yearStart', $startDatetime)
            ->setParameter('yearEnd', $endDatetime)
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAllByCampaign($startDatetime,$endDatetime, $farm)
    {

        $qb = $this->createQueryBuilder('c');

        $qb->join('c.plot','p')
            ->addSelect('p')
            ->join('p.farm','farm')
            ->addSelect('farm')
            ->where('farm.id =:farm AND c.startDatetime BETWEEN :yearStart AND :yearEnd')
            ->setParameter('farm', $farm)
            ->setParameter('yearStart', $startDatetime)
            ->setParameter('yearEnd', $endDatetime)
            ->orWhere('farm.id =:farm  AND c.endDatetime BETWEEN :yearStart AND :yearEnd')
            ->setParameter('farm', $farm)
            ->setParameter('yearStart', $startDatetime)
            ->setParameter('yearEnd', $endDatetime)
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function qbFindAllActiveByFarm($farm)
    {

        $qb = $this->createQueryBuilder('c');

        $qb->join('c.plot','p')

            ->addSelect('p')
            ->join('p.farm','farm')
            ->addSelect('farm')
            ->where('farm.id =:farm')
            ->setParameter('farm', $farm)
            ->andWhere('c.status=:status')
            ->setParameter('status', 'ActiveAction')
        ;

        return $qb

            ;
    }


}
