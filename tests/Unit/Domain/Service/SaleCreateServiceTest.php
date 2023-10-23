<?php

namespace Tests\Unit\Domain\Service;

use App\Domain\Model\Category;
use stdClass;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Model\Product;
use App\Domain\Model\Sale;
use App\Domain\Model\SaleItem;
use App\Domain\Repository\ProductRepository;
use App\Domain\Service\SaleCreateService;
use App\Domain\Repository\SaleRepository;

#[CoversClass(SaleCreateService::class)]
#[UsesClass(Sale::class)]
#[UsesClass(SaleItem::class)]
class SaleCreateServiceTest extends TestCase
{
    public function test_execute_should_call_saleRepository_save_method_and_return_new_sale_on_success() 
    {
        $data1 = new stdClass;
        $data1->id = 1;
        $data1->quantity = 2;

        $data2 = new stdClass;
        $data2->id = 2;
        $data2->quantity = 1;

        $data = ( object ) [ $data1, $data2 ];

        $category = $this->createMock( Category::class );
        $category->method( '__get' )
                 ->with( $this->equalTo( 'tax' ) )
                 ->willReturn( 10 );

        $product1 = $this->createMock( Product::class );
        $product1->expects( $this->any() )
                ->method( '__get' )
                ->willReturnCallback( function( $prop ) use ( $category ) {
                    switch( $prop ) {
                        case 'id':
                            return 1;
                        case 'value':
                            return 100.0;
                        case 'category':
                            return $category;
                    }
                } );

        $product2 = $this->createMock( Product::class );
        $product2->expects( $this->any() )
                ->method( '__get' )
                ->willReturnCallback( function( $prop ) use ( $category ) {
                    switch( $prop ) {
                        case 'id':
                            return 2;
                        case 'value':
                            return 200.0;
                        case 'category':
                            return $category;
                    }
                } );
        
        $productRepository = $this->createMock( ProductRepository::class );
        $productRepository->method( 'all' )
                          ->willReturn( [ $product1, $product2 ] );

        $saleRepository = $this->createMock( SaleRepository::class );
        $saleRepository->expects( $this->once() )->method( 'create' );

        $sale = SaleCreateService::execute( 
            $data, 
            $saleRepository,
            $productRepository
        );
        
        self::assertNotNull( $sale );
    }
}
