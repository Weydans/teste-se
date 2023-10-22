<?php

namespace Tests\Unit\Domain\Model;

use \Exception;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Model\Category;
 
#[CoversClass(Category::class)]
class CategoryTest extends TestCase
{
    /**
     * @dataProvider setTaxDataProvider
     */
    public function test_setTax_method( $tax ) 
    {
        self::expectException(Exception::class );
        
        new Category( 'name', $tax );
    }
    
    public static function setTaxDataProvider() 
    {
        return [
            'showld_throws_exception_when_tax_smaller_than_0_and_gratter_than_-1' => [
                'tax' => -0.01,
            ],
            'showld_throws_exception_when_tax_smaller_than_-1' => [
                'tax' => -1000,
            ],
        ];
    }
    
    public function test_setTax_method_showld_not_throws_exception_when_is_not_negative_number() 
    {   
        $tax = 0.01;     

        $category = new Category( 'name', $tax );
 
        self::assertEquals( $tax, $category->tax );
    }
}
