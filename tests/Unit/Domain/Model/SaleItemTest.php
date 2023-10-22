<?php

namespace Tests\Unit\Domain\Model;

use App\Domain\Model\Category;
use \Exception;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Model\Product;
use App\Domain\Model\Sale;
use App\Domain\Model\SaleItem;

#[CoversClass(SaleItem::class)]
class SaleItemTest extends TestCase
{
    /**
     * @dataProvider setQuantityDataProvider
     */
    public function test_setQuantity_method( $quantity ) 
    {
        self::expectException( Exception::class );

        $product = $this->createMock( Product::class );

        new SaleItem( $quantity, $product );
    }
    
    public static function setQuantityDataProvider() 
    {
        return [
            'showld_throws_exception_when_quantity_equals_0' => [
                'quantity' => 0,
            ],
            'showld_throws_exception_when_quantity_smaller_than_0' => [
                'quantity' => -1,
            ],
        ];
    }

    public function test_setValue_method_showld_not_throws_exception_when_is_positive_number() 
    {   
        $quantity = 1;     
        $product  = $this->createMock( Product::class );

        $saleItem = new SaleItem( $quantity, $product );
 
        self::assertEquals( $quantity, $saleItem->quantity );
        self::assertEquals( $product, $saleItem->product );
    }

    public function test_setSale_method_showld_hold_a_sale() 
    {   
        $quantity = 1;     
        $product  = $this->createMock( Product::class );
        $sale     = $this->createMock( Sale::class );
            
        $saleItem = new SaleItem( $quantity, $product );
        $saleItem->setSale( $sale );
 
        self::assertEquals( $sale, $saleItem->sale );
    }

    public function test_getTotalTaxes_method_showld_return_correct_value() 
    {   
        $quantity     = 2;     
        $productValue = 100;
        $categoryTax  = 20;
        $totalTaxes   = $quantity * $productValue * $categoryTax / 100;

        $category = $this->createMock( Category::class );
        $category->method( '__get' )
                 ->with( $this->equalTo( 'tax' ) )
                 ->willReturn( $categoryTax );

        $product  = $this->createMock( Product::class );
        $product->expects( $this->any() )
                ->method( '__get' )
                ->willReturnCallback( 
                    function( $prop ) use ( $productValue, $category ) {
                        switch( $prop ) {
                            case 'value':
                                return $productValue;
                            case 'category':
                                return $category;
                        }
                    }
                );

        $saleItem = new SaleItem( $quantity, $product );

        $this->assertEquals( $totalTaxes, $saleItem->getTotalTaxes() ); 
    }

    public function test_getTotal_method_showld_return_correct_value() 
    {   
        $quantity     = 2;     
        $productValue = 100;
        $categoryTax  = 20;

        $total = ( $quantity * $productValue * $categoryTax / 100 ) + $productValue * $quantity;

        $category = $this->createMock( Category::class );
        $category->method( '__get' )
                 ->with( $this->equalTo( 'tax' ) )
                 ->willReturn( $categoryTax );

        $product  = $this->createMock( Product::class );
        $product->expects( $this->any() )
                ->method( '__get' )
                ->willReturnCallback( 
                    function( $prop ) use ( $productValue, $category ) {
                        switch( $prop ) {
                            case 'value':
                                return $productValue;
                            case 'category':
                                return $category;
                        }
                    }
                );

        $saleItem = new SaleItem( $quantity, $product );

        $this->assertEquals( $total, $saleItem->getTotal() ); 
    }
}
