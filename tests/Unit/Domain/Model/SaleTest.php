<?php

namespace Tests\Unit\Domain\Model;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Model\Sale;
use App\Domain\Model\SaleItem;

#[CoversClass(Sale::class)]
#[UsesClass(SaleItem::class)]
class SaleTest extends TestCase
{
    public function test_addItem_method_should_hold_guiven_item() 
    {
        $saleItem = $this->createMock( SaleItem::class );
        $sale     = new Sale();
        
        $this->assertEquals( 0, count( $sale->saleItems ) );

        $sale->addItem( $saleItem );

        $this->assertEquals( 1, count( $sale->saleItems ) );
        $this->assertEquals( $saleItem, $sale->saleItems->first() );
    }

    public function test_addItem_method_should_hold_guiven_several_items() 
    {
        $saleItem1 = $this->createMock( SaleItem::class );
        $saleItem2 = $this->createMock( SaleItem::class );
        $saleItem3 = $this->createMock( SaleItem::class );
        $sale      = new Sale();
        
        $this->assertEquals( 0, count( $sale->saleItems ) );

        $sale->addItem( $saleItem1 );
        $sale->addItem( $saleItem2 );
        $sale->addItem( $saleItem3 );

        $this->assertEquals( 3, count( $sale->saleItems ) );
    }
}
