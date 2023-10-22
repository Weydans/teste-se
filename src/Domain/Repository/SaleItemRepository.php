<?php

namespace App\Domain\Repository;

use App\Domain\Model\SaleItem;

class SaleItemRepository extends DoctrineRepository 
{
	protected $entityClass = SaleItem::class;
    
	public function __construct()
	{
		parent::__construct();
	}

	public function getByProductId( int $productId ) : array
	{
		$result = ( $this->manager->createQueryBuilder() )
			->select( 'e' )
			->from( $this->entityClass, 'e' )
			->where( "e.product = :product_id" )
			->setParameter( ':product_id', $productId )
			->getQuery()->getResult();

		return $result;
	}
}
