<?php

namespace App\Domain\Repository;

use App\Domain\Model\Category;

class CategoryRepository extends DoctrineRepository 
{
	protected $entityClass = Category::class;
    
	public function __construct()
	{
		parent::__construct();
	}
}
