<?php

namespace App\Domain\Service;

use \stdClass;
use App\Domain\Model\Product;
use App\Domain\Repository\ProductRepository;
use App\Domain\Repository\CategoryRepository;

class ProductCreateService
{
    public static function execute( 
        stdClass $productDto, 
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    ) : Product 
    {
        $category = CategoryFindService::execute( 
            $productDto->category_id,
            $categoryRepository
        );

        $product = new Product( 
            $productDto->name, 
            $productDto->value,
            $category
        );

        $productRepository->create( $product );

        return $product;
    }
}
