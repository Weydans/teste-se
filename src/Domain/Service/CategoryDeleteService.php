<?php

namespace App\Domain\Service;

use App\Domain\Repository\CategoryRepository;

class CategoryDeleteService
{
    public static function execute(
        int $id,  
        CategoryRepository $repository 
    ) : bool
    {
        return $repository->delete( $id );
    }
}
