<?php

namespace Tests\Unit\Domain\Service;

use stdClass;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Model\Category;
use App\Domain\Service\CategoryUpdateService;
use App\Domain\Repository\CategoryRepository;

#[CoversClass(CategoryUpdateService::class)]
class CategoryUpdateServiceTest extends TestCase
{
    public function test_execute_should_call_categoryRepository_update_method_and_return_updated_category_on_success() 
    {
        $categoryDto = new stdClass;
        $categoryDto->id   = 1;
        $categoryDto->name = 'Valid Name';
        $categoryDto->tax  = 12;

        $category = $this->createMock( Category::class );

        $categoryRepository = $this->createMock( CategoryRepository::class );
        $categoryRepository->method( 'find' )->willReturn( $category );
        $categoryRepository->expects( $this->once() )->method( 'update' ); 
        
        $categoryResponse = CategoryUpdateService::execute( 
            $categoryDto, 
            $categoryRepository
        );
        
        self::assertNotNull( $categoryResponse );
    }
}
