<?php

namespace App\Domain\Service;

use App\Domain\Repository\ProductRepository;

class ProductAllService
{
    public static function execute( ProductRepository $repository ) : ?array 
    {
        return $repository->all();
    }
}
