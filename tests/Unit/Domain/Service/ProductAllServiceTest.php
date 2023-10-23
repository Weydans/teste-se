<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Service\ProductAllService;
use App\Domain\Repository\ProductRepository;

#[CoversClass(ProductAllService::class)]
class ProductAllServiceTest extends TestCase
{
    public function test_execute_should_call_product_repository_all_method() 
    {
        $productRepository = $this->createMock( ProductRepository::class );
        $productRepository->expects( $this->once() )->method( 'all' );
        
        ProductAllService::execute( $productRepository );
    }
}
