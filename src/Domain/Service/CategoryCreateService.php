<?php

namespace App\Domain\Service;

use \stdClass;
use App\Domain\Model\Category;
use App\Domain\Repository\CategoryRepository;

class CategoryCreateService
{
    public static function execute( 
        stdClass $categoryDto, 
        CategoryRepository $repository 
    ) : Category 
    {
        $category = new Category( $categoryDto->name, $categoryDto->tax );

        $repository->create( $category );

        return $category;
    }
}
