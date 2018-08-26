<?php

namespace AppBundle\Repository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{	
	// Return products with some number of elements
	public function pageProducts($productsNum=2,$page=1)
	{
		$query = $this->createQueryBuilder('p')
		    ->leftJoin('p.category', 'c')
            ->where('p.price > 1 AND c.active = 1')
            ->setFirstResult($productsNum*($page-1))
            ->setMaxResults($productsNum)
            ->getQuery();
        return $query->getResult();
	}
}