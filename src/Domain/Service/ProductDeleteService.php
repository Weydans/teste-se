<?php

namespace App\Domain\Service;

use App\Domain\Repository\ProductRepository;
use App\Domain\Exception\InvalidDeleteException;
use App\Domain\Repository\SaleItemRepository;

class ProductDeleteService
{
    public static function execute(
        int $id,  
        ProductRepository $productRepository,
        SaleItemRepository $saleItemRepository

    ) : bool
    {
        $saleItems = $saleItemRepository->getByProductId( $id );

        if ( count( $saleItems ) ) {
            throw new InvalidDeleteException( 
                'Não é permitido remover produtos que possuem registro de venda' 
            );
        }

        return $productRepository->delete( $id );
    }
}
