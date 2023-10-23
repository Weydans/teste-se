<?php

namespace App\Domain\Service;

use App\Domain\Repository\SaleRepository;

class SaleAllService
{
    public static function execute( SaleRepository $repository ) : ?array
    {
        return $repository->all();
    }
}
