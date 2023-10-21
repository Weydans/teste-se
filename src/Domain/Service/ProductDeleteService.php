<?php

namespace App\Domain\Service;

use App\Domain\Repository\ProductRepository;

class ProductDeleteService
{
    public static function execute(
        int $id,  
        ProductRepository $repository 
    ) : bool
    {
        return $repository->delete( $id );
    }
}
