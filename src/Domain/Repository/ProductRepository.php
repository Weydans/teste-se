<?php

namespace App\Domain\Repository;

use App\Domain\Model\Product;

class ProductRepository extends DoctrineRepository 
{
	protected $entityClass = Product::class;
    
	public function __construct()
	{
		parent::__construct();
	}
}
