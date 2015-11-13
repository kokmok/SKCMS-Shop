<?php

namespace SKCMS\ShopBundle\Entity;




class SKBaseProductRepository extends \SKCMS\CoreBundle\Repository\SKEntityRepository
{
    
    public function findPromoted()
    {
        $qb = $this->createQueryBuilder('p');
        $qb->innerJoin('p.promotion', 'pp')
           ->addSelect('pp')
            ->where('pp.active=:active')
            ->setParameter('active', true)
            ->andWhere($qb->expr()->lte("pp.dateStart", ":currentDate"))
            ->andWhere($qb->expr()->gte("pp.dateEnd", ":currentDate"))
            ->setParameter('currentDate', new \DateTime())
                ;
        
        $results = $qb->getQuery()->getResult();
        return $results;
        
    }
}
