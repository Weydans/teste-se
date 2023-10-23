<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Model\Category;
use App\Domain\Model\Product;
use App\Domain\Repository\CategoryRepository;
use App\Domain\Service\ProductCreateService;
use App\Domain\Repository\ProductRepository;
use App\Domain\Service\CategoryFindService;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(ProductCreateService::class)]
#[UsesClass(Product::class)]
#[UsesClass(CategoryFindService::class)]
class ProductCreateServiceTest extends TestCase
{
    public function test_execute_should_call_productRepository_save_method_and_return_new_product_on_success() 
    {
        $productDto              = new \stdClass();
        $productDto->name        = 'Valid Name';
        $productDto->value       = 200.40;
        $productDto->category_id = 1; 
        
        $productRepository = $this->createMock( ProductRepository::class );
        $productRepository->expects( $this->once() )->method( 'create' );
        
        $categoryRepository = $this->createMock( CategoryRepository::class );
        $categoryRepository->method( 'find' )
                           ->willReturn( $this->createMock( Category::class ) );

        $product = ProductCreateService::execute( 
            $productDto, 
            $productRepository,
            $categoryRepository
        );
        
        self::assertNotNull( $product );
    }
}
