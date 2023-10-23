<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Service\ProductDeleteService;
use App\Domain\Repository\ProductRepository;
use App\Domain\Exception\InvalidDeleteException;
use App\Domain\Model\SaleItem;
use App\Domain\Repository\SaleItemRepository;

#[CoversClass(ProductDeleteService::class)]
class ProductDeleteServiceTest extends TestCase
{
    public function test_execute_should_call_product_repository_delete_method() 
    {
        $saleItemRepository = $this->createMock( SaleItemRepository::class );
        $saleItemRepository->method( 'getByProductId' )->willReturn( [] );

        $productRepository = $this->createMock( ProductRepository::class );
        $productRepository->expects( $this->once() )->method( 'delete' );
        
        ProductDeleteService::execute( 1, $productRepository, $saleItemRepository );
    }

    public function test_execute_should_throws_exception_when_product_has_products() 
    {
        self::expectException( InvalidDeleteException::class );

        $saleItem = $this->createMock( SaleItem::class );

        $saleItemRepository = $this->createMock( SaleItemRepository::class );
        $saleItemRepository->method( 'getByProductId' )->willReturn( [ $saleItem ] );
        
        $productRepository = $this->createMock( ProductRepository::class );

        ProductDeleteService::execute( 1, $productRepository, $saleItemRepository );
    }
}
