<?php

namespace App\Domain\Service;

use \stdClass;
use App\Domain\Model\Product;
use App\Domain\Repository\CategoryRepository;
use App\Domain\Repository\ProductRepository;

class ProductUpdateService
{
    public static function execute(
        stdClass $productDto,  
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    ) : Product
    {
        $product = $productRepository->find( $productDto->id );

        $product->name  = $productDto->name;
        $product->value = $productDto->value; 

        if ( $productDto->category_id != $product->category->id ) {
            $product->category = $categoryRepository->find( 
                $productDto->category_id 
            );
        }

        $productRepository->update( $product );

        return $product;
    }
}
