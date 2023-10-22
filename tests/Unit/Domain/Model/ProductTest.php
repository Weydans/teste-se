<?php

namespace Tests\Unit\Domain\Model;

use \Exception;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Model\Product;
use App\Domain\Model\Category;
 
#[CoversClass(Product::class)]
class ProductTest extends TestCase
{
    /**
     * @dataProvider setValueDataProvider
     */
    public function test_setValue_method( $value ) 
    {
        self::expectException(Exception::class );

        $category = $this->createMock( Category::class );

        new Product( 'name', $value, $category );
    }
    
    public static function setValueDataProvider() 
    {
        return [
            'showld_throws_exception_when_value_equals_0' => [
                'value' => 0.00,
            ],
            'showld_throws_exception_when_value_smaller_than_0' => [
                'value' => -0.01,
            ],
        ];
    }
    
    public function test_setValue_method_showld_not_throws_exception_when_is_positive_number() 
    {   
        $value    = 0.01;     
        $category = $this->createMock( Category::class );

        $product = new Product( 'name', $value, $category );
 
        self::assertEquals( $value, $product->value );
    }
}
