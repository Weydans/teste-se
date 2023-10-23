<?php

namespace Tests\Unit\Domain\Service;

use stdClass;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Model\Product;
use App\Domain\Model\Category;
use App\Domain\Repository\CategoryRepository;
use App\Domain\Service\ProductUpdateService;
use App\Domain\Repository\ProductRepository;

#[CoversClass(ProductUpdateService::class)]
class ProductUpdateServiceTest extends TestCase
{
    public function test_execute_should_call_productRepository_update_method_and_return_updated_product_on_success() 
    {
        $productDto              = new stdClass;
        $productDto->id          = 1;
        $productDto->name        = 'Valid Name';
        $productDto->value       = 1200.50;
        $productDto->category_id = 1;

        $category = $this->createMock( Category::class );
        $category->method( '__get' )
                 ->with( 'id' )
                 ->willReturn( '22' );

        $categoryRepository = $this->createMock( CategoryRepository::class );
        $categoryRepository->method( 'find' )->willReturn( $category );

        $product = $this->createMock( Product::class );
        $product->method( '__get' )
                ->with( 'category' )
                ->willReturn( $category );

        $productRepository = $this->createMock( ProductRepository::class );
        $productRepository->method( 'find' )->willReturn( $product );
        
        $productRepository->expects( $this->once() )->method( 'update' ); 
        
        $productResponse = ProductUpdateService::execute( 
            $productDto, 
            $productRepository,
            $categoryRepository
        );
        
        self::assertNotNull( $productResponse );
    }
}
