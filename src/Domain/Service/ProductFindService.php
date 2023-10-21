<?php

namespace App\Domain\Service;

use App\Domain\Model\Product;
use App\Domain\Repository\ProductRepository;

class ProductFindService
{
    public static function execute(
        int $id,  
        ProductRepository $repository 
    ) : Product
    {
        return $repository->find( $id );
    }
}
