<?php

namespace App\Domain\Service;

use stdClass;
use App\Domain\Model\Sale;
use App\Domain\Model\SaleItem;
use App\Domain\Repository\SaleRepository;
use App\Domain\Repository\ProductRepository;

class SaleCreateService
{
    public static function execute( 
        stdClass $data, 
        SaleRepository $saleRepository,
        ProductRepository $productRepository
    ) : Sale 
    {
        $sale     = new Sale();
        $products = ProductAllService::execute( $productRepository );  

        foreach( $data as $saleItem ) {
            foreach( $products as $product ) {
                if ( $product->id == $saleItem->id ) {
                    $sale->addItem( new SaleItem( $saleItem->quantity, $product ) );
                    break;
                }
            }
        }

        $saleRepository->create( $sale );

        return $sale;
    }
}
