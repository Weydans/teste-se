<?php

namespace App\Domain\Service;

use App\Domain\Model\Category;
use App\Domain\Repository\CategoryRepository;

class CategoryFindService
{
    public static function execute(
        int $id,  
        CategoryRepository $repository 
    ) : Category
    {
        return $repository->find( $id );
    }
}
