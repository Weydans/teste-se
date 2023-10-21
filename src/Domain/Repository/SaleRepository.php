<?php

namespace App\Domain\Repository;

use App\Domain\Model\Sale;

class SaleRepository extends DoctrineRepository 
{
	protected $entityClass = Sale::class;
    
	public function __construct()
	{
		parent::__construct();
	}
}
