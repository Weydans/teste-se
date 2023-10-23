<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use Doctrine\Common\Collections\Collection;

use App\Domain\Model\Category;
use App\Domain\Service\CategoryDeleteService;
use App\Domain\Repository\CategoryRepository;
use App\Domain\Exception\InvalidDeleteException;

#[CoversClass(CategoryDeleteService::class)]
class CategoryDeleteServiceTest extends TestCase
{
    public function test_execute_should_call_category_repository_delete_method() 
    {
        $collection = $this->createMock( Collection::class );
        $collection->method( 'isEmpty' )
                   ->willReturn( true );

        $category = $this->createMock( Category::class );
        $category->method( '__get' )
                 ->with( 'products' )
                 ->willReturn( $collection );

        $categoryRepository = $this->createMock( CategoryRepository::class );
        $categoryRepository->method( 'find' )->willReturn( $category );
        $categoryRepository->expects( $this->once() )->method( 'delete' );
        
        CategoryDeleteService::execute( 1, $categoryRepository );
    }

    public function test_execute_should_throws_exception_when_category_has_products() 
    {
        self::expectException( InvalidDeleteException::class );

        $collection = $this->createMock( Collection::class );
        $collection->method( 'isEmpty' )
                   ->willReturn( false );

        $category = $this->createMock( Category::class );
        $category->method( '__get' )
                 ->with( 'products' )
                 ->willReturn( $collection );

        $categoryRepository = $this->createMock( CategoryRepository::class );
        $categoryRepository->method( 'find' )->willReturn( $category );
        
        CategoryDeleteService::execute( 1, $categoryRepository );
    }
}
