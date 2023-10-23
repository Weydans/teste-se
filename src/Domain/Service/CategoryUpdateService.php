<?php

namespace App\Domain\Service;

use \stdClass;
use App\Domain\Model\Category;
use App\Domain\Repository\CategoryRepository;

class CategoryUpdateService
{
    public static function execute(
        stdClass $categoryDto,  
        CategoryRepository $repository 
    ) : Category
    {
        $category = $repository->find( $categoryDto->id );

        $category->name = $categoryDto->name;
        $category->tax  = $categoryDto->tax; 

        $repository->update( $category );

        return $category;
    }
}
