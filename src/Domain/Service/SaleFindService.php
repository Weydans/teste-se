<?php

namespace App\Domain\Service;

use App\Domain\Model\Sale;
use App\Domain\Repository\SaleRepository;

class SaleFindService
{
    public static function execute( int $id, SaleRepository $repository ) : Sale 
    {
        return $repository->find( $id );
    }
}
