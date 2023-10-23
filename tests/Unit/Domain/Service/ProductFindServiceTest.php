<?php

namespace Tests\Unit\Domain\Service;

use App\Domain\Model\Product;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Service\ProductFindService;
use App\Domain\Repository\ProductRepository;

#[CoversClass(ProductFindService::class)]
class ProductFindServiceTest extends TestCase
{
    public function test_execute_should_call_product_repository_find_method() 
    {
        $product = $this->createMock( Product::class );

        $productRepository = $this->createMock( ProductRepository::class );
        $productRepository->method( 'find' )->willReturn( $product );
        $productRepository->expects( $this->once() )->method( 'find' );
        
        ProductFindService::execute( 1, $productRepository );
    }
}
